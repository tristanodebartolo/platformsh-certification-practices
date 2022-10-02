# Utiliser le service

`Platform.sh Certification Practices 2022` | [Chapitre précédent](./chapter-10.md) | [Sommaire](../README.md) | [Chapitre suivant](./chapter-12.md)

## [Retour aux variables](https://master-7rqtwti-4mh7eev5ydrdo.eu-3.platformsh.site/getstarted/basics/data-services/using-services.html#back-to-variables)

Exécutez la commande suivante à partir de la branche `add-db` localement :

```
touch .environment
```

Copiez ensuite ce qui suit dans ce fichier :

```
export DB_HOST=$(echo $PLATFORM_RELATIONSHIPS | base64 --decode | jq -r '.database[0].host')
export DB_PORT=$(echo $PLATFORM_RELATIONSHIPS | base64 --decode | jq -r '.database[0].port')
export DB_USER=$(echo $PLATFORM_RELATIONSHIPS | base64 --decode | jq -r '.database[0].username')
export DB_PATH=$(echo $PLATFORM_RELATIONSHIPS | base64 --decode | jq -r '.database[0].path')
```

Il s'agit du même paramètre de variable que vous avez effectué à l'étape précédente. Le fichier `.environment` est un fichier que vous pouvez versionner et utiliser pour définir dynamiquement des variables d'environnement accessibles à vos applications. Il provient du conteneur d'application lorsque l'application est déployée, lorsqu'elle est démarrée et lorsque, vous vous connectez en SSH au conteneur.


## [Mettre à jour l'application](https://master-7rqtwti-4mh7eev5ydrdo.eu-3.platformsh.site/getstarted/basics/data-services/using-services.html#update-the-application)

Maintenant, mettez à jour l'application pour utiliser ces variables. Ouvrez le script principal "Hello world", qui pour chaque langue sera le suivant :


- PHP: `web/index.php `
- Python: `server.py`

Supprimez son contenu et remplacez-le par ce qui suit :

```php
<?php

declare(strict_types=1);
require __DIR__.'/../vendor/autoload.php';

try {

    // Connect to the database.
    $dsn = sprintf('mysql:host=%s;port=%d;dbname=%s', getenv("DB_HOST"), getenv("DB_PORT"), getenv("DB_PATH"));

    $conn = new \PDO($dsn, getenv("DB_USER"), "", [
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        \PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => TRUE,
        \PDO::MYSQL_ATTR_FOUND_ROWS => TRUE,
    ]);

    // Creating a table.
    $sql = "CREATE TABLE People (
      id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
      name VARCHAR(30) NOT NULL,
      city VARCHAR(30) NOT NULL
      )";
    $conn->query($sql);

    // Insert data.
    $sql = "INSERT INTO People (name, city) VALUES
        ('Neil Armstrong', 'Moon'),
        ('Buzz Aldrin', 'Glen Ridge'),
        ('Sally Ride', 'La Jolla');";
    $conn->query($sql);

    // Show table.
    $sql = "SELECT * FROM People";
    $result = $conn->query($sql);
    $result->setFetchMode(\PDO::FETCH_OBJ);

    if ($result) {
        print <<<TABLE
<table>
<thead>
<tr><th>Name</th><th>City</th></tr>
</thead>
<tbody>
TABLE;
        foreach ($result as $record) {
            printf("<tr><td>%s</td><td>%s</td></tr>\n", $record->name, $record->city);
        }
        print "</tbody>\n</table>\n";
    }

    // Drop table
    $sql = "DROP TABLE People";
    $conn->query($sql);

} catch (\Exception $e) {
    print $e->getMessage();
}
```

Ce nouveau fichier utilise les variables définies dans `.environment` pour

1. Se connecter àla base de donnée
2. Créer une nouvelle table et ajouter de la donnée
3. Affichez le tableau sur le site déployé.

Commiter et pusher les modifications

```
git add .
git commit -m "Use service in app."
git push platform add-db
```

Une fois le déploiement terminé, l'environnement déployé affichera désormais un tableau montrant les données actuellement dans le service MariaDB :

| Name            | City           |
|-----------------|----------------|
| Neil Armstrong  | Moon           |
| Buzz Aldrin     | Glen Ridge     |
| Sally Ride      | La Jolla       |


Vous pouvez également visualiser ces données directement à l'aide de la commande CLI `platform sql` :

```
platform sql 'SELECT * FROM People;' -q
```

résultat :
```mariadb
+----+----------------+------------+
| id | name           | city       |
+----+----------------+------------+
|  1 | Neil Armstrong | Moon       |
|  2 | Buzz Aldrin    | Glen Ridge |
|  3 | Sally Ride     | La Jolla   |
+----+----------------+------------+
```

## [Branches et fusion](https://master-7rqtwti-4mh7eev5ydrdo.eu-3.platformsh.site/getstarted/basics/data-services/using-services.html#branches-and-merges)

Comme précédemment, prenez un moment pour voir comment ces données héritent lors des branches et des fusions.

Créez un nouvel environnement à partir de l'environnement `add-db` :

```
platform environment:branch add-db-child
```

Une fois le déploiement terminé, vérifiez que toutes les données de l'environnement parent `add-db` se trouvent désormais dans le conteneur de service `add-db-child`.

```
platform sql -e add-db-child 'SELECT * FROM People;' -q
```

Vous verrez les mêmes données sur le nouvel environnement. Autrement dit, le conteneur de base de données sur `add-db-child` est une copie exacte du conteneur de base de données sur son parent, `add-db`. Comme auparavant, ce sera le cas pour n'importe quel parent - plus important encore, tout environnement enfant dérivé de la production (`main`) aura automatiquement accès aux données de production via cet héritage.

Combiné avec les fichiers hérités et le code d'application, chaque environnement de développement est une copie exacte de son parent.

Une fois fusionné, l'environnement de production adoptera notre nouvelle configuration d'infrastructure (il contiendra désormais une base de données), mais il ne contiendra pas les données de cet environnement.


## [Clean up project](https://master-7rqtwti-4mh7eev5ydrdo.eu-3.platformsh.site/getstarted/basics/data-services/using-services.html#clean-up-project)

Fusionnez les modifications dans la production :

```
platform environment:merge -y
```

Après avoir vérifié que le même comportement est désormais présent sur l'environnement de production `main`, nettoyez votre projet en désactivant ces environnements de développement :

```
git checkout main
git pull main
platform environment:deactivate add-db-child --delete-branch -y
platform environment:deactivate add-db --delete-branch -y
```

À ce stade, vous avez un seul environnement actif, Main, votre environnement de production. Cet environnement est un cluster de conteneurs : un conteneur de routeur, un conteneur d'application et un conteneur de service. Chaque environnement enfant que vous branchez à partir de la production à partir de maintenant sera une copie exacte de ce cluster, y compris toutes ses données.

Ce sont de véritables environnements de mise en scène. Vous pouvez désormais créer de nouveaux environnements pour expérimenter de nouvelles fonctionnalités de manière isolée, tester leur comportement et fusionner en production exactement de la même manière.


## [Accéder aux services localement](https://master-7rqtwti-4mh7eev5ydrdo.eu-3.platformsh.site/getstarted/basics/data-services/using-services.html#accessing-services-locally)

Cependant, vous n'allez pas vouloir attendre de voir si quelque chose que vous avez poussé sur Platform.sh réussit pour le faire.

L'interface de ligne de commande Platform.sh fournit une méthode pour se connecter rapidement aux services en direct, afin que vous puissiez tester une nouvelle fonctionnalité avant de la transmettre à l'environnement.

Créons un nouvel environnement

```
platform environment:branch new-feature
```

Localement à partir de la branche `new-feature` nouvellement créée, exécutez la commande

```
platform tunnel:open
```

Après quoi vous verrez le message

`SSH tunnel opened to database at: mysql://user:@127.0.0.1:30000/main`. Un tunnel SSH a été ouvert localement vers le conteneur de service de base de données nouvellement créé sur l'environnement `new-feature`. Ce qui manque encore, ce sont les informations d'identification utilisées sur Platform.sh pour se connecter à ce service.

Exécutez la commande :

```
export PLATFORM_RELATIONSHIPS="$(platform tunnel:info --encode)"
```

Cette commande utilise le tunnel pour se moquer de la variable d'environnement `PLATFORM_RELATIONSHIPS` contenant localement les informations d'identification dont l'application aura besoin pour se connecter au service.


Ensuite, sourcez vos variables d'environnement et exécutez l'application localement pour l'afficher sur `localhost:8000` :

```php
. .environment && php -d variables_order=EGPCS -S localhost:8000 -t web
```

## [Emballer](https://master-7rqtwti-4mh7eev5ydrdo.eu-3.platformsh.site/getstarted/basics/data-services/using-services.html#wrapping-up)

Vous avez maintenant toutes les pièces dont vous avez besoin pour déployer de nouvelles fonctionnalités sur Platform.sh via un développement itératif. Créer un environnement, faire des révisions, vérifier le comportement attendu, fusionner en production.

Les derniers guides de cette section Mise en route couvriront des sujets plus avancés utilisant des bases de code plus complexes que cet exemple simple "Hello world", mais ces principes ne changeront jamais.

Avant de faire cela, il y a quelques très courtes mises en garde à connaître sur le sujet des données.



[Chapitre précédent](./chapter-10.md) | [Sommaire](../README.md) | [Chapitre suivant](./chapter-12.md)

# Mises en garde avec les données

`Platform.sh Certification Practices 2022` | [Chapitre précédent](./chapter-11.md) | [Sommaire](../README.md) | [Chapitre suivant](./chapter-13.md)

## [Où sont passés mes fichiers ?](https://master-7rqtwti-4mh7eev5ydrdo.eu-3.platformsh.site/getstarted/basics/data-services/caveats.html#whered-my-files-go)

Sur la branche `new-feature`, supprimez la valeur `data` du fichier `.gitignore`. Cette modification permettra aux données et à leur contenu d'être versionnés

Ajoutez un autre fichier au dossier **/data**:

```
echo "Another committed file." > data/another_file.txt
```

Poussez ensuite cette modification vers l'environnement :

```
git add .
git commit -m "Commit a mount."
git push platform new-feature
```

À la fin de la phase de construction, vous remarquerez ce message :

```
W: The mount '/data' has a path that overlaps with a non-empty folder.
The content of the non-empty folder either comes from:
- your git repository (you may have accidentally committed files).
- or from the build hook.
Please be aware that this content will not be accessible at runtime.
```

Étant donné qu'un montage a été défini pour `data` dans `.platform.app.yaml`, `data` conserve l'accès en écriture au moment de l'exécution. Mais, vous venez de valider un fichier dont le chemin correspond à cette définition.

Alors que se passe-t-il ?

SSH dans le conteneur et vous verrez que même si les données héritées sont toujours présentes dans le montage, data/another_file.txt ne l'est pas. Lorsque les données ont été montées pendant la phase de déploiement, elles ont remplacé les données dans le référentiel, rendant tout ce qui y était engagé inaccessible.

Ce point est soulevé car certains frameworks nécessitent deux choses simultanément :

1. Un répertoire doit conserver l'accès en écriture lors de l'exécution.
2. Les fichiers de ce répertoire sont versionnés.

Cette mise en garde peut prêter à confusion quant à la destination des fichiers validés. Une façon de contourner ce problème consiste à l'anticiper et à déplacer les données validées en conséquence.

Voici un exemple de section de `hooks` pour illustrer ce propos :

```yml
hooks:
    build: |
        # Place committed files in `data` into a temp directory.
        cp -R data data-tmp
    deploy: |
        # Copy committed files back into the mount at `data`.
        cp -R data-tmp/* data/
```

## [Quand les services sont-ils disponibles ?](https://master-7rqtwti-4mh7eev5ydrdo.eu-3.platformsh.site/getstarted/basics/data-services/caveats.html#when-are-services-available)

La plupart des "règles" de Platform.sh existent pour garder les images de construction **réutilisables et indépendant** de l'environnement à tout moment. C'est pourquoi le système de fichiers est en lecture seule après la phase de construction, et c'est aussi pourquoi le comportement décrit ci-dessus pour les montages se produit pendant la phase de déploiement.

C'est aussi pourquoi *les conteneurs de services (c'est-à-dire les bases de données) **ne sont pas disponibles** pendant la phase de construction*.

Les builds que vous définissez existent de manière isolée, produisant des images de build basées uniquement sur l'état de votre code. Rien dans ce processus n'implique de données, et c'est pour cette raison que les données peuvent être héritées.

Il en va de même pour la variable d'environnement `PLATFORM_RELATIONSHIPS`. Si vous incluez la ligne `echo $PLATFORM_RELATIONSHIPS` quelque part dans votre `hook` de construction (`hooks.build`), il n'y aura pas de sortie. Ce n'est que si vous faites la même chose plus tard dans le pipeline, par exemple pendant le hook de déploiement (`hooks.deploy`), que vous verrez une valeur imprimée dans les journaux.

Bien que n'étant pas spécifiquement lié aux données, le même comportement sera également le cas pour `echo $PLATFORM_ROUTES`. Vous ne pourrez utiliser les itinéraires qu'une fois la phase de construction terminée. Comme les données, l'emplacement d'un conteneur - son URL - n'est pas pertinent dans la création d'une image de construction indépendante de l'environnement.

N'hésitez pas à essayer ces commandes par vous-même dans .platform.app.yaml. Certaines applications, en particulier dans Node.js, attendent des informations d'identification de service ou des routes pendant leurs tâches de génération. Lorsqu'ils le feront, vous rencontrerez cette mise en garde et il sera nécessaire de prendre des mesures pour la contourner.


[Chapitre précédent](./chapter-11.md) | [Sommaire](../README.md) | [Chapitre suivant](./chapter-13.md)

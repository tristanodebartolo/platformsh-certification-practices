# Montrez-moi les données

`Platform.sh Certification Practices 2022`

## [Ajouter des données](https://master-7rqtwti-4mh7eev5ydrdo.eu-3.platformsh.site/getstarted/basics/data-services/mounts.html#add-data)

Veuillez vous positionner, si vous ne l'êtes pas déjà, sur la branche `main`.

```
git checkout main
```

### Désactiver une branche

Puis avec la commande suivante nous allons désactiver la branche `updates`.

```
platform environment:deactivate updates -y
```

En visualisant le projet dans la console de gestion, vous ne pourrez voir l'environnement des `updates` que si le **filtre** *inactif* a été sélectionné.

Bien que la branche `updates` existe toujours sans l'avoir supprimée, il s'agit désormais d'un environnement inactif. Il n'y a plus de site déployé `url` pour cet environnement.

### Données

Créez un nouvel environnement appelé data :

```
git pull platform main
platform environment:branch data
```

Et ajoutons les lignes suivante à la suite du fichier `.platform.app.yaml`.

```yml
disk: 512
mounts:
    'data':
        source: local
        source_path: data
```


[Chapitre précédent](./chapter-8.md) | [Sommaire](../README.md.md) | [Chapitre suivant](./chapter-10.md)

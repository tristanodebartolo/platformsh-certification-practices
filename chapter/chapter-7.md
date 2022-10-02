# Fusionnez votre révision

`Platform.sh Certification Practices 2022` | [Chapitre précédent](./chapter-6.md) | [Sommaire](../README.md) | [Chapitre suivant](./chapter-8.md)

## [Fusionner](https://master-7rqtwti-4mh7eev5ydrdo.eu-3.platformsh.site/getstarted/basics/git-started/merge.html#merge)

Dans votre terminal, exécutez la commande :

```
platform environment:merge -y
```

Après avoir exécuté la commande (et dans vue activité de votre console.platform.sh, à la fois sur les environnements Main et Updates), vous verrez ce qui suit :

```
Are you sure you want to merge updates into its parent, main? [Y/n] y
Merging updates into main
Waiting for the activity zpaw3ozznnpxi (Tristano De Bartolo merged updates into Main):

Preparing to merge environment 'updates' into main
Merge successful
Found 6 new commits

Building application 'app' (runtime type: php:8.0, tree: 6322d09)
  Reusing existing build for this tree ID

Provisioning certificates
  Certificates
  - certificate a361ea6: expiring on 2022-12-30 09:27:24+00:00, covering {,www}.main-bvxea6i-rd33ou34jopkc.fr-4.platformsh.site
...
```

L'environnement des `updates` est fusionné avec `main` - l'environnement de production contient maintenant les mouvelles modifications que vous avez validé. Comme précédemment, juste dans le sens inverse, il n'est pas nécessaire de reconstruire l'application sur l'environnement de production. Aucun code n'a changé pendant l'événement de fusion, la branche par défaut est maintenant juste à l'état (tree) précédemment associé à la branche `updates`.

Pour cette raison, la construction peut être réutilisée et la phase de construction ignorée.

## [Et après](https://master-7rqtwti-4mh7eev5ydrdo.eu-3.platformsh.site/getstarted/basics/git-started/merge.html#whats-next)

Ceci conclut la deuxième partie de ce qui rend **Platform.sh** si utile.

Lors du développement d'une application en production, il faut inévitablement y apporter des modifications au jour le jour. Expérimenter ces changements nécessite de développer sur des environnements - souvent appelé environnement de « mise en scène » `staging` - qui correspondent le plus possible à l'environnement de production. Les raisons pour laquelles vous souhaitez que ces environnements de `staging` correspondent le plus possible à l'environnement de production est que vous devez vous assurer que :

1. Les choses qui fonctionnent sur l'environnement de `staging` continue de fonctionner sur l'environnement de `production`.
2. Que rien d'inattendu ne se produise durant l'opération de fusion des branches de travail avec la production.

Sur Platform.sh, fusionner en production signifie simplement réutiliser une image de build préexistante d'un environnement de développement sur l'environnement de production. Cette image de construction est immuable par conception et ne subira pas de nouvelles étapes qui se briseront lors du déploiement.

Il manque bien sûr un élément important pour vous convaincre de ce processus : **les données**, la base de donnée. Jusqu'à présent, les environnements de développement sur Platform.sh sont identiques à l'environnement de production, `main`, en ce qui concerne l'infrastructure, les configurations, mais il n'y a pas de données de production. Sans données de production, bon nombre de vos tests seront incapables de valider de manière adéquate qu'une nouvelle fonctionnalité fonctionne comme prévu lorsque vos utilisateurs commenceront à interagir avec elle en production..

Dans le prochain chapitre, vous verrez comment Platform.sh fournit un certain nombre de services rapidement configurables (comme par exemple des bases de données) - que nos environnements de développement pourront hériterons, tout comme les conteneurs d'applications. Vous allez ajouter des données à l'environnement et voir comment Platform.sh utilise Git pour fournir automatiquement des données de production à chaque environnement de développement.

Avec ces fonctionnalités, `git branch` devient une commande qui génère des copies exactes de l'environnement de production - de véritables environnements de staging - sur lesquels vous pouvez travailler.

Regardons ça.

[Chapitre précédent](./chapter-6.md) | [Sommaire](../README.md) | [Chapitre suivant](./chapter-8.md)


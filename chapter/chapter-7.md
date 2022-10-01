# Fusionnez votre révision

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

Ceci conclut la deuxième partie de ce qui rend Platform.sh si utile. Lors du développement d'une application de production, vous devrez inévitablement y apporter des modifications au jour le jour. Expérimenter ces changements nécessite de développer un environnement qui correspond le plus possible à la production - souvent appelé environnement de « mise en scène ». La raison pour laquelle vous souhaitez que les environnements de « mise en scène » correspondent si étroitement à la production est que vous pouvez être assuré que :

1. Les choses qui fonctionnent dans la mise en scène continueront de fonctionner dans la production.
2. Rien d'inattendu ne se produit dans l'acte de fusionner avec la production.

Sur Platform.sh, fusionner en production signifie simplement réutiliser une image de build préexistante d'un environnement de développement sur l'environnement de production. Cette image de construction est immuable par conception et ne subira pas de nouvelles étapes qui se briseront lors de l'acte de fusion.

Il manque bien sûr un élément important pour vous convaincre de ce processus : les données. Jusqu'à présent, les environnements de développement sur Platform.sh correspondent à la production en ce qui concerne l'infrastructure, mais sans données de production, nombre de vos tests ne pourront pas approuver de manière adéquate qu'une nouvelle fonctionnalité fonctionnera comme prévu lorsque vos utilisateurs commenceront à interagir avec elle en production.

Dans le prochain guide, vous verrez comment Platform.sh fournit un certain nombre de services gérés - des conteneurs de services communs rapidement configurables (c'est-à-dire des bases de données) - qui sont validés et hérités dans les environnements de développement, tout comme les conteneurs d'applications. Vous allez ajouter des données à l'environnement et voir comment Platform.sh utilise Git pour fournir automatiquement des données de production à chaque environnement de développement.

Avec ces fonctionnalités, git branch devient une commande qui génère des copies exactes de la production - de véritables environnements de staging - sur lesquels vous pouvez travailler.

Regardons ça.

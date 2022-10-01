# Comment fonctionnent les données ?

`Platform.sh Certification Practices 2022`

## [Environnements de staging](https://master-7rqtwti-4mh7eev5ydrdo.eu-3.platformsh.site/getstarted/basics/data-services.html#staging-environments)

Comme vous l'avez vu dans la section précédente, Platform.sh utilise Git pour associer l'état unique d'un référentiel (arborescence) à tous les composants qui composent la façon dont vos applications sont construites et déployées. Le code d'application, les dépendances, les variables visibles à la construction et l'infrastructure font partie d'une image de construction unique, héritée lors de la création de nouveaux environnements et réutilisée lors des fusions.

Mais les données sont différentes - du moins, c'est généralement le cas. Les ingénieurs DevOps passent beaucoup de temps à développer et à maintenir des outils internes qui permettent à une équipe de développement de travailler sur des environnements qui incluent des données de production. Les développeurs eux-mêmes font une demande de fonctionnalité dans un environnement de "développement" pour passer en "staging", auquel cas cet espace "le plus proche possible de la production" doit être mis en place avant que le travail puisse reprendre.

Tout cela prend du temps, mais est essentiel pour faire fonctionner correctement les workflows DevOps. Sans données de production, il n'y a aucun moyen clair de savoir avec certitude qu'une fonctionnalité nouvellement introduite ne cassera pas le site de production lorsqu'elle sera fusionnée.

## [Données sur Platform.sh](https://master-7rqtwti-4mh7eev5ydrdo.eu-3.platformsh.site/getstarted/basics/data-services.html#data-on-platformsh)

Dans la section précédente, vous avez vu comment Git a été exploité dans la création de nouveaux environnements. Dans cette section, vous verrez comment cette même logique s'applique non seulement à l'héritage de l'infrastructure, mais également aux données de production.




[Chapitre précédent](./chapter-7.md) | [Sommaire](../README.md.md) | [Chapitre suivant](./chapter-9.md)

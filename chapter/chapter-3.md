# Qu'est-ce que Platform.sh ?

`Platform.sh Certification Practices 2022`

## [Une note sur DevOps](https://master-7rqtwti-4mh7eev5ydrdo.eu-3.platformsh.site/getstarted/basics/git-started.html#a-note-on-devops)

`Certification Practices Platform.sh 2022` | [Chapitre précédent](./chapter-2.md) | [Sommaire](../README.md) | [Chapitre suivant](./chapter-4.md)

Si vous travaillez aujourd'hui sur un site Web de production, vous avez probablement rencontré le concept de DevOps, qui s'est développé en tant que philosophie pour aider à résoudre les problèmes récurrents liés au déploiement, à la maintenance et au test des sites Web de production. En adoptant [le processus, les outils et la culture](https://azure.microsoft.com/en-us/resources/cloud-computing-dictionary/what-is-devops/) DevOps, cela promet des applications et des workflows cohérents, collaboratifs et sécurisés.

Cela suppose que votre site Web est hébergé quelque part - très probablement dans le cloud - et c'est ensuite à votre équipe de sélectionner les outils dont vous aurez besoin pour incarner ses principes. Quel que soit votre choix, cette combinaison devra permettre à votre équipe de déployer des services spécifiques (c'est-à-dire des bases de données, des runtimes) avec des versions spécifiques de manière cohérente.

Si un correctif de sécurité important est publié, votre équipe devrait être en mesure de mettre à niveau de manière fiable la production vers la dernière version. Chaque modification, y compris les correctifs de sécurité, doit être soigneusement testée avant la fusion dans un environnement isolé aussi proche que possible de la production. Cela signifie un code identique, une infrastructure identique et, surtout, des données de production réelles.

Il existe, comme vous pouvez l'imaginer, un grand nombre d'outils dans cet espace destinés à résoudre des parties de ces problèmes. Le problème est qu'acquérir l'expérience nécessaire pour faire toutes ces choses demande du temps. Vous devrez probablement embaucher une personne dédiée (l'ingénieur DevOps) qui a l'expérience nécessaire pour développer un système interne pour orchestrer le tout. Cette personne passera la majorité de son temps à provisionner l'infrastructure et à fournir des environnements à partir desquels d'autres développeurs peuvent réellement travailler. Ils seront coûteux et une responsabilité à perdre.

Former d'autres membres de l'équipe signifie la même chose : du temps pour acquérir une expertise et du temps non consacré au développement de l'application proprement dite. Mais une partie de la philosophie DevOps implique une adoption culturelle. Autrement dit, DevOps est vraiment destiné à être intuitif et suffisamment ancré dans le travail pour que chaque membre de l'équipe le fasse de manière cohérente.

Et pourtant, sans une sorte d'abstraction, le coût est souvent trop élevé pour l'exécuter réellement.

## [Qu'est-ce que Platform.sh ?](https://master-7rqtwti-4mh7eev5ydrdo.eu-3.platformsh.site/getstarted/basics/git-started.html#what-is-platformsh)

Platform.sh est, en partie, un fournisseur de plateforme en tant que service. Il vise à fournir une abstraction simple pour permettre aux équipes de développement de respecter les principes DevOps dans leur travail quotidien en supprimant l'expertise requise pour le faire. Son API est Git, que vous utilisez probablement déjà, qui exploite ce protocole pour effectuer des tâches courantes telles que les commits, la création de branches et les fusions dans les principaux mécanismes de provisionnement de l'infrastructure et des environnements de staging.

Chaque branche ou demande d'extraction (pull request) devient automatiquement un environnement intermédiaire - complet avec des copies exactes de l'infrastructure de production et des données de production. Bien que vous puissiez choisir d'autres outils pour appliquer d'autres bonnes pratiques DevOps (intégration continue, par exemple), en utilisant Git, votre site dispose déjà de tout ce dont il a besoin pour produire ce type d'environnements de manière régulière, cohérente et sécurisée avec Platform.sh.

Platform.sh est construit autour de l'idée de développement itératif. Étant donné que la création d'environnements de développement est identique à la création de branches et que chaque branche, quel que soit son parent, hérite du code et des données de la même manière, vous pouvez expérimenter librement toute nouvelle fonctionnalité. Vous pouvez apporter de petites modifications de manière isolée et les fusionner en production très rapidement et avec un niveau de confiance élevé. D'un autre côté, si cette expérience ne fonctionne pas, il n'y a aucun problème à supprimer l'environnement et à passer à la tâche suivante.

À ce stade, il sera très utile de passer par un exemple. Une fois que vous aurez l'occasion d'utiliser Platform.sh, vous aurez une bien meilleure idée de son utilité pour résoudre ces problèmes courants. Dans ce guide, vous allez déployer une application et expérimenter de nouvelles modifications dans un environnement de développement isolé. Après cela, vous aurez l'occasion d'étudier exactement comment Platform.sh gère les builds et les fusions.

[Chapitre précédent](./chapter-2.md) | [Sommaire](../README.md) | [Chapitre suivant](./chapter-4.md)





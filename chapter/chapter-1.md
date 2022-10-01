# [A quoi servent ces guides ?](https://master-7rqtwti-4mh7eev5ydrdo.eu-3.platformsh.site/getstarted.html#what-are-these-guides-for)

`Platform.sh Certification Practices 2022`

Platform.sh est une solution DevOps flexible et hautement personnalisable pour le déploiement d'applications Web. Cela dit, il y a quelques règles et quelques connaissances de base en configuration que vous devrez connaître pour commencer à l'utiliser.

Ces guides sont destinés à vous guider à travers ces concepts de base lors du déploiement de votre premier projet. Après cela, des sujets supplémentaires sont couverts pour fournir une portée complète de ce à quoi Platform.sh est utile et pour montrer à quoi ressemble le développement au jour le jour.

Certains des sujets que vous aborderez incluent :

- Développement itératif : déployer votre premier projet, y apporter des modifications, puis le fusionner en production.
- Données : utilisation des services intégrés et exploration de l'héritage des données de production.
- Multi-app : Déployez des applications uniques ou des architectures découplées à partir du même projet.
- Dépannage : découvrez comment interagir avec les projets déployés et enquêtez sur les problèmes.
- Flottes : traduisez les normes de projets uniques en une plus grande flotte de nombreux projets.
- Activités : découvrez comment Platform.sh transforme les événements en activités pouvant être utilisées pour envoyer des notifications importantes.

## [Avant de commencer](https://master-7rqtwti-4mh7eev5ydrdo.eu-3.platformsh.site/getstarted.html#before-starting-out)

Chacun des guides de cette section suppose une certaine compréhension préalable des sujets DevOps conventionnels. Ils supposent une certaine connaissance pratique de Git, SSH, des flux de travail DevOps, des environnements de développement, du CI/CD et de l'infrastructure en tant que code (Iac) comme pratique.

Des ressources utiles sont fournies pour contextualiser différentes de déploiement tout au long de ces guides, mais il est préférable de ne pas s'y fier complètement si c'est la première fois que vous déployez des applications en production ou si vous utilisez le contrôle de version pour créer des copies de ces applications afin d'examiner les modifications apportées. Avant de commencer, passez en revue certains des liens ci-dessous si vous n'êtes pas encore familier.

### [Git](https://master-7rqtwti-4mh7eev5ydrdo.eu-3.platformsh.site/getstarted.html#git)

Platform.sh respecte et s'appuie sur [Git](https://git-scm.com/) en tant que système de contrôle de version pour tous les projets. C'est-à-dire que Platform.sh n'est vraiment que Git sous le capot. Vous pouvez parcourir tous les guides de cette section avec seulement une certaine connaissances DevOps, mais une connaissance préalable de Git (ainsi que son installation sur votre machine) est nécessaire.

Vous trouverez ci-dessous quelques ressources qui peuvent vous aider avec le contexte avant d'aller de l'avant.

- [Atlassian Git Tutorials](https://www.atlassian.com/git/tutorials)
- [What is version control?](https://www.atlassian.com/git/tutorials/what-is-version-control)
- [What is Git?](https://www.atlassian.com/git/tutorials/what-is-version-control)
- [Install Git](https://www.atlassian.com/git/tutorials/install-git)
- [Setting up a repository](https://www.atlassian.com/git/tutorials/setting-up-a-repository)
- [Inspecting a repository](https://www.atlassian.com/git/tutorials/inspecting-a-repository)
- [Using branches](https://www.atlassian.com/git/tutorials/using-branches)
- [GitOps](https://www.atlassian.com/git/tutorials/gitops)

Avant de commencer, assurez-vous que Git est installé sur votre ordinateur.

### [Outils requis](https://master-7rqtwti-4mh7eev5ydrdo.eu-3.platformsh.site/getstarted.html#install-the-cli)

Outre l'expérience avec Git, chacun de ces guides suppose le même point de départ minimum : un compte créé sur Platform.sh et la CLI installée sur votre machine.

#### [Créer un compte](https://master-7rqtwti-4mh7eev5ydrdo.eu-3.platformsh.site/getstarted.html#create-an-account)

Platform.sh fournit un essai gratuit d'un mois, qui fournira toutes les ressources dont vous aurez besoin pour parcourir ces guides de démarrage.

Avant de commencer, assurez-vous de vous inscrire pour [un compte d'essai Platform.sh](https://auth.api.platform.sh/register) si vous ne l'avez pas déjà fait. Vous pouvez utiliser votre adresse e-mail pour vous inscrire, ou vous pouvez vous inscrire en utilisant un compte GitHub, Bitbucket ou Google existant. Si vous choisissez cette option, vous pourrez définir ultérieurement un mot de passe pour votre compte Platform.sh.

Vous aurez alors la possibilité de créer un projet (deux options : **Utiliser un modèle** et **Créer à partir de zéro**). Cliquez sur le bouton Annuler dans le coin droit de l'écran pour l'instant - vous créerez un projet plus loin dans ce guide.

#### [Installer l'interface de ligne de commande](https://master-7rqtwti-4mh7eev5ydrdo.eu-3.platformsh.site/getstarted.html#install-the-cli)

En plus d'un compte Platform.sh, chacun des guides suivants suppose que vous utiliserez l'interface de ligne de commande Platform.sh. La CLI est l'outil principal et le plus utile pour déployer des applications et interagir avec vos projets.

Suivez les étapes ci-dessous pour installer.

##### 1. Installer

Dans votre terminal, exécutez la commande suivante en fonction de votre système d'exploitation :

- Mac
```
curl -fsS https://platform.sh/cli/installer | php
```

- Windows
```
curl -f https://platform.sh/cli/installer -o cli-installer.php
php cli-installer.php
```

##### 2. Authentifier et vérifier

Une fois l'installation terminée, lancez la CLI dans votre terminal avec la commande :

```
platform
```

Connectez-vous à l'aide d'un navigateur. Prenez ensuite un moment pour afficher certaines des commandes disponibles avec la commande :

```
platform list
```

## [Commençons](https://master-7rqtwti-4mh7eev5ydrdo.eu-3.platformsh.site/getstarted.html#get-started)

Après cela, vous êtes prêt à démarrer avec Platform.sh et à déployer votre première application.

[Sommaire](../README.md.md) | [Chapitre suivant](./chapter-2.md)

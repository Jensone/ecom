# Récap des commandes

Récapitulatif des commandes pour installer et configurer Symfony puis implémenter une base de données et des migrations.

---

## Mise en place

Créer un projet Symfony :

```bash
symfony new ecom --webapp
```

La commande `symfony`provient de l'interface de ligne de commande appelée `Symfony CLI`. Lien : [Documentation Symfony](https://symfony.com/download)

---

Créer une BDD :

```bash
symfony console doctrine:database:create
```

Supprimer la BDD :
```bash
symfony console doctrine:database:drop --force
```

Il est d'utiliser des accronyme pour certaines commandes comme les suivantes :

```bash
symfony console d:d:c 
# ou
symfony console d:d:d --force 
```

---

Créer une entité :

```bash
symfony console make:entity
```

Les entités sont le nom des classes de votre diagramme de classe. Il servent à représenter le schéma de votre base de données. Dans le cadre de Symfony, il permettent à Doctrine de faire le lien entre votre modèle et votre base de données.

---

Créer une migration :
```bash
symfony console make:migration
```

Notez qu'il faut à chaque modification d'une entité (des propriétés, et des relations) créer une nouvelle migration.

Exécuter la migration :
```bash
symfony console doctrine:migrations:migrate
```

Raccourci : `symfony console d:m:m`

---

Créer les données de démonstration (fake data) :

Installer les packages nécessaires :

```bash
composer req orm-fixtures --dev
composer req fakerphp/faker --dev
```

`orm-fixtures` : package remplir une base de données de manière automatique.
`fakerphp/faker` : package pour générer des fausses données mais cohérentes pour les tests. Lien : [Documentation Faker](https://fakerphp.org/)

Exécuter la commandes pour créer les données de démonstration :

```bash
symfony console doctrine:fixtures:load
```

Raccourci : `symfony console d:f:l`

---

## Lancer le serveur

```bash
symfony server:start
```

Vous pouvez ajouter le drapeau `-d` pour masquer les logs dans le terminal. ATTENTION, pensez à arrêter le serveur lorsque vous avez terminé de travailler sur votre projet en local.

---

## EasyAdmin

EasyAdmin est un outil de gestion de type administration pour Symfony.

Installer le package nécessaire :

```bash
composer require easycorp/easyadmin-bundle
```

Créer le tableau de bord (Dashboard) :

```bash
symfony console make:admin:dashboard
```

Configurer le CRUD pour les entités souhaitées :

```bash
symfony console make:admin:crud
```

Reste plus qu'à configurer la route et le menu du tableau de bord dans le fichier `src/Controller/Admin/DashocoboardController.php`.

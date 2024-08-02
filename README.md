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

Configurer les formulaire avec des spécificités :

Afin de personnaliser et configuer les champs des formulaire dans EasyAdmin, on se rend dans les fichier 'CrudController'.

Exmple pour l'en tité `Categorie.php` qui est gérée avec un CRUD controller :

```php
<?php

//...

use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;

class CategoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Category::class;
    }

    // ...

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnDetail(), // Affiche uniquement sur la page d'index
            TextField::new('ref')->onlyOnDetail(), // Affiche uniquement sur la page d'index
            TextField::new('name') // TextField est un type de champ de texte
                ->setLabel('Nom de la catégorie') // Ajoute un label
                ->setHelp('Remplissez le nom de la catégorie'), // Ajoute un help
            ImageField::new('image') // ImageField est un type de champ de fichier
                ->setUploadedFileNamePattern('[contenthash].[extension]') // Gère le nom du fichier
                ->setBasePath('images/categories') // Chemin du dossier de base pour afficher les images dans les interfaces
                ->setUploadDir('public/images/categories') // Chemin du dossier de destination pour les images téléversées
        ];
    }
}

```

De nombreuses autres options permettent de personnaliser les champs selon vos beoins. Voici les liend de référence dans la documentation Symfony :

- Fields : https://symfony.com/bundles/EasyAdminBundle/current/fields.html
- Actions : https://symfony.com/bundles/EasyAdminBundle/current/actions.html
- FormFields : https://symfony.com/bundles/EasyAdminBundle/current/fields.html#form-tabs


---

## Utilisateurs

Créer un utilisateur :

```bash
symfony console make:user
```

Le `make:user` crée une entité User avec les attributs par défaut suivants :

- id : identifiant unique de la ligne de la table user
- email : email de la ligne de la table user
- password : mot de passe de la ligne de la table user
- roles : liste des rôles de la ligne de la table user

Pour ajouter des attributs (propriété), il faut utiliser la commande `make:entity` ou le faire à la main.


Création de l'authentification :

```bash
symfony console make:security:form-login
```

Cette commande crée en automatique un controller avec un template qui contiennent le formulaire de connexion accompagné du traitement de l'authentification.


Astuces : 
Pour créer un utilisateur dans les fixtures, pensez à générer un mot de passe hashé avec la commande `symfony console security:hash-password`.


Blocage d'accès aux routes :

Certaine route peuvent être dédiées à un des utilisateur de l'applicatio ou un type d'utilsateur spécifique (via le role).

Pour configurer cela on utilise le pare-feu et l'option située dans le fichier `config/packages/security.yaml`.

```yaml
access_control:
    - { path: ^/login, roles: PUBLIC_ACCESS }
    - { path: ^/admin, roles: ROLE_ADMIN }
    - { path: ^/profile, roles: ROLE_USER }
```

Le premier élément correspond à la route qui mène vers `/admin`. C'est généralement une page d'administration, donc le role `ROLE_ADMIN` est requis pour accéder à cette route.

Le second élément correspond à la route qui mène vers `/profile`. C'est une page de profil d'utilisateur classique, donc le role `ROLE_USER` est requis pour accéder à cette route.

Notez que le role `ROLE_ADMIN` est à la fois `ROLE_USER`par défaut car il le précède dans la hiérarchie de rôle.


Conditions d'affichage basés sur l'utilisateur :

Dans Twig il est possible d'utiliser une variable fournie par Symfony afin d'accèder à l'utilisateur actuel `{{ app.user }}`.

Par exemple, pour afficher un message de bienvenue si l'utilisateur est connecté, on peut utiliser la variable `app.user` ou `is_granted` dans une condition, cela ressemblera à ça :

```twig
{% if app.user %}
    <div class="rounded-md p-3 bg-blue-200 mb-3">
        Welcome {{ app.user.username }}, how are you today ?
    </div>
{% endif %}
```

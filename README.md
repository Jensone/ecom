# Récap des commandes

Récapitulatif des commandes pour installer et configurer Symfony puis implémenter une base de données et des migrations.

---

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

---

Créer une migration :
```bash
symfony console make:migration
```

Exécuter la migration :
```bash
symfony console doctrine:migrations:migrate
```

Importer les données de démo :

```bash
symfony console doctrine:fixtures:load
```


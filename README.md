# Récap

Créer une BDD :
```bash
symfony console doctrine:database:create
```

Supprimer la BDD :
```bash
symfony console doctrine:database:drop --force
```

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


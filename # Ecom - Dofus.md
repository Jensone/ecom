# Ecom - Dofus



### Service :

- PL
- Pack Métier
- Forge Magie
- Téhorie Craft
- etc...

| Propriété | Type | Relation |
| --- | --- | --- |
| id | int | PK |
| ref | string | PK |
| name | string | |
| price | float | |
| description | string | |
| image | string | |
| status | boolean | |
| created_at | datetime | |
| updated_at | datetime | |

---

### Product :

- item issus de l'API DofAPI

Tableau à faire en fonction des données de l'API

---

### Users

| Propriété | Type | Relation |
| --- | --- | --- |
| id | int | PK |
| email | string | |
| password | string | |
| username | string | |
| is_verified | boolean | |
| created_at | datetime | |
| updated_at | datetime | |

---

### Order


### Progress

/progess/start GET,POST
/progress/finish GET

### Cart


### Payment


### Invoice
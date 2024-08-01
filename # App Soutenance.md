# App Soutenance


## Gestion des finances perso

Entités : User, Bank, Transaction, Income, Expense, Category

#### User
| Property | Type | Nullable | Relation |
|----------|------|----------|----------|
| id | int | false | |
|email | string | false | |
| password | string | false | |
| firstname | string | false | |
| lastname | string | false | |
| job | string | false | |
| diploma | string | false | |
| Banks | Bank | true | OneToMany: Bank |
| created_at | datetime | false | |
| updated_at | datetime | false | |

#### Bank
| Property | Type | Nullable | Relation |
|----------|------|----------|----------|
| id | int | false | |
| ref | string | false | |
| Transactions | Transaction | true | OneToMany: Transaction |
| Incomes | Income | true | OneToMany: Income |
| Expenses | Expense | true | OneToMany: Expense |
| created_at | datetime | false | |
| updated_at | datetime | false | |

#### Transaction
| Property | Type | Nullable | Relation |
|----------|------|----------|----------|
| id | int | false | |
| ref | string | false | |
| Income | Income | true | OneToOne: Income |
| Expense | Expense | true | OneToOne: Expense |
| amount | decimal(7, 2) | false | |
| created_at | datetime | false | |
| updated_at | datetime | false | |


#### Category
| Property | Type | Nullable | Relation |
|----------|------|----------|----------|
| id | int | false | |
| ref | string | false | |
| name | string | false | |
| image | string | false | |
| Transactions | Transaction | true | OneToMany: Transaction |
| created_at | datetime | false | |
| updated_at | datetime | false | |

#### Income
| Property | Type | Nullable | Relation |
|----------|------|----------|----------|
| id | int | false | |
| ref | string | false | |
| amount | decimal(7, 2) | false | |
| created_at | datetime | false | |
| updated_at | datetime | false | |

#### Expense
| Property | Type | Nullable | Relation |
|----------|------|----------|----------|
| id | int | false | |
| ref | string | false | |
| amount | decimal(7, 2) | false | |
| created_at | datetime | false | |
| updated_at | datetime | false | |

---

## Quiz interactif en ligne

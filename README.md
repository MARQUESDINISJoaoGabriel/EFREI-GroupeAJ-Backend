# Groupe A 07/11/2025 - Projet Conception Back-End (B3-IN)
## -> Équipe
- MARQUES DINIS Joao Gabriel
- TCHOUSSOKNOU YOUAKOUA Craig Armel
## -> Technologies utilisées
- Symfony
- Composer
- PHP
- phphMyAdmin
- JWT
- POSTMAN
- XAMPP
- 
## -> Pré-requis
- Symfony 5.15.1 || `Symfony CLI version 5.15.1 (c) 2021-2025 Fabien Potencier (2025-10-04T08:05:57Z - stable)`
- PHP 8.4.13 || `PHP version 8.4.13 (C:\php-8.4.13\php.exe)`
- Composer 2.8.12 || `Composer version 2.8.12 2025-09-19 13:41:59`
- POSTMAN / Bruno
- MySQL / ... (Adapter le `.env`)
- XAMPP/WAMP/MAMP (Apache + phpMyAdmin)
## Initialisation
```
git clone https://github.com/MARQUESDINISJoaoGabriel/EFREI-B3-GrpA-0711.git
cd ./EFREI-B3-GrpA-071/
composer install
```
- <strong>/!\</strong> Écrire un `.env` suivant ce modèle :
```python
APP_ENV=dev
APP_SECRET=101ada86cafa370e5d1180fea7968eb0


DATABASE_URL="mysql://root:@127.0.0.1:3306/(NOM_BDD_ICI)?serverVersion=8&charset=utf8mb4"

# Autres BDD custom (supprimer les //)
#// SQLite? // DATABASE_URL="sqlite:///%kernel.project_dir%/var/data_%kernel.environment%.db"
#// MySqL? // DATABASE_URL="mysql://app:!ChangeMe!@127.0.0.1:3306/app?serverVersion=8.0.32&charset=utf8mb4"
#// MariaDB? // DATABASE_URL="mysql://app:!ChangeMe!@127.0.0.1:3306/app?serverVersion=10.11.2-MariaDB&charset=utf8mb4"
#// Postgre? // DATABASE_URL="postgresql://app:!ChangeMe!@127.0.0.1:5432/app?serverVersion=16&charset=utf8"
#// Custom? // DATABASE_URL="typeBDD://nomUser:mdp@localhost:portEcoute/nomBDD?serverVersion=8&charset=utf8mb4"

JWT_SECRET_KEY=%kernel.project_dir%/config/jwt/private.pem
JWT_PUBLIC_KEY=%kernel.project_dir%/config/jwt/public.pem
JWT_PASSPHRASE=692012d3524b92cca514e7a83ee7c68e85193fc789aa897632951428e7aa841f
```
- Continuer avec les commandes suivantes
```
php bin/console doctrine:schema:update --complete --force
php bin/console cache:clear
```

- Exécuter les builds + serveurs
```
symfony serve
```
ou `symfony server:start`

- Dans _AMPP -> Lancer ApacheHTTP + MySQL (phpMyAdmin)
- Dans POSTMAN -> Import -> Copier-Coller ci-dessous les données JSON

## -> Immport données POSTMAN  
```json
{
  "info": {
    "_postman_id": "f1-api-symfony-efrei-2025",
    "name": "EFREI – F1 Infractions API (Symfony + JWT)",
    "description": "Collection Postman pour le projet Symfony EFREI Backend : gestion des écuries, pilotes et infractions (authentification JWT).",
    "schema": "https://schema.getpostman.com/json/collection/v2.1.0/collection.json"
  },
  "item": [
    {
      "name": "Auth – Login JWT",
      "request": {
        "method": "POST",
        "header": [
          { "key": "Content-Type", "value": "application/json" }
        ],
        "body": {
          "mode": "raw",
          "raw": "{\n    \"email\": \"admin@f1api.com\",\n    \"password\": \"admin123\"\n}"
        },
        "url": {
          "raw": "http://127.0.0.1:8000/api/login",
          "protocol": "http",
          "host": ["127.0.0.1"],
          "port": "8000",
          "path": ["api", "login"]
        }
      },
      "response": []
    },
    {
      "name": "Ecuries – Liste (GET)",
      "request": {
        "method": "GET",
        "header": [
          { "key": "Authorization", "value": "Bearer {{jwt_token}}" }
        ],
        "url": {
          "raw": "http://127.0.0.1:8000/api/ecuries",
          "protocol": "http",
          "host": ["127.0.0.1"],
          "port": "8000",
          "path": ["api", "ecuries"]
        }
      },
      "response": []
    },
    {
      "name": "Ecuries – Mise à jour pilotes (PATCH)",
      "request": {
        "method": "PATCH",
        "header": [
          { "key": "Authorization", "value": "Bearer {{jwt_token}}" },
          { "key": "Content-Type", "value": "application/json" }
        ],
        "body": {
          "mode": "raw",
          "raw": "{\n    \"pilotes\": [1, 2, 3]\n}"
        },
        "url": {
          "raw": "http://127.0.0.1:8000/api/ecuries/1/pilotes",
          "protocol": "http",
          "host": ["127.0.0.1"],
          "port": "8000",
          "path": ["api", "ecuries", "1", "pilotes"]
        }
      },
      "response": []
    },
    {
      "name": "Pilotes – Liste complète (GET)",
      "request": {
        "method": "GET",
        "header": [
          { "key": "Authorization", "value": "Bearer {{jwt_token}}" }
        ],
        "url": {
          "raw": "http://127.0.0.1:8000/api/pilotes",
          "protocol": "http",
          "host": ["127.0.0.1"],
          "port": "8000",
          "path": ["api", "pilotes"]
        }
      },
      "response": []
    },
    {
      "name": "Infractions – Liste (GET)",
      "request": {
        "method": "GET",
        "header": [
          { "key": "Authorization", "value": "Bearer {{jwt_token}}" }
        ],
        "url": {
          "raw": "http://127.0.0.1:8000/api/infractions",
          "protocol": "http",
          "host": ["127.0.0.1"],
          "port": "8000",
          "path": ["api", "infractions"]
        }
      },
      "response": []
    },
    {
      "name": "Infractions – Créer (POST - Admin)",
      "request": {
        "method": "POST",
        "header": [
          { "key": "Authorization", "value": "Bearer {{jwt_token}}" },
          { "key": "Content-Type", "value": "application/json" }
        ],
        "body": {
          "mode": "raw",
          "raw": "{\n    \"type\": \"penalite\",\n    \"points\": 3,\n    \"description\": \"Collision avec un autre pilote\",\n    \"course\": \"Grand Prix de Monaco\",\n    \"pilote_id\": 1\n}"
        },
        "url": {
          "raw": "http://127.0.0.1:8000/api/infractions",
          "protocol": "http",
          "host": ["127.0.0.1"],
          "port": "8000",
          "path": ["api", "infractions"]
        }
      },
      "response": []
    },
    {
      "name": "Infractions – Filtre par écurie (GET)",
      "request": {
        "method": "GET",
        "header": [
          { "key": "Authorization", "value": "Bearer {{jwt_token}}" }
        ],
        "url": {
          "raw": "http://127.0.0.1:8000/api/infractions?ecurie=1",
          "protocol": "http",
          "host": ["127.0.0.1"],
          "port": "8000",
          "path": ["api", "infractions"],
          "query": [{ "key": "ecurie", "value": "1" }]
        }
      },
      "response": []
    },
    {
      "name": "Infractions – Filtre par pilote (GET)",
      "request": {
        "method": "GET",
        "header": [
          { "key": "Authorization", "value": "Bearer {{jwt_token}}" }
        ],
        "url": {
          "raw": "http://127.0.0.1:8000/api/infractions?pilote=2",
          "protocol": "http",
          "host": ["127.0.0.1"],
          "port": "8000",
          "path": ["api", "infractions"],
          "query": [{ "key": "pilote", "value": "2" }]
        }
      },
      "response": []
    },
    {
      "name": "Infractions – Filtre par date (GET)",
      "request": {
        "method": "GET",
        "header": [
          { "key": "Authorization", "value": "Bearer {{jwt_token}}" }
        ],
        "url": {
          "raw": "http://127.0.0.1:8000/api/infractions?date=2025-11-07",
          "protocol": "http",
          "host": ["127.0.0.1"],
          "port": "8000",
          "path": ["api", "infractions"],
          "query": [{ "key": "date", "value": "2025-11-07" }]
        }
      },
      "response": []
    }
  ],
  "variable": [
    {
      "key": "jwt_token",
      "value": ""
    }
  ]
}
```

## -> Informations

### Entités

-> Users  
- `id` (int)  
- `email` (string, unique)  
- `password` (string, hashé)  
- `roles` (json)  
> Utilisé pour l’authentification JWT.  
> Un utilisateur par défaut est créé dans les fixtures :  
> **email :** admin@f1api.com / **password :** admin123 (ROLE_ADMIN)

-> Écurie  
- `id` (int)  
- `nom` (string, unique)  
- `moteur` (string)  
- `pilotes` (OneToMany → Pilote)  
> Exemple : Ferrari, Red Bull Racing, Mercedes AMG.  

-> Pilote  
- `id` (int)  
- `prenom` (string)  
- `nom` (string)  
- `points` (int, défaut = 12)  
- `statut` (string : "titulaire", "réserviste", "suspendu")  
- `date_debut_f1` (date)  
- `ecurie` (ManyToOne → Ecurie)  
> Chaque pilote appartient à une écurie.  
> Si un pilote atteint 0 point, son statut devient automatiquement “suspendu”.  

-> Infraction  
- `id` (int)  
- `type` (string : "amende" ou "penalite")  
- `montant` (float, optionnel pour amende)  
- `points` (int, optionnel pour pénalité)  
- `description` (text)  
- `course` (string)  
- `date` (datetime)  
- `pilote` (ManyToOne → Pilote, nullable)  
- `ecurie` (ManyToOne → Ecurie, nullable)  
> Seuls les utilisateurs avec le rôle ADMIN peuvent créer une infraction.  
> Une pénalité en points peut suspendre un pilote si ses points atteignent 0.  

### Routes
```

POST - /api/login

> Authentification JWT (connexion)

GET - /api/ecuries

> Liste toutes les écuries avec leurs pilotes (authentifié)

PATCH - /api/ecuries/{id}/pilotes

> Met à jour les pilotes d'une écurie (admin uniquement)

GET - /api/pilotes

> Liste complète des pilotes et de leurs écuries (authentifié)

GET - /api/infractions

> Liste toutes les infractions (authentifié)
> Filtres disponibles : ?ecurie=ID / ?pilote=ID / ?date=YYYY-MM-DD

POST - /api/infractions

> Crée une nouvelle infraction (admin uniquement)

DELETE - /api/infractions/{id}

> Supprime une infraction (admin uniquement)

```



### Documentation Symfony : https://symfony.com/doc

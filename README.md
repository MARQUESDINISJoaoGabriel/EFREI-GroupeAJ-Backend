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
"sample":"test",
"sample2": {
  "sample21":"test",
  "sample22":"test",
  "table" : [{
      "table1":"test",
      "table2":"test2"
    }]
  }
}
```

## -> Informations
### Entités
->    <br>
->    <br>
->    <br>
### Routes
```
GET-
/
POST-
/
PATCH-
/
DELETE-
/
```
### Documentation Symfony : https://symfony.com/doc

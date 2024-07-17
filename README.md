## Groups project
 - Marc MOUREAU
 - Brévin RENAUD

## Installation

1. Navigate to the project directory:
   cd create-API

2. Install libraries
   `composer install`

4. All data are set in .env. Change just the database line to correspond to your database :
    ```
    DATABASE_URL="mysql://user:password@your-localhost/databasename?charset=utf8mb4"
    ```

5. Run this commands to create the database and migrate it :
   `php bin/console doctrine:database:create`
   `php bin/console make:migration`
   `php bin/console d:m:m`

## Run

1. Start the Symfony development server:
   `symfony serve`

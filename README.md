Serverfireteam Panel Package .
=====

This package provides an easily configurable admin panel for Laravel 4.2 applications with croud and UI and more .

Installtions
====
Note: if you problem in any of steps you should first try to fix it after that it report at [github](https://github.com/serverfireteam/panel/issues/new)


1. First you need have a laravel 4.2 project ready to use . 

2.  Add package to require-dev 

    ```json
    {
        "require-dev": {
            "serverfireteam/panel": "dev-master"
        },
    }
    ```
and run the composer update command, the package and its dependencies will be installed


3.  Add the ServiceProvider of the package to the list of providers in the file config/app.php

    ```php
    'providers' => array(
        'Serverfireteam\Panel\PanelServiceProvider'
    )
    ```

4. Run the following command in order to publishe configs, views and assets.  

    ```bash
    php artisan asset:publish "serverfireteam/panel"
    php artisan asset:publish "zofe/rapyd"
    ```


5. Go to the root of your project and run this command in order to set up the database


    ```bash
    php artisan migrate --path="vendor\serverfireteam\panel\src\database\migrations"
    ```

6. Go to your domain.com/public/panel and you can login with , user : admin , password : 12345



Thank you for using our package 


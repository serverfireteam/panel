#Serverfireteam Panel Package .
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/serverfireteam/panel/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/serverfireteam/panel/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/serverfireteam/panel/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/serverfireteam/panel/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/serverfireteam/panel/badges/build.png?b=master)](https://scrutinizer-ci.com/g/serverfireteam/panel/build-status/master)


**Serverfireteam/panel** is a modern Laravel Admin package. 

This package provides an easily configurable admin panel for Laravel 4.2 applications with croud and UI and more .

## Main features

- **Crud**, Hand free crud for laravel model , just with few line you have Add,Edit,delete,search for your Models, etc.
- **Clean Admin**, Base on bootstrap 3 , sb-admin-2 
- **Dashboard**, It show how many record you have in every models you added in menu 
- **Preconfigured**, It have defult user and models you needs
- **Powerful**, Loign , Admin setting , forget password, all you need for admin panel

## Screen shot 
![dashboard of panel](https://raw.githubusercontent.com/serverfireteam/panel/master/public/img/dashboard.png)
![List of Categories](https://raw.githubusercontent.com/serverfireteam/panel/master/public/img/all_categories.png)
![Edit Category ](https://raw.githubusercontent.com/serverfireteam/panel/master/public/img/edit_category.png)

##RoadMap
We are going to develope this package every days and new idea are wellcome .
We have a [Trello](https://trello.com/b/RDZ6HdK9/framework) board for project , you can check it and send your feedback . 

##Installtions
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
    php artisan asset:publish "serverfireteam/rapyd-laravel"
    ```

5. Go to the root of your project and run this command in order to set up the database

    ```bash
    php artisan migrate --path="vendor/serverfireteam/panel/src/database/migrations"
    ```

6. Go to your domain.com/public/panel and you can login with , user : admin , password : 12345


## Learn to add crud 
We have [WIKI](https://github.com/serverfireteam/panel/wiki) for how to do thing .

Thank you for using our package 


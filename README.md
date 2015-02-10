#Serverfireteam Panel Package .
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/serverfireteam/panel/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/serverfireteam/panel/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/serverfireteam/panel/badges/build.png?b=master)](https://scrutinizer-ci.com/g/serverfireteam/panel/build-status/master)
[![Total Downloads](https://poser.pugx.org/serverfireteam/panel/downloads.svg)](https://packagist.org/packages/serverfireteam/panel)
[![Latest Stable Version](https://poser.pugx.org/serverfireteam/panel/v/stable.svg)](https://packagist.org/packages/serverfireteam/panel)
[![Latest Unstable Version](https://poser.pugx.org/serverfireteam/panel/v/unstable.svg)](https://packagist.org/packages/serverfireteam/panel)
[![License](https://poser.pugx.org/serverfireteam/panel/license.svg)](https://packagist.org/packages/serverfireteam/panel)

**Serverfireteam/panel** is a modern Laravel Admin package. 

This package provides an easily configurable admin panel for Laravel 4.2 applications with croud and UI and more .

## Main features

- **Crud**, Hand free crud for laravel model , just with few line you have Add,Edit,delete,search for your Models, etc.
- **Clean Admin**, Base on bootstrap 3 , sb-admin-2 
- **Dashboard**, It show how many record you have in every models you added in menu 
- **Preconfigured**, It have defult user and models you needs
- **Powerful**, Login , Admin setting , forget password, all you need for admin panel

## Screen shot 
![login](https://raw.githubusercontent.com/serverfireteam/panel/master/public/img/serverfire-panel-login.jpg)
![dashboard of panel](https://raw.githubusercontent.com/serverfireteam/panel/master/public/img/serverfire-panel-dashboard.jpg)

- This is custome crud with few line of code .

![List of Pages](https://raw.githubusercontent.com/serverfireteam/panel/master/public/img/serverfire-panel-crud.jpg)
![Edit Pages](https://raw.githubusercontent.com/serverfireteam/panel/master/public/img/serverfire-panel-crud-edit.jpg)

## Demo 
You can check the [live demo here](http://demo.serverfire.net/panel) .
User: admin
Pass: 12345 



##Installtions
Note: if you  face any problem in steps you should report it at [github](https://github.com/serverfireteam/panel/issues/new)


1. First you need a laravel 4.2 project ready to use . 

2.  Add package to require

    ```json
    {
        "require": {
            "serverfireteam/panel": "1.1.*"
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
    php artisan panel:install

    ```

5. Go to your domain.com/public/panel and you can login with , user : admin@change.me , password : 12345


## Learn to add crud 
We have [WIKI](https://github.com/serverfireteam/panel/wiki) for how to do thing .

#Contribution guidelines 
Fork  it , add the link of your fork to you composer.json , edit it and send it for us . 

#Credits 
[SB-admin](http://startbootstrap.com/template-overviews/sb-admin/) for admin themeplate .
a forked of [rapyd](http://rapyd.com) for crud system .



##RoadMap
We are going to develope this package every days and new idea are wellcome .
We have a [Trello](https://trello.com/b/RDZ6HdK9/framework) board for project , you can check it and send your feedback . 
Fllow us in twitter[@serverfireteam](http://twitter.com/serverfireteam) .

Thank you for using our package 


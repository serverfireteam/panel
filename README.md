#Serverfireteam Panel Package
[![Build Status](https://scrutinizer-ci.com/g/serverfireteam/panel/badges/build.png?b=master)](https://scrutinizer-ci.com/g/serverfireteam/panel/build-status/master)
[![Total Downloads](https://poser.pugx.org/serverfireteam/panel/downloads.svg)](https://packagist.org/packages/serverfireteam/panel)
[![Latest Stable Version](https://poser.pugx.org/serverfireteam/panel/v/stable.svg)](https://packagist.org/packages/serverfireteam/panel)
[![License](https://poser.pugx.org/serverfireteam/panel/license.svg)](https://packagist.org/packages/serverfireteam/panel)

**Serverfireteam/panel** is a modern Laravel Admin package. 

<<<<<<< HEAD
This package provides an easily configurable admin panel for Laravel 4.2 applications with croud and UI and more .

## Main features

- **Crud**, Hand free crud for laravel model , just with few line you have Add,Edit,delete,search for your Models, etc.
- **Clean Admin**, Base on bootstrap 3 , sb-admin-2 
- **Dashboard**, It show how many record you have in every models you added in menu 
- **Preconfigured**, It have defult user and models you needs
- **Powerful**, Login , Admin setting , forget password, all you need for admin panel
=======
This package provides an easily configurable admin panel for Laravel 5 and Laravel 4.2 applications with a CRUD system, UI and more.

## Main features

- **Crud**, With just few lines of code, you'll have Add, Edit, Delete and Search actions for your models.
- **Clean Admin**, Based on bootstrap 3 and sb-admin-2 
- **Dashboard**, It shows how many records you have in every model added in menu.
- **Preconfigured**, It has default users and models you need.
- **Powerful**, It offers a Login section, Admin settings, forgot password and all other features you need for admin panel.
>>>>>>> origin/master

## Screen shot 
![login](https://raw.githubusercontent.com/serverfireteam/panel/master/public/img/serverfire-panel-login.jpg)
![dashboard of panel](https://raw.githubusercontent.com/serverfireteam/panel/master/public/img/serverfire-panel-dashboard.jpg)

<<<<<<< HEAD
- This is custome crud with few line of code .
=======
- This is a custom CRUD with few lines of code :
>>>>>>> origin/master

![List of Pages](https://raw.githubusercontent.com/serverfireteam/panel/master/public/img/serverfire-panel-crud.jpg)
![Edit Pages](https://raw.githubusercontent.com/serverfireteam/panel/master/public/img/serverfire-panel-crud-edit.jpg)

## Demo 
You can check the [live demo here](http://demo.serverfire.net/panel) .
User: admin@change.me
Pass: 12345 



<<<<<<< HEAD
##Installtions
Note: if you  face any problem in steps you should report it at [github](https://github.com/serverfireteam/panel/issues/new)
=======
##Installations for laravel 4
Note: if you face any problem in any of the steps you should report it at [github](https://github.com/serverfireteam/panel/issues/new)
>>>>>>> origin/master

Note : we are working on laravel 5 version in laravel5 bransh of repo 

1. First you need to create a laravel 5 (or laravel 4.2) project.

2. Add our package to require section of composer (Since we haven't released the laravel 5 version yet, for laravel 5 replace "1.1.*" with "dev-laravel5") :

    ```json
    {
        "require": {
            "serverfireteam/panel": "1.1.*"
        },
    }
    ```
And run the composer update command, the package and its dependencies will be installed.


<<<<<<< HEAD
3.  Add the ServiceProvider of the package to the list of providers in the file config/app.php
=======
3. Add the ServiceProvider of the package to the list of providers in the config/app.php file
>>>>>>> origin/master

    ```php
    'providers' => array(
        'Serverfireteam\Panel\PanelServiceProvider'
    )
    ```

4. Run the following command in order to publishe configs, views and assets.  

    ```bash
    php artisan panel:install

    ```

5. Go to your domain.com/public/panel and you can login with the following username and password :

    user : admin@change.me
    password : 12345

<<<<<<< HEAD
## Learn to add crud 
We have [WIKI](https://github.com/serverfireteam/panel/wiki) for how to do thing .

#Contribution guidelines 
Fork  it , add the link of your fork to you composer.json , edit it and send it for us . 

#Credits 
[SB-admin](http://startbootstrap.com/template-overviews/sb-admin/) for admin themeplate .
a forked of [rapyd](http://rapyd.com) for crud system .
=======

## Learn to add CRUD 
We have [WIKI](https://github.com/serverfireteam/panel/wiki) for how to do thing.

#Contribution guidelines 
Fork it, add the link of your forked repo to you composer.json, edit it and send it to us. 

#Credits 
[SB-admin](http://startbootstrap.com/template-overviews/sb-admin/) for admin template.
A forked repo of [rapyd](http://rapyd.com) for CRUD system.
>>>>>>> origin/master



##RoadMap
<<<<<<< HEAD
We are going to develope this package every days and new idea are wellcome .
We have a [Trello](https://trello.com/b/RDZ6HdK9/framework) board for project , you can check it and send your feedback . 
Fllow us in twitter[@serverfireteam](http://twitter.com/serverfireteam) .
=======
We are going to develop this package every day and new ideas are welcome.
We have a [Trello](https://trello.com/b/RDZ6HdK9/framework) board for project, you can check it and send your feedbacks. 
Follow us on twitter[@serverfireteam](http://twitter.com/serverfireteam) .
>>>>>>> origin/master

Thank you for using our package 


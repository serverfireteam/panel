# LaravelPanel

[![Total Downloads](https://poser.pugx.org/serverfireteam/panel/downloads.svg)](https://packagist.org/packages/serverfireteam/panel)
[![Latest Stable Version](https://poser.pugx.org/serverfireteam/panel/v/stable.svg)](https://packagist.org/packages/serverfireteam/panel)
[![License](https://poser.pugx.org/serverfireteam/panel/license.svg)](https://packagist.org/packages/serverfireteam/panel)

**LaravelPanel** is a modern Laravel Admin package. 

This package provides an easily configurable admin panel for Laravel applications with a CRUD system, UI and more.

## Table of Contents
* [Main features](#main-features)
* [Screen shots](#screen-shot)
* [Document](#document)
* [Installation](#Installation)



## Main features

- **Permission/Roles** Create groups , give them access and add users to it 
- **Fully translatable** , 9 languages
- **Crud**, With just few lines of code, you'll have Add, Edit, Delete and Search actions for your models.
- **Column types**: text, select box, checkbox , text editor , datetime, image , autocomplete  , tag ,colorpicker 
- **File manager ** power full file manager inside the text editor 
- **Extension system** that allows you to create own custom column types
- **Sorting, ordering, filters, pagination**
- **Import and Export data** Every  crud you make it have import and export data from Excel  
- **Clean Admin**, Based on bootstrap 3 and sb-admin-2 
- **Dashboard**, It shows how many records you have in every model added in menu.
- **Preconfigured**, It has default users and models you need.
- **Powerful**, It offers a Login section, Admin settings, forgot password and all other features you need for admin panel.
- ** RTL support **


## Screen shot 
- This is a custom CRUD with few lines of code :
![dashboard of panel](https://raw.githubusercontent.com/serverfireteam/panel/master/public/img/serverfire-panel-dashboard.jpg)
![Edit Pages](https://raw.githubusercontent.com/serverfireteam/panel/master/public/img/serverfire-panel-crud-edit.jpg)



## Document
[Read the wiki here](https://github.com/serverfireteam/panel/wiki)


## Installation
First you need to create a laravel 5.8 project.

Add LaravelPanel with runing this code in CMD
    
    composer require serverfireteam/panel

Or Add the package to require section of composer And run the composer update command, the package and its dependencies will be installed.

    {
        "require": {
            "serverfireteam/panel": "1.9.*"
        },
    }



Add the ServiceProvider of the package to the list of providers in the config/app.php file

    'providers' => array(
        Serverfireteam\Panel\PanelServiceProvider::class
    )

Run the following command in order to publish configs, views and assets.

    php artisan panel:install

Go to your domain.com/panel and you can login with the following username and password :

    username: admin@change.me
    password: 12345


[for more details read the wiki here](https://github.com/serverfireteam/panel/wiki)



Good news! We're currently available for remote and on-site consulting for small, large and enterprise teams. Please contact info@serverfire.net with your needs and let's work together!



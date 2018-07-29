# LaravelPanel

[![Total Downloads](https://poser.pugx.org/serverfireteam/panel/downloads.svg)](https://packagist.org/packages/serverfireteam/panel)
[![Latest Stable Version](https://poser.pugx.org/serverfireteam/panel/v/stable.svg)](https://packagist.org/packages/serverfireteam/panel)
[![License](https://poser.pugx.org/serverfireteam/panel/license.svg)](https://packagist.org/packages/serverfireteam/panel)

**LaravelPanel** is a modern Laravel Admin package. 

This package provides an easily configurable admin panel for Laravel applications with a CRUD system, UI and more.

## Screen shot 
- This is a custom CRUD with few lines of code :
![Gallery](http://laravelpanel.com/assets/img/create-gallery-2.png)
![dashboard of panel](https://raw.githubusercontent.com/serverfireteam/panel/master/public/img/serverfire-panel-dashboard.jpg)
![Edit Pages](https://raw.githubusercontent.com/serverfireteam/panel/master/public/img/serverfire-panel-crud-edit.jpg)

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



## Documents    

https://github.com/laravelpanel/docs

## Spatie Laravel Permissions

If you do not already have users functionality on your app, you can run `artisan make:auth` and
`artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider" --tag="migrations"`
before migrating.

As part of the usual spatie/laravel-permission installation, you will need to add:

    'role' => \Spatie\Permission\Middlewares\RoleMiddleware::class,
    'permission' => \Spatie\Permission\Middlewares\PermissionMiddleware::class,

to `app/Http/Kernel.php` in the `$routeMiddleware`, as well as `HasRole` to the User class.

Note that this system expects a pre-configured spatie/laravel-permission and
`App\User` class, with a `users` table.

Run the AdminSeeder to create a super-user (default username and password!) and roles - this is essential,
although you should change the email/password immediately afterwards:

    artisan db:seed --class=Serverfireteam\\Panel\\Database\\Seeders\\AdminSeeder

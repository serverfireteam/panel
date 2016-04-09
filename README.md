#LaravelPanel

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


## Demo 
You can check the [live demo here](http://demo.serverfire.net/panel) .
User: admin@change.me
Pass: 12345 

## Get started
[Get started with laravelpanel](http://laravelpanel.com/docs/master/get-started)

## Documents    
[laravelpanel.com/docs/master](http://laravelpanel.com/docs/master) 

## Read this tutorial
[How to create an Image Gallery with managment system in 5 minutes](http://laravelpanel.com/docs/master/create-gallery)


Do you need help with your laravel project ? [we can help you sent mail to : info@serverfire.net](mailto:info@serverfire.net) 


## Panel Commands, files & namespaces
The LaravelPanel package adds three new artisan commands. 
These are `panel:crud`, `panel:createmodel`, and `panel:createcontroller`.

The first command `panel:crud` is a useful combination of the other two commands, 
and creates both a new model and a matching controller.
The separate `panel:createmodel` and `panel:createcontroller` commands provide the flexibility to create 
models and controllers in any location suited to the project structure.

For all LaravelPanel commands, if the entity name (only) is supplied then LaravelPanel will use *default* locations 
that match the base Laravel structure.
For models, this is the *app* folder, and for controllers, the *app/Http/Controllers* folder

###Examples###

`$ php artisan panel:crud Foo` will create a new model class `Foo`, and also a matching controller class `FooController`.
 The model file will be *app/Foo.php*. It  will be namespaced as `App\Foo`  and `class FOO extends Model;`
 The controller file will be *app/Http/Controllers/FooController.php*, with a namespace of  `App\Http\Controllers`
(Note: the model and the controller then need fleshing out with your code)

###Alternative locations for Models and/or Controllers###
The default locations for models and controllers may be just fine, especially for small projects!
But with a large number of models it may be preferred to keep models and controllers 
stored elsewhere to fit your project structure. 
For example, keeping all models in an *app/Models* folder.
This can easily be achieved using the two separate LaravelPanel commands provided.

For example, creating a Post model and PostController.
`panel:createmodel Models/Post` will create the model file *app/Models/Post* folder, namespaced to `App\Models\Post;` and 
`panel:createcontroller Blog/Post` will create file *app/Http/Controllers/Blog/PostController.php*, again with a correct namespace.




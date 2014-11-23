Serverfireteam Panel Package .
=====

This package provides an easily configurable admin panel for Laravel 4.2 applications with croud and UI and more .

Installtions
====
Note: if you see any error in any of steps you should first fix it or report at [github](https://github.com/serverfireteam/panel/issues/new)


1. First you need have a laravel 4.2 project ready to use . 

2. Add package to require-dev 

```json
{
    "require-dev": {
        "serverfireteam/panel": "dev-master"
    },
}
```

3. Add the ServiceProvider of the package to the list of providers in the file config/app.php

```php
'providers' => array(
    'Serverfireteam\Panel\PanelServiceProvider'
)
```

4. Run the install command which will migrate database and publishes configs, views and assets.  

```bash
php artisan asset:publish "serverfireteam/panel"
```

5. Go to your domain.com/public/panel and you can login with , user : admin , password : 12345



Thank you for using our package 


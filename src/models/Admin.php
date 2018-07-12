<?php
namespace Serverfireteam\Panel;

use App\User;

// Delegate auth
class Admin extends User {
    protected $table = 'users';

    protected static function boot()
    {
        parent::boot();

        parent::observe(new AdminObserver);

        static::addGlobalScope(new AdminScope);
    }
}

<?php
namespace Serverfireteam\Panel;

use App\User;

// Delegate auth
class Admin extends User
{
    public $table = 'users';

    public $guard_name = 'web';

    public function getMorphClass()
    {
        return parent::class;
    }

    public function getForeignKey()
    {
        return Str::snake(parent::class).'_'.$this->getKeyName();
    }

    public static function boot()
    {
        parent::boot();

        parent::observe(new AdminObserver);

        static::addGlobalScope(new AdminScope);
    }
}

<?php
namespace Serverfireteam\Panel;

use App\User;
use Illuminate\Notifications\Notifiable;

// Delegate auth
class Admin extends User {

    use HasRoles;
    use Notifiable;

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new AdminScope);
    }
}

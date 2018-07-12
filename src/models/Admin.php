<?php
namespace Serverfireteam\Panel;

use Illuminate\Auth\Authenticatable;
use App\Models\Users\User;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Support\Facades\Input;
use Illuminate\Notifications\Notifiable;

class Admin extends User implements AuthenticatableContract, CanResetPasswordContract {

    use AdminCanResetPassword;
    use HasRoles;

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new AdminScope);
    }

    /**
     * A user may have multiple roles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany('Serverfireteam\Panel\Role', 'role_user', 'user_id');
    }

    public function getReminderEmail(){  
        $email = Input::only('email');
        return $email['email'];            
    }
}

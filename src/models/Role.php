<?php
namespace Serverfireteam\Panel;

use Illuminate\Database\Eloquent\Model;
use Serverfireteam\Panel\Admin;

class Role extends Model {

    protected $table = 'roles';

    protected $fillable = array('name');

    public function Admin()
    {
        return $this->hasOne('Serverfireteam\Panel\Admin');
    }
}

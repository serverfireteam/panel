<?php
namespace Serverfireteam\Panel;

use Illuminate\Database\Eloquent\Model;

class RoleLink extends Model {

    protected $table = 'role_links';

    protected $fillable = array('role_id', 'link_id');
}

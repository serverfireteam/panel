<?php

namespace Serverfireteam\Panel;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    /**
     * A permission can be applied to roles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    
    protected $fillable = array('name', 'label');

    public function roles()
    {
    	return $this->belongsToMany(Role::class);
    }

    public function getAndSave($url, $label){
    	$this->name = $name;
    	$this->label = $label;
    	$this->save();
    }
}

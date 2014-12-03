<?php
namespace Serverfireteam\Panel;

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Admin extends \Eloquent implements UserInterface{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'admins';
        
         public function getAuthIdentifier()
        {
            return $this->getKey();
        }

        /**
         * Get the password for the user.
         *
         * @return string
         */
        public function getAuthPassword()
        {
            return $this->password;
        }
        
        public function getRememberToken(){
            return $this->rememberToken;
        }
        
        public function  setRememberToken($value){
             $this->rememberToken =  $value;
        }


        public function getRememberTokenName(){
            return $this->rememberTokenName;
        }
        
        protected $fillable = array('first_name', 'last_name', 'email', 'password');
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

}
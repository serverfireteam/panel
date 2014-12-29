<?php
namespace Serverfireteam\Panel;

use Illumiate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;


class Admin extends \Eloquent implements UserInterface, RemindableInterface{

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
            return $this->remember_token;
        }
        
        public function  setRememberToken($value){
             $this->remember_token =  $value;
        }

        public function getReminderEmail(){  
            $email = \Input::only('email');
            return $email['email'];            
        }


        public function getRememberTokenName(){
            return $this->remember_token_name;
        }
        
        protected $fillable = array('first_name', 'last_name', 'email', 'password');
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

}
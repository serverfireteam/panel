<?php
namespace Serverfireteam\Panel;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Support\Facades\Input;
use Illuminate\Notifications\Notifiable;

class Admin extends Model implements AuthenticatableContract, CanResetPasswordContract {

    use Authenticatable, AdminCanResetPassword;
    use HasRoles;
    use Notifiable;
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'admins';
    protected $remember_token_name      = 'remember_token';


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
        $email = Input::only('email');
        return $email['email'];
    }


    public function getRememberTokenName(){
        return $this->remember_token_name;
    }


    /**
     * To get all Admins that has $key and $value on extradata field
     * @param $key
     * @param $value
     * @return mixed
     */
    public function getAllExtraData($key, $value){
        //defined by local scope
        return Admin::getExtraData($key, $value)->get();
        //return Admin::where('extradata->' + $key, $value)->get();
        //JSON_CONTAINS() function accepts the JSON field being searched and another to compare against.
        // It returns 1 when a match is found, e.g.
        //return Admin::whereRaw('JSON_CONTAINS(extradata->"$.' + $key + '", \'["' + $value + '"]\')')->get();
    }

    /**
     * Get all the Admins who has $query in $key on extradata field
     * @param $key
     * @param $query
     * @return mixed
     */
    public function getSearchInExtraData($key, $query){
        //defined by local scope
        return Admin::searchInExtraData($key, $query)->get();
        //return Admin::where('extradata->' + $key, 'like', '%'+ $query + '%')->get();
        //JSON_SEARCH() function returns the path to the given match or NULL when there’s no match.
        // It is passed the JSON document being searched, 'one' to find the first match or 'all' to find all matches, and a search string, e.g.
        //return Admin::whereRaw('JSON_SEARCH(extradata->"$.' + $key + '", "one", "%'+ $query + '%") IS NOT NULL')->get();
    }

    /**
     * add or update admin's picture.
     * @param $pic_base64_encoded
     */
    public function updateAdminPicture($pic_base64_encoded){
        //use forceFill() which will bypass the mass assignment check to perform update on any JSON path,
        // if path is not there, it will be created and if it’s present it will be updated accordingly.
        $this->forceFill(['extradata->picture' => $pic_base64_encoded]);

        # Save the changes
        $this->update();
    }

    /**
     * find admin by primary key id
     * @param $admin_id
     * @return mixed
     */
    public function findById($admin_id){
        // Retrieve a model by its primary key...
        $admin = Admin::find($admin_id);
        // Retrieve the first model matching the query constraints...
        //$admin = Admin::where('id', $admin_id)->first();
        return $admin;
    }

    /**
     * Scope a query to get admin by id.
     * @param $query
     * @param $admin_id
     * @return mixed
     */
    public function scopeFindById($query, $admin_id){
        return $query->where('id', $admin_id);
    }

    /**
     * Scope a query to get admin by a $key and $value in extradata.
     * @param $query
     * @param $key
     * @param $value
     * @return mixed
     */
    public function scopeGetExtraData($query, $key, $value){
        //JSON_CONTAINS() function accepts the JSON field being searched and another to compare against.
        // It returns 1 when a match is found, e.g.
        return $query->whereRaw('JSON_CONTAINS(extradata->"$.' + $key + '", \'["' + $value + '"]\')');
        //return $query->where('extradata->' + $key, $value);
    }

    /**
     * Scope a query to get admin by a $key and search in $value.
     * @param $query
     * @param $key
     * @param $query_value
     * @return mixed
     */
    public function scopeSearchInExtraData($query, $key, $query_value){
        //JSON_SEARCH() function returns the path to the given match or NULL when there’s no match.
        // It is passed the JSON document being searched, 'one' to find the first match or 'all' to find all matches, and a search string, e.g.
        return $query->whereRaw('JSON_SEARCH(extradata->"$.' + $key + '", "one", "%'+ $query_value + '%") IS NOT NULL');
        //return $query->where('extradata->' + $key, 'like', '%'+ $query_value + '%');
    }


    protected $fillable = array('first_name', 'last_name', 'email', 'password');
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');




}
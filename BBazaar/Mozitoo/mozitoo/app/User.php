<?php

namespace App;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements Authenticatable
{
      protected $primaryKey = 'user_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //Aunthenticate for Login
    use \Illuminate\Auth\Authenticatable;

    public function tsSubmittedProperty()
    {
      return $this->hasMany('App\TsSubmittedProperty','prop_id');

    }
    public function tsTaggedProperty()
    {
      return $this->hasMany('App\TsTaggedProperty','prop_tagged_id');

    }
    public function tsEditedProperty()
    {
      return $this->hasMany('App\TsEditedSubmittedProperty','tmp_prop_id');

    }
    public function tsAgentOtherInfo()
    {
       return $this->hasOne('App\TsAgentOtherInfo', 'user_id');
    }
    public function tsTagPropertyRequestFun()
    {
      return $this->hasMany('App\TsTagPropertyRequest','tag_prop_request_id');

    }
    public function userTypeFun()
    {
      return $this->belongsTo('App\MsUserType','user_type_id');

    }
    public function tsServiceRequest()
    {
      return $this->hasMany('App\TsServiceRequest','ts_service_req_id');

    }
    public function isAdmin()
    {
        return $this->admin; // this looks for an admin column in your users table
    }
    public function tsTenantOtherInfo()
    {
       return $this->hasOne('App\TsTenantOtherInfo', 'user_id');
    }
    public function tsOwnerOtherInfo()
    {
       return $this->hasOne('App\TsOwnerOtherInfo', 'user_id');
    }
}

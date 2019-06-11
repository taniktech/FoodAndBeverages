<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TsSubmittedProperty extends Model
{
    //
    protected $primaryKey = 'prop_id';

    public function furnishFUn()
    {
      return $this->belongsTo('App\MsPropertyFurnishStatus','prop_furnish_status_id');

    }

    public function userFun()
    {
      return $this->belongsTo('App\User','user_id');

    }
    public function msPropertyAmentyFun()
    {
      return $this->belongsTo('App\MsPropertyAmenty','prop_amenty_id');

    }
    public function msPropertyUserFun()
    {
      return $this->belongsTo('App\User','user_id');

    }
    public function msPropertyTenantFun()
    {
      return $this->belongsTo('App\MsTenantPrefrence','tenant_prefrences_id');

    }
    public function tsTagPropertyRequestFun()
    {
      return $this->hasMany('App\TsTagPropertyRequest','tag_prop_request_id');

    }
    public function tsServiceRequestFun()
    {
      return $this->hasMany('App\TsServiceRequest','ts_service_req_id');

    }
    public function tsTaggedPropFun()
    {
      return $this->hasMany('App\TsTaggedProperty','prop_tagged_id');

    }
    public function msPropBhkFun()
    {
      return $this->belongsTo('App\MsPropBhkType','prop_bhk_id');

    }
    public function msPropTypeFun()
    {
      return $this->belongsTo('App\MsPropertyType','prop_type_id');

    }
    public function tsPropInvntLevelsFUn()
    {
      return $this->hasMany('App\TsPropInvntLevel','prop_id');

    }
    public function tsPropInvnts()
    {
      return $this->hasOne('App\TsPropInventory','prop_id');

    }
    public function tsPropTenants()
    {
      return $this->hasMany('App\TsPropInventory','prop_id')->where('invnt_status_id', 2)->where('user_id', '!=', 0);

    }
}

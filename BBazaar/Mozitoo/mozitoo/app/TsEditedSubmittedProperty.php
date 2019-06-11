<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TsEditedSubmittedProperty extends Model
{
    //
    protected $primaryKey = 'tmp_prop_id';

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
}

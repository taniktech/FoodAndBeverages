<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MsTenantPrefrence extends Model
{
    //
    protected $primaryKey = 'tenant_prefrences_id';
    public function tsSubmittedProperty()
    {
      return $this->hasMany('App\TsSubmittedProperty','prop_id');

    }
}

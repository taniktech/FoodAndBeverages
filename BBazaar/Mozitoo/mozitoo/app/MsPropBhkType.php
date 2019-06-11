<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MsPropBhkType extends Model
{
    //
    protected $table = 'ms_prop_bhk_types';
    protected $primaryKey = 'prop_bhk_id';
    public function tsSubmittedPropFun()
    {
      return $this->hasMany('App\TsSubmittedProperty','prop_id');

    }

}

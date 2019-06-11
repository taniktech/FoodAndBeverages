<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MsPropertyFurnishStatus extends Model
{
    //
    protected $primaryKey = 'prop_furnish_status_id';
    public function tsSubmittedProperty()
    {
      return $this->hasMany('App\TsSubmittedProperty','prop_id');

    }

    public function tsEditedProperty()
    {
      return $this->hasMany('App\TsEditedSubmittedProperty','tmp_prop_id');

    }
}

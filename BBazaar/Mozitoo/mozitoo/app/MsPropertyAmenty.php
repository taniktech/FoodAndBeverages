<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MsPropertyAmenty extends Model
{
    //
    protected $primaryKey = 'prop_amenty_id';
    public function tsSubmittedProperty()
    {
      return $this->hasMany('App\TsSubmittedProperty','prop_id');

    }
    public function tsEditedProperty()
    {
      return $this->hasMany('App\TsEditedSubmittedProperty','tmp_prop_id');

    }
}

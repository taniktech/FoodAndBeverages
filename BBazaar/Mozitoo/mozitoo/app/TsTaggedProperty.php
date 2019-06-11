<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TsTaggedProperty extends Model
{
    //table details
    protected $table = 'ts_tagged_managers';
    protected $primaryKey = 'prop_tagged_id';
    public function userFun()
    {
      return $this->belongsTo('App\User','user_id');

    }
    public function tsSubmittedPropFun()
    {
      return $this->belongsTo('App\TsSubmittedProperty','prop_id');

    }
}

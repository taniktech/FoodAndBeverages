<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TsPropInvntLevel extends Model
{
    //table namd and primary key
    protected $table = 'ts_prop_invnt_levels';
    protected $primaryKey = 'ts_prop_invnt_level_id';
    public function msPropLevelFun()
    {
      return $this->belongsTo('App\MsPropInvntLevel','prop_invnt_level_id');

    }
    public function tsSubmittedPropFun()
    {
      return $this->belongsTo('App\TsSubmittedProperty','prop_id');

    }
}

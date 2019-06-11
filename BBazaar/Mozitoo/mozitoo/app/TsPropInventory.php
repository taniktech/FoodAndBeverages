<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TsPropInventory extends Model
{
    //table details
    protected $table = 'ts_prop_inventories';
    protected $primaryKey = 'ts_prop_invnt_id';
    public function tsSubmittedPropFun()
    {
      return $this->belongsTo('App\TsSubmittedProperty','prop_id');

    }
    public function msInvntStatusFun()
    {
      return $this->belongsTo('App\MsPropInvntStatus','invnt_status_id');

    }
    public function tenantFun()
    {
      return $this->belongsTo('App\User','user_id');

    }
    public function taggedTenFun()
    {
      return $this->hasOne('App\TsTaggedTenant','ts_prop_invnt_id');

    }
}

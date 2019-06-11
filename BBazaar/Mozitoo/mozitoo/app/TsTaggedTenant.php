<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TsTaggedTenant extends Model
{
    //table details
    protected $table = 'ts_tagged_tenants';
    protected $primaryKey = 'tagged_tenant_id';
    public function tenantFun()
    {
      return $this->belongsTo('App\User','user_id');

    }
    public function invntFun()
    {
      return $this->belongsTo('App\TsPropInventory','ts_prop_invnt_id');

    }
    public function statusFun()
    {
      return $this->belongsTo('App\MsTaggedTenantStatus','tagged_tenant_status_id');

    }
}

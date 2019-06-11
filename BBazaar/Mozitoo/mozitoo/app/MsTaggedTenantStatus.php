<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MsTaggedTenantStatus extends Model
{
   //table details
   protected $table = 'ms_tagged_tenant_statuses';
   protected $primaryKey = 'tagged_tenant_status_id';
}

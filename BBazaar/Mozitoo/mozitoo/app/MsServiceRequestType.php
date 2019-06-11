<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MsServiceRequestType extends Model
{
    //
    protected $primaryKey = 'service_req_type_id';
    public function tsServiceRequests()
    {
      return $this->hasMany('App\TsServiceRequest','ts_service_req_id');

    }
}

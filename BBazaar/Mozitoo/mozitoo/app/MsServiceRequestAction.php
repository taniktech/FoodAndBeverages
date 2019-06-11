<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MsServiceRequestAction extends Model
{
    //
    protected $primaryKey = 'service_req_action_id';
    public function tsServiceRequests()
    {
      return $this->hasMany('App\TsServiceRequest','ts_service_req_id');

    }
}

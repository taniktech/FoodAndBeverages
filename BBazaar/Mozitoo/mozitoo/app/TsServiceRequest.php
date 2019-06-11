<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TsServiceRequest extends Model
{
    //
    protected $primaryKey = 'ts_service_req_id';

    public function serviceTypeFUn()
    {
      return $this->belongsTo('App\MsServiceRequestType','service_req_type_id');

    }
    public function userFun()
    {
      return $this->belongsTo('App\User','user_id');

    }
    public function tsSubmittedPropertyFun()
    {
      return $this->belongsTo('App\TsSubmittedProperty','prop_id');

    }
    public function serviceActionFUn()
    {
      return $this->belongsTo('App\MsServiceRequestAction','service_req_action_id');

    }
}

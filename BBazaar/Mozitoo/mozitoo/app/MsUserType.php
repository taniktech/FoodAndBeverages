<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MsUserType extends Model
{
    //
    protected $primaryKey = 'user_type_id';
    public function msUserTypeFun()
    {
      return $this->hasMany('App\User','user_id');

    }
}

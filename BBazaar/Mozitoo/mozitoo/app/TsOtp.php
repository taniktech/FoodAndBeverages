<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TsOtp extends Model
{
    //table details
    protected $table = 'ts_otps';
    protected $primaryKey = 'ts_otp_id';
}

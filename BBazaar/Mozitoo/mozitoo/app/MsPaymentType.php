<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MsPaymentType extends Model
{
    protected $table = 'ms_payment_types';
    protected $primaryKey = 'payment_type_id';
}

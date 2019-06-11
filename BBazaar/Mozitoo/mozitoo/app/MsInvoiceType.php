<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MsInvoiceType extends Model
{
    //table details
    protected $table = 'ms_invoice_types';
    protected $primaryKey = 'invoice_type_id';
}

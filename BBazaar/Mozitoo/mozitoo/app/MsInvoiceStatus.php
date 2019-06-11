<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MsInvoiceStatus extends Model
{
       //table details
       protected $table = 'ms_invoice_statuses';
       protected $primaryKey = 'invoice_status_id';
}

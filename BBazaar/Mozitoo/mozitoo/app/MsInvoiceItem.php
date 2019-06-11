<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MsInvoiceItem extends Model
{
    //table details
   protected $table = 'ms_invoice_items';
   protected $primaryKey = 'item_type_id';
}

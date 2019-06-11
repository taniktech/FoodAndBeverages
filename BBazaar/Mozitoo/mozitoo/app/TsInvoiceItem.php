<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TsInvoiceItem extends Model
{
       //table details
       protected $table = 'ts_invoice_items';
       protected $primaryKey = 'ts_invoice_item_id';

       public function msItemTypeFun()
       {
         return $this->belongsTo('App\MsInvoiceItem','item_type_id');
   
       }
}

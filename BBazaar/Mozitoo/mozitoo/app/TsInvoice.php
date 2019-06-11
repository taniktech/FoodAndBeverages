<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TsInvoice extends Model
{
    //table details
   protected $table = 'ts_invoices';
   protected $primaryKey = 'ts_invoice_id';

   public function msTenantFun()
   {
     return $this->belongsTo('App\User','user_id');

   }
   public function tsInventoryFun()
   {
     return $this->belongsTo('App\TsPropInventory','ts_prop_invnt_id');

   }
   public function tsPropFun()
   {
     return $this->belongsTo('App\TsSubmittedProperty','prop_id');

   }
   public function msInvoiceStatusFun()
   {
     return $this->belongsTo('App\MsInvoiceStatus','invoice_status_id');

   }
   public function msPaymentType()
   {
     return $this->belongsTo('App\MsPaymentType','payment_type_id');

   }
}

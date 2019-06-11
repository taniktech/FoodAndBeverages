<?php if(isset($data) && !empty($data)): ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <title>Mozitoo Invoice</title>
    <style>
     .float-left
     {
         float: left;
     }     
     .float-right
     {
         float: right;
     }     
    .rent-items > tbody > tr > .no-line {
        border-top: none;
    }
    
    .rent-items > thead > tr > .no-line {
        border-bottom: none;
    }
    
    .rent-items > tbody > tr > .thick-line {
        border-top: 2px solid;
    }
    .p-2
    {
        padding: 2px;
    }
    .upper-table td, th {
        padding: 3px;
    }
    </style>
  </head>
  <body>
    <div class="invoice-logo-section">
        <div class="logo-image">
            <img src="<?php echo e(URL::to('src/images/logos/logo3.png')); ?>" alt="Mozitoo Logo" height="80" width="100"> 
        </div>

    </div>
<!--Top Heading -->
<div class="top-section">
    <div class="text-center">
        <p class=""><?php if(isset($data['invoice_id']) && !empty($data['invoice_id'])): ?>Invoice <?php echo e($data['invoice_id']); ?> <?php else: ?> Not Availble <?php endif; ?></p>
    </div>
    <div class="text-center">      
        <p class=""><?php if(isset($data['for_month']) && !empty($data['for_month'])): ?><?php echo e($data['for_month']); ?> <?php else: ?> Not Availble <?php endif; ?></p>
    </div>   
</div>
<!--Top Heading ends-->
<!--Invoice to Section-->
<div class="invoice-to-section">
    <div class="p-2">Invoice To:-</div>
    <div class="clearfix">
        <div class="float-left">
        <?php if(isset($data['tenant_details']) && !empty($data['tenant_details'])): ?>
            <div class="p-2">
                <strong>Name :</strong>
                <?php if($data['tenant_details']['name']): ?>     
                <?php echo e(ucwords($data['tenant_details']['name'])); ?>

                <?php else: ?>
                Not Availble
                <?php endif; ?>
            </div>
            <div class="p-2">
                <strong>Email :</strong>
                <?php if($data['tenant_details']['email']): ?>     
                <?php echo e($data['tenant_details']['email']); ?>

                <?php else: ?>
                Not Availble
                <?php endif; ?>
            </div>
            <div class="p-2">
                <strong>Mobile :</strong>
                <?php if($data['tenant_details']['mobile']): ?>     
                <?php echo e($data['tenant_details']['mobile']); ?>

                <?php else: ?>
                Not Availble
                <?php endif; ?>
            </div>
            <div class="p-2">
                <strong>Address :</strong>
                <?php if($data['tenant_details']->tsTenantOtherInfo): ?>   
                <?php echo e($data['tenant_details']->tsTenantOtherInfo->address_line_1); ?>, <?php echo e($data['tenant_details']->tsTenantOtherInfo->address_line_2); ?>,<br>
                <?php echo e($data['tenant_details']->tsTenantOtherInfo->city); ?>, <?php echo e($data['tenant_details']->tsTenantOtherInfo->state); ?>

                <?php else: ?>
                Not Availble
                <?php endif; ?>
            </div>
        <?php else: ?> 
        <div class="p-2">Not Availble</div><?php endif; ?>
        </div>
        <div class="float-right">
            <table class="upper-table" style="width:50%;background-color: azure; padding:10px;">
                <tbody>
                    <tr>
                        <td>Invoice Date</td>
                        <td style="background-color: aquamarine;">PLEASE PAY</td>
                        <td>DUE DATE</td>
                    </tr>
                    <tr>
                    <td>
                        <?php if(isset($data['invoice_data']) && !empty($data['invoice_data'])): ?>
                        <?php echo e($data['invoice_data']['created_at']->format('d-m-Y')); ?>

                        <?php else: ?>
                        Not Availble
                        <?php endif; ?>
                    </td>
                    <td style="background-color: aquamarine;">
                        <?php if(isset($data['invoice_data']) && !empty($data['invoice_data'])): ?>
                        <?php echo e($data['invoice_data']['total_amount']); ?>

                        <?php else: ?>
                        Not Availble
                        <?php endif; ?>
                    
                    </td>
                    <td>
                        <?php if(isset($data['invoice_data']) && !empty($data['invoice_data'])): ?>
                        <?php  
                        $f_date=date_create($data['invoice_data']['due_date']);           
                        echo date_format($f_date,"d-m-Y");
                         ?>
                        <?php else: ?>
                        Not Availble
                        <?php endif; ?>
                    </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!--Invoice to Section ends-->
<!--Invoice Items -->
<div class="panel panel-default" style="margin-top:20px;">
    <div class="panel-heading">
        <h3 class="panel-title"><strong>Invoice summary</strong></h3>
    </div>
<div class="invoice-item-section panel-body">
<table class="table rent-items table-condensed">
    <thead>
        <tr>
            <th>Sl.</th>
            <th>Account Head</th>
            <th>Amount (Rs.)</th>
            <th style="width:138px;">NET AMOUNT (Rs.)</th>
        </tr>
    </thead>
    <?php if(isset($data['invoice_item_data']) && !empty($data['invoice_item_data']) && isset($data['invoice_data']) && !empty($data['invoice_data'])): ?>
    <tbody>
        <?php  
        $i = 0
         ?>
        <?php foreach($data['invoice_item_data'] as $item): ?>
        <?php 
        $i++
         ?>
        <tr>
            <td><?php echo e($i); ?></td>
            <td><?php if($item->item_type_id && $item->msItemTypeFun): ?><?php echo e($item->msItemTypeFun->item_type); ?><?php else: ?> Other <?php endif; ?></td>
            <td class="text-left"><?php if($item->amount): ?><?php echo e($item->amount); ?><?php else: ?> 00 <?php endif; ?></td>
            <td class="text-right">
                <?php if($item->total): ?>
                    <?php if($item->item_type_id == 3): ?>
                    - <?php echo e($item->total); ?>

                    <?php else: ?>
                    <?php echo e($item->total); ?>

                    <?php endif; ?>
                <?php else: ?> 000 <?php endif; ?></td>
        </tr>
        <?php endforeach; ?>
        <tr>
            <td class="thick-line"></td>
            <td class="thick-line"></td>
            <td class="thick-line text-left"><strong>Subtotal (Rs.)</strong></td>
            <td class="thick-line text-right">
                <?php if(isset($data['invoice_data']) && !empty($data['invoice_data'])): ?>
                <?php if(isset($data['invoice_data']['total_amount'])): ?>
                <?php echo e($data['invoice_data']['total_amount']); ?>

                <?php endif; ?>
                <?php else: ?>
                000
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <td class="no-line"></td>
            <td class="no-line"></td>
            <td class="no-line text-left"><strong>TDS (Rs.)</strong></td>
            <td class="no-line text-right">
                <?php if(isset($data['invoice_data']) && !empty($data['invoice_data'])): ?>
                <?php if(isset($data['invoice_data']['tds'])): ?>
                <?php echo e($data['invoice_data']['tds']); ?>

                <?php endif; ?>
                <?php else: ?>
                000
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <td class="no-line"></td>
            <td class="no-line"></td>
            <td class="no-line text-left"><strong>GST (Rs.)</strong></td>
            <td class="no-line text-right">
                <?php if(isset($data['invoice_data']) && !empty($data['invoice_data'])): ?>
                <?php if(isset($data['invoice_data']['gst'])): ?>
                <?php echo e($data['invoice_data']['gst']); ?>

                <?php endif; ?>
                <?php else: ?>
                000
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <td class="no-line"></td>
            <td class="no-line"></td>
            <td class="no-line text-left"><strong>Payable (Rs.)</strong></td>
            <td class="no-line text-right">
                <?php if(isset($data['invoice_data']) && !empty($data['invoice_data'])): ?>
                <?php if(isset($data['invoice_data']['payable_amount'])): ?>
                <?php echo e($data['invoice_data']['payable_amount']); ?>

                <?php endif; ?>
                <?php else: ?>
                000
                <?php endif; ?>
            </td>
        </tr>
    </tbody>
    <?php endif; ?>
</table>
</div>
</div>
<!--Invoice Items ends-->
<!--Invoice from Section-->
<div class="invoice-from-section">
    <div class="p-2">Invoice From :-</div>
    <div class="clearfix">
        <div class="float-left" style="width:50%;">
            <?php if(isset($data['owner_details']) && !empty($data['owner_details'])): ?>
            <div class="p-2">
                <strong>Name :</strong>
                <?php if($data['owner_details']['name']): ?>     
                <?php echo e(ucwords($data['owner_details']['name'])); ?>

                <?php else: ?>
                Not Availble
                <?php endif; ?>
            </div>
            <div class="p-2">
                <strong>Email :</strong>
                <?php if($data['owner_details']['email']): ?>     
                <?php echo e($data['owner_details']['email']); ?>

                <?php else: ?>
                Not Availble
                <?php endif; ?>
            </div>
            <div class="p-2">
                <strong>Mobile :</strong>
                <?php if($data['owner_details']['mobile']): ?>     
                <?php echo e($data['owner_details']['mobile']); ?>

                <?php else: ?>
                Not Availble
                <?php endif; ?>
            </div>
            <div class="p-2">
                <strong>Address :</strong>
                <?php if($data['owner_details']->tsOwnerOtherInfo): ?>   
                <?php echo e($data['owner_details']->tsOwnerOtherInfo->address_line_1); ?>, <?php echo e($data['owner_details']->tsOwnerOtherInfo->address_line_2); ?>,<br>
                <?php echo e($data['owner_details']->tsOwnerOtherInfo->city); ?>, <?php echo e($data['owner_details']->tsOwnerOtherInfo->state); ?>

                <?php else: ?>
                Not Availble
                <?php endif; ?>
            </div>
        <?php else: ?> 
        <div class="p-2">Not Availble</div><?php endif; ?>
        </div>
        <div class="float-right">
            <?php if(isset($data['invoice_data']) && !empty($data['invoice_data'])): ?>
            <?php if(isset($data['invoice_data']['invoice_status_id']) && $data['invoice_data']['invoice_status_id'] == 3): ?>
            <?php if($data['invoice_data']['payment_transaction_id']): ?>
            <div class="p-2"><strong>Transaction ID : </strong><?php echo e($data['invoice_data']['payment_transaction_id']); ?></div>
            <div class="p-2"><strong>Date : </strong><?php echo e($data['invoice_data']['updated_at']->format('d-M-Y h:i A')); ?></div>
            <?php endif; ?>
                <div class="paid-invoice-image" style="margin-right:40px;">
                    <img src="<?php echo e(URL::to('src/images/paid.jpg')); ?>" alt="Paid Invoice Image" height="150" width="200"> 
                </div>

            <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
<!--Invoice from Section ends-->
  </body>
</html>
<?php endif; ?>
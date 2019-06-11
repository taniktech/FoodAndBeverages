<?php $__env->startSection('admin'); ?>
<?php $__env->startSection('active5'); ?>
    class="active"
<?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.adminheader', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="main-panel">
  <?php $__env->startSection('DashboardSiteMap'); ?>
      Admin Dashboard / Invoice Details
  <?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.adminnav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="content">
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <?php if(isset($data['invoice_id'])): ?>
                <?php 
                $tmp_id_0 = Crypt::encrypt($data['invoice_data']->ts_invoice_id);                         
                $tmp_id_1 = $data['invoice_data']->for_month;
                $tmp_id_2 = $data['invoice_data']->due_date;
                 ?>   
                <div class="header">
                    <h4 class="title">Invoice Summary : <a href="<?php echo e(route('admin.invoices.get',['tmp_id_0'=>$tmp_id_0,'tmp_id_1'=>$tmp_id_1,'tmp_id_2'=>$tmp_id_2])); ?>" target="_blank"><?php echo e($data['invoice_id']); ?>(Click here to see PDF)</a></h4>
                    <p class="category">Invoice Summary</p>
                </div>
                <?php endif; ?>
                <div class="content">
                     <!--Basic details --> 
                    <div class="row">
                        <div class="col-md-4">
                            <p class="category">Basic Details</p>
                            <?php if(isset($data['invoice_data'])): ?>
                            <div class="table-responsive table-full-width">
                                <table class="table table-striped">
                                <tbody>
                                    <tr>
                                    <td class="text-left">Total Amount</td>
                                    <td class="text-left">:</td>
                                    <td class="text-left">
                                        <?php if($data['invoice_data']->total_amount): ?>
                                            Rs. <?php echo e($data['invoice_data']->total_amount); ?>

                                        <?php else: ?>
                                            Not Availble
                                        <?php endif; ?>
                                    </td> 
                                    </tr>  
                                    <tr>
                                    <td class="text-left">Due Date</td>
                                    <td class="text-left">:</td>
                                    <td class="text-left">
                                        <?php if($data['invoice_data']->due_date): ?>
                                        <?php 
                                        $f_date=date_create($data['invoice_data']->due_date);
                                         ?>
                                        <?php echo e(date_format($f_date,"d-m-Y")); ?>

                                        <?php else: ?>
                                            Not Availble
                                        <?php endif; ?>
                                    
                                    </td> 
                                    </tr>
                                    <tr>
                                    <td class="text-left">For Month</td>
                                    <td class="text-left">:</td>
                                    <td class="text-left">
                                        <?php if($data['invoice_data']->for_month): ?>
                                            <?php 
                                            $f_date=date_create($data['invoice_data']->for_month);
                                             ?>
                                            <?php echo e(date_format($f_date,"F-Y")); ?>

                                        <?php else: ?>
                                            Not Availble
                                        <?php endif; ?>
                                    </td> 
                                    </tr>   
                                </tbody>
                                </table>
                            </div>
                            <?php else: ?>
                            <p class="category">Details Not Availble</p>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-4" style="border-inline-start-style: solid;">
                                <p class="category">Tenant Details</p>
                                <?php if(isset($data['tenant_details'])): ?>
                                <div class="table-responsive table-full-width">
                                    <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                        <td class="text-left">Name</td>
                                        <td class="text-left">:</td>
                                        <td class="text-left">
                                            <?php if($data['tenant_details']->name): ?>
                                                <?php echo e(ucwords($data['tenant_details']->name)); ?>

                                            <?php else: ?>
                                                Not Availble
                                            <?php endif; ?>
                                        </td> 
                                        </tr>  
                                        <tr>
                                        <td class="text-left">Mobile</td>
                                        <td class="text-left">:</td>
                                        <td class="text-left">
                                            <?php if($data['tenant_details']->mobile): ?>
                                                <?php echo e($data['tenant_details']->mobile); ?>

                                            <?php else: ?>
                                                Not Availble
                                            <?php endif; ?>
                                        </td> 
                                        </tr>  
                                        <tr>
                                        <td class="text-left">Email</td>
                                        <td class="text-left">:</td>
                                        <td class="text-left">
                                            <?php if($data['tenant_details']->email): ?>
                                                <?php echo e($data['tenant_details']->email); ?>

                                            <?php else: ?>
                                                Not Availble
                                            <?php endif; ?>
                                        </td> 
                                        </tr> 
                                    </tbody>
                                    </table>
                                </div>
                                <?php else: ?>
                                <p class="category">Details Not Availble</p>
                                <?php endif; ?>
                        </div>
                        <div class="col-md-4" style="border-inline-start-style: solid;">
                                <p class="category">Owner Details</p>
                                <?php if(isset($data['owner_details'])): ?>
                                <div class="table-responsive table-full-width">
                                    <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                        <td class="text-left">Name</td>
                                        <td class="text-left">:</td>
                                        <td class="text-left">
                                            <?php if($data['owner_details']->name): ?>
                                                <?php echo e(ucwords($data['owner_details']->name)); ?>

                                            <?php else: ?>
                                                Not Availble
                                            <?php endif; ?>
                                        </td> 
                                        </tr>  
                                        <tr>
                                        <td class="text-left">Mobile</td>
                                        <td class="text-left">:</td>
                                        <td class="text-left">
                                            <?php if($data['owner_details']->mobile): ?>
                                                <?php echo e($data['owner_details']->mobile); ?>

                                            <?php else: ?>
                                                Not Availble
                                            <?php endif; ?>
                                        </td> 
                                        </tr>  
                                        <tr>
                                        <td class="text-left">Email</td>
                                        <td class="text-left">:</td>
                                        <td class="text-left">
                                            <?php if($data['owner_details']->email): ?>
                                                <?php echo e($data['owner_details']->email); ?>

                                            <?php else: ?>
                                                Not Availble
                                            <?php endif; ?>
                                        </td> 
                                        </tr> 
                                    </tbody>
                                    </table>
                                </div>
                                <?php else: ?>
                                <p class="category">Details Not Availble</p>
                                <?php endif; ?>
                            </div>
                    </div>  
                <hr>  
                <?php if(isset($data['invoice_data']) && $data['invoice_data']['invoice_status_id'] == 3): ?>
                <div class="">
                        <h4 class="title"><span class="text-success">Paid <i class="pe-7s-check"></i></span></h4>
                        <p class="category">Payment Details</p>
                </div>     
                    <div class="table-responsive table-full-width">
                        <table class="table table-striped">
                        <tbody>
                            <tr>
                            <td class="text-left">Transaction ID</td>
                            <td class="text-left">:</td>
                            <td class="text-left">
                                <?php if($data['invoice_data']['payment_transaction_id']): ?>
                                <?php echo e($data['invoice_data']['payment_transaction_id']); ?>

                                <?php else: ?>
                                    Not Availble
                                <?php endif; ?>
                            ,</td>
                            <td class="text-left">Payment Date</td>
                            <td class="text-left">:</td>
                            <td class="text-left">
                                <?php if($data['invoice_data']['updated_at']): ?>
                                    <?php echo e($data['invoice_data']['updated_at']->format('d-M-Y h:i A')); ?>

                                <?php else: ?>
                                    Not Availble
                                <?php endif; ?>
                            ,</td> 
                            <td class="text-left">Amount</td>
                            <td class="text-left">:</td>
                            <td class="text-left">
                                <?php if($data['invoice_data']->total_amount): ?>
                                    Rs. <?php echo e($data['invoice_data']->total_amount); ?>

                                <?php else: ?>
                                    Not Availble
                                <?php endif; ?>
                            ,</td>
                            <td class="text-left">Payment Mode</td>
                            <td class="text-left">:</td>
                            <td class="text-left">
                                <?php if($data['invoice_data']->payment_type_id == 1): ?>
                                    Online
                                <?php else: ?>
                                    Not Availble
                                <?php endif; ?>
                            </td>  
                            </tr> 
                        </tbody>
                        </table> 
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </div>
</div>
</div>
</div>
<?php echo $__env->make('includes.adminfooter', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>
<script>
var token = '<?php echo e(Session::token()); ?>';
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
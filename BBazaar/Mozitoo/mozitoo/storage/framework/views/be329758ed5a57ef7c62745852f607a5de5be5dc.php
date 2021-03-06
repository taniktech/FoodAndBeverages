<?php $__env->startSection('owner'); ?>
<?php $__env->startSection('active3'); ?>
    class="active"
<?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.ownerheader', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="main-panel">
  <?php $__env->startSection('DashboardSiteMap'); ?>
      Owner Dashboard / All Invoices
  <?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.ownernav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="content">
    <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">All Invoices</h4>
                            <p class="category">Details of all Invoices</p>
                        </div>        
                        <div class="content table-responsive table-full-width">
                            <?php if(isset($invoices) && count($invoices) > 0): ?>
                            <table class="table table-hover table-striped">
                                <thead>
                                    <th>Sl.</th>
                                    <th>Status</th>  
                                    <th>Appartment Name</th>                         
                                    <th>Tenant Name</th>
                                    <th>Tenant Email</th>
                                    <th>Tenant Mobile</th>
                                    <th>Invoice Date</th>
                                    <th>For Month</th>
                                    <th>Due Date</th>
                                    <th>Payment Mode</th>
                                    <th>View Invoice</th>
                                </thead>
                                <tbody>
                                    <?php 
                                    $i = 0;
                                     ?>
                                    <?php foreach($invoices as $one_invoice): ?>
                                        <?php 
                                        $i++;
                                         ?>
                                    <tr>
                                        <td><?php echo e($i); ?>.</td>
                                        <td>
                                            <?php if($one_invoice->invoice_status_id && $one_invoice->msInvoiceStatusFun): ?>
                                            <?php if($one_invoice->invoice_status_id == 1): ?>
                                            <span class="text-info"><?php echo e(ucwords($one_invoice->msInvoiceStatusFun->invoice_status)); ?></span>
                                            <?php endif; ?>
                                            <?php if($one_invoice->invoice_status_id == 2): ?>
                                            <span class="text-warning"><?php echo e(ucwords($one_invoice->msInvoiceStatusFun->invoice_status)); ?></span>
                                            <?php endif; ?>
                                            <?php if($one_invoice->invoice_status_id == 3): ?>
                                            <span class="text-success"><?php echo e(ucwords($one_invoice->msInvoiceStatusFun->invoice_status)); ?></span>
                                            <?php endif; ?>
                                            <?php else: ?>
                                                Not Availble
                                            <?php endif; ?>   
                                        </td>
                                        <td>
                                            <?php if($one_invoice->prop_id && $one_invoice->tsPropFun && $one_invoice->tsPropFun->prop_title): ?>
                                            <?php echo e(ucwords($one_invoice->tsPropFun->prop_title)); ?>

                                            <?php else: ?>
                                                N/A
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($one_invoice->user_id && $one_invoice->msTenantFun && $one_invoice->msTenantFun->name): ?>
                                            <?php echo e(ucwords($one_invoice->msTenantFun->name)); ?>

                                            <?php else: ?>
                                                Not Availble
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($one_invoice->user_id && $one_invoice->msTenantFun && $one_invoice->msTenantFun->email): ?>
                                            <?php echo e($one_invoice->msTenantFun->email); ?>

                                            <?php else: ?>
                                                Not Availble
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($one_invoice->user_id && $one_invoice->msTenantFun && $one_invoice->msTenantFun->mobile): ?>
                                            <?php echo e($one_invoice->msTenantFun->mobile); ?>

                                            <?php else: ?>
                                                Not Availble
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($one_invoice->created_at): ?>
                                            <?php echo e($one_invoice->created_at->format('d-m-Y')); ?>

                                            <?php else: ?>
                                                Not Availble
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($one_invoice->for_month): ?>
                                                <?php 
                                                $f_date=date_create($one_invoice->for_month);
                                                 ?>
                                                <?php echo e(date_format($f_date,"F-Y")); ?>

                                            <?php else: ?>
                                                Not Availble
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($one_invoice->due_date): ?>
                                                <?php 
                                                $f_date=date_create($one_invoice->due_date);
                                                 ?>
                                                <?php echo e(date_format($f_date,"d-m-Y")); ?>

                                            <?php else: ?>
                                                Not Availble
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($one_invoice->payment_type_id && $one_invoice->msPaymentType): ?>
                                            <?php echo e($one_invoice->msPaymentType->payment_type); ?>

                                            <?php else: ?>
                                            N/A
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php 
                                            $tmp_id_0 = Crypt::encrypt($one_invoice->ts_invoice_id);                         
                                            $tmp_id_1 = $one_invoice->for_month;
                                            $tmp_id_2 = $one_invoice->due_date;
                                             ?>    
                                            <a href="<?php echo e(route('owner.invoices.get',['tmp_id_0'=>$tmp_id_0,'tmp_id_1'=>$tmp_id_1,'tmp_id_2'=>$tmp_id_2])); ?>" target="_blank">View PDF</a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php else: ?>
                        <div class="alert alert-danger text-center">
                            <span><b> Info - </b> No invoice found !</span>
                        </div>
                        <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<div id="divLoading"> 

</div>
</div>
<?php echo $__env->make('includes.adminfooter', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>
<script>
var token = '<?php echo e(Session::token()); ?>';
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.owner', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
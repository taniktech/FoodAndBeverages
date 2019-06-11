<?php $__env->startSection('pendingone'); ?>
<?php $__env->startSection('active2'); ?>
    class="active"
<?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.tenantheader', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="main-panel">
  <?php $__env->startSection('DashboardSiteMap'); ?>
  Tenant Dashboard / My Home / Unit Details
  <?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.tenantnav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="content">
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h4 class="title">Your Details</h4>
                    <p class="category">Details of tenants of this Unit</p>
                </div>        
                <div class="content table-responsive table-full-width">
                    <?php if(isset($one_tenant) && $one_tenant): ?>
                    <table class="table table-hover table-striped" id="ten-invnt-ten-table">
                        <thead>
                            <th>Status</th>                          
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Monthly Rent</th>
                            <th>Maint. Charge</th>
                            <th>Rent Pay Date</th>
                            <th>Rental Agreement</th>
                        </thead>
                        <tbody>
                                <?php 
                                $id = 0;
                                 ?>
                            <tr>
                                <td>
                                    <?php if(isset($one_tenant->statusFun)): ?>             
                                    <?php if($one_tenant->tagged_tenant_status_id == 1): ?>
                                    <span class="text-success"><?php echo e($one_tenant->statusFun->tagged_tenant_status); ?></span>
                                    <?php endif; ?> 
                                    <?php if($one_tenant->tagged_tenant_status_id == 2): ?>
                                    <span class="text-warning"><?php echo e($one_tenant->statusFun->tagged_tenant_status); ?></span>
                                    <?php endif; ?>        
                                    <?php else: ?> 
                                    N/A
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if(isset($one_tenant->tenantFun) && $one_tenant->tenantFun->name): ?>
                                    <?php 
                                    $ten = $one_tenant->user_id;
                                    $id = $one_tenant->tagged_tenant_id;
                                     ?> 
                                    <?php echo e(ucwords($one_tenant->tenantFun->name)); ?>

                                    <?php else: ?> 
                                    N/A
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if(isset($one_tenant->tenantFun) && $one_tenant->tenantFun->email): ?>
                                    <?php echo e($one_tenant->tenantFun->email); ?>

                                    <?php else: ?> 
                                    N/A
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if(isset($one_tenant->tenantFun) && $one_tenant->tenantFun->mobile): ?>
                                    <?php echo e($one_tenant->tenantFun->mobile); ?>

                                    <?php else: ?> 
                                    N/A
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if(isset($one_tenant->start_date)): ?>
                                    <?php 
                                        $s_date=date_create($one_tenant->start_date);
                                     ?>
                                    <?php echo e(date_format($s_date,"d-M-Y")); ?>

                                    <?php else: ?> 
                                    N/A
                                    <?php endif; ?>
                                </td>
                                <?php if($one_tenant->tagged_tenant_status_id == 1 && isset($one_tenant->invntFun)): ?>
                                <td>     
                                    Present
                                </td>
                                <td>     
                                <?php if(isset($one_tenant->invntFun->rent)): ?>
                                <?php echo e($one_tenant->invntFun->rent); ?>

                                <?php else: ?> 
                                    N/A
                                <?php endif; ?>
                                </td>
                                <td>
                                <?php if(isset($one_tenant->invntFun->maint_charge)): ?>
                                <?php echo e($one_tenant->invntFun->maint_charge); ?>

                                <?php else: ?> 
                                    N/A
                                <?php endif; ?>
                                </td>
                                <td>
                                    <?php if(isset($one_tenant->invntFun->rent_pay_date)): ?>
                                    <?php echo e($one_tenant->invntFun->rent_pay_date); ?>

                                    <?php else: ?> 
                                        N/A
                                    <?php endif; ?>
                                </td>
                                <?php endif; ?>
                                <?php if($one_tenant->tagged_tenant_status_id == 2): ?>
                                <td>  
                                    <?php if(isset($one_tenant->end_date)): ?>   
                                    <?php 
                                    $e_date=date_create($one_tenant->end_date);
                                     ?>
                                    <?php echo e(date_format($e_date,"d-M-Y")); ?>

                                    <?php else: ?> 
                                    N/A
                                    <?php endif; ?>
                                </td>
                                <td>     
                                <?php if(isset($one_tenant->rent)): ?>
                                <?php echo e($one_tenant->rent); ?>

                                <?php else: ?> 
                                    N/A
                                <?php endif; ?>
                                </td>
                                <td>
                                <?php if(isset($one_tenant->maint_charge)): ?>
                                <?php echo e($one_tenant->maint_charge); ?>

                                <?php else: ?> 
                                    N/A
                                <?php endif; ?>
                                </td>
                                <td>
                                    <?php if(isset($one_tenant->rent_pay_date)): ?>
                                    <?php echo e($one_tenant->rent_pay_date); ?>

                                    <?php else: ?> 
                                        N/A
                                    <?php endif; ?>
                                </td>
                                <?php endif; ?>
                                <td>
                                    <?php if(Storage::disk('rental_agrmnts')->has($id.'.pdf')): ?>
                                    <?php  
                                    $tmp_id_0 = Crypt::encrypt($id);
                                     ?>
                                    <a href="<?php echo e(route('tenant.rental.agreement.get',['tmp_id_1'=>$tmp_id_0, 'Agreement'=>'Agreement'])); ?>" target="_blank">View PDF</button>
                                    <?php else: ?>
                                    <button type="button" class="u-r-a-ten-p btn btn-info" data-idd="<?php echo e($id); ?>">Upload</button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                <?php else: ?>
                <div class="alert alert-danger text-center">
                    <span><b> Info - </b> There is no history of tenants</span>
                </div>
                <?php endif; ?>
                </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">All Invoices</h4>
                            <p class="category">Details of invoices against this Inventory</p>
                        </div>        
                        <div class="content table-responsive table-full-width">
                            <?php if(isset($invoices) && count($invoices) > 0): ?>
                            <table class="table table-hover table-striped">
                                <thead>
                                    <th>Sl.</th>
                                    <th>Status</th>                           
                                    <th>Tenant Name</th>
                                    <th>Tenant Email</th>
                                    <th>Tenant Mobile</th>
                                    <th>Invoice Date</th>
                                    <th>For Month</th>
                                    <th>Due Date</th>
                                    <th>View Invoice</th>
                                    <th>Action</th>
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
                                            <?php 
                                            $tmp_id_0 = Crypt::encrypt($one_invoice->ts_invoice_id);                         
                                            $tmp_id_1 = $one_invoice->for_month;
                                            $tmp_id_2 = $one_invoice->due_date;
                                             ?>    
                                            <a href="<?php echo e(route('tenant.invoices.get.one',['tmp_id_0'=>$tmp_id_0,'tmp_id_1'=>$tmp_id_1,'tmp_id_2'=>$tmp_id_2])); ?>" target="_blank">View PDF</a>
                                        </td>
                                        <td>
                                        <?php if($one_invoice->invoice_status_id && $one_invoice->msInvoiceStatusFun): ?>
                                        <?php if($one_invoice->invoice_status_id == 2 && $one_invoice->payment_transaction_id == 0): ?>
                                        <a href="<?php echo e(route('tenant.go.to.pay',['tmp_id_0'=>$tmp_id_0,'tmp_id_1'=>$tmp_id_1])); ?>">Pay Now</a>
                                        <?php else: ?> 
                                        <a href="<?php echo e(route('tenant.invoices.download',['tmp_id_0'=>$tmp_id_0,'tmp_id_1'=>$tmp_id_1,'tmp_id_2'=>$tmp_id_2])); ?>">Download</a>
                                        <?php endif; ?>
                                        <?php endif; ?>
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
<div class="modal" tabindex="-1" role="dialog" id="upload-ten-rental-agrmnt" data-backdrop="false" aria-labelledby="myModalLabel" style="background-color: rgba(0, 0, 0, 0.5);">
        <div class="modal-dialog">
            <div class="modal-content">
                <div style="" class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Upload Rental Agreement</h4>
                </div>
                <div class="modal-body">
                    <form id="oat-rental-ten-agrmnt-up" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Select PDF Document</label>
                        <input name="oat_rental_agrmnt" class="file" type="file" data-show-upload="false">
                    </div>
                    <div class="text-right">
                    <button type="submit" class="btn btn-info btn-fill">Upload</button>
                    </div>
                    </form>
                </div>
          </div>
        </div>
      </div><!-- /.modal -->
</div>
<?php echo $__env->make('includes.adminfooter', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>
<script>
var token = '<?php echo e(Session::token()); ?>';
var url_renatl_upload = '<?php echo e(route('rental.tenant.agreement.upload')); ?>';
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.tenant', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
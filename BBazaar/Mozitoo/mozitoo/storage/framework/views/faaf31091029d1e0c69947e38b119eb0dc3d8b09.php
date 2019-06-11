<?php $__env->startSection('admin'); ?>
<?php $__env->startSection('active5'); ?>
    class="active"
<?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.adminheader', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="main-panel">
  <?php $__env->startSection('DashboardSiteMap'); ?>
      Admin Dashboard / All Invoices
  <?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.adminnav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="content">
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="content">
                        <div class="row">
                            <div class="col-xs-3">
                                <div class="icon-big icon-info text-center">
                                    <i class="pe-7s-user"></i>
                                </div>
                            </div>
                            <div class="col-xs-9">
                                <div class="numbers">
                                    <p>Draft Invoices</p>
                                    <?php if($dr_invoices): ?>
                                    <?php echo e(count($dr_invoices)); ?>

                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="footer">
                            <hr />
                            <div class="stats">
                                <?php if($dr_invoices && count($dr_invoices) > 0): ?>
                                <a href="<?php echo e(route('admin.invoices.get.draft')); ?>"><i class="pe-7s-angle-right-circle"></i> View </a>
                                <?php else: ?>
                                <a href="<?php echo e(route('admin.invoices.views')); ?>"><i class="pe-7s-angle-right-circle"></i> Refresh </a>
                                <?php endif; ?>  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card">
                <div class="content">
                    <div class="row">
                        <div class="col-xs-3">
                            <div class="icon-big icon-success text-center">
                                <i class="pe-7s-check"></i>
                            </div>
                        </div>
                        <div class="col-xs-9">
                            <div class="numbers">
                                <p>Pending Invoices</p>
                                <?php if($pend_invoices): ?>
                                <?php echo e(count($pend_invoices)); ?>

                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="footer">
                        <hr />
                        <div class="stats">
                            <?php if($pend_invoices && count($pend_invoices) > 0): ?>
                            <a href="<?php echo e(route('admin.invoices.get.pending')); ?>"><i class="pe-7s-angle-right-circle"></i> View </a>
                            <?php else: ?>
                            <a href="<?php echo e(route('admin.invoices.views')); ?>"><i class="pe-7s-angle-right-circle"></i> Refresh </a>
                            <?php endif; ?>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card">
                <div class="content">
                    <div class="row">
                        <div class="col-xs-3">
                            <div class="icon-big icon-success text-center">
                                <i class="pe-7s-refresh-2"></i>
                            </div>
                        </div>
                        <div class="col-xs-9">
                            <div class="numbers">
                                <p>Paid Invoices</p>
                                
                            </div>
                        </div>
                    </div>
                    <div class="footer">
                        <hr />
                        <div class="stats">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
        <div class="card">
            <div class="content">
                <div class="row">
                    <div class="col-xs-3">
                        <div class="icon-big icon-warning text-center">
                            <i class="pe-7s-attention"></i>
                        </div>
                    </div>
                    <div class="col-xs-9">
                        <div class="numbers">
                            <p>Tab 4</p>
                            
                        </div>
                    </div>
                </div>
                <div class="footer">
                    <hr />
                    <div class="stats">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="content">
                <!-- Single button -->
                <div class="text-right">
                <button type="submit" class="btn btn-warning btn-fill" id="send-reminder" style="">Send Reminders</button>
                <div class="btn-group">
                    <button type="button" class="btn btn-fill btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Create Invoice <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                    <li><a href="<?php echo e(route('admin.invoices.create.bulk.view')); ?>">Bulk Invoice</a></li>
                    <li><a href="<?php echo e(route('admin.invoices.create.custom.view')); ?>">Custom Invoice</a></li>
                    </ul>
                </div>
                </div>
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
                    <h4 class="title">All Invoices List</h4>
                    <p class="category">All Invoices List</p>
                </div>        
                <div class="content table-responsive table-full-width">
                    <?php if(count($all_invoices) > 0): ?>
                    <table class="table table-hover table-striped">
                        <thead>
                            <th>Sl.</th>
                            <th>Status</th>
                            <th>Property</th>
                            <th>Inventory ID</th>                            
                            <th>Tenant Name</th>
                            <th>Tenant Email</th>
                            <th>Tenant Mobile</th>
                            <th>Invoice Date</th>
                            <th>For Month</th>
                            <th>Due Date</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <?php 
                            $i = 0;
                             ?>
                            <?php foreach($all_invoices as $one_item): ?>
                                <?php 
                                $i++;
                                 ?>
                            <tr>
                                <td><?php echo e($i); ?>.</td>
                                <td>
                                    <?php if($one_item->invoice_status_id && $one_item->msInvoiceStatusFun): ?>
                                    <?php if($one_item->invoice_status_id == 1): ?>
                                    <p class="text-info"><?php echo e(ucwords($one_item->msInvoiceStatusFun->invoice_status)); ?></p>
                                    <?php endif; ?>
                                    <?php if($one_item->invoice_status_id == 2): ?>
                                    <p class="text-warning"><?php echo e(ucwords($one_item->msInvoiceStatusFun->invoice_status)); ?></p>
                                    <?php endif; ?>
                                    <?php if($one_item->invoice_status_id == 3): ?>
                                    <p class="text-success"><?php echo e(ucwords($one_item->msInvoiceStatusFun->invoice_status)); ?></p>
                                    <?php endif; ?>
                                    <?php else: ?>
                                        Not Availble
                                    <?php endif; ?>

                                </td>
                                <td>
                                    <?php if($one_item->prop_id && $one_item->tsPropFun && $one_item->tsInventoryFun->prop_id == $one_item->prop_id): ?>
                                    <?php echo e(ucwords($one_item->tsPropFun->prop_title)); ?>

                                    <?php else: ?>
                                        Not Availble
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($one_item->ts_prop_invnt_id && $one_item->tsInventoryFun && $one_item->tsInventoryFun->fomatted_invnt_id && $one_item->tsInventoryFun->prop_id == $one_item->prop_id): ?>
                                    <?php echo e(ucwords($one_item->tsInventoryFun->fomatted_invnt_id)); ?>

                                    <?php else: ?>
                                        Not Availble
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($one_item->user_id && $one_item->msTenantFun && $one_item->msTenantFun->name): ?>
                                    <?php echo e(ucwords($one_item->msTenantFun->name)); ?>

                                    <?php else: ?>
                                        Not Availble
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($one_item->user_id && $one_item->msTenantFun && $one_item->msTenantFun->email): ?>
                                    <?php echo e($one_item->msTenantFun->email); ?>

                                    <?php else: ?>
                                        Not Availble
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($one_item->user_id && $one_item->msTenantFun && $one_item->msTenantFun->mobile): ?>
                                    <?php echo e($one_item->msTenantFun->mobile); ?>

                                    <?php else: ?>
                                        Not Availble
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($one_item->created_at): ?>
                                    <?php echo e($one_item->created_at->format('d-m-Y')); ?>

                                    <?php else: ?>
                                        Not Availble
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($one_item->for_month): ?>
                                        <?php 
                                        $f_date=date_create($one_item->for_month);
                                         ?>
                                        <?php echo e(date_format($f_date,"F-Y")); ?>

                                    <?php else: ?>
                                        Not Availble
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($one_item->due_date): ?>
                                        <?php 
                                        $f_date=date_create($one_item->due_date);
                                         ?>
                                        <?php echo e(date_format($f_date,"d-m-Y")); ?>

                                    <?php else: ?>
                                        Not Availble
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php 
                                    $tmp_id_0 = Crypt::encrypt($one_item->ts_invoice_id);                         
                                    $tmp_id_1 = $one_item->for_month;
                                    $tmp_id_2 = $one_item->due_date;
                                     ?>    
                                    <a href="<?php echo e(route('admin.invoices.one.get.details',['tmp_id_0'=>$tmp_id_0,'tmp_id_1'=>$tmp_id_1,'tmp_id_2'=>$tmp_id_2])); ?>"><button type="button" class="btn btn-info btn-fill">See more</button></a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                <div class="alert alert-danger text-center">
                    <span><b> Info - </b> There is no invoice</span>
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
var url_send_reminder = '<?php echo e(route('admin.send.reminder')); ?>';
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
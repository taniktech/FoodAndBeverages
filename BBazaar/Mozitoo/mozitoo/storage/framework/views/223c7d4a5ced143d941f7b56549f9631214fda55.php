<?php $__env->startSection('admin'); ?>
<?php $__env->startSection('active5'); ?>
    class="active"
<?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.adminheader', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="main-panel">
  <?php $__env->startSection('DashboardSiteMap'); ?>
      Admin Dashboard / Create Custom Invoice
  <?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.adminnav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="content">
<form id="cust-inv-form" method="post">
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h4 class="title">Create Custom Invoice against tenant</h4>
                    <p class="category">Select the tenant from list</p>
                </div>
                <div class="content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="ten-list-cust-inv">Tenant List</label>
                                    <select class="selectpicker form-control" name="ten_list_cust_inv" id="ten-list-cust-inv">
                                        <?php if(isset($tenant_list) && count($tenant_list) > 0): ?>
                                            <option value="" class="ignore">Select...</option>                                      
                                            <?php foreach($tenant_list as $one_tenant): ?>
                                            <?php if($one_tenant->user_id && $one_tenant->tenantFun): ?><option value="<?php echo e($one_tenant->user_id); ?>"><?php echo e($one_tenant->tenantFun->name); ?></option><?php endif; ?>
                                            <?php endforeach; ?>                                   
                                        <?php else: ?>
                                        <optgroup label="No Tenants Availble">
                                          <option value="" class="ignore">Select...</option>
                                        </optgroup>
                                        <?php endif; ?>
                                    </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div id="cust-ten-invnt-prop-summ">                       
   
    </div>

</div>
<div class="container-fluid">
    <div id="cust-ten-invnt-details">                       
   
    </div>

</div>
<div class="container-fluid">
    <div id="cust-ten-head-details">                       
   
    </div>

</div>
<div id="divLoading"> 
</div>
</form>
</div>
<?php echo $__env->make('includes.adminfooter', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>
<script>
var token = '<?php echo e(Session::token()); ?>';
var url_get_cust_inv_ten = '<?php echo e(route('admin.custom.invoice.tenat.details')); ?>';
var url_get_cust_inv_invnt = '<?php echo e(route('admin.custom.invoice.invnt.details')); ?>';
var url_gen_cust_inv = '<?php echo e(route('admin.invoices.genrate.custom.invoice')); ?>';
var url_dr_invoices = '<?php echo e(route('admin.invoices.get.draft')); ?>';
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
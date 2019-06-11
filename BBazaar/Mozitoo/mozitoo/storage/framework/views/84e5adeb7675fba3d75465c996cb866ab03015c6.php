<?php $__env->startSection('admin'); ?>
<?php $__env->startSection('active4'); ?>
    class="active"
<?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.adminheader', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="main-panel">
  <?php $__env->startSection('DashboardSiteMap'); ?>
      Admin Dashboard / Create Inventory
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
                                <p>Active Property</p>
                                <?php echo e($active_prop_count); ?>

                            </div>
                        </div>
                    </div>
                    <div class="footer">
                        <hr />
                        <div class="stats">
                            <?php if($active_prop_count ): ?>
                            <a href="<?php echo e(route('admin.inventory.review.createnew')); ?>"><i class="pe-7s-angle-right-circle"></i> Refresh </a>
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
                            <div class="icon-big icon-warning text-center">
                                <i class="pe-7s-attention"></i>
                            </div>
                        </div>
                        <div class="col-xs-9">
                            <div class="numbers">
                                <p>All Inventory</p>
                                <?php echo e($all_invnt_count); ?>

                            </div>
                        </div>
                    </div>
                    <div class="footer">
                        <hr />
                        <div class="stats">
                            <?php if($all_invnt_count > 0): ?>
                            <a href="<?php echo e(route('admin.inventory.review.all')); ?>"><i class="pe-7s-angle-right-circle"></i> View </a>
                            <?php else: ?>
                            <a href="<?php echo e(route('admin.inventory.review.createnew')); ?>"><i class="pe-7s-angle-right-circle"></i> Refresh </a>
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
                                <p>Occupied</p>
                                <?php echo e($active_invnt_count); ?>

                            </div>
                        </div>
                    </div>
                    <div class="footer">
                        <hr />
                        <div class="stats">
                            <?php if($active_invnt_count > 0): ?>
                            <a href="<?php echo e(route('admin.inventory.review.active')); ?>"><i class="pe-7s-angle-right-circle"></i> View </a>
                            <?php else: ?>
                            <a href="<?php echo e(route('admin.inventory.review.createnew')); ?>"><i class="pe-7s-angle-right-circle"></i> Refresh </a>
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
                                <p>Unoccupied</p>
                                <?php echo e($inactive_invnt_count); ?>

                            </div>
                        </div>
                    </div>
                    <div class="footer">
                        <hr />
                        <div class="stats">
                            <?php if($inactive_invnt_count > 0): ?>
                            <a href="<?php echo e(route('admin.inventory.review.inactive')); ?>"><i class="pe-7s-angle-right-circle"></i> View </a>
                            <?php else: ?>
                            <a href="<?php echo e(route('admin.inventory.review.createnew')); ?>"><i class="pe-7s-angle-right-circle"></i> Refresh </a>
                            <?php endif; ?>
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
                    <h4 class="title">Create Inventory</h4>
                    <p class="category">Select the Property which has no Inventory</p>
                </div>
                <div class="content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="prop-with-no-invnt">Property List having no Inventory</label>
                                    <select class="selectpicker form-control" name="prop_with_no_invnt" id="prop-with-no-invnt">
                                        <?php if($count_flag == true && count($props_with_no_invnt) > 0): ?>
                                        <optgroup label="Property list with no inventory">
                                            <option value="" class="ignore">Select...</option>                                      
                                            <?php foreach($props_with_no_invnt as $oneProperty): ?>
                                            <option value="<?php echo e($oneProperty->prop_id); ?>"><?php echo e($oneProperty->prop_title); ?> Located in <?php echo e($oneProperty->prop_locality); ?></option>
                                            <?php endforeach; ?>  
                                        </optgroup>                                     
                                        <?php else: ?>
                                        <optgroup label="No Property Availble">
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
<div id="divLoading"> 
</div>
<div class="container-fluid">
    <div id="pend-prop-dyn-summary">                       
   
    </div>

</div>
</div>
<!--Modaal-->
<div class="modal" tabindex="-1" role="dialog" id="success-invnt-review-modal" aria-hidden="true" data-backdrop="false" data-keyboard="false" aria-labelledby="myModalLabel" style="background-color:rgba(256,256,256, 0.9);">
    <div class="modal-dialog">
        <div class="modal-content">
        <form id="dyn-created-invnt-ids-form">
          <div style="" class="modal-header">
              <h4 class="modal-title">Inventory List</h4>
          </div>
          <div class="modal-body" id="invnts-modal-body">
             <!--Inventories will be appended-->
          </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-info btn-fill" id="conf-prop-invnt">Confirm</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
        </form>
      </div>
    </div>
  </div>
<!-- /.modal -->
<?php echo $__env->make('includes.adminfooter', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>
<script>
var token = '<?php echo e(Session::token()); ?>';
var url_get_pend_pro_invnt = '<?php echo e(route('admin.inventory.createnew.verify')); ?>';
var url_get_invnt_level_valid = '<?php echo e(route('admin.inventory.level.valid')); ?>';
var url_post_invnt_create = '<?php echo e(route('admin.inventory.createnew')); ?>';
var url_all_invnt = '<?php echo e(route('admin.inventory.review.all')); ?>';
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
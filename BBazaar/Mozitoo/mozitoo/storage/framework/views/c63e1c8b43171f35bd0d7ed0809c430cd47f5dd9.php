<?php $__env->startSection('admin'); ?>
<?php $__env->startSection('active4'); ?>
    class="active"
<?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.adminheader', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="main-panel">
  <?php $__env->startSection('DashboardSiteMap'); ?>
      Admin Dashboard / Occupied Inventory
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
                                <a href="<?php echo e(route('admin.inventory.review.active')); ?>"><i class="pe-7s-angle-right-circle"></i> Refresh </a>
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
                            <a href="<?php echo e(route('admin.inventory.review.active')); ?>"><i class="pe-7s-angle-right-circle"></i> Refresh </a>
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
                            <a href="<?php echo e(route('admin.inventory.review.active')); ?>"><i class="pe-7s-angle-right-circle"></i> Refresh </a>
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
                            <a href="<?php echo e(route('admin.inventory.review.active')); ?>"><i class="pe-7s-angle-right-circle"></i> Refresh </a>
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
                    <h4 class="title">Occupied Inventory List</h4>
                    <p class="category">Occupied Inventory List</p>
                </div>        
                <div class="content table-responsive table-full-width">
                    <?php if($active_invnt_count > 0): ?>
                    <table class="table table-hover table-striped">
                        <thead>
                            <th>Sl.</th>
                            <th>Status</th>
                            <th>Listed By</th>
                            <th>City</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>BHK Type</th>
                            <th>Inventory ID</th>
                            <th>Tenant Name</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <?php 
                            $i = 0;
                             ?>
                            <?php foreach($all_active_invnt as $one_invnt): ?>
                            <?php 
                            $i++;
                             ?>
                            <tr>
                                <td><?php echo e($i); ?>.</td>
                                <td>
                                <?php if($one_invnt->invnt_status_id == 1): ?>
                                <p class="text-warning"><?php echo e($one_invnt->msInvntStatusFun->invnt_status); ?></p>  
                                <?php elseif($one_invnt->invnt_status_id == 2 && $one_invnt->user_id != 0): ?>
                                <p class="text-success"><?php echo e($one_invnt->msInvntStatusFun->invnt_status); ?></p>
                                <?php endif; ?>
                                </td>
                                <td><?php echo e(ucwords($one_invnt->tsSubmittedPropFun->msPropertyUserFun->name)); ?></td>
                                <td><?php echo e($one_invnt->tsSubmittedPropFun->prop_city); ?></td>
                                <td><?php echo e($one_invnt->tsSubmittedPropFun->prop_title); ?></td>
                                <td><?php echo e($one_invnt->tsSubmittedPropFun->msPropTypeFun->prop_type); ?></td>
                                <td><?php echo e($one_invnt->tsSubmittedPropFun->msPropBhkFun->prop_bhk); ?></td>
                                <td><?php echo e($one_invnt->fomatted_invnt_id); ?></td>
                                <td>
                                    <?php if($one_invnt->user_id == 0 && $one_invnt->invnt_status_id == 1): ?>
                                    <p class="text-warning">Not Assigned</p>
                                    <?php elseif($one_invnt->user_id != 0 && $one_invnt->invnt_status_id == 2): ?>
                                    <p class="text-success"><?php echo e(ucwords($one_invnt->tenantFun->name)); ?></p>
                                    <?php else: ?>
                                    <p class="text-warning">Not Assigned</p>
                                    <?php endif; ?>
                                </td>
                                <td>
                                <?php 
                                    $prop_id = $one_invnt->prop_id;
                                    $parameter= Crypt::encrypt($prop_id);
                                 ?>    
                                <a href="<?php echo e(route('admin.inventory.info.one',['prop_id'=>$parameter,'invnt_id'=>$one_invnt->ts_prop_invnt_id])); ?>"><button type="button" class="btn btn-info btn-fill" id="conf-prop-invnt">Modify</button></a></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                <div class="alert alert-danger text-center">
                    <span><b> Info - </b> There is no inventory</span>
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
<!--Modaal-->
<div class="modal" tabindex="-1" role="dialog" id="success-invnt-review-modal" aria-hidden="true" data-backdrop="false" data-keyboard="false" aria-labelledby="myModalLabel" style="background-color:rgba(256,256,256, 0.9);">
    <div class="modal-dialog">
        <div class="modal-content">
          <div style="" class="modal-header">
              <h4 class="modal-title">Inventory List</h4>
          </div>
          <div class="modal-body" id="invnts-modal-body">
             <!--Inventories will be appended-->
          </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-info btn-fill" id="conf-prop-invnt">Confirm</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
<!-- /.modal -->
<?php echo $__env->make('includes.adminfooter', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>
<script>
var token = '<?php echo e(Session::token()); ?>';
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
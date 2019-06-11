<?php $__env->startSection('ownerpendingprops'); ?>
<?php $__env->startSection('active1'); ?>
    class="active"
<?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.ownerheader', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="main-panel">
  <?php $__env->startSection('DashboardSiteMap'); ?>
  Owner Dashboard /Pending Properties For Approval
  <?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.ownernav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Pending Property For Approval</h4>
                        <p class="category">Details of all properties</p>
                    </div>
                    <div class="content table-responsive table-full-width">
                    <?php if(isset($pend_prop) && count($pend_prop) > 0): ?>
                        <table class="table table-hover table-striped">
                            <thead>
                              <th>Sl</th>
                              <th>Property Name</th>
                              <th>Locality</th>
                              <th>Type</th>
                              <th>Posted On</th>
                              <th>Action</th>
                            </thead>
                            <tbody>
                              <?php 
                              $i = 0;
                               ?>
                              <?php foreach($pend_prop as $one_prop): ?>
                              <?php 
                              $i++;
                               ?>
                                <tr>
                                    <td><?php echo e($i); ?></td>
                                    <td>
                                        <?php if($one_prop->prop_title): ?>
                                          <?php echo $one_prop->prop_title; ?>

                                        <?php else: ?> 
                                            N/A 
                                        <?php endif; ?> 
                                    </td>                                                                 
                                    <td>
                                        <?php if($one_prop->prop_locality): ?>
                                        <?php echo $one_prop->prop_locality; ?>

                                        <?php else: ?> 
                                            N/A 
                                        <?php endif; ?> 
                                    </td>
                                    <td>
                                        <?php if($one_prop->msPropTypeFun && $one_prop->msPropBhkFun): ?>
                                        <?php echo e($one_prop->msPropTypeFun->prop_type); ?> - <?php echo e($one_prop->msPropBhkFun->prop_bhk); ?>

                                        <?php else: ?> 
                                        N/A 
                                        <?php endif; ?> 
                                    </td>    
                                  <td>
                                        <?php if($one_prop->created_at): ?>
                                        <?php echo $one_prop->created_at->format('d-M-Y'); ?>

                                        <?php else: ?> 
                                            N/A 
                                        <?php endif; ?> 
                                  </td>
                                  <td><a href="<?php echo e(route('pending.owner.property.edit',['prop_id'=>$one_prop->prop_id])); ?>"><button type="button" class="btn btn-fill btn-success">See details</button></a></td>
                                </tr>
                              <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                    <div class="alert alert-danger text-center">
                        <span><b> Info - </b> There is no new requests</span>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.owner', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
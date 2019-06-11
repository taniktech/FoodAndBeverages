<?php $__env->startSection('requests'); ?>
<?php $__env->startSection('active'); ?>
    class="active"
<?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.adminheader', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="main-panel">
  <?php $__env->startSection('DashboardSiteMap'); ?>
      Admin Dashboard / Pending Requests
  <?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.adminnav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Pending Property Requests</h4>
                        <p class="category">Details of all properties</p>
                    </div>
                    <div class="content table-responsive table-full-width">
                    <?php if($data==true): ?>
                        <table class="table table-hover table-striped">
                            <thead>
                              <th>Sl</th>
                              <th>Listed By</th>
                              <th>Property Title</th>
                              <th>Location</th>
                            </thead>
                            <tbody>
                              <?php 
                              $i = 0;
                               ?>
                              <?php foreach($pendingProperties as $pendingProperty): ?>
                              <?php 
                              $i++;
                               ?>
                                <tr>
                                  <td><?php echo e($i); ?></td>
                                  <td><?php echo $pendingProperty->msPropertyUserFun->name; ?></td>
                                  <td><?php echo $pendingProperty->prop_title; ?></td>
                                  <td><?php echo $pendingProperty->prop_city; ?></td>
                                  <td><a href="<?php echo e(route('property.edit',['prop_id'=>$pendingProperty->prop_id])); ?>"><button type="button" class="btn btn-fill btn-success">See Details</button></a></td>
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

<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
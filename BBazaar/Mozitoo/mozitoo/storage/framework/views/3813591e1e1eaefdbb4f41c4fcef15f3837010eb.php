<?php $__env->startSection('ownerservicerequests'); ?>
<?php $__env->startSection('active6'); ?>
    class="active"
<?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.ownerheader', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="main-panel">
  <?php $__env->startSection('DashboardSiteMap'); ?>
      Owner Dashboard / All Service Requests
  <?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.ownernav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">All Service Requests</h4>
                        <p class="category">Details of all Service Requests</p>
                    </div>
                    <div class="content table-responsive table-full-width">
                    <?php if(isset($ts_ser_reqs) && count($ts_ser_reqs) > 0): ?>
                        <table class="table table-hover table-striped">
                            <thead>
                              <th>Sl</th>
                              <th>Raised By</th>
                              <th>Property Name</th>
                              <th>Service Type</th>
                              <th>Message</th>
                              <th>Status</th>
                              <th>Message from Manager</th>
                            </thead>
                            <tbody>
                              <?php 
                              $i = 0;
                               ?>
                              <?php foreach($ts_ser_reqs as $one_ser_req): ?>
                              <?php 
                              $i++;
                               ?>
                                <tr>
                                  <td><?php echo e($i); ?></td>
                                  <td>
                                    <?php if($one_ser_req->userFun): ?>
                                    <?php if($one_ser_req->user_id == $owner->user_id): ?>
                                    You
                                    <?php elseif($one_ser_req->userFun->name): ?>
                                    <?php echo e(ucwords($one_ser_req->userFun->name)); ?> <?php if($one_ser_req->userFun->userTypeFun): ?>(<?php echo e($one_ser_req->userFun->userTypeFun->user_type); ?>)<?php endif; ?>
                                    <?php else: ?>
                                    N/A
                                    <?php endif; ?>
                                    <?php endif; ?>
                                  </td>
                                  <td>
                                    <?php if($one_ser_req->tsSubmittedPropertyFun && $one_ser_req->tsSubmittedPropertyFun->prop_title): ?>
                                      <?php echo $one_ser_req->tsSubmittedPropertyFun->prop_title; ?><a href="<?php echo e(route('oneownerproperty.check',['prop_id'=>$one_ser_req->prop_id])); ?>"><span style="color: green;font-size: 10px;"> Click to see details</span></a></td>
                                      <?php else: ?>
                                      N/A
                                      <?php endif; ?>
                                    </td>
                                    <td>
                                    <?php if(isset($one_ser_req->serviceTypeFUn)): ?>
                                      <?php echo $one_ser_req->serviceTypeFUn->service_req_type; ?>

                                      <?php else: ?>
                                      N/A
                                      <?php endif; ?>
                                    </td>
                                    <td>
                                    <?php if($one_ser_req->message): ?>
                                    <?php echo $one_ser_req->message; ?>

                                    <?php else: ?>
                                        N/A
                                    <?php endif; ?>
                                    </td>
                                  <td>
                                      <?php if(isset($one_ser_req->serviceActionFUn)): ?>
                                      <?php echo $one_ser_req->serviceActionFUn->service_req_action; ?>

                                      <?php else: ?>
                                      N/A
                                      <?php endif; ?>
                                    </td>
                                    <td>
                                    <?php if($one_ser_req->msg_from_mngr): ?>
                                    <?php echo $one_ser_req->msg_from_mngr; ?>

                                    <?php else: ?>
                                        No message
                                    <?php endif; ?>
                                     </td>
                                </tr>
                              <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                    <div class="alert alert-danger text-center">
                        <span><b> Info - </b> There is no requests !</span>
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
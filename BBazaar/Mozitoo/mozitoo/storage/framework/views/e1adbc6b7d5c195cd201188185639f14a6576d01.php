<?php $__env->startSection('servicerequests'); ?>
<?php $__env->startSection('active3'); ?>
    class="active"
<?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.adminheader', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="main-panel">
  <?php $__env->startSection('DashboardSiteMap'); ?>
      Admin Dashboard / All Service Requests
  <?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.adminnav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Service Requests</h4>
                        <p class="category">Details of all requests</p>
                    </div>
                    <div class="content table-responsive table-full-width">
                    <?php if($data==true): ?>
                        <table class="table table-hover table-striped">
                            <thead>
                              <th>Sl</th>
                              <th>Requested By</th>
                              <th>Message</th>
                              <th>Property</th>
                              <th>Service Req For</th>
                              <th>Status</th>
                              <th>Message from Mgr</th>
                            </thead>
                            <tbody>
                              <?php 
                              $i = 0;
                               ?>
                              <?php foreach($tsServiceRequests as $oneServiceRequest): ?>
                              <?php 
                              $i++;
                               ?>
                              <tr>
                                <td><?php echo e($i); ?></td>
                                <td><?php echo $oneServiceRequest->userFun->name; ?> ( <?php echo $oneServiceRequest->userFun->userTypeFun->user_type; ?>)</td>
                                <?php if($oneServiceRequest->message): ?>
                                  <td><?php echo $oneServiceRequest->message; ?></td>
                                <?php else: ?>
                                    <td>No message from requesting person</td>
                                <?php endif; ?>
                                <td><?php echo $oneServiceRequest->tsSubmittedPropertyFun->prop_title; ?> <a href="<?php echo e(route('oneproperty.check',['prop_id'=>$oneServiceRequest->prop_id])); ?>"><span style="color: green;font-size: 10px;"> Click to see details</span></a></td>
                                <td><?php echo $oneServiceRequest->serviceTypeFUn->service_req_type; ?></td>
                                <td><?php echo $oneServiceRequest->serviceActionFUn->service_req_action; ?></td>
                                <?php if($oneServiceRequest->msg_from_mngr): ?>
                                  <td><?php echo $oneServiceRequest->msg_from_mngr; ?></td>
                                <?php else: ?>
                                    <td>No message fro mgr</td>
                                <?php endif; ?>
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
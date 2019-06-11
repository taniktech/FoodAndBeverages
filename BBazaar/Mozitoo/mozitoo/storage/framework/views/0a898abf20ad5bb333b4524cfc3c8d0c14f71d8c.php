<?php $__env->startSection('tenantservicerequests'); ?>
<?php $__env->startSection('active5'); ?>
    class="active"
<?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.tenantheader', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="main-panel">
  <?php $__env->startSection('DashboardSiteMap'); ?>
      Tenant Dashboard / All Service Requests
  <?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.tenantnav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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
                              <th>Appartment Name</th>
                              <th>Service Type</th>
                              <th>Your Message</th>
                              <th>Status</th>
                              <th>Message from Manager</th>
                            </thead>
                            <tbody>
                              <?php 
                              $i = 0;
                               ?>
                              <?php foreach($ts_ser_reqs as $one_req): ?>
                              <?php 
                              $i++;
                               ?>
                                <tr>
                                  <td><?php echo e($i); ?>.</td>
                                  <td>
                                      <?php if($one_req->tsSubmittedPropertyFun && $one_req->tsSubmittedPropertyFun->prop_title): ?>
                                      <?php echo $one_req->tsSubmittedPropertyFun->prop_title; ?>

                                      <?php else: ?>
                                      N/A
                                      <?php endif; ?>
                                    </td>
                                  <td>
                                      <?php if($one_req->serviceTypeFUn): ?>
                                      <?php echo $one_req->serviceTypeFUn->service_req_type; ?>

                                      <?php else: ?>
                                      N/A
                                      <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if($one_req->message): ?>
                                            <?php echo $one_req->message; ?>

                                        <?php else: ?>
                                            No message
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                      <?php if($one_req->serviceActionFUn): ?>
                                    <?php echo $one_req->serviceActionFUn->service_req_action; ?>

                                    <?php else: ?>
                                      N/A
                                    <?php endif; ?>
                                </td>
                                <td>
                                  <?php if($one_req->msg_from_mngr): ?>
                                    <?php echo $one_req->msg_from_mngr; ?>

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
                        <span><b> Info - </b> There is no requests made yet</span>
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

<?php echo $__env->make('layouts.tenant', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
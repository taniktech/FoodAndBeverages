<?php $__env->startSection('allagentadmin'); ?>
<?php $__env->startSection('active1'); ?>
    class="active"
<?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.adminheader', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="main-panel">
  <?php $__env->startSection('DashboardSiteMap'); ?>
      Admin Dashboard / Agents Info
  <?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.adminnav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">All Property Managers</h4>
                        <p class="category">Details of all Property Managers</p>
                    </div>
                    <div class="content table-responsive table-full-width">
                      <?php if($agentCountFlag==true): ?>
                        <table class="table table-hover table-striped">
                            <thead>
                              <th>Sl</th>
                              <th>Manager's Name</th>
                              <th>Mobile</th>
                              <th>Email</th>
                              <th>Listed On</th>
                            </thead>
                            <tbody>
                              <?php 
                              $i = 0;
                               ?>
                              <?php foreach($agentData as $oneAgent): ?>
                              <?php 
                              $i++;
                               ?>
                                <tr>
                                  <td><?php echo e($i); ?></td>
                                  <td><?php echo e($oneAgent->name); ?> </td>
                                  <td><?php echo e($oneAgent->mobile); ?> </td>
                                  <td><?php echo e($oneAgent->email); ?> </td>
                                  <td><?php echo e($oneAgent->created_at); ?> </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                    <div class="alert alert-danger text-center">
                        <span><b> Info - </b> There is no Manager</span>
                    </div>
                    <?php endif; ?>
                    </div>
                </div>
            </div>
          </div>
      </div>
  </div>
<?php echo $__env->make('includes.adminfooter', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<script>
var token = '<?php echo e(Session::token()); ?>';
</script>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
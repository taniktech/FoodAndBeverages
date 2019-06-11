<?php $__env->startSection('ownerpwd'); ?>
<?php $__env->startSection('active7'); ?>
    class="active"
<?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.ownerheader', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="main-panel">
  <?php $__env->startSection('DashboardSiteMap'); ?>
      Owner Dashboard / Change Password
  <?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.ownernav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Change Password</h4>
                                <p class="category">Please enter your current Password</p>
                            </div>
                            <form id="change-owner-dpwd">
                            <div class="content">
                              <div class="row">
                                  <div class="col-sm-12">
                                      <div class="form-group">
                                          <label for="old_pwd">Current Password</label>
                                          <input class="form-control" name="old_pwd" id="old_pwd" type="password" placeholder="Enter your current password">
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-sm-12">
                                      <div class="form-group">
                                          <label for="new_pwd">Current Password</label>
                                          <input class="form-control" name="new_pwd" id="new_pwd" type="password" placeholder="Enter new password">
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-sm-12">
                                      <div class="form-group">
                                          <label for="re_pwd">Re-enter Password</label>
                                          <input class="form-control" name="re_pwd" id="re_pwd" type="password" placeholder="Repeat your password">
                                      </div>
                                  </div>
                              </div>
                              <div class="text-right">
                              <button type="submit" id="changeDashPwdBtn" class="btn btn-info btn-fill">Change Password</button>
                              </div>
                              </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="divLoading"> 

                </div>
        </div>
<script>
var token = '<?php echo e(Session::token()); ?>';
var url_chnage_pwd = '<?php echo e(route('owner.change.pwd')); ?>';
var home = '<?php echo e(route('home')); ?>';
</script>
<?php echo $__env->make('includes.adminfooter', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.owner', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
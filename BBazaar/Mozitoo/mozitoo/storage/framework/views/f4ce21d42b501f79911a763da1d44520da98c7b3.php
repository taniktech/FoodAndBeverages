<?php $__env->startSection('owner'); ?>
<?php $__env->startSection('active'); ?>
    class="active"
<?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.ownerheader', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="main-panel">
  <?php $__env->startSection('DashboardSiteMap'); ?>
      Owner Dashboard
  <?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.ownernav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="content">
  <div class="container-fluid">
    <div class="row">
        <div class="col-lg-3 col-sm-6">
            <div class="card">
                <div class="content">
                    <div class="row">
                        <div class="col-xs-3">
                            <div class="icon-big icon-warning text-center">
                                <i class="pe-7s-home"></i>
                            </div>
                        </div>
                        <div class="col-xs-9">
                            <div class="numbers">
                                <p>Total Verified Property</p>
                                <?php if(isset($ts_prop)): ?>
                                <?php echo e(count($ts_prop)); ?>

                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="footer">
                        <hr />
                        <div class="stats">
                          <?php if(count($ts_prop) > 0): ?>
                          <a href="<?php echo e(route('owner.property.all')); ?>"><i class="pe-7s-angle-right-circle"></i> View </a>
                          <?php else: ?>
                          <a href="<?php echo e(route('ownerdashboard')); ?>"><i class="pe-7s-angle-right-circle"></i> Refresh </a>
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
                              <p>Total Rented Property</p>
                                <?php if(isset($ts_rented_prop)): ?>
                                <?php echo e(count($ts_rented_prop)); ?>

                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="footer">
                        <hr />
                        <div class="stats">
                          <?php if(count($ts_rented_prop) > 0): ?>
                          <a href="<?php echo e(route('owner.property.all')); ?>"><i class="pe-7s-angle-right-circle"></i> View </a>
                          <?php else: ?>
                          <a href="<?php echo e(route('ownerdashboard')); ?>"><i class="pe-7s-angle-right-circle"></i> Refresh </a>
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
                            <div class="icon-big icon-danger text-center">
                                <i class="pe-7s-volume2"></i>
                            </div>
                        </div>
                        <div class="col-xs-9">
                            <div class="numbers">
                                <p>Raised Service Request</p>
                                <?php if(isset($ts_ser_reqs)): ?>
                                <?php echo e(count($ts_ser_reqs)); ?>

                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="footer">
                        <hr />
                        <div class="stats">
                          <?php if(count($ts_ser_reqs) > 0): ?>
                          <a href="<?php echo e(route('owner.service.req.all')); ?>"><i class="pe-7s-angle-right-circle"></i> View </a>
                          <?php else: ?>
                          <a href="<?php echo e(route('ownerdashboard')); ?>"><i class="pe-7s-angle-right-circle"></i> Refresh </a>
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
                            <div class="icon-big icon-info text-center">
                                <i class="pe-7s-attention"></i>
                            </div>
                        </div>
                        <div class="col-xs-9">
                            <div class="numbers">
                                <p>Pending Property Approvals</p>
                                <?php if(isset($ts_pend_prop)): ?>
                                <?php echo e(count($ts_pend_prop)); ?>

                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="footer">
                        <hr />
                        <div class="stats">
                          <?php if(count($ts_pend_prop) > 0): ?>
                          <a href="<?php echo e(route('owner.prop.requests')); ?>"><i class="pe-7s-angle-right-circle"></i> View </a>
                          <?php else: ?>
                          <a href="<?php echo e(route('ownerdashboard')); ?>"><i class="pe-7s-angle-right-circle"></i> Refresh </a>
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
        <div class="col-md-8">
            <?php if($owner->email_verified == 0 or $owner->mobile_verified == 0): ?>
            <!-- If email or mobile is not verified show -->
            <div class="card">
                <div class="header">
                    <h4 class="title">Verification Pending</h4>
                </div>
                <div class="content">
                    <ul class="list-unstyled team-members">              
                        <?php if($owner->email_verified == 0 ): ?>
                        <!-- If email is not verified show -->
                        <li>
                            <div class="row">
                                <div class="col-md-2">
                                    Email
                                </div>
                                <div class="col-md-6">
                                    <form id="user-email-update">
                                        <input type="email" class="form-control" disabled="disabled" placeholder="Your Email" name="user_email" id="user-email" value="<?php echo $owner->email; ?>">       
                                    </form>
                                    <form id="email-otp-verify">
                                        <div id="dyn-email-veri">
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-3" id="gen-email-otp">
                                        <?php if(($owner->email) && ($owner->email_verified == 0 )): ?>
                                        <a href="javascript:sendEmailOTP();"><i class="fa fa-warning icon-danger"></i> Click here to generate OTP</a><?php endif; ?> 
                                        <?php if(($owner->email) && ($owner->email_verified == 1)): ?><i class="fa fa-check icon-success"></i><?php endif; ?>
                                </div>
                                <div class="col-md-3" id="email-update-save-b" hidden>
                                    <button type="button" onClick="submitEmailUpForm();" class="btn btn-info btn-fill pull-left">Save</button>
                                </div>
                                <div class="col-md-1 text-right">
                                    <button type="button" onclick="dasEmailUpdate();" id="user-email-u-b" class="btn btn-info btn-simple btn-md">
                                        <i class="fa fa-edit"></i>
                                    </button> 
                                </div>
                            </div>
                        </li>
                        <?php endif; ?>
                        <?php if($owner->mobile_verified == 0 ): ?>
                        <!-- If mobile is not verified show -->
                        <li>
                            <div class="row">
                                <div class="col-md-2">
                                    Mobile
                                </div>
                                <div class="col-md-6">
                                    <form id="user-mobile-update">
                                        <input type="text" class="form-control" disabled="disabled" placeholder="Your Email" name="user_mobile" id="user-mobile" value="<?php echo $owner->mobile; ?>">       
                                    </form>
                                    <form id="mobile-otp-verify">
                                        <div id="dyn-mobile-veri">
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-3" id="gen-mobile-otp">
                                        <?php if(($owner->mobile) && ($owner->mobile_verified == 0 )): ?><a href="javascript:sendMobileOTP();"><i class="fa fa-warning icon-danger"></i> Click here to generate OTP</a><?php endif; ?> 
                                        <?php if(($owner->mobile) && ($owner->mobile_verified == 1)): ?><i class="fa fa-check icon-success"></i><?php endif; ?>
                                </div>
                                <div class="col-md-3" id="mobile-update-save-b" hidden>
                                    <button type="button" onClick="submitMobileUpForm();" class="btn btn-info btn-fill pull-left">Save</button>
                                </div>
                                <div class="col-md-1 text-right">
                                    <button type="button" onclick="dasMobileUpdate();" id="user-mobile-u-b" class="btn btn-info btn-simple btn-md">
                                        <i class="fa fa-edit"></i>
                                    </button>    
                                </div>
                            </div>
                        </li>
                        <?php endif; ?>
                    </ul>
                </div>                      
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
</div>
<div id="divLoading"> 

</div>

<script>
var token = '<?php echo e(Session::token()); ?>';
var url_owner_dashboard = '<?php echo e(route('ownerdashboard')); ?>';
var url_send_email_otp = '<?php echo e(route('user.send.email.otp')); ?>';
var url_send_mobile_otp = '<?php echo e(route('user.send.mobile.otp')); ?>';
var url_verify_otp = '<?php echo e(route('user.verify.email.otp')); ?>';
var url_update_em = '<?php echo e(route('user.update.email.mobile')); ?>';
</script>
<?php echo $__env->make('includes.adminfooter', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.owner', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
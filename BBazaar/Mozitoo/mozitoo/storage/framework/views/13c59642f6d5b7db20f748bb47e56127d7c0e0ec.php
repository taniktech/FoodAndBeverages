<?php $__env->startSection('adminsignup'); ?>
<div class="forms">
    <div class="container mt-3">
        <div id="signupbox" class="col-md-6 offset-md-3 ">
            <div class="card text-left">
                <div class="card-header">
                    Sign Up
                </div>
                <div class="card-body">
                    <form id="adminregistrationform">
                        <div class="form-group">
                            <label for="inputName">Name</label>
                            <input type="text" name="inputName" class="form-control" id="inputName" placeholder="Your Name">
                        </div>
                        <div class="form-group">
                            <label for="inputEmail">Email</label>
                            <input type="email" name="inputEmail" class="form-control" id="inputEmail" placeholder="Your Email">
							<label for="inputEmail" id="input_email_err"></label>
						</div>
                        <div class="form-group">
                            <label for="inputMobile">Mobile</label>
                            <input type="text" name="inputMobile" class="form-control" id="inputMobile" placeholder="Your Mobile">
							<label for="inputMobile" id="input_mobile_err"></label>
						</div>
                        <div class="form-group">
                            <label for="inputPassword">Password</label>
                            <input type="password" name="inputPassword" class="form-control" id="inputPassword" placeholder="Your Password">
                        </div>
                          <button type="submit" id="doSignUp" class="btn btn-primary">Sign up</button>
                    </form>
                </div>
                <div class="card-footer text-muted">
                  <div class="col-md-12 control">
                      <div style="padding-top:20px;font-size:85%; margin: 0 -15px;">Already have an account!
                          <a href="javascript:void(0)" onClick="$('#signupbox').hide(); $('#forgotbox').hide(); $('#loginbox').show()">Login Here</a>
                      </div>
                  </div>
                </div>
            </div>
        </div>
        <div id="loginbox" class="col-md-6 offset-md-3" style="display:none;">
            <div class="card text-left">
                <div class="card-header">
                   Sign In
                </div>
                <div class="card-body">
                    <form id="adminloginform">
                        <div class="form-group">
                            <label for="inputEmail">Email</label>
                            <input type="email" name="loginEmail" class="form-control" id="loginEmail" placeholder="Your Email">
							<label for="loginEmail" id="user_email_err"></label>
					   </div>
                        <div class="form-group">
                            <label for="inputPassword">Password</label>
                            <input type="password" name="loginPassword" class="form-control" id="loginPassword" placeholder="Your Password">
							<label for="loginPassword" id="user_pwd_err"></label>
						</div>
                        <button type="submit" id="doSignIn" class="btn btn-primary">Sign In</button>
                    </form>
                </div>
                <div class="card-footer text-muted">
                  <div class="col-md-12 control clearfix">
                      <div style="padding-top:20px;font-size:85%; margin: 0 -15px;float:left;">Don't have an account!
                          <a href="javascript:void(0)" onClick="$('#loginbox').hide(); $('#forgotbox').hide(); $('#signupbox').show()">Sign Up Here</a>
                      </div>
                      <div style="padding-top:20px;font-size:85%;float:right;">Forgot password ?
                          <a href="javascript:void(0)" onClick="$('#loginbox').hide(); $('#signupbox').hide(); $('#forgotbox').show()">Click Here</a>
                      </div>
                  </div>
                </div>
            </div>
        </div>
        <div id="forgotbox" class="col-md-6 offset-md-3" style="display:none;">
          <div class="card text-left">
                <div class="card-header">
                   Reset Password
                </div>
                <div class="card-body">
                    <form id="adminforgotform">
                        <div class="form-group">
                            <label for="resetEmail">Email</label>
                            <input type="email" name="resetEmail" class="form-control" id="resetEmail" placeholder="Your Email">
                            <label for="resetEmail" id="reset_email_err"></label>
                        </div>
                        <button type="submit" id="doForgetPwdBtn" class="btn btn-primary">Reset</button>
                    </form>
                  </div>
                  <div class="card-footer text-muted">
                  <div class="col-md-12 control clearfix">
                      <div style="padding-top:20px;font-size:85%; margin: 0 -15px;float:left;">New ?
                          <a href="javascript:void(0)" onClick="$('#loginbox').hide(); $('#forgotbox').hide(); $('#signupbox').show()">Sign Up Here</a>
                      </div>
                      <div style="padding-top:20px;font-size:85%;float:right;">Already have an account!
                          <a href="javascript:void(0)" onClick="$('#signupbox').hide(); $('#forgotbox').hide(); $('#loginbox').show()">Login Here</a>
                      </div>
                  </div>
                </div>
        </div>
      </div>
    </div>
</div>
<script>
var token = '<?php echo e(Session::token()); ?>';
var urlAdminSignIn = '<?php echo e(route('doadminsignin')); ?>';
var urlAdminSignUp = '<?php echo e(route('doadminsignup')); ?>';
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master2', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
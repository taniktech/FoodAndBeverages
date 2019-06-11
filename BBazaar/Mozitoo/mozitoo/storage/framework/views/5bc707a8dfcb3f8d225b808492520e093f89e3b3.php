<header class="row">
    <div class="row m0 topHeader">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 social_menu">
                    <ul class="list-inline">
                        <li><a href="https://www.facebook.com/Mozitoo-1785649168410724/" target="_blank"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="https://twitter.com/Mozitoo1?s=08" target="_blank"><i class="fa fa-twitter"></i></a></li>
                    </ul>
                </div>
                  <?php if(Auth::check() && Auth::user()->user_type_id == '2'): ?>
                  <div class="col-sm-6 top_menu">
                      <ul class="list-inline">
                          <li>
                            <div class="input-group-btn filterGroup">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                    <a href="#"><i class="fa fa-user"></i> HI <?php if($tenant): ?><?php echo e($tenant->name); ?> <?php endif; ?></a>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                    <li><a href="<?php echo e(route('tenantaccount')); ?>">Account</a></li>
                                    <li><a href="<?php echo e(route('tenant.property.all')); ?>">My Property</a></li>
                                    <li><a href="<?php echo e(route('tenant.logout')); ?>">Log Out</a></li>
                                </ul>
                            </div>
                          </li>
                      </ul>
                  </div>
                  <?php elseif(Auth::check() && Auth::user()->user_type_id == '3'): ?>
                  <div class="col-sm-6 top_menu">
                      <ul class="list-inline">
                          <li>
                            <div class="input-group-btn filterGroup">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                    <a href="#"><i class="fa fa-user"></i> HI <?php if($owner): ?><?php echo e($owner->name); ?> <?php endif; ?></a>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                    <li><a href="<?php echo e(route('ownerdashboard')); ?>">Account</a></li>
                                    <li><a href="<?php echo e(route('owner.logout')); ?>">Log Out</a></li>
                                </ul>
                            </div>
                          </li>
                      </ul>
                  </div>
                  <?php elseif(Auth::check() && Auth::user()->user_type_id == '4'): ?>
                  <div class="col-sm-6 top_menu">
                      <ul class="list-inline">
                          <li>
                            <div class="input-group-btn filterGroup">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                    <a href="#"><i class="fa fa-user"></i> HI <?php if($agent): ?><?php echo e($agent->name); ?> <?php endif; ?></a>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                    <li><a href="<?php echo e(route('agent')); ?>">Account</a></li>
                                    <li><a href="<?php echo e(route('agent.logout')); ?>">Log Out</a></li>
                                </ul>
                            </div>
                          </li>
                      </ul>
                  </div>
                  <?php elseif(Auth::check() && Auth::user()->user_type_id == '1'): ?>
                  <div class="col-sm-6 top_menu">
                      <ul class="list-inline">
                          <li>
                            <div class="input-group-btn filterGroup">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                    <a href="#"><i class="fa fa-user"></i> HI <?php if($admin): ?><?php echo e($admin->name); ?> <?php endif; ?></a>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                    <li><a href="<?php echo e(route('admin')); ?>">Account</a></li>
                                    <li><a href="<?php echo e(route('admin.logout')); ?>">Log Out</a></li>
                                </ul>
                            </div>
                          </li>
                      </ul>
                  </div>
                <?php else: ?>
                <div class="col-sm-6 top_menu">
                    <ul class="list-inline">
                        <li><a data-toggle="modal" href="javascript:void(0)" data-target="#myModal"><i class="fa fa-user"></i>Signin & Signup</a></li>
                    </ul>
                </div>
                <!-- Modal -->
              <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Mozitoo</h4>
                    </div>
                    <div class="modal-body">
                      <div class="forms">
                              <div id="signupbox"  style="display:none;">
                                      <div class="text-center">
                                          Sign Up
                                      </div>
                                          <form id="registration-form">
                                              <div class="form-group">
                                                  <label for="inputName">Name</label>
                                                  <input type="text" name="input_name" class="form-control" id="inputName" placeholder="Your Name">
                                              </div>
                                              <div class="form-group">
                                                  <label for="inputEmail">Email</label>
                                                  <input type="email" name="input_email" class="form-control" id="inputEmail" placeholder="Your Email">
                                                  <label for="inputEmail" id="input_email_err"></label>
                                              </div>
                                              <div class="form-group">
                                                  <label for="inputMobile">Mobile</label>
                                                  <input type="text" name="input_mobile" class="form-control" id="inputMobile" placeholder="Your Mobile">
                                                  <label for="inputMobile" id="input_mobile_err"></label>
                                              </div>
                                              <div class="form-group">
                                                  <label for="inputPassword">Password</label>
                                                  <input type="password" name="input_password" class="form-control" id="inputPassword" placeholder="Your Password">
                                              </div>
                                                <div class="checkbox">
                                                    <label>
                                                      <input type="checkbox" id="input-terms" name="input_terms"> I agree to the <a href="<?php echo e(route('terms.of.use')); ?>" target="_blank"> Terms and Conditions</a>
                                                    </label>
                                                </div>
                                                <button type="submit" id="doSignUp" class="btn btn-primary" disabled>Sign up</button>
                                          </form>
                                      <div class="text-muted">
                                          <div class="col-md-12 control">
                                              <div style="padding-top:20px;font-size:85%; margin: 0 -15px;">Already have an account!
                                                  <a href="javascript:void(0)" onClick="$('#signupbox').hide(); $('#forgotbox').hide(); $('#loginbox').show()">Login Here</a>
                                              </div>
                                          </div>
                                      </div>
                              </div>
                              <div id="loginbox">
                                      <div class="text-center">
                                         Sign In
                                      </div>
                                          <form id="login-form">
                                              <div class="form-group">
                                                  <label for="loginEmail">Email</label>
                                                  <input type="email" name="login_email" class="form-control" id="loginEmail" placeholder="Your Email">
                                                  <label for="loginEmail" id="user_email_err"></label>
                                              </div>
                                              <div class="form-group">
                                                  <label for="loginPassword">Password</label>
                                                  <input type="password" name="login_password" class="form-control" id="loginPassword" placeholder="Your Password">
                                                  <label for="loginPassword" id="user_pwd_err"></label>
                                              </div>
                                              <button type="submit" id="doSignIn" class="btn btn-primary">Sign In</button>
                                          </form>
                                      <div class="text-muted">
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
                              <div id="forgotbox" style="display:none;">
                                      <div class="text-center">
                                         Reset Password
                                      </div>
                                          <form id="forgot-pwd-form-user">
                                              <div class="form-group">
                                                  <label for="resetEmail">Email</label>
                                                  <input type="email" name="resetEmail" class="form-control" id="resetEmail" placeholder="Your Email">
                                                  <label for="resetEmail" id="reset_email_err"></label>
                                              </div>
                                              <button type="submit" id="doForgetPwdBtn" class="btn btn-primary">Reset</button>
                                          </form>
                                      <div class="text-muted">
                                        <div class="col-md-12 control clearfix">
                                            <div style="padding-top:20px;font-size:85%; margin: 0 -15px;float:left;">Don't have an account!
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
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                  </div>

                </div>
              </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container-fluid container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#mainNavigation">
                    <i class="fa fa-bars"></i> Menu
                </button>
                <a class="navbar-brand" href="<?php echo e(route('home')); ?>"><img src="<?php echo e(URL::to('src/images/logos/logo3.png')); ?>" alt=""></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="mainNavigation">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="<?php echo e(route('home')); ?>">Home</a></li>
                    <li><a href="<?php echo e(route('properties')); ?>">Properties</a></li>
                    <li><a href="<?php echo e(route('submitform')); ?>">Rent Your Property </a></li>
                    <li><a href="<?php echo e(route('shop.and.earn')); ?>">Shop & Earn</a></li>
                    <li><a href="<?php echo e(route('blog')); ?>">Blog</a></li>
                    <li><a href="<?php echo e(route('contactus')); ?>">Contact</a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
</header> <!--Header End-->
<script>
    var token = '<?php echo e(Session::token()); ?>';
    var urlSignIn = '<?php echo e(route('dosignin')); ?>';
    var urlSignUp = '<?php echo e(route('dosignup')); ?>';
    var url_check_forgotpwd = '<?php echo e(route('check.forgetpwd.tenant.owner')); ?>';
    var url_tenant_dashboard = '<?php echo e(route('tenantaccount')); ?>';
    var url_owner_dashboard = '<?php echo e(route('ownerdashboard')); ?>';
</script>
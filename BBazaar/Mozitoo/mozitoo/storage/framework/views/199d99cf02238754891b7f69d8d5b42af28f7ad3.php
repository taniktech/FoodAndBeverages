<?php $__env->startSection('forgotpwd'); ?>
<!--Content Area Begin-->

    <section class="row pageCover">
        <div class="container">
            <div class="row m0">
                <div class="fleft page_name">Password Reset</div>
                <div class="fright page_dir">
                    <ul class="list-inline">
                        <li><a href="<?php echo e(route('home')); ?>">home</a></li>
                        <li>Password Reset</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="row contentRow">
        <div class="container">
            <div class="row">
                    <div class="row commentForm m0">
                        <h3 class="text-center">Reset Password</h3>
                        <form id="change-user-pwd" class="row m0">
                            <div class="col-sm-6 col-sm-offset-3 p0 commenterInfoInputs">
                                <div class="row m0">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                        <input type="password" name="newPwd" id="newPwd" class="form-control" placeholder="New Password">
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                        <input type="password" name="rePwd" class="form-control" placeholder="Repeat Password">
                                    </div>
                                    <button class="btn btn-default" id="doForgetPwdBtn" type="submit">Change my password</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </section>

    <!--Content Area End-->
    <script>
    var token = '<?php echo e(Session::token()); ?>';
    var url_change_pwd = '<?php echo e(route('changepwd')); ?>';
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master1', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
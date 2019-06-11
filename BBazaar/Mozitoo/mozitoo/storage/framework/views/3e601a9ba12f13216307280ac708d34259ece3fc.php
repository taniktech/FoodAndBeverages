<?php $__env->startSection('agents'); ?>
<!--Content Area Begin-->

    <section class="row pageCover">
        <div class="container">
            <div class="row m0">
                <div class="fleft page_name">Our Property Managers</div>
                <div class="fright page_dir">
                    <ul class="list-inline">
                        <li><a href="<?php echo e(route('home')); ?>">home</a></li>
                        <li>Our Property Managers</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="row contentRow">
        <div class="container">
            <div class="row">
              <?php foreach($tsAgents as $tsAgent): ?>
                <div class="col-sm-6 col-md-4 col-lg-3 agent">
                    <div class="row m0">
                        <div class="row m0 imageRow">
                          <?php if(Storage::disk('agent_uploads')->has($tsAgent->user_id.'.jpg')): ?>
                          <img src="<?php echo e(route('agent.image', ['filename' => $tsAgent->user_id.'.jpg'])); ?>" alt="..." class="img-responsive"/>
                          <?php else: ?>
                          <img src="<?php echo e(route('agent.image', ['filename' => 'default.jpg'])); ?>" alt="" class="img-responsive">
                          <?php endif; ?>
                            <ul class="nav">
                                <li><a <?php if(!empty($tsAgent->tsAgentOtherInfo->facebook_id)): ?> href="<?php echo e($tsAgent->tsAgentOtherInfo->google_plus_id); ?>" target="_blank" <?php else: ?> href="javascript:void(0)" <?php endif; ?>><i class="fa fa-google-plus"></i></a></li>
                                <li><a <?php if(!empty($tsAgent->tsAgentOtherInfo->facebook_id)): ?> href="<?php echo e($tsAgent->tsAgentOtherInfo->twitter_id); ?>" target="_blank" <?php else: ?> href="javascript:void(0)" <?php endif; ?>><i class="fa fa-twitter"></i></a></li>
                                <li><a <?php if(!empty($tsAgent->tsAgentOtherInfo->facebook_id)): ?> href="<?php echo e($tsAgent->tsAgentOtherInfo->linkedin_id); ?>" target="_blank" <?php else: ?> href="javascript:void(0)" <?php endif; ?>><i class="fa fa-linkedin"></i></a></li>
                                <li><a <?php if(!empty($tsAgent->tsAgentOtherInfo->facebook_id)): ?> href="<?php echo e($tsAgent->tsAgentOtherInfo->facebook_id); ?>" target="_blank" <?php else: ?> href="javascript:void(0)" <?php endif; ?>><i class="fa fa-facebook"></i></a></li>
                            </ul>
                        </div>
                        <div class="row m0 agent_details">
                            <div class="row m0 phoneNumber"><i class="fa fa-phone-square"></i><?php echo e($tsAgent->mobile); ?></div>
                            <div class="row m0 inner">
                                <a href="agent-details.html"><?php echo e($tsAgent->name); ?></a>
                                <span class="phone_trigger">
                                    <i class="fa fa-phone-square"></i>
                                    <i class="fa fa-long-arrow-down"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div> <!--Agent Block-->
              <?php endforeach; ?>
            </div>
            <!-- pagination links-->
            <!-- <nav class="row m0 paginationRow">
                <ul class="pagination">
                    <li class="active"><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                </ul>
            </nav> -->
              <!-- pagination links ends-->
        </div>
    </section>

    <!--Content Area End-->
    <script>
    var token = '<?php echo e(Session::token()); ?>';
    var urlSignIn = '<?php echo e(route('dosignin')); ?>';
    var urlSignUp = '<?php echo e(route('dosignup')); ?>';
    var urlForgotPwd = '<?php echo e(route('doforgetpwd')); ?>';
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master1', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
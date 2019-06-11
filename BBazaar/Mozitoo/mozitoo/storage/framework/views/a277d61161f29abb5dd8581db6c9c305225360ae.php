<?php $__env->startSection('property_details'); ?>
<!--Content Area Begin-->

    <section class="row pageCover">
        <div class="container">
            <div class="row m0">
                <div class="fleft page_name"><?php echo e($tsSubmittedProperty->prop_city); ?></div>
                <div class="fright page_dir">
                    <ul class="list-inline">
                        <li><a href="index.html">home</a></li>
                        <li><a href="listing-list.html">listings</a></li>
                        <li><?php echo e($tsSubmittedProperty->prop_city); ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="row contentRow">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <div class="row m0 listing_details">
                        <div class="info_content row m0">
                            <div class="row m0 imageRow">
                              <?php if(Storage::disk('public_uploads')->has($tsSubmittedProperty->prop_id.'.jpg')): ?>
                                <img src="<?php echo e(route('prop.image', ['filename' => $tsSubmittedProperty->prop_id.'.jpg'])); ?>" alt="..." class="img-responsive"/>
                              <?php else: ?>
                              <img src="<?php echo e(route('prop.image', ['filename' => 'default.jpg'])); ?>" alt="" class="img-responsive">
                              <?php endif; ?>
                                <div class="saleTag"><?php echo e($tsSubmittedProperty->furnishFUn->prop_furnish_status); ?></div>
                            </div>
                            <div class="row m0 description">
                                <div class="row m0">
                                    <div class="row m0 priceRow">
                                        <div class="price fleft">Rs. <?php echo e($tsSubmittedProperty->prop_morp); ?></div>
                                    </div>
                                    <h4 class="location"><?php echo e($tsSubmittedProperty->prop_location); ?></h4>
                                    <a href="#" class="detail_page_specify_btn specify_btn"><i class="fa fa-arrows-alt"></i><?php echo e($tsSubmittedProperty->prop_area); ?> Sq Ft</a>
                                    <a href="#" class="detail_page_specify_btn specify_btn"><i class="fa fa-inbox"></i><?php echo e($tsSubmittedProperty->prop_bed); ?> bedroom</a>
                                    <a href="#" class="detail_page_specify_btn specify_btn"><i class="fa fa-inbox"></i><?php echo e($tsSubmittedProperty->prop_bath); ?> bathroom</a>
                                    <p><?php echo e($tsSubmittedProperty->prop_desc); ?></p>
                                </div>
                                <div class="row m0 additional_features">
                                    <h4 class="location">Amenities</h4>
                                    <?php foreach($msPropertyAmenties as $msPropertyAmenty): ?>
                                    <a href="#" class="feature"><i class="fa fa-check-circle"></i><?php echo e($msPropertyAmenty->prop_amenty_name); ?></a>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div> <!--Grid Listing-->
                </div>
                <div class="col-sm-4 sidebar">
                  <?php if($ownersPropCheck == true): ?>
                  <?php if($taggedAgentCheck == true): ?>
                  <?php foreach($agentsData as $tsAgent): ?>
                  <div class="row m0 widget listedBy">
                      <h4>Listed by:</h4>
                      <div class="row m0 agent">
                          <div class="row m0">
                              <div class="row m0 imageRow">
                                <?php if(Storage::disk('agent_uploads')->has($tsAgent->user_id.'.jpg')): ?>
                                <img src="<?php echo e(route('agent.image', ['filename' => $tsAgent->user_id.'.jpg'])); ?>" alt="..." class="img-responsive"/>
                                <?php else: ?>
                                <img src="<?php echo e(route('agent.image', ['filename' => 'default.jpg'])); ?>" alt="" class="img-responsive">
                                <?php endif; ?>
                                  <ul class="nav">
                                      <li><a href="http://google.com"><i class="fa fa-google-plus"></i></a></li>
                                      <li><a href="http://www.twitter.com"><i class="fa fa-twitter"></i></a></li>
                                      <li><a href="http://www.linkedin.com"><i class="fa fa-linkedin"></i></a></li>
                                      <li><a href="http://www.facebook.com"><i class="fa fa-facebook"></i></a></li>
                                      <li><a href="#"><i class="fa fa-envelope"></i></a></li>
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
                  </div>
                  <?php endforeach; ?>
                  <?php endif; ?>
                  <?php else: ?>
                  <div class="row m0 widget listedBy">
                      <h4>Listed by:</h4>
                      <div class="row m0 agent">
                          <div class="row m0">
                              <div class="row m0 imageRow">
                                <?php if($tsSubmittedProperty->userFun->userTypeFun->user_type_id == 4): ?>
                                <?php if(Storage::disk('agent_uploads')->has($tsSubmittedProperty->user_id.'.jpg')): ?>
                                <img src="<?php echo e(route('agent.image', ['filename' => $tsSubmittedProperty->user_id.'.jpg'])); ?>" alt="..." class="img-responsive"/>
                                <?php else: ?>
                                <img src="<?php echo e(route('agent.image', ['filename' => 'default.jpg'])); ?>" alt="" class="img-responsive">
                                <?php endif; ?>
                                <?php endif; ?>
                                  <ul class="nav">
                                      <li><a href="http://google.com"><i class="fa fa-google-plus"></i></a></li>
                                      <li><a href="http://www.twitter.com"><i class="fa fa-twitter"></i></a></li>
                                      <li><a href="http://www.linkedin.com"><i class="fa fa-linkedin"></i></a></li>
                                      <li><a href="http://www.facebook.com"><i class="fa fa-facebook"></i></a></li>
                                      <li><a href="#"><i class="fa fa-envelope"></i></a></li>
                                  </ul>
                              </div>
                              <div class="row m0 agent_details">
                                  <div class="row m0 phoneNumber"><i class="fa fa-phone-square"></i><?php echo e($tsSubmittedProperty->userFun->mobile); ?></div>
                                  <div class="row m0 inner">
                                      <a href="agent-details.html"><?php echo e($tsSubmittedProperty->userFun->name); ?></a>
                                      <span class="phone_trigger">
                                          <i class="fa fa-phone-square"></i>
                                          <i class="fa fa-long-arrow-down"></i>
                                      </span>
                                  </div>
                              </div>
                          </div>
                      </div> <!--Agent Block-->
                  </div>
                  <?php endif; ?>
                </div>
            </div>
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
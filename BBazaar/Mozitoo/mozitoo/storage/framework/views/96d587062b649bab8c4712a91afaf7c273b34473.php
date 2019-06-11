<?php $__env->startSection('tenantproperties'); ?>
<?php $__env->startSection('active2'); ?>
    class="active"
<?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.tenantheader', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="main-panel">
  <?php $__env->startSection('DashboardSiteMap'); ?>
      Tenant Dashboard / My Home
  <?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.tenantnav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      <div class="content">
        <div class="container-fluid">
        <?php if($data==true): ?>
            <div class="row">
                <div class="col-md-4">
                  <a href="<?php echo e(route('onetenantproperty.check',['prop_id'=>$tenant_prop->prop_id])); ?>">
                    <div class="card card-user">
                        <div class="image">
                          <?php if(Storage::disk('public_uploads')->has($tenant_prop->prop_id.'.jpg')): ?>
                            <img src="<?php echo e(route('prop.image', ['filename' => $tenant_prop->prop_id.'.jpg'])); ?>" alt="..." class="img-responsive"/>
                            <?php else: ?>
                            <img src="<?php echo e(route('prop.image', ['filename' => 'default.jpg'])); ?>" alt="" class="img-responsive">
                            <?php endif; ?>
                        </div>
                        <div class="content">
                            <div class="author">
                                <h4 class="title">
                                <?php if($tenant_prop->prop_title): ?><?php echo $tenant_prop->prop_title; ?>

                                <?php else: ?> 
                                N/A
                                <?php endif; ?>
                                </h4>
                            </div>    
                            <hr>
                            <div class="text-center">
                                <div class="row">
                                    <div class="col-md-6">
                                    <h5>Address Line 1<br />
                                        <small>
                                            <?php if($tenant_prop->prop_address_line1): ?><?php echo $tenant_prop->prop_address_line1; ?>

                                            <?php else: ?> 
                                            N/A
                                            <?php endif; ?>
                                        </small>
                                    </h5>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Location<br />
                                            <small>
                                                <?php if($tenant_prop->prop_locality): ?><?php echo $tenant_prop->prop_locality; ?>

                                                <?php else: ?> 
                                                N/A
                                                <?php endif; ?>
                                            </small>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="text-center">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>Property Type<br />
                                            <small>
                                                <?php if($tenant_prop->msPropTypeFun && $tenant_prop->msPropBhkFun): ?>
                                                <?php echo e($tenant_prop->msPropTypeFun->prop_type); ?> - <?php echo e($tenant_prop->msPropBhkFun->prop_bhk); ?>

                                                <?php else: ?> 
                                                N/A
                                                <?php endif; ?>
                                            </small>
                                        </h5>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Tenant Preferance<br />
                                            <small>
                                                <?php if($tenant_prop->msPropertyTenantFun): ?>
                                                <?php echo e($tenant_prop->msPropertyTenantFun->tenant_prefrences); ?>

                                                <?php else: ?> 
                                                N/A
                                                <?php endif; ?>
                                            </small>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="text-center">
                            Owner - <?php echo e(ucwords($tenant_prop->msPropertyUserFun->name)); ?>

                        </div>
                    </div>
                    </a>
                </div>
            </div>
            <?php else: ?>
            <div class="row">
              <div class="col-md-12">
              <div class="card">
                  <div class="header">
                      <h4 class="title">Your Home</h4>
                      <p class="category">You are not a tenant with us yet</p>
                  </div>
                  <div class="content">
                  <div class="alert alert-danger text-center">
                      <span><b> Info - </b> You are not a tenant with us yet</span>
                  </div>
                    </div>
                </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
<?php echo $__env->make('includes.adminfooter', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.tenant', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
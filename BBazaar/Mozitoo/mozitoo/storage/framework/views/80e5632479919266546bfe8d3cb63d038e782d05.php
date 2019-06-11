<?php $__env->startSection('adminproperties'); ?>
<?php $__env->startSection('active1'); ?>
    class="active"
<?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.adminheader', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="main-panel">
  <?php $__env->startSection('DashboardSiteMap'); ?>
      Admin Dashboard / All Properties
  <?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.adminnav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      <div class="content">
        <div class="container-fluid">
        <?php if($data==true): ?>
            <div class="row">
                <?php foreach($allProperties as $one_property): ?>
                <div class="col-md-4">
                  <a href="<?php echo e(route('oneproperty.check',['prop_id'=>$one_property->prop_id])); ?>">
                    <div class="card card-user">
                        <div class="image">
                          <?php if(Storage::disk('public_uploads')->has($one_property->prop_id.'.jpg')): ?>
                            <img src="<?php echo e(route('prop.image', ['filename' => $one_property->prop_id.'.jpg'])); ?>" alt="..." class="img-responsive"/>
                            <?php else: ?>
                            <img src="<?php echo e(route('prop.image', ['filename' => 'default.jpg'])); ?>" alt="" class="img-responsive">
                            <?php endif; ?>
                        </div>
                        <div class="content">
                            <div class="author">
                                <h4 class="title">
                                <?php if($one_property->prop_title): ?><?php echo $one_property->prop_title; ?>

                                <?php else: ?> 
                                N/A
                                <?php endif; ?>
                                <br />
                                <small class="title">
                                    <?php if($one_property->tsPropInvntLevelsFUn && $one_property->tsPropInvnts): ?>
                                    <?php echo $one_property->tsPropInvnts->fomatted_invnt_id; ?>

                                    <?php else: ?>
                                    N/A
                                    <?php endif; ?>
                                </small>
                                </h4>
                            </div>    
                            <hr>
                            <div class="text-center">
                                <div class="row">
                                    <div class="col-md-6">
                                    <h5>Address Line 1<br />
                                        <small>
                                            <?php if($one_property->prop_address_line1): ?><?php echo $one_property->prop_address_line1; ?>

                                            <?php else: ?> 
                                            N/A
                                            <?php endif; ?>
                                        </small>
                                    </h5>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Location<br />
                                            <small>
                                                <?php if($one_property->prop_locality): ?><?php echo $one_property->prop_locality; ?>

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
                                                <?php if($one_property->msPropTypeFun && $one_property->msPropBhkFun): ?>
                                                <?php echo e($one_property->msPropTypeFun->prop_type); ?> - <?php echo e($one_property->msPropBhkFun->prop_bhk); ?>

                                                <?php else: ?> 
                                                N/A
                                                <?php endif; ?>
                                            </small>
                                        </h5>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Tenants<br />
                                            <small>
                                                <?php if($one_property->tsPropTenants && count($one_property->tsPropTenants) > 0): ?>                                             
                                                <?php 
                                                    $resultstr = [];
                                                    foreach($one_property->tsPropTenants as $tenant)
                                                    {
                                                        $resultstr[] = $tenant->tenantFun->name; 
                                                    }
                                                    echo implode(", ",$resultstr);   
                                                 ?>
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
                            Listed By - <?php echo e($one_property->msPropertyUserFun->name); ?> ( <?php echo e($one_property->msPropertyUserFun->userTypeFun->user_type); ?> )

                        </div>
                    </div>
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
            <?php else: ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">All Properties</h4>
                            <p class="category">No active property</p>
                        </div>
                        <div class="content">
                        <div class="alert alert-danger text-center">
                            <span><b> Info - </b> There is no active property</span>
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

<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
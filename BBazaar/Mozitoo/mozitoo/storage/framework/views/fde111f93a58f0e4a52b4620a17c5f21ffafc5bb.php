<?php $__env->startSection('ownerproperties'); ?>
<?php $__env->startSection('active1'); ?>
    class="active"
<?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.ownerheader', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="main-panel">
  <?php $__env->startSection('DashboardSiteMap'); ?>
      Owner Dashboard / All Properties
  <?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.ownernav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      <div class="content">
        <div class="container-fluid">
        <?php if(isset($ts_prop) && $ts_prop && count($ts_prop) > 0): ?>
            <div class="row">
                <?php foreach($ts_prop as $one_property): ?>
                <div class="col-md-4">
                  <a href="<?php echo e(route('oneownerproperty.check',['prop_id'=>$one_property->prop_id])); ?>">
                    <div class="card card-user">
                        <div class="image">
                          <?php if(Storage::disk('public_uploads')->has($one_property->prop_id.'.jpg')): ?>
                            <img src="<?php echo e(route('prop.image', ['filename' => $one_property->prop_id.'.jpg'])); ?>" alt="Property Image" class="img-responsive"/>
                            <?php else: ?>
                            <img src="<?php echo e(route('prop.image', ['filename' => 'default.jpg'])); ?>" alt="Property Image" class="img-responsive">
                            <?php endif; ?>
                        </div>
                        <div class="content">
                            <div class="author">
                                <h4 class="title">
                                <?php if($one_property->prop_title): ?><?php echo $one_property->prop_title; ?>

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
                                        <h5>Availble as<br />
                                            <small>
                                                <?php if($one_property->tsPropInvntLevelsFUn): ?> 
                                                <?php 
                                                $resultstr = [];
                                                foreach($one_property->tsPropInvntLevelsFUn as $product)
                                                $resultstr[] = $product->msPropLevelFun->prop_invnt_level; 
                                                echo implode(" / ",$resultstr);   
                                                 ?>
                                                <?php else: ?>
                                                N/A
                                                <?php endif; ?>
                                                <?php if($one_property->msPropertyTenantFun): ?>
                                                    ( For - <?php echo e($one_property->msPropertyTenantFun->tenant_prefrences); ?> )
                                                <?php endif; ?>
                                            </small>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="text-center">
                            Listed By - <?php echo e($one_property->msPropertyUserFun->name); ?> ( <?php if($one_property->user_id == $owner->user_id): ?> You <?php endif; ?>)
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

<?php echo $__env->make('layouts.owner', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
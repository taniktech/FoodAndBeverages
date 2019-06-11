<?php $__env->startSection('pendingone'); ?>
<?php $__env->startSection('active2'); ?>
    class="active"
<?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.tenantheader', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="main-panel">
  <?php $__env->startSection('DashboardSiteMap'); ?>
  Tenant Dashboard / My Home / Details
  <?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.tenantnav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="content">
        <div class="container-fluid">
            <div class="row">
              <div class="col-md-4" id="mobile-top">
                <div class="card card-user">
                  <?php if(Storage::disk('public_uploads')->has($one_prop->prop_id.'.jpg')): ?>
                  <img src="<?php echo e(route('prop.image', ['filename' => $one_prop->prop_id.'.jpg'])); ?>" alt="" class="img-responsive">
                  <div class="property-image" style="margin-top:10px; margin-bottom:10px;">
                    <p class="description text-center"> Property image Uploaded by User
                    </p>
                  </div>
                  <?php else: ?>
                  <img src="<?php echo e(route('prop.image', ['filename' => 'default.jpg'])); ?>" alt="" class="img-responsive">
                  <div class="property-image" style="margin-top:10px; margin-bottom:10px;">
                    <p class="description text-center"> Default image
                    </p>
                  </div>
                  <?php endif; ?>
                </div>
                <?php if(count($prop_tenants) > 0): ?>
                <!-- Check if tenants exists-->
                <?php  
                $i = 0;
                 ?>
                <?php foreach($prop_tenants as $one_tenant): ?>   
                <?php  
                $i++;
                 ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header text-center">
                            <h4 class="title">Unit - <?php echo e($i); ?>  <?php if($one_tenant->invnt_status_id == 2 && $one_tenant->user_id != 0): ?><i class="pe-7s-check icon-success"></i><?php else: ?><i class="pe-7s-attention icon-danger"></i><?php endif; ?></h4> 
                            <?php 
                                $prop_id = $one_tenant->prop_id;
                                $invnt_id = $one_tenant->ts_prop_invnt_id;
                                $f_invnt_id = $one_tenant->fomatted_invnt_id;
                                $parameter= Crypt::encrypt($invnt_id);
                             ?>    
                            <a href="<?php echo e(route('onetenantproperty.check.oneinvnt',['prop_id'=>$prop_id,'invnt_id'=>$parameter,'check'=>$f_invnt_id])); ?>">See more</a>
                            <div class="content">
                            <?php if($one_tenant->invnt_status_id == 2 && $one_tenant->user_id != 0): ?>
                                <h5>Tenant Name : <?php if($one_tenant->tenantFun): ?><span class="text-info"><?php echo e($one_tenant->tenantFun->name); ?><?php else: ?> N/A <?php endif; ?></span></h5>
                                <h5>Tenant Mobile : <?php if($one_tenant->tenantFun): ?><span class="text-info"><?php echo e($one_tenant->tenantFun->mobile); ?><?php else: ?> N/A <?php endif; ?></span></h5>
                                <h5 class="title">Monthly Rent :<?php if($one_tenant->rent): ?><strong class="text-warning"> Rs. <?php echo e($one_tenant->rent); ?><?php else: ?> N/A <?php endif; ?></strong></h5>
                                <h5 class="category">Maintenance Charge :<?php if($one_tenant->maint_charge): ?><strong class="text-warning"> Rs. <?php echo e($one_tenant->maint_charge); ?><?php else: ?> N/A <?php endif; ?></strong></h5>
                            <?php else: ?>
                            <div class="alert alert-danger text-center">
                                <span><b> Info - </b> Unoccupied Inventory</span>
                            </div>
                            <?php endif; ?>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
                <?php endif; ?>
              </div>
              <div class="col-md-8">
                      <div class="card">
                          <div class="header">
                              <h4 class="title">Review Property</h4>
                          </div>
                          <hr/>
                          <div class="content">
                            <form id="owner-pending-property-form">
                            <fieldset disabled="disabled">
                              <input type="text" hidden name="prop_id" id="prop-id" value="<?php echo $one_prop->prop_id; ?>">
                                  <h4 class="title">Property Information</h4>
                                  <div class="row">
                                      <div class="col-md-12">
                                          <div class="form-group">
                                              <label for="property-title">Property Title</label>
                                              <input type="text" class="form-control" placeholder="Property Title" name="property_title" id="property-title" value="<?php if($one_prop->prop_title): ?><?php echo $one_prop->prop_title; ?><?php else: ?><?php echo $n_a; ?><?php endif; ?>">
                                          </div>
                                      </div>
                                  </div>
                                  <div class="row">
                                      <div class="col-md-12">
                                          <div class="form-group">
                                              <label for="property-desc">Property Description</label>
                                              <textarea rows="5" class="form-control" placeholder="Property Description" name="property_desc" id="property-desc"><?php if($one_prop->prop_desc): ?><?php echo $one_prop->prop_desc; ?><?php else: ?><?php echo $n_a; ?><?php endif; ?></textarea>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                          <label for="inputTenant">Tenant Preferences</label>
                                          <select class="selectpicker form-control" name="inputTenant" id="inputTenant">
                                          <optgroup label="Tenants">
                                            <?php if($one_prop->tenant_prefrences_id && $one_prop->msPropertyTenantFun): ?>
                                                <option selected><?php echo e($one_prop->msPropertyTenantFun->tenant_prefrences); ?></option>
                                            <?php endif; ?>
                                          </optgroup>
                                          </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                          <label for="property-type">Property Type</label>
                                          <select name="property_type" id="property-type" class="selectpicker form-control">
                                            <optgroup label="Property Type">
                                            <?php if($one_prop->prop_type_id && $one_prop->msPropTypeFun): ?>
                                            <option selected><?php echo e($one_prop->msPropTypeFun->prop_type); ?></option>
                                            <?php endif; ?>                                  
                                            </optgroup>
                                          </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                      <div class="form-group">
                                          <label for="property-bhk">BHK Type</label>
                                          <select name="property_bhk" id="property-bhk" class="selectpicker form-control">
                                            <optgroup label="Property BHK">
                                            <?php if($one_prop->prop_bhk_id && $one_prop->msPropBhkFun): ?>
                                              <option selected><?php echo e($one_prop->msPropBhkFun->prop_bhk); ?></option>
                                            <?php endif; ?> 
                                            </optgroup>
                                          </select>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row">
                                      <div class="col-md-3">
                                          <div class="form-group">
                                              <label for="property-age">Property Age</label>
                                              <input type="text" class="form-control" placeholder="Age Of Property" name="property_age" id="property-age" value="<?php if($one_prop->prop_age): ?><?php echo $one_prop->prop_age; ?><?php else: ?><?php echo $n_a; ?><?php endif; ?>">
                                          </div>
                                      </div>
                                      <div class="col-md-3">
                                          <div class="form-group">
                                              <label for="property-area">Area (in Sq. ft)</label>
                                              <input type="text" class="form-control" placeholder="Area" name="property_area" id="property-area" value="<?php if($one_prop->prop_area): ?><?php echo $one_prop->prop_area; ?><?php else: ?><?php echo $n_a; ?><?php endif; ?>">
                                          </div>
                                      </div>
                                      <div class="col-md-3">
                                        <div class="form-group">
                                          <label for="propertyFurnishingStatus">Furnishing status</label>
                                          <select name="propertyFurnishingStatus" id="propertyFurnishingStatus" class="selectpicker form-control">
                                            <optgroup label="Furnishing status">
                                            <?php if($one_prop->prop_furnish_status_id && $one_prop->furnishFUn): ?>
                                            <option selected><?php echo e($one_prop->furnishFUn->prop_furnish_status); ?></option>
                                            <?php endif; ?> 
                                            </optgroup>
                                          </select>
                                        </div>
                                    </div>
                                    <?php if($one_prop->prop_furniture_age): ?>
                                      <div class="col-md-3" id="ageOfFurn">
                                          <div class="form-group">
                                            <label for="propertyFurnishingAge">Age of furniture</label>
                                            <input type="text" name="" id="propertyFurnishingAge" class="form-control" value="<?php if($one_prop->prop_furniture_age): ?><?php echo $one_prop->prop_furniture_age; ?><?php else: ?><?php echo $n_a; ?><?php endif; ?>">
                                          </div>
                                      </div>
                                    <?php endif; ?> 
                                  </div>
                                  <hr/>
                                  <div class="row">
                                    <div class="col-md-12">
                                    <h4 class="title">Amenities</h4>
                                    <fieldset class="field4">
                                      <?php if(count($ms_property_amenties) > 0): ?>
                                      <?php foreach($ms_property_amenties as $msPropertyAmenty): ?>
                                      <div class="fleft checkbox_div">
                                          <input type="checkbox" checked class="amenityBoxes" value="<?php echo e($msPropertyAmenty->prop_amenty_id); ?>">
                                          <label for="amenity<?php echo e($msPropertyAmenty->prop_amenty_id); ?>"><?php echo e($msPropertyAmenty->prop_amenty_name); ?></label>
                                      </div> <!--checkbox-->
                                      <?php endforeach; ?>
                                    <?php endif; ?>
                                    </fieldset>
                                    <hr/>
                                    </div>
                                </div>
                                <h4 class="title">Property Address</h4>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="propertyAddressLine1">Address Line 1</label>
                                            <input type="text" class="form-control" placeholder="Address Line 1" name="propertyAddressLine1" id="propertyAddressLine1" value="<?php if($one_prop->prop_address_line1): ?><?php echo $one_prop->prop_address_line1; ?><?php else: ?><?php echo $n_a; ?><?php endif; ?>">
                                        </div>
                                    </div>
                                  </div>
                                  <div class="row">
                                      <div class="col-md-6">
                                          <div class="form-group">
                                              <label for="propertyLocation">Locality</label>
                                              <input type="text" class="form-control" placeholder="Property Location" name="propertyLocation" id="propertyLocality" value="<?php if($one_prop->prop_locality): ?><?php echo $one_prop->prop_locality; ?><?php else: ?><?php echo $n_a; ?><?php endif; ?>">
                                          </div>
                                      </div>
                                      <div class="col-md-6">
                                          <div class="form-group">
                                              <label for="propertyCity">City/District/Town</label>
                                              <input type="text" class="form-control" placeholder="City" name="propertyCity" id="propertyCity" value="<?php if($one_prop->prop_city): ?><?php echo $one_prop->prop_city; ?><?php else: ?><?php echo $n_a; ?><?php endif; ?>">
                                          </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="propertyPincode">Pincode</label>
                                                <input type="text" class="form-control" placeholder="Pincode" name="propertyPincode" id="propertyPincode" value="<?php if($one_prop->prop_pincode): ?><?php echo $one_prop->prop_pincode; ?><?php else: ?><?php echo $n_a; ?><?php endif; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="propertyState">State</label>
                                                <input type="text" class="form-control" placeholder="State" name="propertyState" id="propertyState" value="<?php if($one_prop->prop_state): ?><?php echo $one_prop->prop_state; ?><?php else: ?><?php echo $n_a; ?><?php endif; ?>">
                                            </div>
                                        </div>
        
                                      </div>
                                      <div class="row" style="display:none">
                                        <div class="form-group col-md-4">
                                          <label for="inputLat">Lat</label>
                                          <input type="text" class="form-control" name="inputLat" id="inputLat" value="<?php if($one_prop->prop_lat): ?><?php echo $one_prop->prop_lat; ?><?php else: ?><?php echo 0; ?><?php endif; ?>">
                                        </div>
                                        <div class="form-group col-md-4">
                                          <label for="inputLng">Long</label>
                                          <input type="text" class="form-control" name="inputLng" id="inputLng" value="<?php if($one_prop->prop_lng): ?><?php echo $one_prop->prop_lng; ?><?php else: ?><?php echo 0; ?><?php endif; ?>">
                                        </div>
                                      </div>
                                      <hr/>
                                </fieldset>
                            </form>
                          </div>
                      </div>
                  </div>
                <div class="col-md-4" id="desktop-top">
                      <div class="card card-user">
                          <?php if(Storage::disk('public_uploads')->has($one_prop->prop_id.'.jpg')): ?>
                          <img src="<?php echo e(route('prop.image', ['filename' => $one_prop->prop_id.'.jpg'])); ?>" alt="" class="img-responsive">
                          <div class="property-image" style="margin-top:10px; margin-bottom:10px;">
                              <p class="description text-center"> Property image Uploaded by User
                              </p>
                          </div>
                          <?php else: ?>
                          <img src="<?php echo e(route('prop.image', ['filename' => 'default.jpg'])); ?>" alt="" class="img-responsive">
                          <div class="property-image" style="margin-top:10px; margin-bottom:10px;">
                              <p class="description text-center"> Default image
                              </p>
                          </div>
                          <?php endif; ?>
                          </div>
                          <?php if(count($prop_tenants) > 0): ?>
                          <!-- Check if tenants exists-->
                          <?php  
                          $i = 0;
                           ?>
                          <?php foreach($prop_tenants as $one_tenant): ?>   
                          <?php  
                          $i++;
                           ?>
                          <div class="row">
                              <div class="col-md-12">
                                  <div class="card">
                                      <div class="header text-center">
                                      <h4 class="title">Unit - <?php echo e($i); ?>  <?php if($one_tenant->invnt_status_id == 2 && $one_tenant->user_id != 0): ?><i class="pe-7s-check icon-success"></i><?php else: ?><i class="pe-7s-attention icon-danger"></i><?php endif; ?></h4> 
                                    <?php 
                                        $prop_id = $one_tenant->prop_id;
                                        $invnt_id = $one_tenant->ts_prop_invnt_id;
                                        $f_invnt_id = $one_tenant->fomatted_invnt_id;
                                        $parameter= Crypt::encrypt($invnt_id);
                                     ?>    
                                    <a href="<?php echo e(route('onetenantproperty.check.oneinvnt',['prop_id'=>$prop_id,'invnt_id'=>$parameter,'check'=>$f_invnt_id])); ?>">See more</a>
                                      <div class="content">
                                      <?php if($one_tenant->invnt_status_id == 2 && $one_tenant->user_id != 0): ?>
                                          <h5>Tenant Name : <?php if($one_tenant->tenantFun): ?><span class="text-info"><?php echo e($one_tenant->tenantFun->name); ?><?php else: ?> N/A <?php endif; ?></span></h5>
                                          <h5>Tenant Mobile : <?php if($one_tenant->tenantFun): ?><span class="text-info"><?php echo e($one_tenant->tenantFun->mobile); ?><?php else: ?> N/A <?php endif; ?></span></h5>
                                          <h5 class="title">Monthly Rent :<?php if($one_tenant->rent): ?><strong class="text-warning"> Rs. <?php echo e($one_tenant->rent); ?><?php else: ?> N/A <?php endif; ?></strong></h5>
                                          <h5 class="category">Maintenance Charge :<?php if($one_tenant->maint_charge): ?><strong class="text-warning"> Rs. <?php echo e($one_tenant->maint_charge); ?><?php else: ?> N/A <?php endif; ?></strong></h5>
                                      <?php else: ?>
                                      <div class="alert alert-danger text-center">
                                          <span><b> Info - </b> Unoccupied Inventory</span>
                                      </div>
                                      <?php endif; ?>
                                      </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <?php endforeach; ?>
                          <?php endif; ?>
                </div>
            </div>
        </div>
      </div>


<?php echo $__env->make('includes.adminfooter', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.tenant', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
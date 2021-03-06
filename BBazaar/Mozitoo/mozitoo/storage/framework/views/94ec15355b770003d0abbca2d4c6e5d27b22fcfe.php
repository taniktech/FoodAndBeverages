<?php $__env->startSection('pendingone'); ?>
<?php $__env->startSection('active1'); ?>
    class="active"
<?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.ownerheader', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="main-panel">
  <?php $__env->startSection('DashboardSiteMap'); ?>
  Owner Dashboard / All Properties / Review One
  <?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.ownernav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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
          <?php if(count($prop_mgr) > 0): ?>
          <!-- Check if Manager is assigned-->
          <div class="card">
          <div class="header">
              <h4 class="title">Property Manager</h4>
              <p class="category">Details of Person</p>
          </div>
          <div class="content">
                <div class="table-responsive table-full-width">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                            <td class="text-left">Name</td>
                            <td class="text-left">:</td>
                            <td class="text-left"><?php if($prop_mgr->userFun): ?><?php echo e($prop_mgr->userFun->name); ?><?php else: ?> N/A <?php endif; ?></td> 
                            </tr>  
                            <tr>
                            <td class="text-left">Mobile</td>
                            <td class="text-left">:</td>
                            <td class="text-left">
                                <?php if($prop_mgr->userFun): ?>
                                <?php echo e($prop_mgr->userFun->mobile); ?>

                                <?php else: ?> N/A
                                <?php endif; ?>
                            </td> 
                            </tr> 
                            <tr>
                                <td class="text-left">Email</td>
                                <td class="text-left">:</td>
                                <td class="text-left">
                                    <?php if($prop_mgr->userFun): ?>
                                    <?php echo e($prop_mgr->userFun->email); ?>

                                    <?php else: ?> N/A
                                    <?php endif; ?>
                                </td> 
                            </tr>   
                        </tbody>
                    </table>
                </div>
          </div>
        </div>
        <?php endif; ?>
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
                    <h4 class="title">Inventory - <?php echo e($i); ?>  <?php if($one_tenant->invnt_status_id == 2 && $one_tenant->user_id != 0): ?><i class="pe-7s-check icon-success"></i><?php else: ?><i class="pe-7s-attention icon-danger"></i><?php endif; ?></h4>
                    <?php 
                        $prop_id = $one_tenant->prop_id;
                        $invnt_id = $one_tenant->ts_prop_invnt_id;
                        $f_invnt_id = $one_tenant->fomatted_invnt_id;
                        $parameter= Crypt::encrypt($invnt_id);
                     ?>    
                    <a href="<?php echo e(route('oneownerproperty.check.oneinvnt',['prop_id'=>$prop_id,'invnt_id'=>$parameter,'check'=>$f_invnt_id])); ?>">See more</a>
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
                    <form id="pending-property-form">
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
                                      <option class="ignore" value="">Select...</option>
                                      <?php if(count($msTenantPrefrences) > 0 && $one_prop->tenant_prefrences_id): ?>
                                      <?php foreach($msTenantPrefrences as $msTenantPrefrence): ?>
                                          <option value="<?php echo e($msTenantPrefrence->tenant_prefrences_id); ?>" <?php if($one_prop->tenant_prefrences_id == $msTenantPrefrence->tenant_prefrences_id): ?> selected <?php endif; ?>><?php echo e($msTenantPrefrence->tenant_prefrences); ?></option>
                                      <?php endforeach; ?>
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
                                      <option class="ignore" value="">Select...</option>
                                      <?php if(count($msPropertyTypes) > 0 && $one_prop->prop_type_id): ?>
                                      <?php foreach($msPropertyTypes as $msPropertyType): ?>
                                      <option value="<?php echo e($msPropertyType->prop_type_id); ?>" <?php if($one_prop->prop_type_id == $msPropertyType->prop_type_id): ?> selected <?php endif; ?>><?php echo e($msPropertyType->prop_type); ?></option>
                                      <?php endforeach; ?>  
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
                                      <option class="ignore" value="">Select...</option>
                                      <?php if(count($msPropBhkTypes) > 0 && $one_prop->prop_bhk_id): ?>
                                      <?php foreach($msPropBhkTypes as $msPropBhkType): ?>
                                        <option value="<?php echo e($msPropBhkType->prop_bhk_id); ?>"  <?php if($one_prop->prop_bhk_id == $msPropBhkType->prop_bhk_id): ?> selected <?php endif; ?>><?php echo e($msPropBhkType->prop_bhk); ?></option>
                                      <?php endforeach; ?>
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
                                      <option class="ignore" value="">Select...</option>
                                      <?php if(count($msPropertyFurnishStatuses) > 0 && $one_prop->prop_furnish_status_id): ?>
                                      <?php foreach($msPropertyFurnishStatuses as $msPropertyFurnishStatuse): ?>
                                      <option value="<?php echo e($msPropertyFurnishStatuse->prop_furnish_status_id); ?>" <?php if($one_prop->prop_furnish_status_id == $msPropertyFurnishStatuse->prop_furnish_status_id): ?> selected <?php endif; ?>><?php echo e($msPropertyFurnishStatuse->prop_furnish_status); ?></option>
                                      <?php endforeach; ?>
                                      <?php endif; ?> 
                                      </optgroup>
                                    </select>
                                  </div>
                              </div>
                                <div class="col-md-3" id="ageOfFurn">
                                    <div class="form-group">
                                      <label for="propertyFurnishingAge">Age of furniture</label>
                                      <input type="text" name="" id="propertyFurnishingAge" class="form-control" value="<?php if($one_prop->prop_furniture_age): ?><?php echo $one_prop->prop_furniture_age; ?><?php else: ?><?php echo $n_a; ?><?php endif; ?>">
                                    </div>
                                </div>
                            </div>
                            <hr/>
                            <div class="row">
                              <div class="col-md-12">
                              <h4 class="title">Amenities</h4>
                              <fieldset class="field4">
                                <?php if($msPropertyAmentyAllCheck==true): ?>
                                <?php foreach($msPropertyAmenties as $msPropertyAmenty): ?>
                                <div class="fleft checkbox_div">
                                    <input type="checkbox" checked class="amenityBoxes" id="amenity<?php echo e($msPropertyAmenty->prop_amenty_id); ?>" value="<?php echo e($msPropertyAmenty->prop_amenty_id); ?>">
                                    <label for="amenity<?php echo e($msPropertyAmenty->prop_amenty_id); ?>"><?php echo e($msPropertyAmenty->prop_amenty_name); ?></label>
                                </div> <!--checkbox-->
                                <?php endforeach; ?>
                                <?php foreach($msPropertyAmentyAll as $msPropertyAmenty): ?>
                                  <div class="fleft checkbox_div">
                                      <input type="checkbox" class="amenityBoxes" id="amenity<?php echo e($msPropertyAmenty->prop_amenty_id); ?>" value="<?php echo e($msPropertyAmenty->prop_amenty_id); ?>">
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
                                <h4 class="title">Property Picture</h4>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="propertyPic">Property Picture</label>
                                            <input id="propertyPic" name="property_pic" class="file" type="file" data-show-upload="false">
                                        </div>
                                    </div>
                                </div>
                                  <hr/>
                              <?php if(count($ts_prop_invnt_levels) > 0): ?>
                              <?php 
                              $i = 0;
                               ?>
                                <h4 class="title">Rental Type</h4>
                                <?php foreach($ts_prop_invnt_levels as $ts_prop_invnt_level): ?>
                                
                              <div class="row">
                                  <div class="col-sm-4">
                                      <div class="form-group">
                                      <label for="prop-invnt-level[<?php echo e($i); ?>]">Category</label>
                                      <input type="text" id="prop-invnt-level[<?php echo e($i); ?>]" class="form-control" value="<?php if($ts_prop_invnt_level->msPropLevelFun): ?><?php echo e($ts_prop_invnt_level->msPropLevelFun->prop_invnt_level); ?><?php else: ?><?php echo $n_a; ?><?php endif; ?>" disabled>
                                      </div>
                                  </div>    
                                  <div class="" style="display:none">
                                      <div class="form-group">
                                          <input type="text" name="ts_prop_invnt_level[<?php echo e($i); ?>]" class="form-control" value="<?php if($ts_prop_invnt_level->ts_prop_invnt_level_id): ?><?php echo e($ts_prop_invnt_level->ts_prop_invnt_level_id); ?><?php else: ?><?php echo $n_a; ?><?php endif; ?>">
                                      </div>
                                      <div class="form-group">
                                          <input type="text" name="prop_invnt_level[<?php echo e($i); ?>]" class="form-control" value="<?php if($ts_prop_invnt_level->prop_invnt_level_id): ?><?php echo e($ts_prop_invnt_level->prop_invnt_level_id); ?><?php else: ?><?php echo $n_a; ?><?php endif; ?>">
                                      </div>
                                  </div>
                                  <div class="col-sm-4">
                                      <div class="form-group">
                                      <label for="exp-rent<?php echo e($i); ?>">Expected Rent</label>
                                     <input type="text" name="exp_rent[<?php echo e($i); ?>]" id="exp-rent<?php echo e($i); ?>" class="form-control" value="<?php if($ts_prop_invnt_level->exp_rent): ?><?php echo e($ts_prop_invnt_level->exp_rent); ?><?php else: ?><?php echo $n_a; ?><?php endif; ?>">
                                      </div>
                                  </div>                                
                                  <div class="col-sm-4">
                                      <div class="form-group">
                                      <label for="exp-depo[<?php echo e($i); ?>]">Expected Deposit</label>
                                      <input type="text" name="exp_depo[<?php echo e($i); ?>]" id="exp-depo[<?php echo e($i); ?>]" class="form-control" value="<?php if($ts_prop_invnt_level->exp_deposit): ?><?php echo e($ts_prop_invnt_level->exp_deposit); ?><?php else: ?><?php echo $n_a; ?><?php endif; ?>">
                                      </div>
                                  </div>
                              </div>
                              <?php 
                              $i++;
                               ?>
                              <?php endforeach; ?>
                            <?php /* <div class="text-right">
                            <button type="submit" class="btn btn-info btn-fill">Approve Property</button>
                            </div> */ ?>
                            <div class="clearfix"></div>
                            <?php endif; ?>
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
                    <?php if(count($prop_mgr) > 0): ?>
                    <!-- Check if Manager is assigned-->
                    <div class="card">
                    <div class="header">
                        <h4 class="title">Property Manager</h4>
                        <p class="category">Details of Person</p>
                    </div>
                    <div class="content">
                        <div class="table-responsive table-full-width">
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                    <td class="text-left">Name</td>
                                    <td class="text-left">:</td>
                                    <td class="text-left"><?php if($prop_mgr->userFun): ?><?php echo e($prop_mgr->userFun->name); ?><?php else: ?> N/A <?php endif; ?></td> 
                                    </tr>  
                                    <tr>
                                    <td class="text-left">Mobile</td>
                                    <td class="text-left">:</td>
                                    <td class="text-left">
                                        <?php if($prop_mgr->userFun): ?>
                                        <?php echo e($prop_mgr->userFun->mobile); ?>

                                        <?php else: ?> N/A
                                        <?php endif; ?>
                                    </td> 
                                    </tr> 
                                    <tr>
                                        <td class="text-left">Email</td>
                                        <td class="text-left">:</td>
                                        <td class="text-left">
                                            <?php if($prop_mgr->userFun): ?>
                                            <?php echo e($prop_mgr->userFun->email); ?>

                                            <?php else: ?> N/A
                                            <?php endif; ?>
                                        </td> 
                                    </tr>   
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
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
                            <h4 class="title">Inventory - <?php echo e($i); ?>  <?php if($one_tenant->invnt_status_id == 2 && $one_tenant->user_id != 0): ?><i class="pe-7s-check icon-success"></i><?php else: ?><i class="pe-7s-attention icon-danger"></i><?php endif; ?></h4>
                            <?php 
                                $prop_id = $one_tenant->prop_id;
                                $invnt_id = $one_tenant->ts_prop_invnt_id;
                                $f_invnt_id = $one_tenant->fomatted_invnt_id;
                                $parameter= Crypt::encrypt($invnt_id);
                             ?>    
                            <a href="<?php echo e(route('oneownerproperty.check.oneinvnt',['prop_id'=>$prop_id,'invnt_id'=>$parameter,'check'=>$f_invnt_id])); ?>">See more</a>
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

<div class="modal" tabindex="-1" role="dialog" id="success-review-modal" data-backdrop="false" aria-labelledby="myModalLabel" style="background-color:rgba(256,256,256, 0.9);">
  <div class="modal-dialog">
      <div class="modal-content">
          <div style="" class="modal-header">
              <h3 style="text-align:center" class="modal-title"> Successfully Reviewed</h3>
          </div>
          <div class="modal-body">
              <div class="text-center">
                 <i style="font-size: 40px;" class="pe-7s-check animated rotateIn"></i>
                  <p>Property Successfully Updated.</p>
              </div>
          </div>
      <div style="text-align:center" class="modal-footer">
      <button style="" type="button" class="btn btn-primary" class="button button-block" id="reloadSucModal">
        Ok
      </button>
      </div>
    </div>
  </div>
</div><!-- /.modal -->
<!--jQuery-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
var token = '<?php echo e(Session::token()); ?>';
var UrlUpdateOneOwnerProperty = '<?php echo e(route('update.one.owner.property')); ?>';
var ownerAllProp = '<?php echo e(route('owner.property.all')); ?>';
</script>
<script>
$( document ).ready(function() {
  var fullFurnDefault = $('#propertyFurnishingStatus').val();
  if(fullFurnDefault == 3)
  {
    $('#ageOfFurn').show();
    $("#propertyFurnishingAge").attr('name', 'propertyFurnishingAge');
  }
  else {
      $('#ageOfFurn').hide();
  }

$("#propertyFurnishingStatus").change(function(){
var fullFurn = $('#propertyFurnishingStatus').val();
if(fullFurn == 3)
{
  $('#ageOfFurn').show();
  $("#propertyFurnishingAge").attr('name', 'propertyFurnishingAge');
}
else {
    $('#ageOfFurn').hide();
}
});
});
</script>
<?php echo $__env->make('includes.adminfooter', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>
    <script>
      // This example displays an address form, using the autocomplete feature
      // of the Google Places API to help users fill in the information.

      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      var placeSearch, autocomplete;
      var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name'
      };

      function initAutocomplete() {
        // Create the autocomplete object, restricting the search to geographical
        // location types.
        autocomplete = new google.maps.places.Autocomplete(
            /** @type  {!HTMLInputElement} */(document.getElementById('propertyLocality')),
            {types: ['geocode']});

        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);
      }

      function fillInAddress() {
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();
        var lat = place.geometry.location.lat(),
        lng = place.geometry.location.lng();
        // Then do whatever you want with them
          document.getElementById('inputLat').value = lat;
          document.getElementById('inputLng').value = lng;
      }

      // Bias the autocomplete object to the user's geographical location,
      // as supplied by the browser's 'navigator.geolocation' object.
      function geolocate() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var geolocation = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            var circle = new google.maps.Circle({
              center: geolocation,
              radius: position.coords.accuracy
            });
            autocomplete.setBounds(circle.getBounds());
          });
        }
      }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAt7SQhfY0th76s-6n_TQwN1KY1c3hnqa8&libraries=places&callback=initAutocomplete"
        async defer></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.owner', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
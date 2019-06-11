<?php $__env->startSection('tenant'); ?>
<?php $__env->startSection('active2'); ?>
    class="active"
<?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.tenantheader', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="main-panel">
  <?php $__env->startSection('DashboardSiteMap'); ?>
  Tenant Dashboard/ Add new Property
  <?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.tenantnav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      <div class="content">
        <div class="container-fluid">
          <div class="row">
              <div class="col-md-12">
                  <div class="card">
                      <div class="header" style="padding-bottom:20px;">
                          <h4 class="title">Add new Property</h4>
                          <p class="category">You can add property here.</p>
                      </div>
                    </div>
              </div>
          </div>
          <section class="row contentRow submit_property">
            <form id="submit_property_form" class="row" method="POST" enctype="multipart/form-data">
                <h4 class="form_heading">Property Informations</h4>
                <fieldset class="field1">
                  <?php if($tenantPrefrence==true): ?>
                  <div class="form-group">
                  <label for="inputTenant">Tenant Preferences</label>
                  <select name="inputTenant" id="inputTenant" class="form-control selectpicker">
                  <optgroup label="Tenants">
                    <option class="ignore" value="">Select...</option>
                      <?php foreach($msTenantPrefrences as $msTenantPrefrence): ?>
                          <option value="<?php echo e($msTenantPrefrence->tenant_prefrences_id); ?>"><?php echo e($msTenantPrefrence->tenant_prefrences); ?></option>
                      <?php endforeach; ?>
                  </optgroup>
                  </select>
                  </div>
                  <?php endif; ?>
                    <div class="form-group property_title">
                        <label for="property_title">Property Name</label>
                        <input type="text" class="form-control" name="property_title" id="property_title" >
                    </div>
                    <div class="form-group property_desc">
                        <label for="property_desc">Property Description (* Please specify the vastu)</label>
                        <textarea name="property_desc" id="property_desc" class="form-control"></textarea>
                    </div>
                    <div class="row">
                      <?php if($propertyType==true): ?>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="property_type">Property Type</label>
                                <select name="property_type" id="property_type" class="form-control selectpicker">
                                  <optgroup label="Property Type">
                                  <option class="ignore" value="">Select...</option>
                                  <?php foreach($msPropertyTypes as $msPropertyType): ?>
                                  <option value="<?php echo e($msPropertyType->prop_type_id); ?>"><?php echo e($msPropertyType->prop_type); ?></option>
                                  <?php endforeach; ?>
                                  </optgroup>
                                </select>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if($propBhkType==true): ?>
                        <div class="col-sm-4">
                          <div class="form-group">
                              <label for="property-bhk">BHK Type</label>
                              <select name="property_bhk" id="property-bhk" class="form-control selectpicker">
                                <optgroup label="Property BHK">
                                <option class="ignore" value="">Select...</option>
                                <?php foreach($msPropBhkTypes as $msPropBhkType): ?>
                                  <option value="<?php echo e($msPropBhkType->prop_bhk_id); ?>"><?php echo e($msPropBhkType->prop_bhk); ?></option>
                                <?php endforeach; ?>
                                </optgroup>
                              </select>
                          </div>
                        </div>
                        <?php endif; ?>
                        <div class="col-sm-4">
                              <div class="form-group area">
                                  <label for="property_area">Area ( In Sq.ft )</label>
                                  <input class="form-control" name="property_area" id="property_area" type="text">
                              </div>
                          </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-4">
                          <div class="form-group age">
                              <label for="property_age">Age of property ( In Months )</label>
                              <input type="text" name="property_age" id="property_age" class="form-control">
                          </div>
                      </div>
                      <?php if($propertyFurnishStatus==true): ?>
                      <div class="col-sm-4">
                      <div class="form-group furnishing">
                          <label for="property_furnishing_status">Furnishing status</label>
                          <select name="property_furnishing_status" id="property_furnishing_status" class="form-control selectpicker">
                              <optgroup label="Furnishing status">
                              <option class="ignore" value="">Select...</option>
                              <?php foreach($msPropertyFurnishStatuses as $msPropertyFurnishStatuse): ?>
                              <option value="<?php echo e($msPropertyFurnishStatuse->prop_furnish_status_id); ?>"><?php echo e($msPropertyFurnishStatuse->prop_furnish_status); ?></option>
                               <?php endforeach; ?>
                              </optgroup>
                          </select>
                      </div>
                      </div>
                      <?php endif; ?>
                        <div class="col-sm-4" id="ageFurn">
                            <div class="form-group furnitureage">
                                <label for="property_furnishing_age">Age of furniture</label>
                                <input type="text" name="" id="property_furnishing_age" class="form-control">
                            </div>
                        </div>
                    </div>
                </fieldset>
                <?php if($propInvntLevel==true): ?>
                <h4 class="form_heading">Rental Details</h4>
                <fieldset class="field2">
                  <div class="form-group">
                      <label for="rental-type">Rent As</label>
                      <select multiple="multiple" name="rental_type[]" id="rental-type" class="form-control">
                          <?php foreach($msPropInvntLevels as $msPropInvntLevel): ?>
                          <option value="<?php echo e($msPropInvntLevel->prop_invnt_level_id); ?>" data-invt="<?php echo e($msPropInvntLevel->prop_invnt_level_id); ?>"><?php echo e($msPropInvntLevel->prop_invnt_level); ?></option>
                          <?php endforeach; ?>
                      </select>
                  </div>
                  <!--Dynamic rent categories will be added -->
                  <div id="rent-categories">
                  </div>
                </fieldset>
                <?php endif; ?>
                <h4 class="form_heading">Add Photo Gallery</h4>
                <fieldset class="field3">
                <input id="add_photo_gallery" name="add_photo_gallery" class="file" type="file" data-min-file-count="1" data-show-upload="false">
                </fieldset>
                <h4 class="form_heading">Property full address</h4>
                <fieldset class="field4">
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="form-group">
                              <label for="addressline1">Address Line 1</label>
                              <input type="text" class="form-control" name="addressline1" id="addressline1">
                          </div>
                          </div>
                      </div>
                          <div class="row">
                              <div class="col-sm-6">
                                  <div class="form-group">
                                      <label for="">Locality</label>
                                      <input type="text" name="inputLocality" id="inputLocality" class="form-control">
                                  </div>
                              </div>
                              <?php if($ts_state): ?>
                              <div class="col-sm-6">
                                  <div class="form-group">
                                      <label for="inputState">State</label>
                                      <select class="form-control selectpicker" data-live-search="true" data-size="10" name="inputState" id="inputState">
                                          <option value="" class="ignore">Select...</option> 
                                          <?php if(count($ts_states) > 0): ?>
                                              <?php foreach($ts_states as $ts_state): ?>
                                                  <option value="<?php echo e($ts_state->state_id); ?>" class="ignore"><?php echo e($ts_state->name); ?></option>
                                              <?php endforeach; ?>       
                                          <?php endif; ?>                                  
                                      </select>
                                  </div>
                              </div>
                              <?php endif; ?>
                          </div>
                          <div class="row">
                              <?php if($ts_state && count($ts_states) > 0): ?>
                              <div class="col-sm-6">
                                  <div class="form-group">
                                      <label for="inputCity">City/District/Town</label>
                                      <select class="form-control selectpicker" data-live-search="true" data-size="10" name="inputCity" id="inputCity">
                                          <option value="" class="ignore">Select...</option>                                
                                      </select>
                                  </div>
                              </div>
                              <?php endif; ?>
                              <div class="col-sm-6">
                                  <div class="form-group property_address_pincode">
                                      <label for="inputPincode">Pincode</label>
                                      <input type="text" name="inputPincode" id="inputPincode" class="form-control">
                                  </div>
                              </div>
                          </div>
                          <div class="row" style="display:none">
                            <div class="form-group col-md-4">
                              <label for="inputLat">Lat</label>
                              <input type="text" class="form-control" name="inputLat" id="inputLat" value="0">
                            </div>
                            <div class="form-group col-md-4">
                              <label for="inputLng">Long</label>
                              <input type="text" class="form-control" name="inputLng" id="inputLng" value="0">
                            </div>
                            </div>
                </fieldset>
                <h4 class="form_heading">Amenities</h4>
                <fieldset class="field5">
                  <?php if($propertyAmenty==true): ?>
                  <?php foreach($msPropertyAmenties as $msPropertyAmenty): ?>
                    <div class="fleft checkbox_div">
                        <input type="checkbox" class="amenityBoxes" id="amenity<?php echo e($msPropertyAmenty->prop_amenty_id); ?>" value="<?php echo e($msPropertyAmenty->prop_amenty_id); ?>">
                        <label for="amenity<?php echo e($msPropertyAmenty->prop_amenty_id); ?>"><?php echo e($msPropertyAmenty->prop_amenty_name); ?></label>
                    </div> <!--checkbox-->
                    <?php endforeach; ?>
                    <?php endif; ?>
                </fieldset>
            </form>
          </section>
          <!--Content Area End-->
        </div>
        <div id="divLoading"> 

        </div>
    </div>
    <?php echo $__env->make('includes.adminfooter', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>
    <script>
    var token = '<?php echo e(Session::token()); ?>';
    var url_tenant_sub_form = '<?php echo e(route('tenant.submitnewform')); ?>';
    var url_get_respective_cities = '<?php echo e(route('get.respective.cities')); ?>';
    var url_owner_dashboard = '<?php echo e(route('ownerdashboard')); ?>';
    </script>
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
            /** @type  {!HTMLInputElement} */(document.getElementById('inputLocality')),
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

<?php echo $__env->make('layouts.tenant', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
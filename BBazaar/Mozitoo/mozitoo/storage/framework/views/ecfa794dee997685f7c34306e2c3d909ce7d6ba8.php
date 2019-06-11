<?php $__env->startSection('pendingone'); ?>
<?php $__env->startSection('active1'); ?>
    class="active"
<?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.adminheader', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="main-panel">
  <?php $__env->startSection('DashboardSiteMap'); ?>
  Admin Dashboard / All Properties / Review One
  <?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.adminnav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="content">
  <div class="container-fluid">
      <div class="row">
        <div class="col-md-4" id="mobile-top">
          <div class="card card-user">
            <?php if(Storage::disk('public_uploads')->has($oneProperty->prop_id.'.jpg')): ?>
            <img src="<?php echo e(route('prop.image', ['filename' => $oneProperty->prop_id.'.jpg'])); ?>" alt="" class="img-responsive">
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
          <!--Property Listed By-->
          <div class="card">
          <div class="header">
            <?php if($oneProperty->userFun->userTypeFun->user_type_id == 4): ?>
              <h4 class="title">Property Listed By (Manager)</h4>
            <?php elseif($oneProperty->userFun->userTypeFun->user_type_id == 3): ?>
            <h4 class="title">Property Listed By (Owner)</h4>
            <?php endif; ?>
              <p class="category">Details of Person</p>
          </div>
          <div class="content">
            <div class="form-group">
                <label for="propertyOwnerName">Name (disabled)</label>
                <input type="text" class="form-control" disabled placeholder="Name" name="propertyOwnerName" id="propertyOwnerName" value="<?php echo $oneProperty->userFun->name; ?>">
            </div>
            <div class="form-group">
                <label for="propertyOwnerName">Email (disabled)</label>
                <input type="text" class="form-control" disabled placeholder="Name" name="propertyOwnerName" id="propertyOwnerName" value="<?php echo $oneProperty->userFun->email; ?>">
            </div>
            <div class="form-group">
                <label for="propertyOwnerName">Mobile (disabled)</label>
                <input type="text" class="form-control" disabled placeholder="Name" name="propertyOwnerName" id="propertyOwnerName" value="<?php echo $oneProperty->userFun->mobile; ?>">
            </div>
          </div>

          </div>

          <!--Property Listed By ends-->
          <!-- Tagged Perosn-->
          <?php if($taggedProperty == true): ?>
          <?php foreach($tsTaggedProperty as $oneTaggedProperty): ?>
          <div class="card">
          <div class="header">
            <?php if($oneTaggedProperty->userFun->userTypeFun->user_type_id == 4): ?>
              <h4 class="title">Property Manager</h4>
            <?php elseif($oneTaggedProperty->userFun->userTypeFun->user_type_id == 2): ?>
            <h4 class="title">Tenant</h4>
            <?php endif; ?>
              <p class="category">Details of Person</p>
          </div>
          <div class="content">
            <div class="form-group">
                <label for="propertyOwnerName">Name (disabled)</label>
                <input type="text" class="form-control" disabled placeholder="Name" name="propertyOwnerName" id="propertyOwnerName" value="<?php echo $oneTaggedProperty->userFun->name; ?>">
            </div>
            <div class="form-group">
                <label for="propertyOwnerName">Email (disabled)</label>
                <input type="text" class="form-control" disabled placeholder="Name" name="propertyOwnerName" id="propertyOwnerName" value="<?php echo $oneTaggedProperty->userFun->email; ?>">
            </div>
            <div class="form-group">
                <label for="propertyOwnerName">Mobile (disabled)</label>
                <input type="text" class="form-control" disabled placeholder="Name" name="propertyOwnerName" id="propertyOwnerName" value="<?php echo $oneTaggedProperty->userFun->mobile; ?>">
            </div>
          </div>

          </div>

          <?php endforeach; ?>
          <?php endif; ?>
          <!-- Tagged Perosn ends-->
        </div>
          <div class="col-md-8">
              <div class="card">
                  <div class="header">
                      <h4 class="title">Review Property</h4>
                  </div>
                  <hr/>
                  <div class="content">
                  <form id="onePropertyForm">
                      <input type="text" hidden name="propertyID" id="propertyID" value="<?php echo $oneProperty->prop_id; ?>">
                          <h4 class="title">Property Information</h4>
                          <div class="row">
                              <div class="col-md-12">
                                  <div class="form-group">
                                      <label for="propertyTitle">Property Title</label>
                                      <input type="text" class="form-control" placeholder="Property Title" name="propertyTitle" id="propertyTitle" value="<?php echo $oneProperty->prop_title; ?>">
                                  </div>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-md-12">
                                  <div class="form-group">
                                      <label for="propertyDesc">Property Description</label>
                                      <textarea rows="5" class="form-control" placeholder="Property Description" name="propertyDesc" id="propertyDesc"><?php echo $oneProperty->prop_desc; ?></textarea>
                                  </div>
                              </div>
                          </div>
                          <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                  <label for="inputTenant">Tenant Preferences</label>
                                  <select class="selectpicker form-control" name="inputTenant" id="inputTenant">
                                  <optgroup label="Tenants">
                                    <option class="ignore" value="">Select...</option>
                                    <option value="1" <?php if($oneProperty->tenant_prefrences_id == 1): ?> selected <?php endif; ?>>Family</option>
                                    <option value="2" <?php if($oneProperty->tenant_prefrences_id == 2): ?> selected <?php endif; ?>>Bachelors</option>
                                    <option value="3" <?php if($oneProperty->tenant_prefrences_id == 3): ?> selected <?php endif; ?>>Both, Family & Bachelors</option>
                                    <option value="4" <?php if($oneProperty->tenant_prefrences_id == 4): ?> selected <?php endif; ?>>No Choice</option>
                                  </optgroup>
                                  </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                  <label for="propertyType">Property Type</label>
                                  <select name="propertyType" id="propertyType" class="selectpicker form-control">
                                    <optgroup label="Property Type">
                                    <option class="ignore" value="">Select...</option>
                                    <option value="1" <?php if($oneProperty->prop_type_id == 1): ?> selected <?php endif; ?>>Home</option>
                                    <option value="2" <?php if($oneProperty->prop_type_id == 2): ?> selected <?php endif; ?>>Restrurent</option>
                                    </optgroup>
                                  </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                  <label for="propertyFurnishingStatus">Furnishing status</label>
                                  <select name="propertyFurnishingStatus" id="propertyFurnishingStatus" class="selectpicker form-control">
                                    <optgroup label="Furnishing status">
                                    <option class="ignore" value="">Select...</option>
                                    <option value="1" <?php if($oneProperty->prop_furnish_status_id == 1): ?> selected <?php endif; ?> >Not furnished</option>
                                    <option value="2" <?php if($oneProperty->prop_furnish_status_id == 2): ?> selected <?php endif; ?> >Semi furnished</option>
                                    <option value="3" <?php if($oneProperty->prop_furnish_status_id == 3): ?> selected <?php endif; ?> >Fully furnished</option>
                                    </optgroup>
                                  </select>
                                </div>
                            </div>
                              <div class="col-md-3" id="ageOfFurn">
                                  <div class="form-group">
                                    <label for="propertyFurnishingAge">Age of furniture</label>
                                    <input type="text" name="" id="propertyFurnishingAge" class="form-control" value="<?php echo $oneProperty->prop_furniture_age; ?>">
                                  </div>
                              </div>
                          </div>
                          <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="propertyBeds">Bedrooms</label>
                                    <input type="text" class="form-control" placeholder="Bedrooms" name="propertyBeds" id="propertyBeds" value="<?php echo $oneProperty->prop_bed; ?>">
                                </div>
                            </div>
                              <div class="col-md-2">
                                  <div class="form-group">
                                      <label for="propertyBaths">Bathrooms</label>
                                      <input type="text" class="form-control" placeholder="Bathrooms" name="propertyBaths" id="propertyBaths" value="<?php echo $oneProperty->prop_bath; ?>">
                                  </div>
                              </div>
                              <div class="col-md-2">
                                  <div class="form-group">
                                      <label for="propertyAge">Property Age</label>
                                      <input type="text" class="form-control" placeholder="Age Of Property" name="propertyAge" id="propertyAge" value="<?php echo $oneProperty->prop_age; ?>">
                                  </div>
                              </div>
                              <div class="col-md-3">
                                  <div class="form-group">
                                      <label for="propertyArea">Area (in Sq. ft)</label>
                                      <input type="text" class="form-control" placeholder="Area" name="propertyArea" id="propertyArea" value="<?php echo $oneProperty->prop_area; ?>">
                                  </div>
                              </div>
                              <div class="col-md-3">
                                  <div class="form-group">
                                      <label for="propertyPrice">Expected Price</label>
                                      <input type="text" class="form-control" placeholder="Price" name="propertyPrice" id="propertyPrice" value="<?php echo $oneProperty->prop_rent; ?>">
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
                                    <input type="text" class="form-control" placeholder="Address Line 1" name="propertyAddressLine1" id="propertyAddressLine1" value="<?php echo $oneProperty->prop_address_line1; ?>">
                                </div>
                            </div>
                          </div>
                          <div class="row">
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="propertyLocation">Locality</label>
                                      <input type="text" class="form-control" placeholder="Property Location" name="propertyLocation" id="propertyLocality" value="<?php echo $oneProperty->prop_locality; ?>">
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="propertyCity">City/District/Town</label>
                                      <input type="text" class="form-control" placeholder="City" name="propertyCity" id="propertyCity" value="<?php echo $oneProperty->prop_city; ?>">
                                  </div>
                              </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="propertyPincode">Pincode</label>
                                        <input type="text" class="form-control" placeholder="Pincode" name="propertyPincode" id="propertyPincode" value="<?php echo $oneProperty->prop_pincode; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="propertyState">State</label>
                                        <input type="text" class="form-control" placeholder="State" name="propertyState" id="propertyState" value="<?php echo $oneProperty->prop_state; ?>">
                                    </div>
                                </div>

                              </div>
                              <div class="row" style="display:none">
                                <div class="form-group col-md-4">
                                  <label for="inputLat">Lat</label>
                                  <input type="text" class="form-control" name="inputLat" id="inputLat" value="<?php echo $oneProperty->prop_lat; ?>">
                                </div>
                                <div class="form-group col-md-4">
                                  <label for="inputLng">Long</label>
                                  <input type="text" class="form-control" name="inputLng" id="inputLng" value="<?php echo $oneProperty->prop_lng; ?>">
                                </div>
                              </div>
                              <hr/>
                              <h4 class="title">Property Picture</h4>
                              <div class="row">
                                  <div class="col-md-12">
                                      <div class="form-group">
                                          <label for="propertyPic">Property Picture</label>
                                          <input id="propertyPic" name="propertyPic" class="file" type="file" data-show-upload="false">
                                      </div>
                                  </div>
                              </div>
                                <hr/>
                              <h4 class="title">Add MORP</h4>
                              <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="propertyMORP">Add MORP</label>
                                        <input type="text" class="form-control" placeholder="MORP" name="propertyMORP" id="propertyMORP" value="<?php echo $oneProperty->prop_morp; ?>">
                                    </div>
                                </div>
                              </div>
                              <hr/>
                          <div class="text-right">
                          <a href="<?php echo e(route('oneproperty.delete',['prop_id'=>$oneProperty->prop_id])); ?>"><button type="button" class="btn btn-danger btn-fill">Delete</button></a>
                          <button type="submit" class="btn btn-info btn-fill">Update Property</button>
                          </div>
                          <div class="clearfix"></div>
                        </form>
          </div>
              </div>
          </div>
          <div class="col-md-4" id="desktop-top">
              <div class="card card-user">
                <?php if(Storage::disk('public_uploads')->has($oneProperty->prop_id.'.jpg')): ?>
                <img src="<?php echo e(route('prop.image', ['filename' => $oneProperty->prop_id.'.jpg'])); ?>" alt="" class="img-responsive">
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
              <!--Property Listed By-->
              <div class="card">
              <div class="header">
                <?php if($oneProperty->userFun->userTypeFun->user_type_id == 4): ?>
                  <h4 class="title">Property Listed By (Manager)</h4>
                <?php elseif($oneProperty->userFun->userTypeFun->user_type_id == 3): ?>
                <h4 class="title">Property Listed By (Owner)</h4>
                <?php endif; ?>
                  <p class="category">Details of Person</p>
              </div>
              <div class="content">
                <div class="form-group">
                    <label for="propertyOwnerName">Name (disabled)</label>
                    <input type="text" class="form-control" disabled placeholder="Name" name="propertyOwnerName" id="propertyOwnerName" value="<?php echo $oneProperty->userFun->name; ?>">
                </div>
                <div class="form-group">
                    <label for="propertyOwnerName">Email (disabled)</label>
                    <input type="text" class="form-control" disabled placeholder="Name" name="propertyOwnerName" id="propertyOwnerName" value="<?php echo $oneProperty->userFun->email; ?>">
                </div>
                <div class="form-group">
                    <label for="propertyOwnerName">Mobile (disabled)</label>
                    <input type="text" class="form-control" disabled placeholder="Name" name="propertyOwnerName" id="propertyOwnerName" value="<?php echo $oneProperty->userFun->mobile; ?>">
                </div>
              </div>

              </div>

              <!--Property Listed By ends-->

              <!--Tagged Person -->
              <?php if($taggedProperty == true): ?>
              <?php foreach($tsTaggedProperty as $oneTaggedProperty): ?>
              <div class="card">
              <div class="header">
                <?php if($oneTaggedProperty->userFun->userTypeFun->user_type_id == 4): ?>
                  <h4 class="title">Property Manager</h4>
                <?php elseif($oneTaggedProperty->userFun->userTypeFun->user_type_id == 2): ?>
                <h4 class="title">Tenant</h4>
                <?php endif; ?>
                  <p class="category">Details of Person</p>
              </div>
              <div class="content">
                <div class="form-group">
                    <label for="propertyOwnerName">Name (disabled)</label>
                    <input type="text" class="form-control" disabled placeholder="Name" name="propertyOwnerName" id="propertyOwnerName" value="<?php echo $oneTaggedProperty->userFun->name; ?>">
                </div>
                <div class="form-group">
                    <label for="propertyOwnerName">Email (disabled)</label>
                    <input type="text" class="form-control" disabled placeholder="Name" name="propertyOwnerName" id="propertyOwnerName" value="<?php echo $oneTaggedProperty->userFun->email; ?>">
                </div>
                <div class="form-group">
                    <label for="propertyOwnerName">Mobile (disabled)</label>
                    <input type="text" class="form-control" disabled placeholder="Name" name="propertyOwnerName" id="propertyOwnerName" value="<?php echo $oneTaggedProperty->userFun->mobile; ?>">
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
var UrlUpdateOneProperty = '<?php echo e(route('update.one.property')); ?>';
var adminAllProp = '<?php echo e(route('property.all')); ?>';
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

<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
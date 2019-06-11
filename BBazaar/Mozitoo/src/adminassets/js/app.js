$.validator.addMethod("greaterThan",

function (value, element, param) {
  var $min = $(param);
  if (this.settings.onfocusout) {
    $min.off(".validate-greaterThan").on("blur.validate-greaterThan", function () {
      $(element).valid();
    });
  }
  return parseInt(value) > parseInt($min.val());
}, "MORP must be greater than expected price");

$("#pending-property-form").validate({
  ignore: ".ignore",
    errorClass: 'invalid',
    validClass: 'success',
    rules: {
        propertyTitle: {
            required: true
        },
        propertyDesc: {
            required: true
        },
        inputTenant: {
            required: true
        },
        propertyType: {
            required: true
        },
        propertyFurnishingStatus: {
            required: true
        },
        propertyFurnishingAge: {
            required: true,
            number: true
        },
        propertyAge: {
            required: true,
            number: true
        },
        propertyArea: {
            required: true,
            number: true
        },
        propertyAddressLine1: {
            required: true
        },
        propertyLocation: {
            required: true
        },
        propertyCity: {
            required: true
        },
        propertyPincode: {
            required: true,
            number: true
        },
        propertyState: {
            required: true
        },
        prop_mgr_id: {
            required: true,
            email: true
        },
        'exp_rent[0]':{
            required: true,
            number: true
        },
        'exp_rent[1]':{
            required: true,
            number: true
        },
        'exp_rent[2]':{
            required: true,
            number: true
        },
        'exp_depo[0]':{
            required: true,
            number: true
        },
        'exp_depo[1]':{
            required: true,
            number: true
        },
        'exp_depo[2]':{
            required: true,
            number: true
        },
        'property_morp[0]':{
            required: true,
            number: true
        },
        'property_morp[1]':{
            required: true,
            number: true
        },
        'property_morp[2]':{
            required: true,
            number: true
        }
    },
submitHandler: function(form)
{
    //Get all form data
    var form_data = new FormData($('#pending-property-form')[0]);// Creating object of FormData class

    //Validation and some data fomatting
    var property_amenties = $('.amenityBoxes:checked').map(function() {
        return this.value;
        }).get().join(',');

    if(!property_amenties)
    {
        property_amenties = 0;

    }
    //Append Amenties
    form_data.append("property_amenties", property_amenties);
    form_data.append("_token", token);

  $.ajax({
        url: UrlUpdateProperty,
        data: form_data,   // Setting the data attribute of ajax with file_data
        cache: false,
        contentType: false,
        processData: false,
        type: "POST",
        beforeSend: function()
        {
            $("div#divLoading").addClass('show');
        },
        success: function (res)
        {
            if(res.rc == 2)
            {
              $("input#prop-mgr-id").removeAttr('style');
              $('input#prop-mgr-id').focus().css({'border-color':'#f44','box-shadow':'0 0 8px #f44'});
              $("#prop-mgr-id-err").empty();
              $("#prop-mgr-id-err").html(res.rd);
              $(":input").bind("keyup change", function(e) {
                $("input#prop-mgr-id").removeAttr('style');
                $("#prop-mgr-id-err").empty();
              });
            }
            else if(res.rc == 1)
            {
            $('#succ-msg').empty();
            $('#succ-msg').html(res.rd);
            $('#success-review-modal').modal('show');
            $('#reloadSucModal').click(function()
             {
               location.reload();
             });
           }
           else
           {
              demo.showNotification('top','right', res.rd);
           }

        },
        error: function(err)
        {
            demo.showNotification('top','right', "Something went wrong !");
        },
        complete: function(com)
        {
            $("div#divLoading").removeClass('show');
        }

        });
}
});
$("#onePropertyForm").validate({
  ignore: ".ignore",
    errorClass: 'invalid',
    validClass: 'success',
    rules: {
        propertyTitle: {
            required: true
        },
        propertyDesc: {
            required: true
        },
        inputTenant: {
            required: true
        },
        propertyType: {
            required: true
        },
        propertyFurnishingStatus: {
            required: true
        },
        propertyFurnishingAge: {
            required: true,
            number: true
        },
        propertyBeds: {
            required: true,
            number: true
        },
        propertyBaths: {
            required: true,
            number: true
        },
        propertyAge: {
            required: true,
            number: true
        },
        propertyArea: {
            required: true,
            number: true
        },
        propertyPrice: {
            required: true,
            number: true
        },
        propertyAddressLine1: {
            required: true
        },
        propertyLocation: {
            required: true
        },
        propertyCity: {
            required: true
        },
        propertyPincode: {
            required: true,
            number: true
        },
        propertyState: {
            required: true
        },
        propertyMORP:
        {
          required: true,
          number: true,
          greaterThan: '#propertyPrice'
        }
    },
submitHandler: function(form)
{
  var property_amenties = $('.amenityBoxes:checked').map(function() {
               return this.value;
               }).get().join(',');
 if(!property_amenties)
 {
   property_amenties = 0;
 }
  var propertyID = $('input#propertyID').val();
  var propertyTitle = $('input#propertyTitle').val();
  var propertyDesc = $('textarea#propertyDesc').val();
  var inputTenant = $('select#inputTenant').val();
  var propertyType = $('select#propertyType').val();
  var propertyFurnishingStatus = $('select#propertyFurnishingStatus').val();
  var propertyFurnishingAge = $('input#propertyFurnishingAge').val();
  var propertyBeds = $('input#propertyBeds').val();
  var propertyBaths = $('input#propertyBaths').val();
  var propertyAge = $('input#propertyAge').val();
  var propertyArea = $('input#propertyArea').val();
  var propertyPrice = $('input#propertyPrice').val();
  var propertyAddressLine1 = $('input#propertyAddressLine1').val();
  var propertyLocation = $('input#propertyLocality').val();
  var propertyCity = $('input#propertyCity').val();
  var propertyPincode = $('input#propertyPincode').val();
  var propertyState = $('input#propertyState').val();
  var inputLat = $('input#inputLat').val();
  var inputLng = $('input#inputLng').val();
  var propertyMORP = $('input#propertyMORP').val();
  /*Property pic */
  var propertyPic = $("#propertyPic").prop("files")[0];   // Getting the Profile of file from file field
  if(!propertyFurnishingAge)
  {
    propertyFurnishingAge = 0;
  }
  if(!inputLat)
  {
    inputLat = 12.9716;
    inputLng = 77.5946;
  }
  var form_data = new FormData();// Creating object of FormData class
  form_data.append("propertyID", propertyID);
  form_data.append("propertyTitle", propertyTitle);
  form_data.append("propertyDesc", propertyDesc);
  form_data.append("inputTenant", inputTenant);
  form_data.append("propertyType", propertyType);
  form_data.append("propertyFurnishingStatus", propertyFurnishingStatus);
  form_data.append("propertyFurnishingAge", propertyFurnishingAge);
  form_data.append("propertyBeds", propertyBeds);
  form_data.append("propertyBaths", propertyBaths);
  form_data.append("propertyAge", propertyAge);
  form_data.append("propertyArea", propertyArea);
  form_data.append("propertyPrice", propertyPrice);
  form_data.append("propertyAddressLine1", propertyAddressLine1);
  form_data.append("propertyLocation", propertyLocation);
  form_data.append("propertyCity", propertyCity);
  form_data.append("propertyPincode", propertyPincode);
  form_data.append("propertyState", propertyState);
  form_data.append("propertyPic", propertyPic);
  form_data.append("propertyAmenties", property_amenties);
  form_data.append("inputLat", inputLat);
  form_data.append("inputLng", inputLng);
  form_data.append("propertyMORP", propertyMORP);
  form_data.append("_token", token);
  $.ajax({
        url: UrlUpdateOneProperty,
        data: form_data,   // Setting the data attribute of ajax with file_data
        cache: false,
        contentType: false,
        processData: false,
        type: "POST",
        beforeSend: function()
        {
          $("body").css("opacity", 0.2);
            console.log("Done");
        },
        success: function (res)
        {
          $("body").removeAttr('style');
          console.log(res);
            if(res.rc == 1)
            {
              $('#success-review-modal').modal('show');
              $('#successMsg').text(res.rd);
              $('#reloadSucModal').click(function()
               {
                window.location = adminAllProp;
               });

            }
            else {
              alert("Something went wrong");
            }


        }
        });
}
});
//Update Edited Property
$("#pendingEditedPropertyForm").validate({
  ignore: ".ignore",
    errorClass: 'invalid',
    validClass: 'success',
    rules: {
        propertyTitle: {
            required: true
        },
        propertyDesc: {
            required: true
        },
        inputTenant: {
            required: true
        },
        propertyType: {
            required: true
        },
        propertyFurnishingStatus: {
            required: true
        },
        propertyFurnishingAge: {
            required: true,
            number: true
        },
        propertyBeds: {
            required: true,
            number: true
        },
        propertyBaths: {
            required: true,
            number: true
        },
        propertyAge: {
            required: true,
            number: true
        },
        propertyArea: {
            required: true,
            number: true
        },
        propertyPrice: {
            required: true,
            number: true
        },
        propertyAddressLine1: {
            required: true
        },
        propertyLocation: {
            required: true
        },
        propertyCity: {
            required: true
        },
        propertyPincode: {
            required: true,
            number: true
        },
        propertyState: {
            required: true
        },
        propertyMORP:
        {
          required: true,
          number: true,
          greaterThan: '#propertyPrice'
        }
    },
submitHandler: function(form)
{
  var property_amenties = $('.amenityBoxes:checked').map(function() {
               return this.value;
               }).get().join(',');
 if(!property_amenties)
 {
   property_amenties = 0;
 }
  var propertyID = $('input#propertyID').val();
  var propertyTitle = $('input#propertyTitle').val();
  var propertyDesc = $('textarea#propertyDesc').val();
  var inputTenant = $('select#inputTenant').val();
  var propertyType = $('select#propertyType').val();
  var propertyFurnishingStatus = $('select#propertyFurnishingStatus').val();
  var propertyFurnishingAge = $('input#propertyFurnishingAge').val();
  var propertyBeds = $('input#propertyBeds').val();
  var propertyBaths = $('input#propertyBaths').val();
  var propertyAge = $('input#propertyAge').val();
  var propertyArea = $('input#propertyArea').val();
  var propertyPrice = $('input#propertyPrice').val();
  var propertyAddressLine1 = $('input#propertyAddressLine1').val();
  var propertyLocation = $('input#propertyLocality').val();
  var propertyCity = $('input#propertyCity').val();
  var propertyPincode = $('input#propertyPincode').val();
  var propertyState = $('input#propertyState').val();
  var inputLat = $('input#inputLat').val();
  var inputLng = $('input#inputLng').val();
  var propertyMORP = $('input#propertyMORP').val();
  /*Property pic */
  var propertyPic = $("#propertyPic").prop("files")[0];   // Getting the Profile of file from file field
  if(!propertyFurnishingAge)
  {
    propertyFurnishingAge = 0;
  }
  if(!inputLat)
  {
    inputLat = 12.9716;
    inputLng = 77.5946;
  }
  var form_data = new FormData();// Creating object of FormData class
  form_data.append("propertyID", propertyID);
  form_data.append("propertyTitle", propertyTitle);
  form_data.append("propertyDesc", propertyDesc);
  form_data.append("inputTenant", inputTenant);
  form_data.append("propertyType", propertyType);
  form_data.append("propertyFurnishingStatus", propertyFurnishingStatus);
  form_data.append("propertyFurnishingAge", propertyFurnishingAge);
  form_data.append("propertyBeds", propertyBeds);
  form_data.append("propertyBaths", propertyBaths);
  form_data.append("propertyAge", propertyAge);
  form_data.append("propertyArea", propertyArea);
  form_data.append("propertyPrice", propertyPrice);
  form_data.append("propertyAddressLine1", propertyAddressLine1);
  form_data.append("propertyLocation", propertyLocation);
  form_data.append("propertyCity", propertyCity);
  form_data.append("propertyPincode", propertyPincode);
  form_data.append("propertyState", propertyState);
  form_data.append("propertyPic", propertyPic);
  form_data.append("propertyAmenties", property_amenties);
  form_data.append("inputLat", inputLat);
  form_data.append("inputLng", inputLng);
  form_data.append("propertyMORP", propertyMORP);
  form_data.append("_token", token);
  $.ajax({
        url: UrlUpdateEditedProperty,
        data: form_data,   // Setting the data attribute of ajax with file_data
        cache: false,
        contentType: false,
        processData: false,
        type: "POST",
        beforeSend: function()
        {
          $("body").css("opacity", 0.2);
            console.log("Done");
        },
        success: function (res)
        {
          $("body").removeAttr('style');
            console.log(res);
            if(res.rc == 1)
            {
              $('#success-review-modal').modal('show');
              $('#successMsg').text(res.rd);
              $('#reloadSucModal').click(function()
               {
                window.location = adminAllProp;
               });

            }
            else {
              alert("Something went wrong");
            }


        }
        });
}
});
//For Owner
$("#oneOwnerPropertyForm").validate({
  ignore: ".ignore",
    rules: {
        propertyTitle: {
            required: true
        },
        propertyDesc: {
            required: true
        },
        inputTenant: {
            required: true
        },
        propertyType: {
            required: true
        },
        propertyFurnishingStatus: {
            required: true
        },
        propertyFurnishingAge: {
            required: true,
            number: true
        },
        propertyBeds: {
            required: true,
            number: true
        },
        propertyBaths: {
            required: true,
            number: true
        },
        propertyAge: {
            required: true,
            number: true
        },
        propertyArea: {
            required: true,
            number: true
        },
        propertyPrice: {
            required: true,
            number: true
        },
        propertyAddressLine1: {
            required: true
        },
        propertyLocation: {
            required: true
        },
        propertyCity: {
            required: true
        },
        propertyPincode: {
            required: true,
            number: true
        },
        propertyState: {
            required: true
        }
    },
submitHandler: function(form)
{
  var property_amenties = $('.amenityBoxes:checked').map(function() {
               return this.value;
               }).get().join(',');
 if(!property_amenties)
 {
   property_amenties = 0;
 }
  var propertyID = $('input#propertyID').val();
  var propertyTitle = $('input#propertyTitle').val();
  var propertyDesc = $('textarea#propertyDesc').val();
  var inputTenant = $('select#inputTenant').val();
  var propertyType = $('select#propertyType').val();
  var propertyFurnishingStatus = $('select#propertyFurnishingStatus').val();
  var propertyFurnishingAge = $('input#propertyFurnishingAge').val();
  var propertyBeds = $('input#propertyBeds').val();
  var propertyBaths = $('input#propertyBaths').val();
  var propertyAge = $('input#propertyAge').val();
  var propertyArea = $('input#propertyArea').val();
  var propertyPrice = $('input#propertyPrice').val();
  var propertyAddressLine1 = $('input#propertyAddressLine1').val();
  var propertyLocation = $('input#propertyLocality').val();
  var propertyCity = $('input#propertyCity').val();
  var propertyPincode = $('input#propertyPincode').val();
  var propertyState = $('input#propertyState').val();
  var inputLat = $('input#inputLat').val();
  var inputLng = $('input#inputLng').val();
  /*Profile pic */
  var propertyPic = $("#propertyPic").prop("files")[0];   // Getting the Profile of file from file field
  if(!propertyFurnishingAge)
  {
    propertyFurnishingAge = 0;
  }
  if(!inputLat)
  {
    inputLat = 12.9716;
    inputLng = 77.5946;
  }
  var form_data = new FormData();// Creating object of FormData class
  form_data.append("propertyID", propertyID);
  form_data.append("propertyTitle", propertyTitle);
  form_data.append("propertyDesc", propertyDesc);
  form_data.append("inputTenant", inputTenant);
  form_data.append("propertyType", propertyType);
  form_data.append("propertyFurnishingStatus", propertyFurnishingStatus);
  form_data.append("propertyFurnishingAge", propertyFurnishingAge);
  form_data.append("propertyBeds", propertyBeds);
  form_data.append("propertyBaths", propertyBaths);
  form_data.append("propertyAge", propertyAge);
  form_data.append("propertyArea", propertyArea);
  form_data.append("propertyPrice", propertyPrice);
  form_data.append("propertyAddressLine1", propertyAddressLine1);
  form_data.append("propertyLocation", propertyLocation);
  form_data.append("propertyCity", propertyCity);
  form_data.append("propertyPincode", propertyPincode);
  form_data.append("propertyState", propertyState);
  form_data.append("propertyPic", propertyPic);
  form_data.append("propertyAmenties", property_amenties);
  form_data.append("inputLat", inputLat);
  form_data.append("inputLng", inputLng);
  form_data.append("_token", token);
  $.ajax({
        url: UrlUpdateOneOwnerProperty,
        data: form_data,   // Setting the data attribute of ajax with file_data
        cache: false,
        contentType: false,
        processData: false,
        type: "POST",
        beforeSend: function()
        {
          $("body").css("opacity", 0.2);
            console.log("Done");
        },
        success: function (res)
        {
          $("body").removeAttr('style');
          console.log(res);
            if(res.rc == 1)
            {
              $('#success-review-modal').modal('show');
              $('#successMsg').text(res.rd);
              $('#reloadSucModal').click(function()
               {
                window.location = ownerAllProp;
               });

            }
            else {
              alert("Something went wrong");
            }


        }
        });
}
});

// Update one agent property
$("#oneAgentPropertyForm").validate({
  ignore: ".ignore",
    rules: {
        propertyTitle: {
            required: true
        },
        propertyDesc: {
            required: true
        },
        inputTenant: {
            required: true
        },
        propertyType: {
            required: true
        },
        propertyFurnishingStatus: {
            required: true
        },
        propertyFurnishingAge: {
            required: true,
            number: true
        },
        propertyBeds: {
            required: true,
            number: true
        },
        propertyBaths: {
            required: true,
            number: true
        },
        propertyAge: {
            required: true,
            number: true
        },
        propertyArea: {
            required: true,
            number: true
        },
        propertyPrice: {
            required: true,
            number: true
        },
        propertyAddressLine1: {
            required: true
        },
        propertyLocation: {
            required: true
        },
        propertyCity: {
            required: true
        },
        propertyPincode: {
            required: true,
            number: true
        },
        propertyState: {
            required: true
        }
    },
submitHandler: function(form)
{
  var property_amenties = $('.amenityBoxes:checked').map(function() {
               return this.value;
               }).get().join(',');
 if(!property_amenties)
 {
   property_amenties = 0;
 }
  var propertyID = $('input#propertyID').val();
  var propertyTitle = $('input#propertyTitle').val();
  var propertyDesc = $('textarea#propertyDesc').val();
  var inputTenant = $('select#inputTenant').val();
  var propertyType = $('select#propertyType').val();
  var propertyFurnishingStatus = $('select#propertyFurnishingStatus').val();
  var propertyFurnishingAge = $('input#propertyFurnishingAge').val();
  var propertyBeds = $('input#propertyBeds').val();
  var propertyBaths = $('input#propertyBaths').val();
  var propertyAge = $('input#propertyAge').val();
  var propertyArea = $('input#propertyArea').val();
  var propertyPrice = $('input#propertyPrice').val();
  var propertyAddressLine1 = $('input#propertyAddressLine1').val();
  var propertyLocation = $('input#propertyLocality').val();
  var propertyCity = $('input#propertyCity').val();
  var propertyPincode = $('input#propertyPincode').val();
  var propertyState = $('input#propertyState').val();
  var inputLat = $('input#inputLat').val();
  var inputLng = $('input#inputLng').val();
  /*Profile pic */
  var propertyPic = $("#propertyPic").prop("files")[0];   // Getting the Profile of file from file field
  if(!propertyFurnishingAge)
  {
    propertyFurnishingAge = 0;
  }
  if(!inputLat)
  {
    inputLat = 12.9716;
    inputLng = 77.5946;
  }
  var form_data = new FormData();// Creating object of FormData class
  form_data.append("propertyID", propertyID);
  form_data.append("propertyTitle", propertyTitle);
  form_data.append("propertyDesc", propertyDesc);
  form_data.append("inputTenant", inputTenant);
  form_data.append("propertyType", propertyType);
  form_data.append("propertyFurnishingStatus", propertyFurnishingStatus);
  form_data.append("propertyFurnishingAge", propertyFurnishingAge);
  form_data.append("propertyBeds", propertyBeds);
  form_data.append("propertyBaths", propertyBaths);
  form_data.append("propertyAge", propertyAge);
  form_data.append("propertyArea", propertyArea);
  form_data.append("propertyPrice", propertyPrice);
  form_data.append("propertyAddressLine1", propertyAddressLine1);
  form_data.append("propertyLocation", propertyLocation);
  form_data.append("propertyCity", propertyCity);
  form_data.append("propertyPincode", propertyPincode);
  form_data.append("propertyState", propertyState);
  form_data.append("propertyPic", propertyPic);
  form_data.append("propertyAmenties", property_amenties);
  form_data.append("inputLat", inputLat);
  form_data.append("inputLng", inputLng);
  form_data.append("_token", token);
  $.ajax({
        url: UrlUpdateOneAgentProperty,
        data: form_data,   // Setting the data attribute of ajax with file_data
        cache: false,
        contentType: false,
        processData: false,
        type: "POST",
        beforeSend: function()
        {
          $("body").css("opacity", 0.2);
            console.log("Done");
        },
        success: function (res)
        {
          $("body").removeAttr('style');
          console.log(res);
            if(res.rc == 1)
            {
              $('#success-review-modal').modal('show');
              $('#successMsg').text(res.rd);
              $('#reloadSucModal').click(function()
               {
                window.location = agentAllProp;
               });

            }
            else {
              alert("Something went wrong");
            }


        }
        });
}
});

// Agent Tag Check
$("#ownerPropertyID").change(function(){
  var propID = $('#ownerPropertyID').val();
  $.ajax({
      method: 'GET',
      url: UrlTagCheckAgentAdmin,
      data: {propID: propID},
      beforeSend: function()
      {
          $("body").css("opacity", 0.2);
      },
      success: function (res)
      {
        $("body").removeAttr('style');
        if(res.rc == 3)
        {
          location.reload();
          $("#tagAgentPropertyFormAdmin")[0].reset();
        }
        else if(res.rc == 2)
        {
            $('#tagToPropMgrEmail').val("");
            $('#PropTaggedID').val("");
        }
        else if(res.rc == 1)
        {
          $('#tagToPropMgrEmail').val("");
          $('#PropTaggedID').val("");
          $('#tagToPropMgrEmail').val(res.e);
          $('#PropTaggedID').val(res.i);
        }
      }
  });
});
// Tenant Tag Check
$("#allPropertyIDTenant").change(function(){
  var propID = $('#allPropertyIDTenant').val();
  $.ajax({
      method: 'GET',
      url: UrlTagCheckTenatAdmin,
      data: {propID: propID},
      beforeSend: function()
      {
          $("body").css("opacity", 0.2);
      },
      success: function (res)
      {
        console.log(res);
        $("body").removeAttr('style');
        if(res.rc == 3)
        {
          location.reload();
          $("#tagTenantPropertyFormAdmin")[0].reset();
        }
        else if(res.rc == 2)
        {

          $("#dynamicRowsTenant").css('display', 'none');
        }
        else if(res.rc == 1)
        {
          $("#dynamicRowsTenant").removeAttr('style');
          $("#tenatRowsdis").empty();
          $("#tenatRowsdis1").empty();
          $("#tenatRowsdis2").empty();
          for (var i = 0; i < res.emails.length; i++)
              {
                html = $("<div class='form-group'>")
                  .append("<label for=''>Tenant email id:</label>")
                  .append("<input type='email' class='form-control' placeholder='Tenat Email ID' disabled value='"+res.emails[i].email+"'>");
                  $("#tenatRowsdis").append(html);
              }
          for (var i = 0; i < res.rent.length; i++)
              {
                html = $("<div class='form-group'>")
                  .append("<label for=''>Monthly Rent:</label>")
                  .append("<input type='text' class='form-control' placeholder='Monthly Rent' disabled value='"+res.rent[i]+"'>");
                  $("#tenatRowsdis1").append(html);
              }
          for (var i = 0; i < res.taggedids.length; i++)
              {
                html = $("<div class='form-group dynTenRows'>")
                  .append("<button type='button' class='btn btn-fill btn-success delPropTenAdminDash' data-delid='"+res.taggedids[i]+"'>Remove</button>");
                  $("#tenatRowsdis2").append(html);
              }

        }
      }
  });
});


//delete tenant from property
$("body").on("click", ".delPropTenAdminDash", function(){
  var delID=$(this).data("delid");
    $.ajax({
            method: 'POST',
            url: UrlDelOneTen,
            data: {delID: delID, _token: token},
            beforeSend: function()
            {
                $("body").css("opacity", 0.2);
            },
            success: function (res)
            {
              $("body").removeAttr('style');
              if(res.rc == 3)
              {
                alert(res.rd);
                location.reload();
              }
              else if(res.rc == 2)
              {
                alert(res.rd);
                location.reload();
              }
              else if(res.rc == 1)
              {
                $("#tagTenantPropertyFormAdmin")[0].reset();
                location.reload();
              }
              else {
                alert("Something went wrong");
                location.reload();
              }
            }
        });

});
// Add one service request owner
$("#tagAgentPropertyFormAdmin").validate({
  ignore: ".ignore",
    rules: {
        ownerPropertyID: {
            required: true
        },
        tagToPropMgrEmail: {
            required: true,
            email: true
        }
    },
submitHandler: function(form)
{
  var ownerPropertyID = $('select#ownerPropertyID').val();
  var tagToPropMgrEmail = $('input#tagToPropMgrEmail').val();
  var PropTaggedID = $('#PropTaggedID').val();
  if(!PropTaggedID)
  {
    PropTaggedID = 404;
  }
  var form_data = new FormData();// Creating object of FormData class
  form_data.append("ownerPropertyID", ownerPropertyID);
  form_data.append("tagToPropMgrEmail", tagToPropMgrEmail);
  form_data.append("PropTaggedID", PropTaggedID);
  form_data.append("_token", token);
  $.ajax({
        url: UrlTagToAgentAdmin,
        data: form_data,   // Setting the data attribute of ajax with file_data
        cache: false,
        contentType: false,
        processData: false,
        type: "POST",
        beforeSend: function()
        {
            console.log("Done");
        },
        success: function (res)
        {
          console.log(res);
          if(res.rc == 2)
          {
            $("input#tagToPropMgrEmail").removeAttr('style');
            $('input#tagToPropMgrEmail').focus().css({'border-color':'#f44','box-shadow':'0 0 8px #f44'});
            $("#tagToPropMgrEmailErr").empty();
            $("#tagToPropMgrEmailErr").html(res.rd);
            $(":input").bind("keyup change", function(e) {
              $("input#tagToPropMgrEmail").removeAttr('style');
              $("#tagToPropMgrEmailErr").empty();
            });
          }
          else if(res.rc == 1)
          {
            $('#success-tag-mgr-review-modal').modal('show');
            //appending modal background inside the blue div
            $('.modal-backdrop').appendTo('#mgrTagFrm');
            //remove the padding right and modal-open class from the body tag which bootstrap adds when a modal is shown
            $('body').removeClass("modal-open")
            $('body').css("padding-right","");
            $('#reloadSucModalMgr').click(function()
             {
              location.reload();
             });
          }
          else {
            alert("Something went wrong");
          }


        }
        });
}
});
// Add one service request tenant
$("#tagTenantPropertyFormAdmin").validate({
  ignore: ".ignore",
    rules: {
        allPropertyIDTenant: {
            required: true
        },
        tagToPropTenEmail: {
          required: true,
          email: true
        },
        tagToPropTenRent: {
          required: true,
          number: true
        }
    },
submitHandler: function(form)
{
  var allPropertyID = $('select#allPropertyIDTenant').val();
  var tagToPropTenEmail = $('input#tagToPropTenEmail').val();
  var tagToPropTenRent = $('input#tagToPropTenRent').val();
  var form_data = new FormData();// Creating object of FormData class
  form_data.append("allPropertyID", allPropertyID);
  form_data.append("tagToPropTenEmail", tagToPropTenEmail);
  form_data.append("tagToPropTenRent", tagToPropTenRent);
  form_data.append("_token", token);
  $.ajax({
        url: UrlTagToTenatAdmin,
        data: form_data,   // Setting the data attribute of ajax with file_data
        cache: false,
        contentType: false,
        processData: false,
        type: "POST",
        beforeSend: function()
        {
            console.log("Done");
        },
        success: function (res)
        {
          console.log(res);
          if(res.rc == 2)
          {
            $("input#tagToPropTenEmail").removeAttr('style');
            $('input#tagToPropTenEmail').focus().css({'border-color':'#f44','box-shadow':'0 0 8px #f44'});
            $("#tagToPropTenEmailErr").empty();
            $("#tagToPropTenEmailErr").html(res.rd);
            $(":input").bind("keyup change", function(e) {
              $("input#tagToPropTenEmail").removeAttr('style');
              $("#tagToPropTenEmailErr").empty();
            });
          }
          else if(res.rc == 1)
          {
            $('#success-tag-ten-review-modal').modal('show');
            //appending modal background inside the blue div
            $('.modal-backdrop').appendTo('#tenTagFrm');
            //remove the padding right and modal-open class from the body tag which bootstrap adds when a modal is shown
            $('body').removeClass("modal-open")
            $('body').css("padding-right","");
            $('#reloadSucModalTen').click(function()
             {
              $("#tagTenantPropertyFormAdmin")[0].reset();
              location.reload();
             });
          }
          else {
            alert("Something went wrong");
          }


        }
        });
}
});
//Create Service Request from owner
$("#owner-ser-req-form").validate({
  ignore: ".ignore",
    rules: {
        owner_prop_id: {
            required: true
        },
        service_req_type: {
            required: true
        }
    },
submitHandler: function(form)
{
    let form_data = new FormData($('#owner-ser-req-form')[0]);
    form_data.append("_token", token);
    $.ajax({
        url: url_owner_post_ser_req,
        data: form_data,
        cache: false,
        contentType: false,
        processData: false,
        type: "POST",
        beforeSend: function()
        {
            $("div#divLoading").addClass('show');
        },
        success: function (res)
        {
            if(res.rc == 1)
            {
                demo.showNotification('top','right', res.rd);
                setTimeout(function()
                {
                    window.location.replace(url_owner_get_ser_reqs);
                },20);

            }
            else
            {
                demo.showNotification('top','right', res.rd);
            }

        },
        error: function(err)
        {
            demo.showNotification('top','right', "Something went wrong !");
        },
        complete: function(com)
        {
            $("div#divLoading").removeClass('show');
        }
    });
}
});
//Create Service Request from Tenat
$("#ser-req-tenant-form").validate({
  ignore: ".ignore",
    rules: {
        prop_id: {
            required: true,
            number: true
        },
        service_req_type: {
            required: true
        }
    },
submitHandler: function(form)
{

    let form_data = new FormData($('#ser-req-tenant-form')[0]);// Creating object of FormData class
    form_data.append("_token", token);
    $.ajax({
        url: url_tenant_service_req,
        data: form_data,
        cache: false,
        contentType: false,
        processData: false,
        type: "POST",
        beforeSend: function()
        {
            $("div#divLoading").addClass('show');
        },
        success: function (res)
        {
            if(res.rc == 1)
            {
                demo.showNotification('top','right', res.rd);
                setTimeout(function()
                { 
                    window.location.replace(url_tenant_all_service_req)
                },20);

            }
            else
            {
                demo.showNotification('top','right', res.rd);
            }

        },
        error: function(err)
        {
            demo.showNotification('top','right', "Something went wrong !");
        },
        complete: function(com)
        {
            $("div#divLoading").removeClass('show');
        }
    });
}
});
//Change Service Request Status
$('.ok').on('click', function(event){

var propID=$(this).data("prop");
var newStatus = $("input[name='status"+propID+"']:checked").val();

  $.ajax({
          method: 'POST',
          url: urlUpdateStatusSerReq,
          data: {newStatus: newStatus, propID: propID, _token: token},
          beforeSend: function()
          {
              console.log("Done");
          },
          success: function (res)
          {
            if(res.rc == 3)
            {
              alert("Something went wrong");
              location.reload();
            }
            else if(res.rc == 2)
            {
              location.reload();
            }
            else if(res.rc == 1)
            {
              location.reload();

            }
            else {
              alert("Something went wrong");
              location.reload();
            }
          }
      });


});
//Update Owner profile
$("#ownerProfileForm").validate({
    rules: {
        inputAdhar: {
            required: true
        },
        inputGSTN: {
            required: true
        },
        inputName: {
            required: true
        },
        inputAddressLine1: {
            required: true
        },
        inputAddressLine2: {
            required: true
        },
        inputCity: {
            required: true
        },
        inputState: {
            required: true
        },
        inputPincode: {
            required: true,
            number:true
        },
        inputAbout: {
            required: true
        }
    },
submitHandler: function(form)
{
  var inputAdhar = $('input#inputAdhar').val();
  var inputGSTN = $('input#inputGSTN').val();
  var inputName = $('input#inputName').val();
  var inputAddressLine1 = $('input#inputAddressLine1').val();
  var inputAddressLine2 = $('input#inputAddressLine2').val();
  var inputCity = $('input#inputCity').val();
  var inputState = $('input#inputState').val();
  var inputPincode = $('input#inputPincode').val();
  var inputAbout = $('textarea#inputAbout').val();

  var form_data = new FormData();// Creating object of FormData class
  form_data.append("inputAdhar", inputAdhar);
  form_data.append("inputGSTN", inputGSTN);
  form_data.append("inputName", inputName);
  form_data.append("inputAddressLine1", inputAddressLine1);
  form_data.append("inputAddressLine2", inputAddressLine2);
  form_data.append("inputCity", inputCity);
  form_data.append("inputState", inputState);
  form_data.append("inputPincode", inputPincode);
  form_data.append("inputAbout", inputAbout);
  form_data.append("_token", token);
  $.ajax({
        url: UrlUpdateOwnerProfile,
        data: form_data,   // Setting the data attribute of ajax with file_data
        cache: false,
        contentType: false,
        processData: false,
        type: "POST",
        beforeSend: function()
        {
            $("body").css("opacity", 0.2);
        },
        success: function (res)
        {
          $("body").removeAttr('style');
          if(res.rc == 1)
          {
            $('#success-review-modal').modal('show');
            $('#reloadSucModal').click(function()
             {
               location.reload();
             });
          }
          else if(res.rc == 2)
          {
            location.reload();

          }
          else
          {
            alert("Something went wrong");

          }
        }
        });
}
});
//Update Tenant profile
$("#tenantProfileForm").validate({
    rules: {
        inputName: {
            required: true
        },
        inputAddressLine1: {
            required: true
        },
        inputAddressLine2: {
            required: true
        },
        inputCity: {
            required: true
        },
        inputState: {
            required: true
        },
        inputPincode: {
            required: true,
            number:true
        },
        inputAbout: {
            required: true
        }
    },
submitHandler: function(form)
{
  var inputName = $('input#inputName').val();
  var inputAddressLine1 = $('input#inputAddressLine1').val();
  var inputAddressLine2 = $('input#inputAddressLine2').val();
  var inputCity = $('input#inputCity').val();
  var inputState = $('input#inputState').val();
  var inputPincode = $('input#inputPincode').val();
  var inputAbout = $('textarea#inputAbout').val();

  var form_data = new FormData();// Creating object of FormData class

  form_data.append("inputName", inputName);
  form_data.append("inputAddressLine1", inputAddressLine1);
  form_data.append("inputAddressLine2", inputAddressLine2);
  form_data.append("inputCity", inputCity);
  form_data.append("inputState", inputState);
  form_data.append("inputPincode", inputPincode);
  form_data.append("inputAbout", inputAbout);
  form_data.append("_token", token);
  $.ajax({
        url: UrlUpdateTenantProfile,
        data: form_data,   // Setting the data attribute of ajax with file_data
        cache: false,
        contentType: false,
        processData: false,
        type: "POST",
        beforeSend: function()
        {
            $("body").css("opacity", 0.2);
        },
        success: function (res)
        {
          $("body").removeAttr('style');
          if(res.rc == 1)
          {
            $('#success-review-modal').modal('show');
            $('#reloadSucModal').click(function()
             {
               location.reload();
             });
          }
          else if(res.rc == 2)
          {
            location.reload();

          }
          else
          {
            alert("Something went wrong");

          }
        }
        });
}
});
//Update Agent profile
$("#agentProfileForm").validate({
    rules: {
        agentName: {
            required: true
        },
        agentEmail: {
            required: true
        },
        agentMobile: {
            required: true
        },
        agentRera: {
            required: true
        },
        agentCompany: {
            required: true
        },
        agentAdhar: {
            required: true
        },
        agentAddOne: {
            required: true
        },
        agentAddTwo: {
            required: true
        },
        agentCity: {
            required: true
        },
        agentState: {
            required: true
        },
        agentPincode: {
            required: true
        },
        agentAbout: {
            required: true
        },
        agentGoogleID: {
            required: true,
            url: true
        },
        agentTwitterID: {
            required: true,
            url: true
        },
        agentFacebookID: {
            required: true,
            url: true
        },
        agentLinkedinID: {
            required: true,
            url: true
        }
    },
submitHandler: function(form)
{
  var agentName = $('input#agentName').val();
  var agentEmail = $('input#agentEmail').val();
  var agentMobile = $('input#agentMobile').val();
  var agentRera = $('input#agentRera').val();
  var agentCompany = $('input#agentCompany').val();
  var agentAdhar = $('input#agentAdhar').val();
  var agentAddOne = $('input#agentAddOne').val();
  var agentAddTwo = $('input#agentAddTwo').val();
  var agentCity = $('input#agentCity').val();
  var agentState = $('input#agentState').val();
  var agentPincode = $('input#agentPincode').val();
  var agentAbout = $('textarea#agentAbout').val();
  var agentGoogleID = $('input#agentGoogleID').val();
  var agentTwitterID = $('input#agentTwitterID').val();
  var agentFacebookID = $('input#agentFacebookID').val();
  var agentLinkedinID = $('input#agentLinkedinID').val();
  /*Profile pic */
  var agent_pic = $("#agent_pic").prop("files")[0];   // Getting the Profile of file from file field
  var form_data = new FormData();// Creating object of FormData class

  form_data.append("agentName", agentName);
  form_data.append("agentEmail", agentEmail);
  form_data.append("agentMobile", agentMobile);
  form_data.append("agentRera", agentRera);
  form_data.append("agentCompany", agentCompany);
  form_data.append("agentAdhar", agentAdhar);
  form_data.append("agentAddOne", agentAddOne);
  form_data.append("agentAddTwo", agentAddTwo);
  form_data.append("agentCity", agentCity);
  form_data.append("agentState", agentState);
  form_data.append("agentPincode", agentPincode);
  form_data.append("agentAbout", agentAbout);
  form_data.append("agent_pic", agent_pic);
  form_data.append("agentGoogleID", agentGoogleID);
  form_data.append("agentTwitterID", agentTwitterID);
  form_data.append("agentFacebookID", agentFacebookID);
  form_data.append("agentLinkedinID", agentLinkedinID);
  form_data.append("_token", token);
  $.ajax({
        url: UrlUpdateAgentProfile,
        data: form_data,   // Setting the data attribute of ajax with file_data
        cache: false,
        contentType: false,
        processData: false,
        type: "POST",
        beforeSend: function()
        {
            $("body").css("opacity", 0.2);
        },
        success: function (res)
        {
          $("body").removeAttr('style');
          if(res.rc == 1)
          {
            $('#success-review-modal').modal('show');
            $('#reloadSucModal').click(function()
             {
               location.reload();
             });
          }
          else if(res.rc == 2)
          {
            location.reload();

          }
          else
          {
            alert("Something went wrong");

          }
        }
        });
}
});
// Update one agent pending property for approval
$("#oneAgentPendingPropertyApproval").validate({
  ignore: ".ignore",
    rules: {
        propertyTitle: {
            required: true
        },
        propertyDesc: {
            required: true
        },
        inputTenant: {
            required: true
        },
        propertyType: {
            required: true
        },
        propertyFurnishingStatus: {
            required: true
        },
        propertyFurnishingAge: {
            required: true
        },
        propertyBeds: {
            required: true,
            number: true
        },
        propertyBaths: {
            required: true,
            number: true
        },
        propertyAge: {
            required: true,
            number: true
        },
        propertyArea: {
            required: true,
            number: true
        },
        propertyPrice: {
            required: true,
            number: true
        },
        propertyAddressLine1: {
            required: true
        },
        propertyLocation: {
            required: true
        },
        propertyCity: {
            required: true
        },
        propertyPincode: {
            required: true,
            number: true
        },
        propertyState: {
            required: true
        }
    },
submitHandler: function(form)
{
  var property_amenties = $('.amenityBoxes:checked').map(function() {
               return this.value;
               }).get().join(',');
 if(!property_amenties)
 {
   property_amenties = 0;
 }

  var propertyID = $('input#propertyID').val();
  var propertyTitle = $('input#propertyTitle').val();
  var propertyDesc = $('textarea#propertyDesc').val();
  var inputTenant = $('select#inputTenant').val();
  var propertyType = $('select#propertyType').val();
  var propertyFurnishingStatus = $('select#propertyFurnishingStatus').val();
  var propertyFurnishingAge = $('input#propertyFurnishingAge').val();
  var propertyBeds = $('input#propertyBeds').val();
  var propertyBaths = $('input#propertyBaths').val();
  var propertyAge = $('input#propertyAge').val();
  var propertyArea = $('input#propertyArea').val();
  var propertyPrice = $('input#propertyPrice').val();
  var propertyAddressLine1 = $('input#propertyAddressLine1').val();
  var propertyLocation = $('input#propertyLocality').val();
  var propertyCity = $('input#propertyCity').val();
  var propertyPincode = $('input#propertyPincode').val();
  var propertyState = $('input#propertyState').val();
  var inputLat = $('input#inputLat').val();
  var inputLng = $('input#inputLng').val();
  /*Profile pic */
  var propertyPic = $("#propertyPic").prop("files")[0];   // Getting the Profile of file from file field
  if(!inputLat)
  {
    inputLat = 12.9716;
    inputLng = 77.5946;
  }
  if(!propertyFurnishingAge)
  {
    propertyFurnishingAge = 0;
  }
  var form_data = new FormData();// Creating object of FormData class
  form_data.append("propertyID", propertyID);
  form_data.append("propertyTitle", propertyTitle);
  form_data.append("propertyDesc", propertyDesc);
  form_data.append("inputTenant", inputTenant);
  form_data.append("propertyType", propertyType);
  form_data.append("propertyFurnishingStatus", propertyFurnishingStatus);
  form_data.append("propertyFurnishingAge", propertyFurnishingAge);
  form_data.append("propertyBeds", propertyBeds);
  form_data.append("propertyBaths", propertyBaths);
  form_data.append("propertyAge", propertyAge);
  form_data.append("propertyArea", propertyArea);
  form_data.append("propertyPrice", propertyPrice);
  form_data.append("propertyAddressLine1", propertyAddressLine1);
  form_data.append("propertyLocation", propertyLocation);
  form_data.append("propertyCity", propertyCity);
  form_data.append("propertyPincode", propertyPincode);
  form_data.append("propertyState", propertyState);
  form_data.append("propertyPic", propertyPic);
  form_data.append("propertyAmenties", property_amenties);
  form_data.append("inputLat", inputLat);
  form_data.append("inputLng", inputLng);
  form_data.append("_token", token);
  $.ajax({
        url: UrlUpdateOneAgentPendingPropApproval,
        data: form_data,   // Setting the data attribute of ajax with file_data
        cache: false,
        contentType: false,
        processData: false,
        type: "POST",
        beforeSend: function()
        {
          $("body").css("opacity", 0.2);
            console.log("Done");
        },
        success: function (res)
        {
          $("body").removeAttr('style');
          console.log(res);
            if(res.rc == 1)
            {
              $('#success-review-modal').modal('show');
              $('#successMsg').text(res.rd);
              $('#reloadSucModal').click(function()
               {
                window.location = agentAllProp;
               });

            }
            else {
              alert("Something went wrong");
            }


        }
        });
}
});
// Update one owner pending property for approval
$("#owner-pending-property-form").validate({
    ignore: ".ignore",
    errorClass: 'invalid',
    validClass: 'success',
    rules: {
        propertyTitle: {
            required: true
        },
        propertyDesc: {
            required: true
        },
        inputTenant: {
            required: true
        },
        propertyType: {
            required: true
        },
        propertyFurnishingStatus: {
            required: true
        },
        propertyFurnishingAge: {
            required: true,
            number: true
        },
        propertyAge: {
            required: true,
            number: true
        },
        propertyArea: {
            required: true,
            number: true
        },
        propertyAddressLine1: {
            required: true
        },
        propertyLocation: {
            required: true
        },
        propertyCity: {
            required: true
        },
        propertyPincode: {
            required: true,
            number: true
        },
        propertyState: {
            required: true
        }
    },
submitHandler: function(form)
{
    //Get all form data
    var form_data = new FormData($('#owner-pending-property-form')[0]);// Creating object of FormData class

    //Validation and some data fomatting
    var property_amenties = $('.amenityBoxes:checked').map(function() {
        return this.value;
        }).get().join(',');

    if(!property_amenties)
    {
        property_amenties = 0;

    }
    //Append Amenties
    form_data.append("property_amenties", property_amenties);
    form_data.append("_token", token);

  $.ajax({
        url: url_update_pend_owner_prop,
        data: form_data,   // Setting the data attribute of ajax with file_data
        cache: false,
        contentType: false,
        processData: false,
        type: "POST",
        beforeSend: function()
        {
            $("div#divLoading").addClass('show');
        },
        success: function (res)
        {
            if(res.rc == 1)
            {
                demo.showNotification('top','right', res.rd);
                setTimeout(function()
                {
                    window.location.replace(url_get_pend_prop);
                },20);
           }
           else
           {
              demo.showNotification('top','right', res.rd);
           }

        },
        error: function(err)
        {
            demo.showNotification('top','right', "Something went wrong !");
        },
        complete: function(com)
        {
            $("div#divLoading").removeClass('show');
        }

        });
}
});
/* Update Owner Password*/
$("#change-owner-dpwd").validate({
    rules: {
        old_pwd: {
          required: true, minlength: 5, maxlength: 10
        },
        new_pwd: {
          required: true, minlength: 5, maxlength: 10
        },
         re_pwd: {
          equalTo: "#new_pwd"
        }
    }
    , messages: {
      old_pwd: {
        required: "Please Enter your password",
        minlength: "Password must be at least 5 characters long",
        maxlength: "Password must be at 10 characters long"
      },
      new_pwd: {
        required: "Please Enter your password",
        minlength: "Password must be at least 5 characters long",
        maxlength: "Password must be at 10 characters long"
      },
      re_pwd: {
        equalTo: "Password must be same",
      }
    },
submitHandler: function(form)
{
    let form_data = new FormData($('#change-owner-dpwd')[0]);// Creating object of FormData class
    form_data.append("_token", token);
    $.ajax({
        url: url_chnage_pwd,
        data: form_data,
        cache: false,
        contentType: false,
        processData: false,
        type: "POST",
        beforeSend: function()
        {
            $("div#divLoading").addClass('show');
        },
        success: function (res)
        {
            if(res.rc == 1)
            {
                demo.showNotification('top','right', res.rd);
                setTimeout(function()
                {
                    window.location = home;
                },20);          
            }
            else
            {
                demo.showNotification('top','right', res.rd);
            }

        },
        error: function(err)
        {
            demo.showNotification('top','right', "Something went wrong !");
        },
        complete: function(com)
        {
            $("div#divLoading").removeClass('show');
        }
    });
 }
});
/* Update Tenant Password*/
$("#change-tenant-dpwd").validate({
    rules: {
        old_pwd: {
          required: true, minlength: 5, maxlength: 10
        },
        new_pwd: {
          required: true, minlength: 5, maxlength: 10
        },
         re_pwd: {
          equalTo: "#new_pwd"
        }
    }
    , messages: {
      old_pwd: {
        required: "Please Enter your password",
        minlength: "Password must be at least 5 characters long",
        maxlength: "Password must be at 10 characters long"
      },
      new_pwd: {
        required: "Please Enter your password",
        minlength: "Password must be at least 5 characters long",
        maxlength: "Password must be at 10 characters long"
      },
      re_pwd: {
        equalTo: "Password must be same",
      }
    },
submitHandler: function(form)
{
    let form_data = new FormData($('#change-tenant-dpwd')[0]);// Creating object of FormData class
    form_data.append("_token", token);
    $.ajax({
        url: url_ten_chnage_pwd,
        data: form_data,
        cache: false,
        contentType: false,
        processData: false,
        type: "POST",
        beforeSend: function()
        {
            $("div#divLoading").addClass('show');
        },
        success: function (res)
        {
            if(res.rc == 1)
            {
                demo.showNotification('top','right', res.rd);
                setTimeout(function()
                {
                    window.location = home;
                },20);          
            }
            else
            {
                demo.showNotification('top','right', res.rd);
            }

        },
        error: function(err)
        {
            demo.showNotification('top','right', "Something went wrong !");
        },
        complete: function(com)
        {
            $("div#divLoading").removeClass('show');
        }
    });
 }
});
//Create inventory section | Show summary of property
$("#prop-with-no-invnt").change(function(){
    let prop_id = $('#prop-with-no-invnt').val();
    if(prop_id > 0)
    {
        $.ajax({
            method: 'GET',
            url: url_get_pend_pro_invnt,
            data: {prop_id: prop_id},
            beforeSend: function()
            {
                $("div#divLoading").addClass('show');
            },
            success: function (res)
            {

                if(res.rc == 1)
                {
                    //Empty div
                    $('div#pend-prop-dyn-summary').children().remove();
                    if(res.rd.prop_count_flag == true)
                    {
                        var invnt_elements = [];
                        let html = "<div></div>";
                        let table_rows = "<div></div>";

                        if(res.rd.prop_details.invnt_data_flag == true)
                        {
                            for(i=0; i < res.rd.prop_details.invnt_data.length; i++)
						    {

                             table_rows = $('<tr>')
                            .append('<td class="text-left">'+(i+1)+'</td>')
                            .append('<td class="text-left">'+res.rd.prop_details.invnt_data[i].category+'</td>')
                            .append('<td class="text-left">'+res.rd.prop_details.invnt_data[i].exp_rent+'</td>')
                            .append('<td class="text-left">'+res.rd.prop_details.invnt_data[i].exp_deposit+'</td>')
                            .append('<td class="text-left">'+res.rd.prop_details.invnt_data[i].morp+'</td>')
                            .append('<td class="text-left"><button type="button" class="btn btn-success ci-action-btn" data-actionid="'+res.rd.prop_details.invnt_data[i].level_id+'">Create Inventory</button></td>');
                            invnt_elements.push(table_rows);

                            }
                            html1 = $('<div>')
                            .append($('<div class="row">')
                            .append($('<div class="col-md-12">')
                            .append('<p class="category">Inventory Breakdown Availble</p>')
                            .append($('<div class="table-responsive table-full-width">')
                            .append($('<table class="table table-hover">')
                            .append($('<thead>')
                            .append($('<tr>')
                            .append('<th>Sl</th>')
                            .append('<th>Category</th>')
                            .append('<th>Expected Rent</th>')
                            .append('<th>Expected Deposit</th>')
                            .append('<th>MORP</th>')
                            .append('<th>Action</th>')))
                            .append($('<tbody>')
                            .append(invnt_elements))))));

                        }
                        html = $('<div>')
                        .append($('<div class="card">')
                        .append($('<div class="header">')
                        .append('<h4 class="title">Property Summary</h4>'))
                        .append($('<div class="content">')
                        .append($('<div class="row">')
                        .append($('<div class="col-md-4">')
                        .append('<p class="category">Property Listed By</p>')
                        .append($('<div class="table-responsive table-full-width">')
                        .append($('<table class="table table-striped">')
                        .append($('<tbody>')
                        .append($('<tr>')
                        .append('<td class="text-left">Name</td>')
                        .append('<td class="text-left">:</td>')
                        .append('<td class="text-left">'+res.rd.prop_details.listed_by_name+'(Owner)</td>'))
                        .append($('<tr>')
                        .append('<td class="text-left">Mobile</td>')
                        .append('<td class="text-left">:</td>')
                        .append('<td class="text-left">'+res.rd.prop_details.listed_by_mobile+'</td>'))))))
                        .append($('<div class="col-md-4" style="border-inline-start-style: dotted;">')
                        .append('<p class="category">Property Features</p>')
                        .append($('<div class="table-responsive table-full-width">')
                        .append($('<table class="table table-striped">')
                        .append($('<tbody>')
                        .append($('<tr>')
                        .append('<td class="text-left">Type</td>')
                        .append('<td class="text-left">:</td>')
                        .append('<td class="text-left">'+res.rd.prop_details.prop_type+" - "+res.rd.prop_details.prop_bhk_type+'</td>'))
                        .append($('<tr>')
                        .append('<td class="text-left">Furnish</td>')
                        .append('<td class="text-left">:</td>')
                        .append('<td class="text-left">'+res.rd.prop_details.prop_furnish+'</td>'))))))
                        .append($('<div class="col-md-4" style="border-inline-start-style: dotted;">')
                        .append('<p class="category">Property Location</p>')
                        .append($('<div class="table-responsive table-full-width">')
                        .append($('<table class="table table-striped">')
                        .append($('<tbody>')
                        .append($('<tr>')
                        .append('<td class="text-left">Locality</td>')
                        .append('<td class="text-left">:</td>')
                        .append('<td class="text-left">'+res.rd.prop_details.prop_locality+'</td>'))
                        .append($('<tr>')
                        .append('<td class="text-left">City</td>')
                        .append('<td class="text-left">:</td>')
                        .append('<td class="text-left">'+res.rd.prop_details.prop_city+'</td>')))))))
                        .append('<hr>')
                        .append(html1)));

                        //Append dynamic data to parent id
                        $('div#pend-prop-dyn-summary').append(html);

                    }

                }
                else
                {
                    location.reload();
                }
            },
            error: function(err)
            {
                location.reload();
            },
            complete: function(com)
            {
                $("div#divLoading").removeClass('show');
            }

        });
    }
    else
    {
        $('div#pend-prop-dyn-summary').children().remove();
    }


});

//Create Inventory action button
$("body").on("click", ".ci-action-btn", function(){
 let id=$(this).data("actionid");
 let prop_id = $("#prop-with-no-invnt").val();

    if(id > 0 && prop_id)
    {
    $.ajax({
        method: 'GET',
        url: url_get_invnt_level_valid,
        data: {id: id, prop_id: prop_id},
        beforeSend: function()
        {
            $("div#divLoading").addClass('show');
        },
        success: function (res)
        {

            if(res.rc == 1)
            {
                //Empty the modal
                $('div#invnts-modal-body').children().remove();
                if(res.rd.prop_data_flag == true)
                {
                    var invnt_elements = [];
                    let html = "<div></div>";
                    let table_rows = "<div></div>";

                    if(res.rd.prop_details.prop_invnt_flag == true)
                    {
                        for(i=0; i < res.rd.prop_details.prop_invnt_details.length; i++)
                        {

                        table_rows = $('<tr>')
                        .append('<td class="text-left">'+(i+1)+'</td>')
                        .append('<td class="text-left">'+res.rd.prop_details.prop_city+'</td>')
                        .append('<td class="text-left">'+res.rd.prop_details.prop_name+'</td>')
                        .append('<td class="text-left">'+res.rd.prop_details.prop_type+'</td>')
                        .append('<td class="text-left">'+res.rd.prop_details.prop_bhk+'</td>')
                        .append('<td class="text-left"><input type="text" class="form-control dyn-invnt-review-class" placeholder="Inventory ID" name="prop_invnt_ids_review['+i+']" value="'+res.rd.prop_details.prop_invnt_details[i]+'"></td>');



                        invnt_elements.push(table_rows);
                        }

                        html = $('<div>')
                        .append($('<div class="table-responsive table-full-width">')
                        .append($('<table class="table table-hover">')
                        .append($('<thead>')
                        .append($('<tr>')
                        .append('<th>Sl</th>')
                        .append('<th>Level 1</th>')
                        .append('<th>Level 2</th>')
                        .append('<th>Level 3</th>')
                        .append('<th>Level 4</th>')
                        .append('<th>Inventory ID</th>')))
                        .append($('<tbody>')
                        .append(invnt_elements))));

                    }
                     //Append dynamic data to parent id
                     $('div#invnts-modal-body').append(html);

                     //Add validation to dynamically created inventory
                     $('.dyn-invnt-review-class').each(function () {
                        $(this).rules("add", {
                            required: true
                        });
                    });

                }
                $('#conf-prop-invnt').data("actionid",id);
                $("#success-invnt-review-modal").modal('show');
            }
            else
            {
                location.reload();
            }


        },
        error: function(err)
        {
            location.reload();
        },
        complete: function(com)
        {
            $("div#divLoading").removeClass('show');
        }
    });
    }
    else
    {
        location.reload();
    }
});
//After preview, create Inventory now for this property with
$("#dyn-created-invnt-ids-form").validate({
submitHandler: function(form)
{
    let id=$("#conf-prop-invnt").data("actionid");
    let prop_id = $("#prop-with-no-invnt").val();
    if(id > 0 && prop_id > 0)
    {
     //Get all form data
     let form_data = new FormData($('#dyn-created-invnt-ids-form')[0]);// Creating object of FormData class
     form_data.append("_token", token);
     form_data.append("id", id);
     form_data.append("prop_id", prop_id);

    $.ajax({
        type: "POST",
        url: url_post_invnt_create,
        data: form_data,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function()
        {
            $("div#divLoading").addClass('show');
        },
        success: function (res)
        {
            if(res.rc == 1)
            {
                $("#success-invnt-review-modal").modal('hide');
                demo.showNotification('top','right', res.rd);
                setTimeout(function()
                {
                    window.location.replace(url_all_invnt)
                },20);
            }
            else
            {
                demo.showNotification('top','right', res.rd);
            }

        },
        error: function(err)
        {
            demo.showNotification('top','right', "Something went wrong !");
        },
        complete: function(com)
        {
            $("div#divLoading").removeClass('show');
        }
    });
    }
    else
    {
        location.reload();
    }
}

});
//Get one tenant info to assign inventory
$("#tenat-list").change(function(){

    let id = $("#tenat-list").val();
    if(id > 0)
    {
    $.ajax({
        method: 'GET',
        url: url_get_one_tenant,
        data: {id: id},
        beforeSend: function()
        {
            $("div#divLoading").addClass('show');
        },
        success: function (res)
        {
            if(res.rc == 1)
            {
                 //Empty the div
                 $('div#tenant-dyn-preview').children().remove();
                let html = "<div></div>";
                var dates = [];
                for (var i = 1; i < 20; i++) {
                    var date = '<option value="' + i + '">' + i + '</option>';
                    dates.push(date);
                  }


                if(res.rd)
                {
                let ten_mobile = 'N/A';
                let ten_m_status = '<i class="fa fa-warning icon-danger"></i>';
                let ten_email = 'N/A';
                let ten_e_status = '<i class="fa fa-warning icon-danger"></i>';
                if(res.rd.mobile)
                {
                    ten_mobile = res.rd.mobile; 
                }
                if(res.rd.mobile && res.rd.mobile_verified == 1)
                {
                    ten_m_status = '<i class="fa fa-check icon-success"></i>';
                }
                if(res.rd.email)
                {
                    ten_email = res.rd.email; 
                }
                if(res.rd.email && res.rd.email_verified == 1)
                {
                    ten_e_status = '<i class="fa fa-check icon-success"></i>';
                }
                html= $('<div class="row" style="margin-top:2%;">')
                    .append($('<div class="col-md-6">')
                    .append('<h5 class="title">Tenant Details</h5>')
                    .append($('<div class="table-responsive table-full-width">')
                    .append($('<table class="table table-hover">')
                    .append($('<tbody>')
                    .append($('<tr>')
                    .append('<td class="text-left">Name</td>')
                    .append('<td class="text-left">:</td>')
                    .append('<td class="text-left">'+res.rd.name+'</td>'))
                    .append($('<tr>')
                    .append('<td class="text-left">Mobile</td>')
                    .append('<td class="text-left">:</td>')
                    .append('<td class="text-left">'+ten_mobile+' '+ten_m_status+'</td>'))
                    .append($('<tr>')
                    .append('<td class="text-left">Email</td>')
                    .append('<td class="text-left">:</td>')
                    .append('<td class="text-left">'+ten_email+' '+ten_e_status+'</td>'))))))

                    .append($('<div class="col-md-6" style="border-inline-start-style: solid;">')
                    .append('<h5 class="title">Add Rental Details</h5>')
                    .append($('<div class="table-responsive table-full-width">')
                    .append($('<table class="table table-hover">')
                    .append($('<tbody>')
                    .append($('<tr>')
                    .append('<td class="text-left">Rent</td>')
                    .append('<td class="text-left">:</td>')
                    .append('<td class="text-left"><input type="text" class="form-control" placeholder="Enter rent per month" name="invnt_rent" id="invnt-rent"></td>'))
                    .append($('<tr>')
                    .append('<td class="text-left">Maintenance Charge</td>')
                    .append('<td class="text-left">:</td>')
                    .append('<td class="text-left"><input type="text" class="form-control" placeholder="Enter maintenance charge p/m" name="invnt_maint_charge" id="invnt-maint-charge"></td>'))
                    .append($('<tr>')
                    .append('<td class="text-left">Monthly Rent Pay Date</td>')
                    .append('<td class="text-left">:</td>')
                    .append('<td class="text-left"><select class="form-control" name="rent_pay_date" id="rent-pay-date">'+dates+'</select></td>')))))
                    .append($('<div class="text-right">')
                    .append('<button type="submit" class="btn btn-info btn-fill">Assign</button>')));

                }
                    //Append dynamic data to parent id
                    $('div#tenant-dyn-preview').append(html);

            }
            else
            {
                demo.showNotification('top','right', res.rd);
            }

        },
        error: function(err)
        {
            demo.showNotification('top','right', "Something went wrong !");
        },
        complete: function(com)
        {
            $("div#divLoading").removeClass('show');
        }
    });
    }
    else
    {
        $('div#tenant-dyn-preview').children().remove();
    }
});
//Assign tenant
$("#assign-ten-form").validate({
    rules: {
        invnt_rent: {
            required: true,
            number: true
        },
        rent_pay_date: {
            required: true,
            number: true
        },
        invnt_maint_charge: {
            required: true,
            number: true
        }
    },
submitHandler: function(form)
{
    let selected_uid = $('#tenat-list').val();
    let psummary_id = $('#psummary-id').data("psid");
    let invnt_s_id = $('#invnt-summry-id').data("invntsid");
     //Get all form data
     let form_data = new FormData($('#assign-ten-form')[0]);// Creating object of FormData class
     form_data.append("_token", token);
     form_data.append("selected_uid", selected_uid);
     form_data.append("p_summary_id", psummary_id);
     form_data.append("invnt_s_id", invnt_s_id);
     $.ajax({
        url: url_post_assign_tenant,
        data: form_data,
        cache: false,
        contentType: false,
        processData: false,
        type: "POST",
        beforeSend: function()
        {
            $("div#divLoading").addClass('show');
        },
        success: function (res)
        {

            if(res.rc == 1)
            {
                demo.showNotification('top','right', res.rd);
                setTimeout(function()
                {
                    window.location.replace(url_all_invnt)
                },20);
            }
            else
            {
                demo.showNotification('top','right', res.rd);
            }
        },
        error: function(err)
        {
            demo.showNotification('top','right', "Something went wrong !");
        },
        complete: function(com)
        {
            $("div#divLoading").removeClass('show');
        }
    });

}
});
/*To remove the disablity from rental details*/
$('#remo-disabled-button-rent').click(function(){

    if( $('#remo-disabled-button-rent').text()=='Edit Rental Details')
    {

    $('#remo-disabled-button-rent').after('<button type="submit" class="btn btn-success btn-fill" id="update-rent-details-sub" style="float:right; margin-right:10px;">Update</button>');
    $('#remo-disabled-button-rent').after('<button type="button" id="cancel-rental-update" class="btn btn-info" style="float:right;">Cancel</button>');
    $(".rental-details").removeAttr('disabled');
    $('#remo-disabled-button-rent').hide();

    }


});
//Cancel button for editing rental details
$("body").on('click', '#cancel-rental-update', function (e)
{
    $('#edit-rental-details-form')[0].reset();
    $('#edit-rental-details-form').find('label').remove();
    if( $('#cancel-rental-update').text()=='Cancel')
    {
        $(".rental-details").attr('disabled', 'disabled');
        $('#cancel-rental-update').remove();
        $('#update-rent-details-sub').remove();
        $('#remo-disabled-button-rent').show();
    }
});
$("#edit-rental-details-form").validate({
    rules: {
        edit_invnt_rent: {
            required: true,
            number: true
        },
        edit_maint_charge: {
            required: true,
            number: true
        },
        edi_rent_pay_date: {
            required: true,
            number: true
        }
    },
submitHandler: function(form)
{

    let psummary_id = $('#psummary-id').data("psid");
    let rentfuid = $('#rent-for-user').data("rentfuid");
    let invnt_s_id = $('#invnt-summry-id').data("invntsid");
     //Get all form data
     let form_data = new FormData($('#edit-rental-details-form')[0]);// Creating object of FormData class
     form_data.append("_token", token);
     form_data.append("p_summary_id", psummary_id);
     form_data.append("invnt_s_id", invnt_s_id);
     form_data.append("rentfuid", rentfuid);
     $.ajax({
        url: url_update_tenant_rent,
        data: form_data,
        cache: false,
        contentType: false,
        processData: false,
        type: "POST",
        beforeSend: function()
        {
            $("div#divLoading").addClass('show');
        },
        success: function (res)
        {
            if(res.rc == 1)
            {
                demo.showNotification('top','right', res.rd);
                $(".rental-details").attr('disabled', 'disabled');
                setTimeout(function()
                {
                    window.location.reload();
                },20);

            }
            else
            {
                demo.showNotification('top','right', res.rd);
            }

        },
        error: function(err)
        {
            demo.showNotification('top','right', "Something went wrong !");
        },
        complete: function(com)
        {
            $("div#divLoading").removeClass('show');
        }
    });

}
});
//Remove tenant
$('form#edit-rental-details-form').find('button[id=remo-ten-invnt-btn]').on('click', function(event){

// Stop acting like a button
event.preventDefault();
let psummary_id = $('#psummary-id').data("psid");
let rentfuid = $('#rent-for-user').data("rentfuid");
let invnt_s_id = $('#invnt-summry-id').data("invntsid");
$.ajax({
    url: url_remove_ten_invnt,
    data: {p_summary_id: psummary_id, rentfuid: rentfuid, invnt_s_id: invnt_s_id, _token: token},
    type: "POST",
    beforeSend: function()
    {
        $("div#divLoading").addClass('show');
    },
    success: function (res)
    {

        if(res.rc == 1)
        {
            demo.showNotification('top','right', res.rd);
            $(".rental-details").attr('disabled', 'disabled');
            setTimeout(function()
            {
                window.location.reload();
            },20);

        }
        else
        {
            demo.showNotification('top','right', res.rd);
        }

    },
    error: function(err)
    {
        demo.showNotification('top','right', "Something went wrong !");
    },
    complete: function(com)
    {
        $("div#divLoading").removeClass('show');
    }
});


});
//Edit email from dashboard
function dasEmailUpdate()
{
    let form = $('form#user-email-update');
    form.find("input#user-email").removeAttr('disabled');
    $("div#gen-email-otp").hide();
    $("div#email-update-save-b").show();
    $('#user-email-u-b').html('<i class="fa fa-times"></i>');
    $('#user-email-u-b').removeClass('btn-info');
    $('#user-email-u-b').addClass('btn-danger');
    $('#user-email-u-b').attr('onclick', 'dasEmailUpCan();');
}
//Cancel edit email
function dasEmailUpCan()
{
    let form = $('form#user-email-update');
    form.find("input#user-email").attr('disabled', 'disabled');
    $("div#gen-email-otp").show();
    $('#user-email-update')[0].reset();
    $("div#email-update-save-b").hide();
    $('#user-email-u-b').html('<i class="fa fa-edit"></i>');
    $('#user-email-u-b').addClass('btn-info');
    $('#user-email-u-b').removeClass('btn-danger');
    $('#user-email-u-b').attr('onclick', 'dasEmailUpdate();');

}
//Edit email from dashboard
function dasMobileUpdate()
{
    let form = $('form#user-mobile-update');
    form.find("input#user-mobile").removeAttr('disabled');
    $("div#gen-mobile-otp").hide();
    $("div#mobile-update-save-b").show();
    $('#user-mobile-u-b').html('<i class="fa fa-times"></i>');
    $('#user-mobile-u-b').removeClass('btn-info');
    $('#user-mobile-u-b').addClass('btn-danger');
    $('#user-mobile-u-b').attr('onclick', 'dasMobileUpCan();');
}
//Cancel edit email
function dasMobileUpCan()
{
    $("#user-mobile").attr('disabled', 'disabled');
    $("div#gen-mobile-otp").show();
    $('#user-mobile-update')[0].reset();
    $("div#mobile-update-save-b").hide();
    $('#user-mobile-u-b').html('<i class="fa fa-edit"></i>');
    $('#user-mobile-u-b').addClass('btn-info');
    $('#user-mobile-u-b').removeClass('btn-danger');
    $('#user-mobile-u-b').attr('onclick', 'dasMobileUpdate();');

}
//Edit name from dashboard
function dasNameUpdate()
{
    let form = $('form#user-name-update');
    form.find("input#user-name").removeAttr('disabled');
    $("div#name-check").hide();
    $("div#name-update-save-b").show();
    $('#user-name-u-b').html('<i class="fa fa-times"></i>');
    $('#user-name-u-b').removeClass('btn-info');
    $('#user-name-u-b').addClass('btn-danger');
    $('#user-name-u-b').attr('onclick', 'dasNameUpCan();');
}
//Cancel edit name
function dasNameUpCan()
{
    let form = $('form#user-name-update');
    form.find("input#user-name").attr('disabled', 'disabled');
    $("div#name-update-save-b").hide();
    $("div#name-check").show();
    $('form#user-name-update')[0].reset();
    $('#user-name-u-b').html('<i class="fa fa-edit"></i>');
    $('#user-name-u-b').addClass('btn-info');
    $('#user-name-u-b').removeClass('btn-danger');
    $('#user-name-u-b').attr('onclick', 'dasNameUpdate();');

}
//Send Mobile OTP
function sendMobileOTP(data)
{
    // var delID=data.getAttribute("id");
    // document.getElementById(delID).setAttribute("class", "btn btn-danger btn-simple btn-md");
    // alert(delID);
    $('#user-mobile-u-b').children().remove();
    $.ajax({
        url: url_send_mobile_otp,
        type: "GET",
        beforeSend: function()
        {
            $("div#divLoading").addClass('show');
        },
        success: function (res)
        {

            if(res.rc == 1)
            {
                //Empty the div
                $('div#dyn-mobile-veri').children().remove();
                let html = "<div></div>";
                if(res.rd)
                {
                html= $('<div class="row">')
                    .append($('<div class="col-md-8">')
                    .append($('<div class="form-group">')
                    .append('<input type="text" class="form-control" placeholder="Enter OTP" name="input_otp" id="input-otp-mobile">')
                    .append('<label for="input-otp-mobile">'+res.rd+'</label>')
                    .append('<input type="hidden" class="form-control" name="for" value="2">')))
                    .append($('<div class="col-md-4">')
                    .append($('<div class="form-group">')
                    .append('<button type="submit" class="btn btn-info btn-fill pull-right">Verify</button>')));
                }
                //Change text to resend otp
                $('div#gen-mobile-otp').find('a[href="javascript:sendMobileOTP();"]').text('Resend OTP');
                //Append dynamic data to parent id
                $('div#dyn-mobile-veri').append(html);
            }
            else
            {
                demo.showNotification('top','right', res.rd);
            }

        },
        error: function(err)
        {
            demo.showNotification('top','right', "Something went wrong !");
        },
        complete: function(com)
        {
            $("div#divLoading").removeClass('show');
        }
    });
}

//Send email OTP
function sendEmailOTP()
{

    $('#user-email-u-b').children().remove();
    $.ajax({
        url: url_send_email_otp,
        type: "GET",
        beforeSend: function()
        {
            $("div#divLoading").addClass('show');
        },
        success: function (res)
        {

            if(res.rc == 1)
            {
                //Empty the div
                $('div#dyn-email-veri').children().remove();
                let html = "<div></div>";
                if(res.rd)
                {
                html= $('<div class="row">')
                    .append($('<div class="col-md-8">')
                    .append($('<div class="form-group">')
                    .append('<input type="text" class="form-control" placeholder="Enter OTP" name="input_otp" id="input-otp-email">')
                    .append('<label for="input-otp-email">'+res.rd+'</label>')
                    .append('<input type="hidden" class="form-control" name="for" value="1">')))
                    .append($('<div class="col-md-4">')
                    .append($('<div class="form-group">')
                    .append('<button type="submit" class="btn btn-info btn-fill pull-right">Verify</button>')));
                }
                //Change text to resend otp
                $('div#gen-email-otp').find('a[href="javascript:sendEmailOTP();"]').text('Resend OTP');
                //Append dynamic data to parent id
                $('div#dyn-email-veri').append(html);
            }
            else
            {
                demo.showNotification('top','right', res.rd);
            }

        },
        error: function(err)
        {
            demo.showNotification('top','right', "Something went wrong !");
        },
        complete: function(com)
        {
            $("div#divLoading").removeClass('show');
        }
    });
}
//Dashboard-email-otp-verify form
$("#email-otp-verify").validate({
    errorClass: 'invalid',
    validClass: 'success',
    rules: {
        input_otp: {
            required: true
        }
    },
submitHandler: function(form)
{
    let form_data = new FormData($('#email-otp-verify')[0]);// Creating object of FormData class
    form_data.append("_token", token);
    $.ajax({
        url: url_verify_otp,
        data: form_data,
        cache: false,
        contentType: false,
        processData: false,
        type: "POST",
        beforeSend: function()
        {
            $("div#divLoading").addClass('show');
        },
        success: function (res)
        {
            if(res.rc == 1)
            {

            //Disble email box
            $("#user-email").attr('disabled', 'disabled');
            $("div#email-update-save-b").remove();
            //Empty the div
            $('div#dyn-email-veri').children().remove();
            //Change save button to resend otp
            $("div#gen-email-otp").children().remove();
            $('div#gen-email-otp').html('<i class="fa fa-check icon-success"></i>');

            }
            else if(res.rc == 3)
            {
                $("input#input-otp-email").removeAttr('style');
                $("label[for=input-otp-email]").text(res.rd);
                $('input#input-otp-email').focus().css({'border-color':'#f44','box-shadow':'0 0 8px #f44'});
                $(":input").bind("keyup change", function(e) {
                $("input#input-otp-email").removeAttr('style');
                $("label[for=input-otp-email]").empty();
                });
            }
        },
        error: function(err)
        {
            demo.showNotification('top','right', "Something went wrong !");
        },
        complete: function(com)
        {
            $("div#divLoading").removeClass('show');
        }
    });
}
});
//Dashboard-email-update-form
$("#user-email-update").validate({
    rules: {
        user_email: {
            required: true,
            email: true
        }
    },
submitHandler: function(form)
{

    let form_data = new FormData($('#user-email-update')[0]);// Creating object of FormData class
    form_data.append("_token", token);
    $.ajax({
        url: url_update_em,
        data: form_data,
        cache: false,
        contentType: false,
        processData: false,
        type: "POST",
        beforeSend: function()
        {
            $("div#divLoading").addClass('show');
        },
        success: function (res)
        {
            if(res.rc == 1)
            {
                //Empty the div
                $('div#dyn-email-veri').children().remove();
                let html = "<div></div>";
                if(res.rd)
                {
                html= $('<div class="row">')
                    .append($('<div class="col-md-8">')
                    .append($('<div class="form-group">')
                    .append('<input type="text" class="form-control" placeholder="Enter OTP" name="input_otp" id="input-otp-email">')
                    .append('<input type="hidden" class="form-control" name="for" value="1">')))
                    .append($('<div class="col-md-4">')
                    .append($('<div class="form-group">')
                    .append('<button type="submit" class="btn btn-info btn-fill pull-right">Verify</button>')));
                }
                //Disble email box
                $("#user-email").attr('disabled', 'disabled');
                //Change save button to resend otp
                $("div#gen-email-otp").show();
                $("div#gen-email-otp").children().remove();
                //Remove cancel button and save button
                $('#user-email-u-b').children().remove();
                $("div#email-update-save-b").children().remove();
                $('div#gen-email-otp').html('<a href="javascript:sendEmailOTP();">Resend OTP</a>');
                //Append dynamic data to parent id
                $('div#dyn-email-veri').append(html);
            }
            else
            {
                demo.showNotification('top','right', res.rd);
            }

        },
        error: function(err)
        {
            demo.showNotification('top','right', "Something went wrong !");
        },
        complete: function(com)
        {
            $("div#divLoading").removeClass('show');
        }
    });
}
});
//Submit email update form
function submitEmailUpForm(){
    if($("#user-email-update").valid())
    {
        $("#user-email-update").submit();
    }
    
}
//Dashboard-mobile-update-form
$("#user-mobile-update").validate({
    rules: {
        user_mobile: {
            required: true,
            number: true,
            minlength: 10,
            maxlength: 10
        }
    },
submitHandler: function(form)
{

    let form_data = new FormData($('#user-mobile-update')[0]);// Creating object of FormData class
    form_data.append("_token", token);
    $.ajax({
        url: url_update_em,
        data: form_data,
        cache: false,
        contentType: false,
        processData: false,
        type: "POST",
        beforeSend: function()
        {
            $("div#divLoading").addClass('show');
        },
        success: function (res)
        {
            if(res.rc == 1)
            {
                //Empty the div
                $('div#dyn-mobile-veri').children().remove();
                let html = "<div></div>";
                if(res.rd)
                {
                html= $('<div class="row">')
                    .append($('<div class="col-md-8">')
                    .append($('<div class="form-group">')
                    .append('<input type="text" class="form-control" placeholder="Enter OTP" name="input_otp" id="input-otp-mobile">')
                    .append('<input type="hidden" class="form-control" name="for" value="2">')))
                    .append($('<div class="col-md-4">')
                    .append($('<div class="form-group">')
                    .append('<button type="submit" class="btn btn-info btn-fill pull-right">Verify</button>')));
                }
                //Disble email box
                $("#user-mobile").attr('disabled', 'disabled');
                //Change save button to resend otp
                $("div#gen-mobile-otp").show();
                $("div#gen-mobile-otp").children().remove();
                //Remove cancel button and save button
                $('#user-mobile-u-b').children().remove();
                $("div#mobile-update-save-b").children().remove();
                $('div#gen-mobile-otp').html('<a href="javascript:sendMobileOTP();">Resend OTP</a>');
                //Append dynamic data to parent id
                $('div#dyn-mobile-veri').append(html);
            }
            else
            {
                demo.showNotification('top','right', res.rd);
            }

        },
        error: function(err)
        {
            demo.showNotification('top','right', "Something went wrong !");
        },
        complete: function(com)
        {
            $("div#divLoading").removeClass('show');
        }
    });
}
});
//Submit email update form
function submitMobileUpForm(){
    if($("#user-mobile-update").valid())
    {   
        $("#user-mobile-update").submit();
    }
    
}
//Dashboard-mobile-otp-verify form
$("#mobile-otp-verify").validate({
    errorClass: 'invalid',
    validClass: 'success',
    rules: {
        input_otp: {
            required: true
        }
    },
submitHandler: function(form)
{
    let form_data = new FormData($('#mobile-otp-verify')[0]);// Creating object of FormData class
    form_data.append("_token", token);
    $.ajax({
        url: url_verify_otp,
        data: form_data,
        cache: false,
        contentType: false,
        processData: false,
        type: "POST",
        beforeSend: function()
        {
            $("div#divLoading").addClass('show');
        },
        success: function (res)
        {
            if(res.rc == 1)
            {
            //Disble email box
            $("#user-mobile").attr('disabled', 'disabled');
            $("div#mobile-update-save-b").remove();
            //Empty the div
            $('div#dyn-mobile-veri').children().remove();
            //Change save button to resend otp
            $("div#gen-mobile-otp").children().remove();
            $('div#gen-mobile-otp').html('<i class="fa fa-check icon-success"></i>');
            }
            else if(res.rc == 3)
            {
                $("label[for=input-otp-mobile]").text(res.rd);
                $("input#input-otp-mobile").removeAttr('style');
                $('input#input-otp-mobile').focus().css({'border-color':'#f44','box-shadow':'0 0 8px #f44'});
                $(":input").bind("keyup change", function(e) {
                $("input#input-otp-mobile").removeAttr('style');
                $("label[for=input-otp-mobile]").empty();
                });
            }
        },
        error: function(err)
        {
            demo.showNotification('top','right', "Something went wrong !");
        },
        complete: function(com)
        {
            $("div#divLoading").removeClass('show');
        }
    });
}
});
//Dashboard-email-update-form
$("#user-name-update").validate({
    rules: {
        user_name: {
            required: true
        }
    },
submitHandler: function(form)
{

    let form_data = new FormData($('#user-name-update')[0]);// Creating object of FormData class
    form_data.append("_token", token);
    $.ajax({
        url: url_update_name,
        data: form_data,
        cache: false,
        contentType: false,
        processData: false,
        type: "POST",
        beforeSend: function()
        {
            $("div#divLoading").addClass('show');
        },
        success: function (res)
        {
            if(res.rc == 1)
            {
                 //Disble email box
                $("#user-name").val(res.name);
                $("#user-name").attr('disabled', 'disabled');
                $("div#name-update-save-b").hide();
                $('#user-name-u-b').html('<i class="fa fa-edit"></i>');
                $('#user-name-u-b').addClass('btn-info');
                $("div#name-check").show();
                $('#user-name-u-b').removeClass('btn-danger');
                $('#user-name-u-b').attr('onclick', 'dasNameUpdate();');
            }
            else
            {
                demo.showNotification('top','right', res.rd);
            }

        },
        error: function(err)
        {
            demo.showNotification('top','right', "Something went wrong !");
        },
        complete: function(com)
        {
            $("div#divLoading").removeClass('show');
        }
    });
}
});
//Submit email update form
function submitNameUpForm(){
    $("#user-name-update").valid();
    $("#user-name-update").submit();
}
//Dashboard Switch from tenant to owner
// $("#owner-dash-switch-form").validate({
//     rules: {
//         input_password: {
//             required: true
//         }
//     },
// submitHandler: function(form)
// {

//     let form_data = new FormData($('#owner-dash-switch-form')[0]);// Creating object of FormData class
//     form_data.append("_token", token);
//     $.ajax({
//         url: url_switch_owner_dash,
//         data: form_data,
//         cache: false,
//         contentType: false,
//         processData: false,
//         type: "POST",
//         beforeSend: function()
//         {
//             $("div#divLoading").addClass('show');
//         },
//         success: function (res)
//         {
//             if(res.rc == 3)
//             {
//               $("input#input-password").removeAttr('style');
//               $('input#input-password').focus().css({'border-color':'#f44','box-shadow':'0 0 8px #f44'});
//               $("label[for=input-password]").text(res.rd);
//               $(":input").bind("keyup change", function(e) {
//                 $("input#input-password").removeAttr('style');
//                 $("label[for=input-password]").empty();
//               });
//             }
//             else if(res.rc == 1)
//             {
//                 var mymodal = $('#switch-to-owner');
//                 mymodal.find('.modal-header').remove();
//                 mymodal.find('.modal-body').html('<h5 class="text-center">Switching to Owner Dashboard...</h5>');
//                 window.location.replace(url_owner_dashboard);
//             }
//             else
//             {
//                 demo.showNotification('top','right', res.rd);
//             }

//         },
//         error: function(err)
//         {
//             demo.showNotification('top','right', "Something went wrong !");
//         },
//         complete: function(com)
//         {
//             $("div#divLoading").removeClass('show');
//         }
//     });
// }
// });
//Dashboard Switch from tenant to owner
// $("#tenant-dash-switch-form").validate({
//     rules: {
//         input_password: {
//             required: true
//         }
//     },
// submitHandler: function(form)
// {

//     let form_data = new FormData($('#tenant-dash-switch-form')[0]);// Creating object of FormData class
//     form_data.append("_token", token);
//     $.ajax({
//         url: url_switch_owner_dash,
//         data: form_data,
//         cache: false,
//         contentType: false,
//         processData: false,
//         type: "POST",
//         beforeSend: function()
//         {
//             $("div#divLoading").addClass('show');
//         },
//         success: function (res)
//         {
//             if(res.rc == 3)
//             {
//               $("input#input-password").removeAttr('style');
//               $('input#input-password').focus().css({'border-color':'#f44','box-shadow':'0 0 8px #f44'});
//               $("label[for=input-password]").text(res.rd);
//               $(":input").bind("keyup change", function(e) {
//                 $("input#input-password").removeAttr('style');
//                 $("label[for=input-password]").empty();
//               });
//             }
//             else if(res.rc == 1)
//             {
//                 var mymodal = $('#switch-to-tenant');
//                 mymodal.find('.modal-header').remove();
//                 mymodal.find('.modal-body').html('<h5 class="text-center">Switching to Tenant Dashboard...</h5>');
//                 window.location.replace(url_tenant_dashboard);
//             }
//             else
//             {
//                 demo.showNotification('top','right', res.rd);
//             }

//         },
//         error: function(err)
//         {
//             demo.showNotification('top','right', "Something went wrong !");
//         },
//         complete: function(com)
//         {
//             $("div#divLoading").removeClass('show');
//         }
//     });
// }
// });
//Genrate bulk invoice form
$("#gen-bulk-invoice").validate({
    rules: {
        rent_for_month: {
            required: true
        },
        rent_due_date: {
            required: true
        }
    },
submitHandler: function(form)
{

    let form_data = new FormData($('#gen-bulk-invoice')[0]);// Creating object of FormData class
    form_data.append("_token", token);
    $.ajax({
        url: url_gen_bulk_invoice,
        data: form_data,
        cache: false,
        contentType: false,
        processData: false,
        type: "POST",
        beforeSend: function()
        {
            $("div#divLoading").addClass('show');
        },
        success: function (res)
        {
            if(res.rc == 1)
            {
                demo.showNotification('top','right', res.rd);
                setTimeout(function()
                {
                    window.location.replace(url_dr_invoices);
                },20);

            }
            else
            {
                demo.showNotification('top','right', res.rd);
            }

        },
        error: function(err)
        {
            demo.showNotification('top','right', "Something went wrong !");
        },
        complete: function(com)
        {
            $("div#divLoading").removeClass('show');
        }
    });
}
});
//Send Bulk invoice
$('button#confirm-send-draft').confirm({
    title: 'Confirm!',
    theme: 'bootstrap',
    buttons: {
        confirm:{
            btnClass: 'btn btn-info btn-fill',
            action: function(){
                $.ajax({
                    url: url_send_bulk_invoice,
                    method: "POST",
                    data: {_token: token},
                    beforeSend: function()
                    {
                        $("div#divLoading").addClass('show');
                    },
                    success: function (res)
                    {
                        if(res.rc == 1)
                        {
                            demo.showNotification('top','right', res.rd);
                            setTimeout(function()
                            {
                                window.location.replace(url_all_invoice_view);
                            },20);

                        }
                        else
                        {
                            demo.showNotification('top','right', res.rd);
                        }

                    },
                    error: function(err)
                    {
                        demo.showNotification('top','right', "Something went wrong !");
                    },
                    complete: function(com)
                    {
                        $("div#divLoading").removeClass('show');
                    }
                });

            }

        },
        cancel: function () {

        }
    }
});
//Delete drafted invoices
$("body").on("click", ".del-dr-inv", function(){
var tmp=$(this).data("tmp");
var tmpp=$(this).data("tmpp");
var tmppp=$(this).data("tmppp");
$.confirm({
    title: 'Confirm!',
    theme: 'bootstrap',
    buttons: {
        confirm:{
            btnClass: 'btn btn-info btn-fill',
            action: function(){

                $.ajax({
                    url: url_delete_dr_invoice,
                    method: "POST",
                    data:{tmp: tmp, tmpp: tmpp, tmppp: tmppp, _token: token},
                    beforeSend: function()
                    {
                        $("div#divLoading").addClass('show');
                    },
                    success: function (res)
                    {
                        if(res.rc == 1)
                        {
                            demo.showNotification('top','right', res.rd);
                            setTimeout(function()
                            {
                                location.reload();
                            },20);

                        }
                        else
                        {
                            demo.showNotification('top','right', res.rd);
                        }

                    },
                    error: function(err)
                    {
                        demo.showNotification('top','right', "Something went wrong !");
                    },
                    complete: function(com)
                    {
                        $("div#divLoading").removeClass('show');
                    }
                });

            }

        },
        cancel: function () {

        }
    }
});
});
//Send Bulk invoice
$('button#send-reminder').confirm({
    title: 'Confirm!',
    theme: 'bootstrap',
    buttons: {
        confirm:{
            btnClass: 'btn btn-info btn-fill',
            action: function(){
                $.ajax({
                    url: url_send_reminder,
                    method: "POST",
                    data: {_token: token},
                    beforeSend: function()
                    {
                        $("div#divLoading").addClass('show');
                    },
                    success: function (res)
                    {
                        if(res.rc == 1)
                        {
                            demo.showNotification('top','right', res.rd);
                            setTimeout(function()
                            {
                                location.reload();
                            },20);

                        }
                        else
                        {
                            demo.showNotification('top','right', res.rd);
                        }

                    },
                    error: function(err)
                    {
                        demo.showNotification('top','right', "Something went wrong !");
                    },
                    complete: function(com)
                    {
                        $("div#divLoading").removeClass('show');
                    }
                });

            }

        },
        cancel: function () {

        }
    }
});
//Create custom invoice section | Show summary of property, owner and tenant selcted
$("#ten-list-cust-inv").change(function(){
    let id = $('#ten-list-cust-inv').val();
    if(id > 0)
    {
        $.ajax({
            method: 'POST',
            url: url_get_cust_inv_ten,
            data: {id: id, _token: token},
            beforeSend: function()
            {
                $("div#divLoading").addClass('show');
            },
            success: function (res)
            {
                if(res.rc == 1)
                {
                    //Empty div
                    $('div#cust-ten-invnt-prop-summ').children().remove();
                    $('div#cust-ten-invnt-details').children().remove();
                    $('div#cust-ten-head-details').children().remove();
                    if(res.rd != undefined)
                    {
                      var invnt_elements = [];
                      let html = '<div></div>';
                      let list_options = '<option value="" class="ignore">Select...</option>';
                      invnt_elements.push(list_options);
                      let tenant_table = '<tr></tr>';
                      let prop_table = '<tr></tr>';
                      let owner_table = '<tr></tr>';
                      if(res.rd.invnt_details != undefined && res.rd.invnt_details.length > 0)
                      {
                        for(i=0; i < res.rd.invnt_details.length; i++)
						               {

                            list_options = $('<option value='+res.rd.invnt_details[i].invnt_id+'>'+res.rd.invnt_details[i].invnt+'</option>');
                            invnt_elements.push(list_options);

                            }
                      }
                      //Tenant details
                      if(res.rd.ten_details != undefined )
                      {

                      tenant_table =  $('<tbody>')
                                      .append($('<tr>')
                                      .append('<td class="text-left">Name</td>')
                                      .append('<td class="text-left">:</td>')
                                      .append('<td class="text-left">'+res.rd.ten_details.name+'</td>'))
                                      .append($('<tr>')
                                      .append('<td class="text-left">Email</td>')
                                      .append('<td class="text-left">:</td>')
                                      .append('<td class="text-left">'+res.rd.ten_details.email+'</td>'))
                                      .append($('<tr>')
                                      .append('<td class="text-left">Mobile</td>')
                                      .append('<td class="text-left">:</td>')
                                      .append('<td class="text-left">'+res.rd.ten_details.mobile+'</td>'))
                                      .append($('<tr>')
                                      .append('<td class="text-left">Address</td>')
                                      .append('<td class="text-left">:</td>')
                                      .append('<td class="text-left">'+res.rd.ten_details.line_1+', '+res.rd.ten_details.line_2+', '+res.rd.ten_details.city+', '+res.rd.ten_details.state+' - '+res.rd.ten_details.pin+'</td>'))

                      }
                      //Property details
                      if(res.rd.prop_details != undefined )
                      {

                      prop_table =  $('<tbody>')
                                      .append($('<tr>')
                                      .append('<td class="text-left">Apt Name</td>')
                                      .append('<td class="text-left">:</td>')
                                      .append('<td class="text-left">'+res.rd.prop_details.prop_title+'</td>'))
                                      .append($('<tr>')
                                      .append('<td class="text-left">Type</td>')
                                      .append('<td class="text-left">:</td>')
                                      .append('<td class="text-left">'+res.rd.prop_details.prop_type+" - "+res.rd.prop_details.prop_bhk_type+'</td>'))
                                      .append($('<tr>')
                                      .append('<td class="text-left">Furnish</td>')
                                      .append('<td class="text-left">:</td>')
                                      .append('<td class="text-left">'+res.rd.prop_details.prop_furnish+'</td>'))
                                      .append($('<tr>')
                                      .append('<td class="text-left">Locality</td>')
                                      .append('<td class="text-left">:</td>')
                                      .append('<td class="text-left">'+res.rd.prop_details.prop_locality+'</td>'))

                      }
                      //Owner details
                      if(res.rd.owner_details != undefined )
                      {

                      owner_table =  $('<tbody>')
                                      .append($('<tr>')
                                      .append('<td class="text-left">Name</td>')
                                      .append('<td class="text-left">:</td>')
                                      .append('<td class="text-left">'+res.rd.owner_details.name+'</td>'))
                                      .append($('<tr>')
                                      .append('<td class="text-left">Email</td>')
                                      .append('<td class="text-left">:</td>')
                                      .append('<td class="text-left">'+res.rd.owner_details.email+'</td>'))
                                      .append($('<tr>')
                                      .append('<td class="text-left">Mobile</td>')
                                      .append('<td class="text-left">:</td>')
                                      .append('<td class="text-left">'+res.rd.owner_details.mobile+'</td>'))
                                      .append($('<tr>')
                                      .append('<td class="text-left">Address</td>')
                                      .append('<td class="text-left">:</td>')
                                      .append('<td class="text-left">'+res.rd.owner_details.line_1+', '+res.rd.owner_details.line_2+', '+res.rd.owner_details.city+', '+res.rd.owner_details.state+' - '+res.rd.owner_details.pin+'</td>'))

                      }

                        html = $('<div>')
                        .append($('<div class="card">')
                        .append($('<div class="header">')
                        .append('<h4 class="title">Property Summary</h4>'))
                        .append($('<div class="content">')
                        .append($('<div class="row">')
                        .append($('<div class="col-md-4">')
                        .append('<p class="category">Tenant Details</p>')
                        .append($('<div class="table-responsive table-full-width">')
                        .append($('<table class="table table-striped">')
                        .append(tenant_table))))
                        .append($('<div class="col-md-4" style="border-inline-start-style: solid;">')
                        .append('<p class="category">Property Details</p>')
                        .append($('<div class="table-responsive table-full-width">')
                        .append($('<table class="table table-striped">')
                        .append(prop_table))))
                        .append($('<div class="col-md-4" style="border-inline-start-style: solid;">')
                        .append('<p class="category">Owner Details</p>')
                        .append($('<div class="table-responsive table-full-width">')
                        .append($('<table class="table table-striped">')
                        .append(owner_table)))))
                        .append($('<div class="row">')
                        .append($('<div class="col-md-12">')
                        .append('<p class="category">Assigned Inventories</p>')
                        .append($('<div class="form-group">')
                        .append($('<select class="selectpicker form-control" name="cust_inv_invnt_select" id="cust-inv-invnt-select">')
                        .append(invnt_elements)))))));

                        //Append dynamic data to parent id
                        $('div#cust-ten-invnt-prop-summ').append(html);
                        $("select#cust-inv-invnt-select").selectpicker("refresh");
                    }
                }
                else
                {
                    location.reload();
                }
            },
            error: function(err)
            {
                location.reload();
            },
            complete: function(com)
            {
                $("div#divLoading").removeClass('show');
            }

        });
    }
    else
    {
        $('div#cust-ten-invnt-prop-summ').children().remove();
        $('div#cust-ten-invnt-details').children().remove();
        $('div#cust-ten-head-details').children().remove();
    }


});
//Create custom invoice section | Show summary of property, owner and tenant selcted
$("body").on("change", "#cust-inv-invnt-select", function(){
    let id = $('#cust-inv-invnt-select').val();
    if(id > 0)
    {
        $.ajax({
            method: 'POST',
            url: url_get_cust_inv_invnt,
            data: {id: id, _token: token},
            beforeSend: function()
            {
                $("div#divLoading").addClass('show');
            },
            success: function (res)
            {

                if(res.rc == 1)
                {
                    //Empty div
                    $('div#cust-ten-invnt-details').children().remove();
                    $('div#cust-ten-head-details').children().remove();
                    let html = '<div></div>';
                    let html1 = '<div></div>';
                    let invnt_table = '<tbody></tbody>';
                    let head_items_array = [];
                    let head_items = '<option value="" class="ignore">Select...</option>';
                    let my_items = '<option value="" class="ignore">Select...</option>';
                    let for_month_array = [];
                    head_items_array.push(head_items);
                    for_month_array.push(my_items);
                      //Property details
                      if(res.rd != undefined)
                      {

                        invnt_table =  $('<tbody>')
                                      .append($('<tr>')
                                      .append('<td class="text-left">Monthly Rent</td>')
                                      .append('<td class="text-left">:</td>')
                                      .append('<td class="text-left">Rs. '+res.rd.rent+'</td>')
                                      .append('<td class="text-left">Maintenance Charge</td>')
                                      .append('<td class="text-left">:</td>')
                                      .append('<td class="text-left">Rs. '+res.rd.maint_charge+'</td>')
                                      .append('<td class="text-left">Rent Pay Date</td>')
                                      .append('<td class="text-left">:</td>')
                                      .append('<td class="text-left">'+res.rd.rent_pay_date+'</td>'));


                      }
                      if(res.rd != undefined && res.account_head.length > 0)
                      {
                        //Account head array
                        for(i=0; i < res.account_head.length; i++)
						{

                            head_items = $('<option value="'+res.account_head[i].item_type_id+'">'+res.account_head[i].item_type+'</option>');
                            head_items_array.push(head_items);

                        }
                        //Month Year array
                        if(res.month_year_array != undefined && res.month_year_array.length > 0)                      
                        {
                            for(i=0; i < res.month_year_array.length; i++)
                            {

                                my_items = $('<option value="'+res.month_year_array[i]+'">'+res.month_year_array[i]+'</option>');
                                for_month_array.push(my_items);

                            }
                        }
                        //For account head section
                        html1 = $('<div>')
                                .append($('<div class="card">')
                                .append($('<div class="header">')
                                .append('<h4 class="title">Add Invoice Items</h4>'))
                                .append($('<div class="content">')
                                .append($('<div class="row">')
                                .append($('<div class="col-md-4">')
                                .append('<label for="cust-inv-f-m">For Month</label>')
                                .append($('<select class="form-control" required name="cust_inv_f_m" id="cust-inv-f-m">')
                                .append(for_month_array)))
                                .append($('<div class="col-md-4">')
                                .append('<label for="cust-inv-d-d">Due Date</label>')
                                .append('<input type="text" placeholder="Date" required name="cust_inv_d_d" id="cust-inv-d-d" class="form-control datepicker">')))                  
                                .append('<hr>')
                                .append($('<div class="row">')
                                .append($('<div class="col-md-12">')
                                .append($('<div class="table-responsive table-full-width">')
                                .append($('<table class="table table-striped" id="cust-inv-table">')
                                .append($('<thead>')
                                .append($('<tr>')
                                .append('<th>Account Head</th>')
                                .append('<th>Price</th>')
                                .append('<th>Net Amount</th>')))
                                .append($('<tbody>')
                                .append($('<tr>')
                                .append($('<td>')
                                .append($('<select class="form-control inv-row-fields inv-item-0" name="cust_inv_item[0][1]" id="acnt-head-items">')
                                .append(head_items_array)))
                                .append('<td><input type="text" class="form-control numeric inv-row-fields inv-item-1" placeholder="Enter amount" name="cust_inv_item[0][2]"></td>')
                                .append('<td><input type="text" class="form-control numeric inv-row-fields inv-item-2" placeholder="Total = 00" name="cust_inv_item[0][3]" disabled></td>')
                                .append('<td><button type="button" class="btn btn-fill btn-success" id="add-cust-inv-row">Add Row</button></td>')))))))
                                .append('<hr>')
                                .append($('<div class="row">')
                                .append($('<div class="col-md-6 col-md-offset-4">')
                                .append($('<div class="table-responsive table-full-width">')
                                .append($('<table class="table table-hover">')
                                .append($('<tbody class="text-right">')
                                .append($('<tr>')
                                .append('<td>Subtotal</td>')
                                .append('<td>:</td>')
                                .append('<td id="cust-inv-subtottl">00</td>'))
                                .append($('<tr>')
                                .append('<td>Add TDS (%)</td>')
                                .append('<td><input type="text" class="form-control numeric" placeholder="Enter TDS in %" name="cust_inv_tds" id="cust-inv-enter-tds" style="width:50%;"></td>')
                                .append('<td id="cust-inv-tds">00</td>'))
                                .append($('<tr>')
                                .append('<td>Add GST (%)</td>')
                                .append('<td><input type="text" class="form-control numeric" placeholder="Enter GST in %" name="cust_inv_gst" id="cust-inv-enter-gst" style="width:50%;"></td>')
                                .append('<td id="cust-inv-gst">00</td>'))
                                .append($('<tr>')
                                .append('<td>Net Total</td>')
                                .append('<td>:</td>')
                                .append('<td id="cust-inv-net">00</td>')))))))
                                .append('<hr>')
                                .append($('<div class="row">')
                                .append($('<div class="col-md-3 col-md-offset-9">')
                                .append('<button type="button" class="btn btn-fill btn-success" id="save-cust-inv-row" style="margin-right:10px;">Save</button>')
                                .append('<button type="button" class="btn btn-fill btn-warning" id="gen-cust-inv">Generate</button>')))));
                                    
                                

                        $('div#cust-ten-head-details').append(html1);
                        //Add validation to dynamically created inventory
                        $("#cust-inv-form").validate(); //sets up the validator
                        $('.inv-row-fields').each(function () {
                            $(this).rules("add", {
                                required: true,
                                number: true
                            });
                        });
                        $('.datepicker').datepicker({
                            format:'d-MM-yyyy',
                            startDate: '0d',
                            todayHighlight: true,
                            autoclose: true
                        });
                      }
                      //For inventory details section
                        html = $('<div>')
                        .append($('<div class="card">')
                        .append($('<div class="header">')
                        .append('<h4 class="title">Inventory Summary</h4>'))
                        .append($('<div class="content">')
                        .append($('<div class="row">')
                        .append($('<div class="col-md-12">')
                        .append($('<div class="table-responsive table-full-width">')
                        .append($('<table class="table table-striped">')
                        .append(invnt_table)))))));
                      

                        //Append dynamic data to parent id
                        $('div#cust-ten-invnt-details').append(html);
                        //Make it only numeric acceptable
                        $('.numeric').numeric({decimal: true, negative: false});

                    }

                else
                {
                    location.reload();
                }
            },
            error: function(err)
            {
                location.reload();
            },
            complete: function(com)
            {
                $("div#divLoading").removeClass('show');
            }

        });
    }
    else
    {
        //$('div#cust-ten-invnt-prop-summ').children().remove();
    }

});
//Add custom invoice row
let i=1;
$("body").on("click", "#add-cust-inv-row", function(){
//Clone the head items
let cnt_head_items = $("#acnt-head-items > option").clone();
let new_row =   $('<tr>')
                .append($('<td>')
                .append($('<select class="form-control inv-row-fields inv-item-0" name="cust_inv_item['+i+'][1]">')
                .append(cnt_head_items)))
                .append('<td><input type="text" class="form-control numeric inv-row-fields inv-item-1" placeholder="Enter amount" name="cust_inv_item['+i+'][2]"></td>')
                .append('<td><input type="text" class="form-control numeric inv-row-fields inv-item-2" placeholder="Total = 00" name="cust_inv_item['+i+'][3]" disabled></td>')
                .append('<td><button type="button" class="btn btn-fill btn-warning remove-cust-inv-item">Remove</button></td>')

$('table#cust-inv-table').append(new_row);
//Make it only numeric acceptable
$('.numeric').numeric({decimal: true, negative: false});
$("#cust-inv-form").validate(); //sets up the validator
//Add rule to dynamic created input boxes
$('.inv-row-fields').each(function () {
    $(this).rules("add", {
        required: true,
        number: true
    });
});
i++;
});
//Remove Custome invoice items row
$("body").on("click", ".remove-cust-inv-item", function(){

    $(this).parent().parent().remove();
    validateCustInv();
});
//Validate form
$("body").on("click", "#save-cust-inv-row", function(){
    
    validateCustInv();

});
//Add GST
$("body").on("keyup", "#cust-inv-enter-gst", function(){
    addGST();
});

//Add TDS
$("body").on("keyup", "#cust-inv-enter-tds", function(){
    addTDS();
});
//Function to validate custom invoice fields
function validateCustInv()
{
    if($("#cust-inv-form").valid())
    {
        let sum = 0;
        $('.inv-item-0').each(function() {
            let input_name = $(this).attr('name');    
            var matches = input_name.match(/\[(.*?)\]/);
            let submatch = 0;
            if (matches) 
            {
                submatch = matches[1];       
            }
            let price = $('input[name="cust_inv_item['+submatch+'][2]"]').val();
            if(!isNaN(submatch) && !isNaN(price)) 
            {
                if($(this).val() == 3)
                {
                    $('input[name="cust_inv_item['+submatch+'][3]"]').val('- '+price);
                     sum -= Number(price);
                }
                else
                {
                    $('input[name="cust_inv_item['+submatch+'][3]"]').val(price);
                    sum += Number(price);
                }
            }
       
         });
         //Check if sum is positive integer
         if(sum > 0)
         {
            $('td#cust-inv-subtottl').text(sum);
            addNetValue();
            addTDS();
            addGST();
            return true;
         }
         else
         {
            $('td#cust-inv-subtottl').text(00);
            demo.showNotification('top','right', "Sum should be a positive number !");
            addNetValue();
            addTDS();
            addGST();
            return false;
         }
         
    }
}
//FUnction to calculate total net vlaue
function addNetValue()
{

    let sub_total = parseFloat($('td#cust-inv-subtottl').text());
    let tds_val = parseFloat($('td#cust-inv-tds').text()); 
    let gst_val = parseFloat($('td#cust-inv-gst').text()); 
    if(!isNaN(sub_total) && !isNaN(tds_val) && !isNaN(gst_val) && sub_total > 0)
    {
        let final_val = Number(sub_total + tds_val + gst_val);
        $('td#cust-inv-net').text(final_val);
    }
    else
    {
        $('td#cust-inv-net').text(00);
    }

}
//Function to calculate total GST
function addTDS()
{
    let sub_total = parseFloat($('td#cust-inv-subtottl').text());
    let tds_val = parseFloat($('#cust-inv-enter-tds').val()); 
    let net_sum = parseFloat($('td#cust-inv-net').text());
    if(!isNaN(tds_val) && !isNaN(sub_total) && !isNaN(net_sum) && sub_total > 0 && net_sum > 0 && tds_val > 0)
    {

        let total_tds = parseFloat(sub_total*tds_val);
        total_tds = parseFloat(total_tds/100);
        $('td#cust-inv-tds').text(total_tds);
        addNetValue();
    }
    else
    {
        $('td#cust-inv-tds').text(00);
        addNetValue();
    }
}
//Function to calculate GST
function addGST()
{
    let sub_total = parseFloat($('td#cust-inv-subtottl').text());
    let gst_val = parseFloat($('#cust-inv-enter-gst').val()); 
    let net_sum = parseFloat($('td#cust-inv-net').text());
    if(!isNaN(gst_val) && !isNaN(sub_total) && !isNaN(net_sum) && sub_total > 0 && net_sum > 0 && gst_val > 0)
    {

        let total_gst = parseFloat(sub_total*gst_val);
        total_gst = parseFloat(total_gst/100);
        $('td#cust-inv-gst').text(total_gst);
        addNetValue();
    }
    else
    {
        $('td#cust-inv-gst').text(00);
        addNetValue();
    }
}
//Genrate Custome invoice
$("body").on("click", "#gen-cust-inv", function(){
    //If Form is verified
    if(validateCustInv())
    {
        $.confirm({
            title: 'Confirm!',
            theme: 'bootstrap',
            buttons: {
                confirm:{
                    btnClass: 'btn btn-info btn-fill',
                    action: function(){
        
                        let form_data = new FormData($('#cust-inv-form')[0]);// Creating object of FormData class
                        form_data.append("_token", token);
                        $.ajax({
                            url: url_gen_cust_inv,
                            data: form_data,
                            cache: false,
                            contentType: false,
                            processData: false,
                            type: "POST",
                            beforeSend: function()
                            {
                                $("div#divLoading").addClass('show');
                            },
                            success: function (res)
                            {
                                if(res.rc == 1)
                                {
                                    demo.showNotification('top','right', res.rd);
                                    setTimeout(function()
                                    {
                                        window.location.replace(url_dr_invoices);
                                    },20);
        
                                }
                                else
                                {
                                    demo.showNotification('top','right', res.rd);
                                }
        
                            },
                            error: function(err)
                            {
                                demo.showNotification('top','right', "Something went wrong !");
                            },
                            complete: function(com)
                            {
                                $("div#divLoading").removeClass('show');
                            }
                        });
        
                    }
        
                },
                cancel: function () {
        
                }
            }
        });

        
    }

});
let oat_id = 0;
let oat_ten_id = 0;
//Upload rental agreement
$('table#oat-invnt-ten-table').find('button[class="u-r-a-p btn btn-info"]').on('click', function(event){
oat_id = $(this).data('idd');
oat_ten_id = $(this).data('id');
$('#upload-rental-agrmnt').modal();
});
//Upload rental agreement form
$("#oat-rental-agrmnt-up").validate({
    rules: {
        oat_rental_agrmnt: {
            required: true,
            extension: "pdf"
        }
    },
    messages: 
    {
        oat_rental_agrmnt: {
            required: "Please select a file.",
            extension: "Please select PDF file only."
        }
    },
submitHandler: function(form)
{
    if(oat_id > 0 && oat_ten_id > 0)
    {
    let form_data = new FormData($('#oat-rental-agrmnt-up')[0]);// Creating object of FormData class
    form_data.append("oat_id", oat_id);
    form_data.append("oat_ten_id", oat_ten_id);
    form_data.append("_token", token);
    $.ajax({
        url: url_renatl_upload,
        data: form_data,
        cache: false,
        contentType: false,
        processData: false,
        type: "POST",
        beforeSend: function()
        {
            $("div#divLoading").addClass('show');
        },
        success: function (res)
        {
            if(res.rc == 1)
            {
                demo.showNotification('top','right', res.rd);
                setTimeout(function()
                {
                    location.reload();
                },20);

            }
            else
            {
                demo.showNotification('top','right', res.rd);
            }

        },
        error: function(err)
        {
            demo.showNotification('top','right', "Something went wrong !");
        },
        complete: function(com)
        {
            $("div#divLoading").removeClass('show');
        }
    });
    }
    else
    {
        location.reload();
    }
}
});
//Load Cities When States is selcted
$("#input-state").change(function(){

    var inputState = $('select#input-state').val();
    if (!isNaN(inputState) && inputState > 0)
    {
        
        $.ajax({
        method: 'GET',
        url: url_get_respective_cities, 
        data: {inputState: inputState},
        success: function (res) 
                {

                if(res.rc == 1)
                {
    
                $("select#input-city").empty();
                $("select#input-city").append("<option value=''>Select</option>");
                    $("select#input-city").selectpicker("refresh");
                for (var i = 0; i < res.rd.length; i++)
                { 
    
                    let html = $("<option value='"+res.rd[i].city_id+"'>"+res.rd[i].name+"</option>");
                    $("select#input-city").append(html);
                    $("select#input-city").selectpicker("refresh");
                }
                $("select#input-city").append("<option value='Other'>Other</option>");
                $("select#input-city").selectpicker("refresh");
            }
                else if(res.rc == 2)
                {
                $("select#input-city").empty();
                $("select#input-city").append("<option value=''>Select</option>");
                $("select#input-city").selectpicker("refresh");
                }
    
                }
            }); 
    
    }
    else
    {
        $("select#inputCity").empty();
        $("select#inputCity").append("<option value=''>Select</option>");
        $("select#inputCity").selectpicker("refresh");
    }
    
    
    });
//Save owner Address
$("#owner-address-form").validate({
    errorClass: 'invalid',
    validClass: 'success',
    rules: {
        add_line_1: {
            required: true
        },
        add_line_2: {
            required: true
        },
        input_state: {
            required: true
        },
        input_city: {
            required: true
        },
        pin: {
            required: true,
            number: true
        }
    },
submitHandler: function(form)
{

    let form_data = new FormData($('#owner-address-form')[0]);// Creating object of FormData class
    form_data.append("_token", token);
    $.ajax({
        url: url_owner_post_address,
        data: form_data,
        cache: false,
        contentType: false,
        processData: false,
        type: "POST",
        beforeSend: function()
        {
            $("div#divLoading").addClass('show');
        },
        success: function (res)
        {
            if(res.rc == 1)
            {
                demo.showNotification('top','right', res.rd);
                setTimeout(function()
                {
                    location.reload(true);
                },20);

            }
            else
            {
                demo.showNotification('top','right', res.rd);
            }

        },
        error: function(err)
        {
            demo.showNotification('top','right', "Something went wrong !");
        },
        complete: function(com)
        {
            $("div#divLoading").removeClass('show');
        }
    });
}
});
//Edit address details owner
function ownerAddEdit()
{
    let form = $('form#owner-address-form');
    form.find(".form-control").prop('disabled', false);
    form.find('.selectpicker').selectpicker('refresh');
    form.find('#action-owner-add-form').text('Cancel');
    form.find("#action-up-owner-add-form").show();
    form.find('#action-owner-add-form').removeClass('btn-fill');
    form.find('#action-owner-add-form').attr('onclick', 'ownerAddEditCan();');
    return true;
}
//Cancel edit address owner  form
function ownerAddEditCan()
{
    let form = $('form#owner-address-form');
    form.find(".form-control").prop('disabled', true);
    form.find('.selectpicker').selectpicker('refresh');
    form.find("#action-up-owner-add-form").hide();
    form.find('#action-owner-add-form').addClass('btn-fill');
    $(form)[0].reset();
    form.find('#action-owner-add-form').text('Edit');
    form.find('#action-owner-add-form').attr('onclick', 'ownerAddEdit();');
    return true;

}
//Submit adress update form owner
function ownerAddEditSubForm(){
    let form = $('form#owner-address-form');
    form.valid();
    form.submit();
    return true;
}
//Save owner bank details
$("#owner-bank-form").validate({
    errorClass: 'invalid',
    validClass: 'success',
    rules: {
        pan_no: {
            required: true
        },
        adhaar_no: {
            required: true
        },
        acc_holder_name: {
            required: true
        },
        acc_no: {
            required: true,
            number: true
        },
        bank_name: {
            required: true
        },
        branch_name: {
            required: true
        },
        ifsc: {
            required: true
        },
        type: {
            required: true
        },
        micr: {
            required: true
        },
        cheque: {
            required: true,
            extension: "pdf|jpeg|jpg|png"
        }
    },
submitHandler: function(form)
{

    let form_data = new FormData($('#owner-bank-form')[0]);// Creating object of FormData class
    form_data.append("_token", token);
    $.ajax({
        url: url_owner_post_bank_details,
        data: form_data,
        cache: false,
        contentType: false,
        processData: false,
        type: "POST",
        beforeSend: function()
        {
            $("div#divLoading").addClass('show');
        },
        success: function (res)
        {
            if(res.rc == 1)
            {
                demo.showNotification('top','right', res.rd);
                setTimeout(function()
                {
                    location.reload(true);
                },20);

            }
            else
            {
                demo.showNotification('top','right', res.rd);
            }

        },
        error: function(err)
        {
            demo.showNotification('top','right', "Something went wrong !");
        },
        complete: function(com)
        {
            $("div#divLoading").removeClass('show');
        }
    });
}
});
//Edit bank details owner
function ownerBankEdit()
{
    let form = $('form#owner-bank-form');
    form.find(".form-control").prop('disabled', false);
    form.find('#action-owner-bank-form').text('Cancel');
    form.find("#action-up-owner-bank-form").show();
    form.find('#action-owner-bank-form').removeClass('btn-fill');
    form.find('#action-owner-bank-form').attr('onclick', 'ownerBankEditCan();');
    return true;
}
//Cancel edit bank details owner  form
function ownerBankEditCan()
{
    let form = $('form#owner-bank-form');
    form.find(".form-control").prop('disabled', true);
    form.find("#action-up-owner-bank-form").hide();
    form.find('#action-owner-bank-form').addClass('btn-fill');
    $(form)[0].reset();
    form.find('#action-owner-bank-form').text('Edit');
    form.find('#action-owner-bank-form').attr('onclick', 'ownerBankEdit();');
    return true;

}
//Submit bank details form owner
function ownerBankEditSubForm(){
    let form = $('form#owner-bank-form');
    form.valid();
    form.submit();
    return true;
}
//Save about me owner
$("#owner-about-form").validate({
    errorClass: 'invalid',
    validClass: 'success',
    rules: {
        about_me: {
            required: true
        }
    },
submitHandler: function(form)
{

    let form_data = new FormData($('#owner-about-form')[0]);// Creating object of FormData class
    form_data.append("_token", token);
    $.ajax({
        url: url_owner_post_about_me,
        data: form_data,
        cache: false,
        contentType: false,
        processData: false,
        type: "POST",
        beforeSend: function()
        {
            $("div#divLoading").addClass('show');
        },
        success: function (res)
        {
            if(res.rc == 1)
            {
                demo.showNotification('top','right', res.rd);
                setTimeout(function()
                {
                    location.reload(true);
                },20);

            }
            else
            {
                demo.showNotification('top','right', res.rd);
            }

        },
        error: function(err)
        {
            demo.showNotification('top','right', "Something went wrong !");
        },
        complete: function(com)
        {
            $("div#divLoading").removeClass('show');
        }
    });
}
});
//Edit owner about me 
function ownerAboutEdit()
{
    let form = $('form#owner-about-form');
    form.find(".form-control").prop('disabled', false);
    form.find('#action-owner-about-form').text('Cancel');
    form.find("#action-up-about-form").show();
    form.find('#action-owner-about-form').removeClass('btn-fill');
    form.find('#action-owner-about-form').attr('onclick', 'ownerAboutEditCan();');
    return true;
}
//Cancel edit about me owner  form
function ownerAboutEditCan()
{
    let form = $('form#owner-about-form');
    form.find(".form-control").prop('disabled', true);
    form.find("#action-up-about-form").hide();
    form.find('#action-owner-about-form').addClass('btn-fill');
    $(form)[0].reset();
    form.find('#action-owner-about-form').text('Edit');
    form.find('#action-owner-about-form').attr('onclick', 'ownerAboutEdit();');
    return true;

}
//Submit about me owner form
function ownerAboutEditSubForm(){
    let form = $('form#owner-about-form');
    form.valid();
    form.submit();
    return true;
}
//Save Tenant Address
$("#tenant-address-form").validate({
    errorClass: 'invalid',
    validClass: 'success',
    rules: {
        add_line_1: {
            required: true
        },
        add_line_2: {
            required: true
        },
        input_state: {
            required: true
        },
        input_city: {
            required: true
        },
        pin: {
            required: true,
            number: true
        }
    },
submitHandler: function(form)
{

    let form_data = new FormData($('#tenant-address-form')[0]);// Creating object of FormData class
    form_data.append("_token", token);
    $.ajax({
        url: url_tenant_post_address,
        data: form_data,
        cache: false,
        contentType: false,
        processData: false,
        type: "POST",
        beforeSend: function()
        {
            $("div#divLoading").addClass('show');
        },
        success: function (res)
        {
            if(res.rc == 1)
            {
                demo.showNotification('top','right', res.rd);
                setTimeout(function()
                {
                    location.reload(true);
                },20);

            }
            else
            {
                demo.showNotification('top','right', res.rd);
            }

        },
        error: function(err)
        {
            demo.showNotification('top','right', "Something went wrong !");
        },
        complete: function(com)
        {
            $("div#divLoading").removeClass('show');
        }
    });
}
});
//Edit address details tenant
function tenAddEdit()
{
    let form = $('form#tenant-address-form');
    form.find(".form-control").prop('disabled', false);
    form.find('.selectpicker').selectpicker('refresh');
    form.find('#action-tenant-add-form').text('Cancel');
    form.find("#action-up-tenant-add-form").show();
    form.find('#action-tenant-add-form').removeClass('btn-fill');
    form.find('#action-tenant-add-form').attr('onclick', 'tenAddEditCan();');
    return true;
}
//Cancel edit address tenant  form
function tenAddEditCan()
{
    let form = $('form#tenant-address-form');
    form.find(".form-control").prop('disabled', true);
    form.find('.selectpicker').selectpicker('refresh');
    form.find("#action-up-tenant-add-form").hide();
    form.find('#action-tenant-add-form').addClass('btn-fill');
    $(form)[0].reset();
    form.find('#action-tenant-add-form').text('Edit');
    form.find('#action-tenant-add-form').attr('onclick', 'tenAddEdit();');
    return true;

}
//Submit adress update form tenant
function tenAddEditSubForm(){
    let form = $('form#tenant-address-form');
    form.valid();
    form.submit();
    return true;
}
//Save tenant bank details
$("#tenant-bank-form").validate({
    errorClass: 'invalid',
    validClass: 'success',
    rules: {
        pan_no: {
            required: true
        },
        adhaar_no: {
            required: true
        },
        acc_holder_name: {
            required: true
        },
        acc_no: {
            required: true,
            number: true
        },
        bank_name: {
            required: true
        },
        branch_name: {
            required: true
        },
        ifsc: {
            required: true
        },
        type: {
            required: true
        },
        micr: {
            required: true
        },
        cheque: {
            required: true,
            extension: "pdf|jpeg|jpg|png"
        }
    },
submitHandler: function(form)
{

    let form_data = new FormData($('#tenant-bank-form')[0]);// Creating object of FormData class
    form_data.append("_token", token);
    $.ajax({
        url: url_tenant_post_bank,
        data: form_data,
        cache: false,
        contentType: false,
        processData: false,
        type: "POST",
        beforeSend: function()
        {
            $("div#divLoading").addClass('show');
        },
        success: function (res)
        {
            if(res.rc == 1)
            {
                demo.showNotification('top','right', res.rd);
                setTimeout(function()
                {
                    location.reload(true);
                },20);

            }
            else
            {
                demo.showNotification('top','right', res.rd);
            }

        },
        error: function(err)
        {
            demo.showNotification('top','right', "Something went wrong !");
        },
        complete: function(com)
        {
            $("div#divLoading").removeClass('show');
        }
    });
}
});
//Edit bank details tenant
function tenBankEdit()
{
    let form = $('form#tenant-bank-form');
    form.find(".form-control").prop('disabled', false);
    form.find('#action-tenant-bank-form').text('Cancel');
    form.find("#action-up-tenant-bank-form").show();
    form.find('#action-tenant-bank-form').removeClass('btn-fill');
    form.find('#action-tenant-bank-form').attr('onclick', 'tenBankEditCan();');
    return true;
}
//Cancel edit bank details tenant  form
function tenBankEditCan()
{
    let form = $('form#tenant-bank-form');
    form.find(".form-control").prop('disabled', true);
    form.find("#action-up-tenant-bank-form").hide();
    form.find('#action-tenant-bank-form').addClass('btn-fill');
    $(form)[0].reset();
    form.find('#action-tenant-bank-form').text('Edit');
    form.find('#action-tenant-bank-form').attr('onclick', 'tenBankEdit();');
    return true;

}
//Submit bank details form tenant
function tenBankEditSubForm(){
    let form = $('form#tenant-bank-form');
    form.valid();
    form.submit();
    return true;
}
//Save about me tenant
$("#tenant-about-form").validate({
    errorClass: 'invalid',
    validClass: 'success',
    rules: {
        about_me: {
            required: true
        }
    },
submitHandler: function(form)
{

    let form_data = new FormData($('#tenant-about-form')[0]);// Creating object of FormData class
    form_data.append("_token", token);
    $.ajax({
        url: url_tenant_post_about,
        data: form_data,
        cache: false,
        contentType: false,
        processData: false,
        type: "POST",
        beforeSend: function()
        {
            $("div#divLoading").addClass('show');
        },
        success: function (res)
        {
            if(res.rc == 1)
            {
                demo.showNotification('top','right', res.rd);
                setTimeout(function()
                {
                    location.reload(true);
                },20);

            }
            else
            {
                demo.showNotification('top','right', res.rd);
            }

        },
        error: function(err)
        {
            demo.showNotification('top','right', "Something went wrong !");
        },
        complete: function(com)
        {
            $("div#divLoading").removeClass('show');
        }
    });
}
});
//Edit tenant about me
function tenAboutEdit()
{
    let form = $('form#tenant-about-form');
    form.find(".form-control").prop('disabled', false);
    form.find('#action-tenant-about-form').text('Cancel');
    form.find("#action-tenant-up-about-form").show();
    form.find('#action-tenant-about-form').removeClass('btn-fill');
    form.find('#action-tenant-about-form').attr('onclick', 'tenAboutEditCan();');
    return true;
}
//Cancel edit about me tenant  form
function tenAboutEditCan()
{
    let form = $('form#tenant-about-form');
    form.find(".form-control").prop('disabled', true);
    form.find("#action-tenant-up-about-form").hide();
    form.find('#action-tenant-about-form').addClass('btn-fill');
    $(form)[0].reset();
    form.find('#action-tenant-about-form').text('Edit');
    form.find('#action-tenant-about-form').attr('onclick', 'tenAboutEdit();');
    return true;

}
//Submit about me tenant form
function tenAboutEditSubForm(){
    let form = $('form#tenant-about-form');
    form.valid();
    form.submit();
    return true;
}
//Upload rental tenant agreement
let assi_ten_id = 0;
//Upload rental agreement
$('table#ten-invnt-ten-table').find('button[class="u-r-a-ten-p btn btn-info"]').on('click', function(event){
assi_ten_id = $(this).data('idd');
$('#upload-ten-rental-agrmnt').modal();
});
//Upload rental agreement form
$("#oat-rental-ten-agrmnt-up").validate({
    rules: {
        oat_rental_agrmnt: {
            required: true,
            extension: "pdf"
        }
    },
    messages: 
    {
        oat_rental_agrmnt: {
            required: "Please select a file.",
            extension: "Please select PDF file only."
        }
    },
submitHandler: function(form)
{
    if(assi_ten_id > 0)
    {
    let form_data = new FormData($('#oat-rental-ten-agrmnt-up')[0]);// Creating object of FormData class
    form_data.append("oat_ten_id", assi_ten_id);
    form_data.append("_token", token);
    $.ajax({
        url: url_renatl_upload,
        data: form_data,
        cache: false,
        contentType: false,
        processData: false,
        type: "POST",
        beforeSend: function()
        {
            $("div#divLoading").addClass('show');
        },
        success: function (res)
        {
            if(res.rc == 1)
            {
                demo.showNotification('top','right', res.rd);
                setTimeout(function()
                {
                    location.reload(true);
                },20);

            }
            else
            {
                demo.showNotification('top','right', res.rd);
            }

        },
        error: function(err)
        {
            demo.showNotification('top','right', "Something went wrong !");
        },
        complete: function(com)
        {
            $("div#divLoading").removeClass('show');
        }
    });
    }
    else
    {
        location.reload();
    }
}
});
//Redirect to payment method
$("#payment-options-form").validate({
    errorClass: 'invalid',
    validClass: 'success',
    rules: {
        pay_option: {
            required: true
        }
    },
    messages: 
    {
        pay_option: {
            required: "Please select a payment method."
        }
    },
    errorPlacement: function(error, element) {
    if (element.attr("name") == "pay_option")
    error.insertAfter("#err_pay_options");
    else
       error.insertAfter(element);

  },
submitHandler: function(form)
{
    //Show Loading
    //$("div#divLoading").addClass('show');
    let form_data = new FormData($('#payment-options-form')[0]);
    let pay_val = 0;
    if(form_data.has('pay_option'))
    {
        pay_val = form_data.get('pay_option');
        if(pay_val == 1)
        {
            window.location.href = url_payment+"?method="+pay_val;
        }
        else if(pay_val == 2)
        {
            window.location.href = url_payment+"?method="+pay_val;
        }
        else if(pay_val == 3)
        {
            window.location.href = url_payment+"?method="+pay_val;
        }
        else if(pay_val == 4)
        {
            window.location.href = url_payment+"?method="+pay_val;
        }
        else
        {
            location.reload();
        }
    }
    else
    {
        //$("div#divLoading").removeClass('show');
        location.reload();
    }
}
});
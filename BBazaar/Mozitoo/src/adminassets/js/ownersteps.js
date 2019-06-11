(function($) {
  "use strict";

  var form = $("#submit_property_form");

  form.steps({
      headerTag: "h4.form_heading",
      bodyTag: "fieldset",
      transitionEffect: "fade",
      stepsOrientation: $.fn.steps.stepsOrientation.vertical,
      labels: {
          cancel: "Cancel",
          current: "current step:",
          pagination: "Pagination",
          finish: "Submit",
          next: "Next Step",
          previous: "Previous",
          loading: "Loading ..."
      },
      onStepChanging: function (event, currentIndex, newIndex)
      {
          // Allways allow previous action even if the current form is not valid!
          if (currentIndex > newIndex)
          {
              return true;
          }
          // Needed in some cases if the user went back (clean up)
          if (currentIndex < newIndex)
          {
              // To remove error styles
              form.find(".body:eq(" + newIndex + ") label.error").remove();
              form.find(".body:eq(" + newIndex + ") .error").removeClass("error");
          }
          form.validate().settings.ignore = ":disabled,:hidden";
          return form.valid();
      },
      onStepChanged: function (event, currentIndex, priorIndex)
      {
      },
      onFinishing: function (event, currentIndex)
      {
          form.validate().settings.ignore = ":disabled";
          return form.valid();
      },
      onFinished: function (event, currentIndex)
      {
          //Get all form data
          var form_data = new FormData($('#submit_property_form')[0]);// Creating object of FormData class
         
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
                url: url_owner_sub_form,
                data: form_data,   // Setting the data attribute of ajax with form data
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
                          window.location.replace(url_get_pend_prop)
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
  }).validate({
      errorPlacement: function errorPlacement(error, element) { element.before(error); },
      ignore: ".ignore",
      rules: {
          inputTenant:
          {
            required: true
          },
          property_title:
          {
            required: true
          },
          property_desc:
          {
            required: true
          },
          property_type:
          {
            required: true
          },
          property_furnishing_status:
          {
            required: true
          },
          property_age:
          {
            required: true,
            number: true
          },
          property_area:
          {
            required: true,
            number: true
          },
          property_bhk:{
              required: true
          },
          'rental_type[]':
          {
            required: true
          },
          property_furnishing_age:
          {
            required: true,
            number: true
          },
          addressline1:
          {
            required: true
          },
          inputLat:
          {
            required: true,
            min: 1
          },
          inputLocality:
          {
            required: true
          },
          inputCity:
          {
            required: true
          },
          inputPincode:
          {
            required: true,
            number: true
          },
          inputState:
          {
            required: true
          }

      }
  })
})(jQuery)

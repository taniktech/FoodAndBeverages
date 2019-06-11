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
          var property_amenties = $('.amenityBoxes:checked').map(function() {
                       return this.value;
                       }).get().join(',');
         if(!property_amenties)
         {
           property_amenties = 0;
         }
         /*New User Info */
          var new_user_name = $('input#new_user_name').val();
          var new_user_pwd = $('input#new_user_pwd').val();
          var new_user_email = $('input#new_user_email').val();
          var new_user_mobile = $('input#new_user_mobile').val();
          var inputManager = $('select#inputManager').val();
          var user_email = $('input#user_email').val();
          var user_password = $('input#user_password').val();
          var inputManagerLogin = $('select#inputManagerLogin').val();
           /*New User Info ends*/
           /* Property info */
          var inputTenant = $('select#inputTenant').val();
          var property_title = $('input#property_title').val();
          var property_desc = $('textarea#property_desc').val();
          var property_type = $('select#property_type').val();
          var property_rent = $('input#property_rent').val();
          var property_beds = $('input#property_beds').val();
          var property_baths = $('input#property_baths').val();
          var property_area = $('input#property_area').val();
          var property_age = $('input#property_age').val();
          var property_furnishing_status = $('select#property_furnishing_status').val();
          var property_furnishing_age = $('input#property_furnishing_age').val();
           /* Property info ends */
           /* Property address */
          var addressline1 = $('input#addressline1').val();
          var inputLocality = $('input#inputLocality').val();
          var inputCity = $('input#inputCity').val();
          var inputPincode = $('input#inputPincode').val();
          var inputState = $('input#inputState').val();
          var inputLat = $('input#inputLat').val();
          var inputLng = $('input#inputLng').val();
          /* Property address ends*/
          /*Property pic */
          var add_photo_gallery = $("#add_photo_gallery").prop("files")[0];   // Getting the properties of file from file field
          /* Property address ends*/
          if(!inputLat)
          {
            inputLat = 12.9716;
            inputLng = 77.5946;
          }
          if(!property_furnishing_age)
          {
            property_furnishing_age = 0;
          }
          /*User Type */
          var user_type = $('input#user_type_val').val();

          var form_data = new FormData();// Creating object of FormData class
          form_data.append("inputTenant", inputTenant);// Adding extra parameters to form_data
          form_data.append("property_title", property_title);
          form_data.append("property_desc", property_desc);
          form_data.append("property_type", property_type);
          form_data.append("property_rent", property_rent);
          form_data.append("property_beds", property_beds);
          form_data.append("property_baths", property_baths);
          form_data.append("property_area", property_area);
          form_data.append("property_age", property_age);
          form_data.append("property_furnishing_status", property_furnishing_status);
          form_data.append("property_furnishing_age", property_furnishing_age);
          form_data.append("addressline1", addressline1);
          form_data.append("inputLocality", inputLocality);
          form_data.append("inputCity", inputCity);
          form_data.append("inputPincode", inputPincode);
          form_data.append("inputState", inputState);
          form_data.append("inputLat", inputLat);
          form_data.append("inputLng", inputLng);
          form_data.append("property_amenties", property_amenties);
          form_data.append("add_photo_gallery", add_photo_gallery);// Appending parameter named add_photo_gallery with properties of file_field to form_data
          form_data.append("property_amenties", property_amenties);
          form_data.append("new_user_name", new_user_name);
          form_data.append("new_user_pwd", new_user_pwd);
          form_data.append("new_user_email", new_user_email);
          form_data.append("new_user_mobile", new_user_mobile);
          form_data.append("inputManager", inputManager);
          form_data.append("_token", token);
                if(user_type == 1)
                {
                  $.ajax({
                        url: adminsubmitnewform,
                        data: form_data,   // Setting the data attribute of ajax with file_data
                        cache: false,
                        contentType: false,
                        processData: false,
                        type: "POST",
                        beforeSend: function()
                        {
                            $("body").css("opacity", 0.2);
                            console.log("Done");
                          // $("[href='#finish']").hide();
                          // $("[href='#previous']").hide();
                          // $("[href='#previous']").after('<button type="button" class="btn btn-success btn-lg" disabled>Loading</button>');
                        },
                        success: function (res)
                        {
                          $("body").removeAttr('style');
                          if(res.rc == 2)
                          {
                            $("input#new_user_email").removeAttr('style');
                            $('input#new_user_email').focus().css({'border-color':'#f44','box-shadow':'0 0 8px #f44'});
                            $("#new_user_email_err").empty();
                            $("#new_user_email_err").html(res.rd);
                            $(":input").bind("keyup change", function(e) {
                              $("input#new_user_email").removeAttr('style');
                              $("#new_user_email_err").empty();
                            });

                          }
                          else if(res.rc == 3)
                            {
                              $("input#new_user_mobile").removeAttr('style');
                              $('input#new_user_mobile').focus().css({'border-color':'#f44','box-shadow':'0 0 8px #f44'});
                              $("#new_user_mobile_err").empty();
                              $("#new_user_mobile_err").html(res.rd);
                              $(":input").bind("keyup change", function(e) {
                                $("input#new_user_mobile").removeAttr('style');
                                $("#new_user_mobile_err").empty();
                              });
                            }
                            else if(res.rc == 1){
                              $('.new_user_form').parent().prepend("<div class='alert alert-success'>"+res.rd+"</div>");
                              window.location = 'allproperties';
                            }
                            else {
                              alert("Something went wrong");
                            }
                        }
                      });
                  }
                  else if(user_type == 2){
                    form_data.append("user_email", user_email);
                    form_data.append("user_password", user_password);
                    form_data.append("inputManager", inputManagerLogin);
                    form_data.append("_token", token);
                    $.ajax({
                          url: adminsubmitnewformone,
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
                            if(res.rc == 2)
                            {
                              $("input#user_email").removeAttr('style');
                              $('input#user_email').focus().css({'border-color':'#f44','box-shadow':'0 0 8px #f44'});
                              $("#user_email_err").empty();
                              $("#user_email_err").html(res.rd);
                              $(":input").bind("keyup change", function(e) {
                                $("input#user_email").removeAttr('style');
                                $("#user_email_err").empty();
                              });

                            }
                              else if(res.rc == 1){
                                $('.existing_user_form').parent().prepend("<div class='alert alert-success'>"+res.rd+"</div>");
                                window.location = 'allproperties';
                              }
                              else {
                                alert("Something went wrong");
                              }
                          }
                        });
                  }
                  else {
                    alert("Something went wrong.");
                  }
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
            property_baths:
            {
              required: true,
              number: true
            },
            property_beds:
            {
              required: true,
              number: true
            },
            property_rent:
            {
              required: true,
              number: true
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
            },
            new_user_name: {
              required: "#user_type:unchecked"

            },
            new_user_email: {
              required: "#user_type:unchecked",
              email: true
            },
            new_user_mobile: {
              required: "#user_type:unchecked"
            },
            new_user_pwd: {
              required: "#user_type:unchecked"
            },
            inputManager: {
              required: "#user_type:unchecked"
            },
            inputManagerLogin: {
              required: "#user_type:checked"
            },
            user_password: {
              required: "#user_type:checked"
            },
            user_email: {
              required: "#user_type:checked",
              email: true
            }

        }
    })
})(jQuery)

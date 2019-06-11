// Function for atleast one digit
 $.validator.addMethod("specialNum",function(value,element){
      return this.optional(element) || /\d/g.test( value );
  },"Password must contain at least one number.");

// Function for atleast one special char
 $.validator.addMethod("specialChar",function(value,element){
      return this.optional(element) || /[*@!#%&()^~{}]+/.test( value );
  },"Password must contain at least one special character.");

 // Function for atleast one special char
 $.validator.addMethod("specialAlpha",function(value,element){
      return this.optional(element) || /[a-z]+/g.test( value );
  },"Password must contain at least one alphabet.");

/* New Admin-form-data validation*/
$("#adminregistrationform").validate({
    rules: {
      inputName: {
          required: true,maxlength: 30
      }
      ,
      inputEmail: {
          required: true, email: true
      }
      ,
        inputMobile: {
            required: true,
            number: true,
            minlength: 10,
            maxlength: 10
        }
        , inputPassword: {
            required: true,
            specialAlpha: true,
            specialNum: true,
            specialChar: true,
            minlength: 5,
            maxlength: 10
        }
    }
    , messages: {
      inputName: {
          required: "Please Enter your name",
          maxlength: "Your name must be 30 characters long"
      }
      ,
      inputEmail: {
        required: "Please Enter your Email",
        email: "Please enter a valid email address"
      }
      ,
        inputMobile: {
            required: "Please Enter your mobile number",
            minlength: "Please enter a valid mobile number",
            maxlength: "Please enter a valid mobile number",
            number: "Please enter a valid mobile number"
        }
        , inputPassword: {
          required: "Please Enter your password",
          minlength: "Your password must be at least 5 characters long",
          maxlength: "Password can be 10 characters long"
        }
    },
submitHandler: function(form)
{
  var name = $('input#inputName').val();
  var email = $('input#inputEmail').val();
  var mobile = $('input#inputMobile').val();
  var password = $('input#inputPassword').val();
  var token = "newAdReg";
    $.ajax({
        method: 'POST',
        url: 'process',
        data: {name: name, email: email, mobile: mobile, password:password,_token: token},
        beforeSend: function()
        {
            console.log("Done");
        },
        success: function (data)
        {
          var res = jQuery.parseJSON(data);
          if(res.rc == 2)
          {

            $("input#inputEmail").removeAttr('style');
            $('input#inputEmail').focus().css({'border-color':'#f44','box-shadow':'0 0 8px #f44'});          
            $("#input_email_err").remove();
            $('input#inputEmail').after('<label id="input_email_err" for="inputEmail">'+res.rd+'</label>');
            $(":input").bind("keyup change", function(e) {
              $("input#inputEmail").removeAttr('style');
              $("#input_email_err").remove();
            });

          }
          else if(res.rc == 3)
            {

              $("input#inputMobile").removeAttr('style');
              $('input#inputMobile').focus().css({'border-color':'#f44','box-shadow':'0 0 8px #f44'});             
              $("#input_mobile_err").remove();
              $('input#inputMobile').after('<label id="input_mobile_err" for="inputMobile">'+res.rd+'</label>');
              $(":input").bind("keyup change", function(e) {
                $("input#inputMobile").removeAttr('style');    
                $("#input_mobile_err").remove();
              });

            }
            else if(res.rc == 1)
            {
              $('#adminregistrationform').parent().prepend("<div class='alert alert-success'>"+res.rd+"</div>");
                $.ajax({
                type: "POST",
                url: "session",
                data:{sesadminid:res.uid, sesname:res.name, adminid:res.user_type_id}, 
                success: function(data)
                {
                  window.location = 'admindashboard';
                
                }
                });   
              
              
            }
        else {
          alert("Something went wrong");
        }
        }
      });
    }
});
/* Newcustomer-form-data validation*/
$("#registrationform").validate({
    rules: {
      inputName: {
          required: true,maxlength: 30
      }
      ,
      inputEmail: {
          required: true, email: true
      }
      ,
        inputMobile: {
            required: true,
            number: true,
            minlength: 10,
            maxlength: 10
        }
        , inputPassword: {
            required: true,
            specialAlpha: true,
            specialNum: true,
            specialChar: true,
            minlength: 5,
            maxlength: 10
        }
    }
    , messages: {
      inputName: {
          required: "Please Enter your name",
          maxlength: "Your name can be 30 characters long"
      }
      ,
      inputEmail: {
        required: "Please Enter your Email",
        email: "Please enter a valid email address"
      }
      ,
        inputMobile: {
            required: "Please Enter your mobile number",
            minlength: "Please enter a valid mobile number",
            maxlength: "Please enter a valid mobile number",
            number: "Please enter a valid mobile number"
        }
        , inputPassword: {
          required: "Please Enter your password",
          minlength: "Your password must be at least 5 characters long",
          maxlength: "Password can be 10 characters long"
        }
    },
submitHandler: function(form)
{
  var name = $('input#inputName').val();
  var email = $('input#inputEmail').val();
  var mobile = $('input#inputMobile').val();
  var password = $('input#inputPassword').val();
  var token = "newReg";
    $.ajax({
        method: 'POST',
        url: 'process',
        data: {name: name, email: email, mobile: mobile, password:password,_token: token},
        beforeSend: function()
        {
            console.log("Done");
        },
        success: function (data)
        {
          var res = jQuery.parseJSON(data);
          console.log(res);
          if(res.rc == 2)
          {

            $("input#inputEmail").removeAttr('style');
            $('input#inputEmail').focus().css({'border-color':'#f44','box-shadow':'0 0 8px #f44'});          
            $("#input_email_err").remove();
            $('input#inputEmail').after('<label id="input_email_err" for="inputEmail">'+res.rd+'</label>');
            $(":input").bind("keyup change", function(e) {
              $("input#inputEmail").removeAttr('style');
              $("#input_email_err").remove();
            });

          }
          else if(res.rc == 3)
            {

              $("input#inputMobile").removeAttr('style');
              $('input#inputMobile').focus().css({'border-color':'#f44','box-shadow':'0 0 8px #f44'});             
              $("#input_mobile_err").remove();
              $('input#inputMobile').after('<label id="input_mobile_err" for="inputMobile">'+res.rd+'</label>');
              $(":input").bind("keyup change", function(e) {
                $("input#inputMobile").removeAttr('style');    
                $("#input_mobile_err").remove();
              });

            }
            else if(res.rc == 1)
            {
              $('#registrationform').parent().prepend("<div class='alert alert-success'>"+res.rd+"</div>");
              $.ajax({
                type: "POST",
                url: "session",
                data:{sesid:res.uid, sesname:res.name}, 
                success: function(data)
                {
                  location.reload();
                
                }
              });    
              
              
            }
        else {
          alert("Something went wrong");
        }
        }
      });
    }
});
/*Admin login-form-data validation*/

$("#adminloginform").validate({
    rules: {
        loginEmail: {
            required: true, email: true
        }
        , loginPassword: {
            required: true,
            specialAlpha: true,
            specialNum: true,
            specialChar: true,
            minlength: 5,
            maxlength: 10
        }
    }
    , messages: {
      loginEmail: {
          required: "Please Enter your Email",
          email: "Please enter a valid email address."
      },
        loginPassword: {
          required: "Please Enter your password",
          minlength: "Your password must be at least 5 characters long",
          maxlength: "Password can be 10 characters long"
        }
    },
submitHandler: function(form)
{
  var email = $('input#loginEmail').val();
  var password = $('input#loginPassword').val();
  var token = "adLog";
    $.ajax({
        method: 'POST',
        url: 'process',
        data: {email: email, password:password,_token: token},
        beforeSend: function()
        {
            console.log("Done");
        },
        success: function (data)
        {
          var res = jQuery.parseJSON(data);
          if(res.rc == 2)
          {
            $("input#loginEmail").removeAttr('style');
            $('input#loginEmail').focus().css({'border-color':'#f44','box-shadow':'0 0 8px #f44'});        
            $("#user_email_err").remove();
            $('input#loginEmail').after('<label for="loginEmail" id="user_email_err">'+res.rd+'</label>');
            $(":input").bind("keyup change", function(e) {
              $("input#loginEmail").removeAttr('style');
              $("#user_email_err").remove();
            });
          }
          else if(res.rc == 3)
            {
              $("input#loginPassword").removeAttr('style');
              $('input#loginPassword').focus().css({'border-color':'#f44','box-shadow':'0 0 8px #f44'});
              $("#user_pwd_err").remove();
              $('input#loginPassword').after('<label for="loginPassword" id="user_pwd_err">'+res.rd+'</label>');
              $(":input").bind("keyup change", function(e) {
                $("input#loginPassword").removeAttr('style');
                $("#user_pwd_err").remove();
              });
            }
            else if(res.rc == 1)
            {
                console.log(res);
                $('#adminloginform').parent().prepend("<div class='alert alert-success'>"+res.rd+"</div>");
                $.ajax({
                type: "POST",
                url: "session",
                data:{sesadminid:res.uid, sesname:res.name, adminid:res.user_type_id}, 
                success: function(data)
                {
                  window.location = 'admindashboard';
                
                }
                });    
            }
        else {
        console.log(res);
        }
        }
      });
    }
});

/* login-form-data validation*/

$("#loginform").validate({
    rules: {
        loginEmail: {
            required: true, email: true
        }
        , loginPassword: {
            required: true,
            specialAlpha: true,
            specialNum: true,
            specialChar: true,
            minlength: 5,
            maxlength: 10

        }
    }
    , messages: {
      loginEmail: {
          required: "Please Enter your Email",
          email: "Please enter a valid email address."
      },
        loginPassword: {
          required: "Please Enter your password",
          minlength: "Your password must be at least 5 characters long",
          maxlength: "Password can be 10 characters long"
        }
    },
submitHandler: function(form)
{
  var email = $('input#loginEmail').val();
  var password = $('input#loginPassword').val();
  var token = "log";
    $.ajax({
        method: 'POST',
        url: 'process',
        data: {email: email, password:password,_token: token},
        beforeSend: function()
        {
            console.log("Done");
        },
        success: function (data)
        {

          var res = jQuery.parseJSON(data);
          if(res.rc == 2)
          {
            $("input#loginEmail").removeAttr('style');
            $('input#loginEmail').focus().css({'border-color':'#f44','box-shadow':'0 0 8px #f44'});        
            $("#user_email_err").remove();
            $('input#loginEmail').after('<label for="loginEmail" id="user_email_err">'+res.rd+'</label>');
            $(":input").bind("keyup change", function(e) {
              $("input#loginEmail").removeAttr('style');
              $("#user_email_err").remove();
            });
          }
          else if(res.rc == 3)
            {
              $("input#loginPassword").removeAttr('style');
              $('input#loginPassword').focus().css({'border-color':'#f44','box-shadow':'0 0 8px #f44'});
              $("#user_pwd_err").remove();
              $('input#loginPassword').after('<label for="loginPassword" id="user_pwd_err">'+res.rd+'</label>');
              $(":input").bind("keyup change", function(e) {
                $("input#loginPassword").removeAttr('style');
                $("#user_pwd_err").remove();
              });
            }
            else if(res.rc == 1)
            {
                console.log(res);
                $('#loginform').parent().prepend("<div class='alert alert-success'>"+res.rd+"</div>");
                $.ajax({
                type: "POST",
                url: "session",
                data:{sesid:res.uid, sesname:res.name}, 
                success: function(data)
                {
                  location.reload();
                
                }
                });    
            }
        else {
        console.log(res);
        }
        }
      });
    }
});
//Forgot Password
$("#forgotform").validate({
    rules: {
        resetMobile: {
            required: true,
            number: true,
            minlength: 10,
            maxlength: 10
        }
    }
    , messages: {
      resetMobile: {
          required: "Please Enter your mobile number",
          minlength: "Please enter a valid mobile number",
          maxlength: "Please enter a valid mobile number",
          number: "Please enter a valid mobile number"
      }
    },
submitHandler: function(form)
{
  var mobile = $('input#resetMobile').val();
  var token = "fPwdUser";

    $.ajax({
        method: 'POST',
        url: 'process',
        data: {mobile: mobile, _token: token},
        beforeSend: function()
        {
          $("#doForgetPwdBtn").prop('disabled', true);
        },
        success: function (data)
        {
            var res = jQuery.parseJSON(data);
            if(res.rc == 2)
            {

              $("input#resetMobile").removeAttr('style');
              $('input#resetMobile').focus().css({'border-color':'#f44','box-shadow':'0 0 8px #f44'});             
              $("#reset_mobile_err").remove();
              $('input#resetMobile').after('<label id="reset_mobile_err" for="resetMobile">'+res.rd+'</label>');
              $(":input").bind("keyup change", function(e) {
                $("input#resetMobile").removeAttr('style');    
                $("#reset_mobile_err").remove();
              });
              $("#doForgetPwdBtn").removeAttr('disabled');
            }
            else if(res.rc == 1)
            {
              $('#forgotbox').css('display','none');
              $('#otpbox').css('display','block');
              $("#doForgetPwdBtn").removeAttr('disabled');
              $("#olds").val(res.m);
            }
            else
            {
              location.reload();
            }
        }
      });
}
});
//Update Password using OTP
$("#updatePwdForm").validate({
    rules: {
        verCode: {
            required: true
        }, 
        newPwd: {
            required: true,
            specialAlpha: true,
            specialNum: true,
            specialChar: true,
            minlength: 5,
            maxlength: 10
        },
         rePwd: {
          equalTo: "#newPwd"
        }
    }
    , messages: {
      verCode: {
          required: "Please Enter OTP"
      },
        newPwd: {
          required: "Please Enter your password",
          minlength: "Your password must be at least 5 characters long",
          maxlength: "Password can be 10 characters long"
        },
      rePwd: {
        equalTo: "Password must be same",
      }
    },
submitHandler: function(form)
{
  var mobile = $('input#olds').val();
  var otp = $('input#verCode').val();
  var newPwd = $('input#newPwd').val();
  var token = "verifyOtpFpwd";

    $.ajax({
        method: 'POST',
        url: 'process',
        data: {mobile: mobile, otp: otp, newPwd: newPwd, _token: token},
        beforeSend: function()
        {
          //$("#doUpdatePwdBtn").prop('disabled', true);
            console.log("Done");
        },
        success: function (data)
        {
          console.log(data);
          var res = jQuery.parseJSON(data);
            if(res.rc == 2)
            {

              $("input#verCode").removeAttr('style');
              $('input#verCode').focus().css({'border-color':'#f44','box-shadow':'0 0 8px #f44'});             
              $("#verCode_err").remove();
              $('input#verCode').after('<label id="verCode_err" for="verCode">'+res.rd+'</label>');
              $(":input").bind("keyup change", function(e) {
                $("input#verCode").removeAttr('style');    
                $("#verCode_err").remove();
              });
              $("#doUpdatePwdBtn").removeAttr('disabled');
            }
            else if(res.rc == 1)
            {

                $('#updatePwdForm').parent().prepend("<div class='alert alert-success'>"+res.rd+"</div>");
                $.ajax({
                type: "POST",
                url: "session",
                data:{sesid:res.uid, sesname:res.name}, 
                success: function(data)
                {
                  location.reload();
                
                }
                });    
            }
            else
            {
              location.reload();
            }
          
        }
      });
}
});
//Adding to cart when not logged in or logged in
    $("#goToLogBtnID").click(function() {

      var isValid = $("#indexOrderForm").valid();

      if(isValid == true)
      {
        
        console.log(outletSelect);
        $('#loginModal').modal('show');

       
      }

    }); 
/* Add to cart*/
$("#indexOrderForm").validate({
    rules: {
      outletSelect: {
          required: true
      }
      ,
      menuSelect: {
          required: true
      },
      qtySelect: {
          required: true
      }
    }
    , messages: {
      outletSelect: {
          required: "Please select nearest outlet"
      }
      ,
      menuSelect: {
        required: "Please select one menu item"
      },
      qtySelect: {
        required: "Please select quantity"
      }
    },
submitHandler: function(form)
{

  var formValues = $("#indexOrderForm").serialize();
  $.ajax({
      method: 'POST',
      url: 'process', 
      data: formValues,
      success: function (data) 
            {

              var res = jQuery.parseJSON(data);
                $.ajax({
                type: "POST",
                url: "session",
                data:{mo_id:res.ts_cart_id, quantity:1}, 
                success: function(data)
                {

                 window.location = 'cart';
                
                }
                });  
            }
        }); 
}
});
/* Remove from cart*/
$('.remove').on('click', function(event){

var moid=$(this).data("moid");
var token = 'removeItem'
  $.ajax({
          method: 'POST',
          url: 'process',
          data: {moid: moid, _token: token},
          beforeSend: function()
          {
              console.log("Done");
          },
          success: function (data)
          {
            var res = jQuery.parseJSON(data);
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
              $.ajax({
                type: "POST",
                url: "session",
                data:{remove_mo_id:res.rd}, 
                success: function(data)
                {

                  // console.log(data);
                 location.reload();
                
                }
                });  
              

            }
            else {
              alert("Something went wrong");
              location.reload();
            }
          }
      });


});
//Selecting Biryani Quantuty
    // This button will increment the value
    $('.qtyplus').click(function(e){
        
        $(".qtyplus").prop('disabled', true);
        $(".qtyminus").prop('disabled', true);
        
        // Stop acting like a button
        e.preventDefault(); 
        $("body").css("opacity", 0.2);
        //Get the current Flag
        var currentPlusFlag=$(this).data("goidp");

        //Get the Item ID
        var currentItemID=$(this).data("gomoidp");

        // Get the field name
        fieldName = $(this).attr('field');

        //Get the Price for the current item
        currentPrice = parseFloat($("#test_menu_price_id"+currentPlusFlag).val());

        //Get the Total Price of the cart
        totalCartPrice = parseFloat($("#total_sum_value").text());

        //Get the Total Payble amount of the cart
        totalPaybleAmount = parseFloat($("#finalPaybleMoney").text());
        // Get its current value
        var currentVal = parseInt($('input[name='+fieldName+']').val());

        // If is not undefined
        if (!isNaN(currentVal) && !isNaN(currentPrice)) {
           $.ajax({
                type: "POST",
                url: "session",
                data:{up_mo_id:currentItemID, up_quantity:currentVal + 1}, 
                success: function(data)
                {

                 // Increment
                $('input[name='+fieldName+']').val(currentVal + 1);

                //Increase total value for this item   
                $("#thisItemTotal"+currentPlusFlag).text(currentPrice*(currentVal+1));

                //Increase total value of the cart   
                $("#total_sum_value").text(totalCartPrice + currentPrice);

                //Increase payble amount
                $("#finalPaybleMoney").text(totalPaybleAmount + currentPrice);

                $(".qtyplus").removeAttr('disabled');
                $(".qtyminus").removeAttr('disabled');
                $("body").removeAttr('style'); 
                }
                });  
            

        } else {
            // Otherwise put a 1 there
            $('input[name='+fieldName+']').val(1);

            //Reset total value for this item to intial price
            $("#thisItemTotal"+currentPlusFlag).text(currentPrice);
        }

    });
    // This button will decrement the value till 0
    $(".qtyminus").click(function(e) {

        $(".qtyminus").prop('disabled', true);
        $(".qtyplus").prop('disabled', true);
        // Stop acting like a button
        e.preventDefault();
        $("body").css("opacity", 0.2);
        //Get the current Flag
        var currentMinusFlag=$(this).data("goidm");

        //Get the Item ID
        var currentItemID=$(this).data("gomoidm");

        // Get the field name
        fieldName = $(this).attr('field');

        //Get the Price for the current item
        currentPrice = parseFloat($("#test_menu_price_id"+currentMinusFlag).val());

        //Get the Total Price of the cart
        totalCartPrice = parseFloat($("#total_sum_value").text());

         //Get the Total Payble amount of the cart
        totalPaybleAmount = parseFloat($("#finalPaybleMoney").text());

        // Get its current value
        var currentVal = parseInt($('input[name='+fieldName+']').val());
        // If it isn't undefined or its greater than 0
        if (!isNaN(currentVal) && !isNaN(currentPrice) && currentVal > 1) {

            $.ajax({
                type: "POST",
                url: "session",
                data:{up_mo_id:currentItemID, up_quantity:currentVal - 1}, 
                success: function(data)
                {

                // Decrement one
                $('input[name='+fieldName+']').val(currentVal - 1);

                //Reduce total value for this item   
                $("#thisItemTotal"+currentMinusFlag).text(currentPrice*(currentVal-1));

                //Reduce total value of the cart   
                $("#total_sum_value").text(totalCartPrice - currentPrice);

                //Increase payble amount
                $("#finalPaybleMoney").text(totalPaybleAmount - currentPrice);
                
                $(".qtyminus").removeAttr('disabled');
                $(".qtyplus").removeAttr('disabled');
                $("body").removeAttr('style'); 
                }
                }); 
            

        } else {
            // Otherwise put a 1 there
            $('input[name='+fieldName+']').val(1);

            //Reset total value for this item to intial price
            $("#thisItemTotal"+currentMinusFlag).text(currentPrice);
        }
    });
    //Trigger when there is any chnage in quantiy
   $("#itemQuantity").bind("change paste keyup", function() {
       alert($(this).val()); 
    });
   $("#itemQuantity").change(function() { 
    console.log("j");
    }); 

// Update User profile
$("#userProfileForm").validate({
    rules: {
      inputName: {
          required: true
      }
    },
submitHandler: function(form)
{

  var formValues = $("#userProfileForm").serialize();
  $.ajax({
      method: 'POST',
      url: 'process', 
      data: formValues,
      success: function (data) 
            {
            var res = jQuery.parseJSON(data);
            if(res.rc == 3)
            {
              alert("Something went wrong");
              location.reload();
            }
            else if(res.rc == 2)
            {

              $('#successModal').modal('show');
              $('#reloadSucModal').click(function()
               {
                 location.reload();
               });
            }
            else if(res.rc == 1)
            {
              $('#successModal').modal('show');
              $('#reloadSucModal').click(function()
               {
                 location.reload();
               });
            }
            else
            {
              alert("Something went wrong");
              location.reload();
            }

            }
        }); 
}
});
// Add new address
$("#usersAddNewAddress").validate({
    rules: {
      inputName: {
          required: true
      },
      inputAddress1: {
          required: true
      },
      inputAddress2: {
          required: true
      },
      inputCity: {
          required: true
      },
      inputZip: {
          required: true
      },
      inputMobile: {
          required: true,
          number: true,
          minlength: 10,
          maxlength: 10
      }
    },
submitHandler: function(form)
{

  var formValues = $("#usersAddNewAddress").serialize();
  $.ajax({
      method: 'POST',
      url: 'process', 
      data: formValues,
      success: function (data) 
            {
            console.log(data);
            var res = jQuery.parseJSON(data);
            if(res.rc == 1)
            {
              location.reload();
            }


            }
        }); 
}
});
// Apply coupon code
$("#applyCouponCodeForm").validate({
  ignore: [],
    rules: {
      inputCouponCode: {
          required: true
      }
    },
      messages: {
      inputCouponCode: {
          required: "Please Select one coupon code"
      }
    },
    errorPlacement: function(error, element) {
    if (element.attr("name") == "inputCouponCode")
    error.insertAfter("#coupon_code_err");
    else
       error.insertAfter(element);

  },
submitHandler: function(form)
{

  if($("#inputCouponCode").val() == "loyal50")
  {
  
  var token = "lCheck";
  $.ajax({
      method: 'POST',
      url: 'process', 
      data: {_token: token},
      success: function (data) 
            {

            var res = jQuery.parseJSON(data);
            if(res.rc == 1)
            {
              var coupon_name = res.c_name.toUpperCase();
              var coupon_money = res.c_money; 

                $.ajax({
                type: "POST",
                url: "session",
                data:{ad_c_code:res.ts_coupon_code}, 
                success: function(data)
                {
                  $('.applyCouponDiv').hide();
                  html = $("<div class='alert alert-success' role='alert'>")
                        .append(coupon_name+" Coupon Code Applied <a href='javascript:void(0)' class='alert-link' id='rLinkCCode'>Remove</a>");
                        $(".couponCodeAppliedDiv").append(html);  
                  $("#cAppliedMoney").empty();
                  $("#cAppliedMoney").html(coupon_money);
                  //Get the Total Price of the cart
                  var totalCartPrice = parseFloat($("#total_sum_value").text());
                  var paybleAmount = $("#finalPaybleMoney").text();
                  if (!isNaN(totalCartPrice) && !isNaN(paybleAmount)) 
                  {
                    //Update Payble Amount
                    var reducedPrice = totalCartPrice - coupon_money;
                    $("#finalPaybleMoney").empty();
                    $("#finalPaybleMoney").html(reducedPrice);
                  
                  }
                }
                }); 
              
            }
            else if(res.rc == 2)
            {

            $("input#inputCouponCode").removeAttr('style');
            $('input#inputCouponCode').focus().css({'border-color':'#f44','box-shadow':'0 0 8px #f44'});
            $("#coupon_code_err").empty();
            $("#coupon_code_err").html(res.rd);
            $(":input").bind("keyup change", function(e) {
              $("input#inputCouponCode").removeAttr('style');
              $("#coupon_code_err").empty();
            });

            }
            else
            {
            $("input#inputCouponCode").removeAttr('style');
            $('input#inputCouponCode').focus().css({'border-color':'#f44','box-shadow':'0 0 8px #f44'});
            $("#coupon_code_err").empty();
            $("#coupon_code_err").html("Please Try After Sometime");
            $(":input").bind("keyup change", function(e) {
              $("input#inputCouponCode").removeAttr('style');
              $("#coupon_code_err").empty();
            });

            }

            }
        }); 
  }
  else
  {

  var formValues = $("#applyCouponCodeForm").serialize();
  $.ajax({
      method: 'POST',
      url: 'process', 
      data: formValues,
      success: function (data) 
            {
            console.log(data);
            var res = jQuery.parseJSON(data);
            if(res.rc == 1)
            {
              var coupon_name = res.c_name.toUpperCase();
              var coupon_money = res.c_money; 

                $.ajax({
                type: "POST",
                url: "session",
                data:{ad_c_code:res.ts_coupon_code}, 
                success: function(data)
                {
                  $('.applyCouponDiv').hide();
                  html = $("<div class='alert alert-success' role='alert'>")
                        .append(coupon_name+" Coupon Code Applied <a href='javascript:void(0)' class='alert-link' id='rLinkCCode'>Remove</a>");
                        $(".couponCodeAppliedDiv").append(html);  
                  $("#cAppliedMoney").empty();
                  $("#cAppliedMoney").html(coupon_money);
                  //Get the Total Price of the cart
                  var totalCartPrice = parseFloat($("#total_sum_value").text());
                  var paybleAmount = $("#finalPaybleMoney").text();
                  if (!isNaN(totalCartPrice) && !isNaN(paybleAmount)) 
                  {
                    //Update Payble Amount
                    var reducedPrice = totalCartPrice - coupon_money;
                    $("#finalPaybleMoney").empty();
                    $("#finalPaybleMoney").html(reducedPrice);
                  
                  }
                }
                }); 
              
            }
            else if(res.rc == 2)
            {

            $("input#inputCouponCode").removeAttr('style');
            $('input#inputCouponCode').focus().css({'border-color':'#f44','box-shadow':'0 0 8px #f44'});
            $("#coupon_code_err").empty();
            $("#coupon_code_err").html(res.rd);
            $(":input").bind("keyup change", function(e) {
              $("input#inputCouponCode").removeAttr('style');
              $("#coupon_code_err").empty();
            });

            }
            else
            {
            $("input#inputCouponCode").removeAttr('style');
            $('input#inputCouponCode').focus().css({'border-color':'#f44','box-shadow':'0 0 8px #f44'});
            $("#coupon_code_err").empty();
            $("#coupon_code_err").html("Please Try After Sometime");
            $(":input").bind("keyup change", function(e) {
              $("input#inputCouponCode").removeAttr('style');
              $("#coupon_code_err").empty();
            });

            }

            }
        }); 
  }

}
});

//Remove Coupon code 
$("body").on("click", "#rLinkCCode", function(){
      $.ajax({
        type: "POST",
        url: "session",
        data:{re_c_code:1}, 
        success: function(data)
        {

            $('.couponCodeAppliedDiv').empty();
            $('.applyCouponDiv').show();
            $("#cAppliedMoney").empty();
            $("#cAppliedMoney").html(0);
             //Get the Total Price of the cart
            var totalCartPrice = parseFloat($("#total_sum_value").text());
            var paybleAmount = $("#finalPaybleMoney").text();
            if (!isNaN(totalCartPrice) && !isNaN(paybleAmount)) 
            {
              //Update Payble Amount
              $("#finalPaybleMoney").empty();
              $("#finalPaybleMoney").html(totalCartPrice);
            
            }

        }
        }); 

  });
//Show Sign in Modal
$('#showSigninModal').on('click', function(event){
    $('.signupLink').removeClass('active');
    $('.signupModalTab').removeClass('active show');

    $('.loginLink').addClass('active');
    $('.loginModalTab').addClass('active show');
   
    $('#loginModal').modal('show');
  });
//Show Sign up modal
$('#showSignupModal').on('click', function(event){

    $('.loginLink').removeClass('active');
    $('.loginModalTab').removeClass('active show');

    $('.signupLink').addClass('active');
    $('.signupModalTab').addClass('active show');
   
    $('#loginModal').modal('show');
    


  });
//Open Login Modal
$('a[id="openLoginModal"]').on('click', function(event){
    $('.loginLink').removeClass('active');
    $('.loginModalTab').removeClass('active show');

    $('.signupLink').addClass('active');
    $('.signupModalTab').addClass('active show');
   
    $('#loginModal').modal('show'); 
}); 
//Open Edit Address Modal
$('a[class="openEditAddressModal"]').on('click', function(event){

      // Stop acting like a button
      event.preventDefault();

      //Get the current Flag
      var currentAddressFlag=$(this).data("addid");
      var token = "checkAddForEdit"
      $.ajax({
      method: 'POST',
      url: 'process', 
      data: {addid:currentAddressFlag, _token: token},
      success: function (data) 
            {
            var res = jQuery.parseJSON(data);
            if(res.rc == 1)
            {
              $('#usersEditAddress').find('input[id=addressID]').val(res.rd.ts_address_id);
              $('#usersEditAddress').find('input[id=inputEditName]').val(res.rd.name);
              $('#usersEditAddress').find('input[id=inputEditMobile]').val(res.rd.mobile);
              $('#usersEditAddress').find('input[id=inputEditAddress1]').val(res.rd.address_line_1);
              $('#usersEditAddress').find('input[id=inputEditAddress2]').val(res.rd.address_line_2);
              $('#usersEditAddress').find('input[id=inputEditZip]').val(res.rd.pincode);
              
              $('#editAddressModal').modal('show');
            }
            else if(res.rc == 2)
            {
              location.reload();
              
            }
            else
            {
              location.reload();
            }

            }
        }); 
       
}); 

// Edit address
$("#usersEditAddress").validate({
    rules: {
      inputEditName: {
          required: true
      },
      inputEditAddress1: {
          required: true
      },
      inputEditAddress2: {
          required: true
      },
      inputEditCity: {
          required: true
      },
      inputEditZip: {
          required: true
      },
      inputEditMobile: {
          required: true,
          number: true,
          minlength: 10,
          maxlength: 10
      }
    },
submitHandler: function(form)
{

  var formValues = $("#usersEditAddress").serialize();
  $.ajax({
      method: 'POST',
      url: 'process', 
      data: formValues,
      success: function (data) 
            {

            var res = jQuery.parseJSON(data);
            if(res.rc == 1)
            {
              location.reload();
            }
            else
            {
               location.reload();
            }


            }
        }); 
}
});

//Delete Address
$('#usersEditAddress').find('button[id=deleteAdd]').on('click', function(event){

var addressID = $('#usersEditAddress').find('input[id=addressID]').val();
var token = "deleteUsersAdd";

  $.ajax({
      method: 'POST',
      url: 'process', 
      data: {addressID: addressID, _token: token},
      success: function (data) 
            {

            var res = jQuery.parseJSON(data);
            if(res.rc == 1)
            {
                var reDelAddSess = "reDelAddSess";
                $.ajax({
                method: 'POST',
                url: 'session', 
                data: {reDelAddSess: reDelAddSess, addID: addressID},
                success: function (data) 
                      {
                      console.log(data);
                      location.reload();

                      }
                  }); 
              
            }
            else
            {
               location.reload();
            }


            }
        }); 

}); 

//Load Menu When Outlet is selcted
$("#outletSelect").change(function(){

  var outletID = $('select#outletSelect').val();
  if (!isNaN(outletID) && outletID > 0)
  {
    var token = "loadMenuForOutlet";
    
      $.ajax({
      method: 'POST',
      url: 'process', 
      data: {outletID: outletID, _token: token},
      success: function (data) 
            {

            var res = jQuery.parseJSON(data);
            if(res.rc == 1)
            {

              $("select#menuSelect").empty();
              $("select#menuSelect").append("<option value=''>Select Menu</option>");
               $("select#menuSelect").selectpicker("refresh");
              for (var i = 0; i < res.rd.length; i++)
              { 

                html = $("<option value='"+res.rd[i].menu_id+"'>"+res.rd[i].menu+"</option>");
                $("select#menuSelect").append(html);
                $("select#menuSelect").selectpicker("refresh");
              }

            }
           else if(res.rc == 2)
            {
              $("select#menuSelect").empty();
              $("select#menuSelect").append("<option value=''>Select Menu</option>");
              $("select#menuSelect").selectpicker("refresh");
            }

            }
        }); 

  }
  

}); 
//Load Quantity When Menu is selcted
$("#menuSelect").change(function(){

  var menuID = $('select#menuSelect').val();
  var outletID = $('select#outletSelect').val();
  if (!isNaN(menuID) && menuID > 0)
  {
    var token = "loadQtyForMenu";
    
      $.ajax({
      method: 'POST',
      url: 'process', 
      data: {menuID: menuID, outletID: outletID, _token: token},
      success: function (data) 
            {

            var res = jQuery.parseJSON(data);
            if(res.rc == 1)
            {

              $("select#qtySelect").empty();
              $("select#qtySelect").append("<option value=''>Select Quantity</option>");
              $("#qtySelect").selectpicker("refresh");
              for (var i = 0; i < res.rd.length; i++)
              { 

                html = $("<option value='"+res.rd[i].ts_menu_details_id+"'>"+res.rd[i].qty+"</option>");
                $("select#qtySelect").append(html);
                $("select#qtySelect").selectpicker("refresh");
              }


            }
            else if(res.rc == 2)
              {
                $("select#qtySelect").empty();
                $("select#qtySelect").append("<option value=''>Select Quantity</option>");
                $("select#qtySelect").selectpicker("refresh");
              }
              else
              {
                location.reload();
              }

            }
        }); 

  }
  
});

//Add delivery address to session
$("#selectDelAdd input:radio").click(function() {

  var currentAddID=$(this).val();
      $.ajax({
      method: 'POST',
      url: 'session', 
      data: {delAdd: currentAddID},
      beforeSend: function()
        {
            $("body").css("opacity", 0.2);
        },
      success: function (data) 
        {
          $("body").removeAttr('style');

        }
        }); 
    
});
//Proceed to pay
$('#finalBtnDiv').find('button[id=proceedToPay]').on('click', function(event){
    
      var checkSession = "checkSes";
      $.ajax({
      method: 'POST',
      url: 'session', 
      data: {checkSession: checkSession},
      beforeSend: function()
        {
            $("body").css("opacity", 0.2);
        },
      success: function (data) 
        {
          var res = jQuery.parseJSON(data);
          if(res.rc == 1)
          {
            var createOrder = "creOrder";
            $.ajax({
            method: 'POST',
            url: 'process', 
            data: {_token: createOrder},
            success: function (data) 
              {
                var res = jQuery.parseJSON(data);
                if(res.rc == 1)
                {

                  var ad_fp_oid = "do";
                  var o_id = res.order_id;
                  var fp = res.amount;
                  $.ajax({
                  method: 'POST',
                  url: 'session', 
                  data: {ad_fp_oid: ad_fp_oid, f_p: fp, order_id: o_id},
                  success: function (data) 
                    {
                    var res = jQuery.parseJSON(data);
                    if(res.rc == 1)
                    {
                      var goID = res.rd.order_id;
                      window.location.href = "processTransaction?id="+goID;
                    }
                    else
                    if(res.rc == 2)
                    {
                       location.reload();
                    }
                    else if(res.rc == 3)
                    {
                      alert(res.rd);
                    }
                    else
                     {
                      alert("Something went wrong");
                    }

                    }
                  }); 
                }
                else
                {
                   location.reload();
                }
              }
              }); 
          }
          else if(res.rc == 2)
          {
            $("body").removeAttr('style');
            alert(res.rd);
          }
          else
          {
             location.reload();
          }

        }
        }); 
});
//Cash On delivery
$('#codDiv').find('button[id=codBtn]').on('click', function(event){
  
      $('#codDiv').find('button[id=codBtn]').prop('disabled', true);
      var checkSession = "checkSes";
      $.ajax({
      method: 'POST',
      url: 'session', 
      data: {checkSession: checkSession},
      beforeSend: function()
        {
            $("body").css("opacity", 0.2);
        },
      success: function (data) 
        {

          var res = jQuery.parseJSON(data);
          if(res.rc == 1)
          {
            var token="cOnDel";
              $.ajax({
              method: 'POST',
              url: 'process', 
              data: {_token: token},
              success: function (data) 
                {
                  $("body").removeAttr('style');

                   var res = jQuery.parseJSON(data);
                   if(res.rc == 1)
                    {
                      var oID = res.rd;
                      window.location = 'orderresponse?orderID='+oID;
                
                    }
                    else if(res.rc == 2)
                    {
                      location.reload();
                    }
                    else
                    {
                       location.reload();
                    }
                }
                }); 
            
          }
          else if(res.rc == 2)
          {
            alert(res.rd);
          }
          else
          {
             location.reload();
          }

        }
        }); 
});
// Edit address
$("#subscribeusForm").validate({
    rules: {
      subscribeMobile: {
          required: true,
          number: true,
          minlength: 10,
          maxlength: 10
      }
    }, 
      messages: {
      subscribeMobile: {
          required: "Please Enter your mobile number",
          minlength: "Please enter a valid mobile number",
          maxlength: "Please enter a valid mobile number",
          number: "Please enter a valid mobile number"
      }
    },
submitHandler: function(form)
{

  var formValues = $("#subscribeusForm").serialize();
      $.ajax({
      method: 'POST',
      url: 'process', 
      data: formValues,
      beforeSend: function()
        {
            $("body").css("opacity", 0.2);
        },
      success: function (data) 
        {

          $("body").removeAttr('style');
          var res = jQuery.parseJSON(data);
          if(res.rc == 1)
          {
            $('#subscribeusForm').empty().append('<h4 class="title">'+res.rd+'</h4>');
          }
          else
          {
             location.reload();
          }

        }
        }); 

}
});
// Repeat Order

$(".repeatThisOrder").click(function(e) {

    $(".repeatThisOrder").prop('disabled', true);
      // Stop acting like a button
      e.preventDefault();
     $("body").css("opacity", 0.2);
    //Get the current Order ID
    var rid=$(this).data("rid");
    var token = "reOrder";
      
    $.ajax({
    method: 'POST',
    url: 'process', 
    data: {rid: rid, _token: token},
    success: function (data) 
      {
         var res = jQuery.parseJSON(data);

          if(res.rc == 1)
          {

            $.ajax({
            type: "POST",
            url: "session",
            data:{re_mo_id:res.rd}, 
            success: function(data1)
            {

              var res1 = jQuery.parseJSON(data1);
              if(res1.rc == 1)
              {
                $("body").removeAttr('style');
                window.location = 'cart';

              }
              else
              {
                $("body").removeAttr('style');
                location.reload();
              }
            }
            });  
          }
          else
          {
            location.reload();
          }

      }
      }); 

});
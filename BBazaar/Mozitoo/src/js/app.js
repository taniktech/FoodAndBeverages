/* Newcustomer-form-data validation*/
$("#adminregistrationform").validate({
    rules: {
      inputName: {
          required: true,maxlength: 15
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
            required: true,minlength:5, maxlength: 10
        }
    }
    , messages: {
      inputName: {
          required: "Please Enter your name",
          maxlength: "Your name must be at 15 characters long"
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
          minlength: "Password must be at least 5 characters long",
          maxlength: "Password must not be more than 10 characters long"
        }
    },
submitHandler: function(form)
{
  var name = $('input#inputName').val();
  var email = $('input#inputEmail').val();
  var mobile = $('input#inputMobile').val();
  var password = $('input#inputPassword').val();
    $.ajax({
        method: 'POST',
        url: urlAdminSignUp,
        data: {name: name, email: email, mobile: mobile, password:password,_token: token},
        beforeSend: function()
        {
            console.log("Done");
        },
        success: function (res)
        {
          if(res.rc == 2)
          {

            $("input#inputEmail").removeAttr('style');
            $('input#inputEmail').focus().css({'border-color':'#f44','box-shadow':'0 0 8px #f44'});
            $("#input_email_err").empty();
            $("#input_email_err").html(res.rd);
            $(":input").bind("keyup change", function(e) {
              $("input#inputEmail").removeAttr('style');
              $("#input_email_err").empty();
            });

          }
          else if(res.rc == 3)
            {

              $("input#inputMobile").removeAttr('style');
              $('input#inputMobile').focus().css({'border-color':'#f44','box-shadow':'0 0 8px #f44'});
              $("#input_mobile_err").empty();
              $("#input_mobile_err").html(res.rd);
              $(":input").bind("keyup change", function(e) {
                $("input#inputMobile").removeAttr('style');
                $("#input_mobile_err").empty();
              });

            }
            else if(res.rc == 1)
            {
                window.location = 'admin';
            }
        else {
          alert("Something went wrong");
        }
        }
      });
    }
});
/* Admin-form-data validation*/

$("#adminloginform").validate({
    rules: {
        loginEmail: {
            required: true, email: true
        }
        , loginPassword: {
            required: true, minlength: 5, maxlength: 10
        }
    }
    , messages: {
      loginEmail: {
          required: "Please Enter your Email",
          email: "Please enter a valid email address."
      },
        loginPassword: {
          required: "Please Enter your password",
          minlength: "Password must be at least 5 characters long",
          maxlength: "Password must be at 10 characters long"
        }
    },
submitHandler: function(form)
{
  var email = $('input#loginEmail').val();
  var password = $('input#loginPassword').val();
    $.ajax({
        method: 'POST',
        url: urlAdminSignIn,
        data: {email: email, password:password,_token: token},
        beforeSend: function()
        {
            console.log("Done");
        },
        success: function (res)
        {
          if(res.rc == 2)
          {
            $("input#loginEmail").removeAttr('style');
            $('input#loginEmail').focus().css({'border-color':'#f44','box-shadow':'0 0 8px #f44'});
            $("#user_email_err").empty();
            $("#user_email_err").html(res.rd);
            $(":input").bind("keyup change", function(e) {
              $("input#loginEmail").removeAttr('style');
              $("#user_email_err").empty();
            });
          }
          else if(res.rc == 3)
            {
              $("input#loginPassword").removeAttr('style');
              $('input#loginPassword').focus().css({'border-color':'#f44','box-shadow':'0 0 8px #f44'});
              $("#user_pwd_err").empty();
              $("#user_pwd_err").html(res.rd);
              $(":input").bind("keyup change", function(e) {
                $("input#loginPassword").removeAttr('style');
                $("#user_pwd_err").empty();
              });
            }
            else if(res.rc == 1)
            {
				window.location = 'admin';
			}
			else {
        console.log(res);
        }
        }
      });
    }
});
/* Newcustomer-form-data validation*/
$("#registration-form").validate({
    rules: {
      input_name: {
          required: true,maxlength: 30
      }
      ,
      input_email: {
          required: true, email: true
      }
      ,
      input_mobile: {
            required: true,
            number: true,
            minlength: 10,
            maxlength: 10
        }
        , input_password: {
            required: true,minlength:5, maxlength: 10
        },
        input_terms:
        {
          required: true
        }
    }
    , messages: {
      input_name: {
          required: "Please Enter your name",
          maxlength: "Your name must be at 30 characters long"
      }
      ,
      input_email: {
        required: "Please Enter your Email",
        email: "Please enter a valid email address"
      }
      ,
      input_mobile: {
            required: "Please Enter your mobile number",
            minlength: "Please enter a valid mobile number",
            maxlength: "Please enter a valid mobile number",
            number: "Please enter a valid mobile number"
        }
        , input_password: {
          required: "Please Enter your password",
          minlength: "Password must be at least 5 characters long",
          maxlength: "Password must be at 10 characters long"
        }
    },
submitHandler: function(form)
{
  //Get all form data
  let form_data = new FormData($('#registration-form')[0]);// Creating object of FormData class
  form_data.append("_token", token);
    $.ajax({
        type: "POST",
        url: urlSignUp,
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

          if(res.rc == 2)
          {

            $("input#inputEmail").removeAttr('style');
            $('input#inputEmail').focus().css({'border-color':'#f44','box-shadow':'0 0 8px #f44'});
            $("#input_email_err").empty();
            $("#input_email_err").html(res.rd);
            $(":input").bind("keyup change", function(e) {
              $("input#inputEmail").removeAttr('style');
              $("#input_email_err").empty();
            });

          }
          else if(res.rc == 3)
            {

              $("input#inputMobile").removeAttr('style');
              $('input#inputMobile').focus().css({'border-color':'#f44','box-shadow':'0 0 8px #f44'});
              $("#input_mobile_err").empty();
              $("#input_mobile_err").html(res.rd);
              $(":input").bind("keyup change", function(e) {
                $("input#inputMobile").removeAttr('style');
                $("#input_mobile_err").empty();
              });

            }
            else if(res.rc == 1)
            {
                $('#registration-form').parent().prepend("<div class='alert alert-success'>"+res.rd+"</div>");
                if(res.dashboard == 2)
                {
                  window.location.replace(url_tenant_dashboard);

                }
                else if(res.dashboard == 3)
                {
                  window.location.replace(url_owner_dashboard);
                }
                else {
                  location.reload();
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
});

/* login-form-data validation*/

$("#login-form").validate({
    rules: {
      login_email: {
            required: true, email: true
        }
        , login_password: {
            required: true, minlength: 5, maxlength: 10
        }
    }
    , messages: {
      login_email: {
          required: "Please Enter your Email",
          email: "Please enter a valid email address."
      },
      login_password: {
          required: "Please Enter your password",
          minlength: "Password must be at least 5 characters long",
          maxlength: "Password must be at 10 characters long"
        }
    },
submitHandler: function(form)
{
  //Get all form data
  let form_data = new FormData($('#login-form')[0]);// Creating object of FormData class
  form_data.append("_token", token);
    $.ajax({
        type: "POST",
        url: urlSignIn,
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
          if(res.rc == 2)
          {
            $("input#loginEmail").removeAttr('style');
            $('input#loginEmail').focus().css({'border-color':'#f44','box-shadow':'0 0 8px #f44'});
            $("#user_email_err").empty();
            $("#user_email_err").html(res.rd);
            $(":input").bind("keyup change", function(e) {
              $("input#loginEmail").removeAttr('style');
              $("#user_email_err").empty();
            });
          }
          else if(res.rc == 3)
            {
              $("input#loginPassword").removeAttr('style');
              $('input#loginPassword').focus().css({'border-color':'#f44','box-shadow':'0 0 8px #f44'});
              $("#user_pwd_err").empty();
              $("#user_pwd_err").html(res.rd);
              $(":input").bind("keyup change", function(e) {
                $("input#loginPassword").removeAttr('style');
                $("#user_pwd_err").empty();
              });
            }
            else if(res.rc == 1)
            {

                $('#login-form').parent().prepend("<div class='alert alert-success'>"+res.rd+"</div>");
                if(res.dashboard == 2)
                {
                  window.location.replace(url_tenant_dashboard);

                }
                else if(res.dashboard == 3)
                {
                  window.location.replace(url_owner_dashboard);
                }
                else {
                  location.reload();
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
});
/* Forget-password-form-data validation*/

$("#forgot-pwd-form-user").validate({
    rules: {
        resetEmail: {
            required: true, email: true
        }
    }
    , messages: {
      resetEmail: {
          required: "Please Enter your Email",
          email: "Please enter a valid email address."
      }
    },
submitHandler: function(form)
{
  let form_data = new FormData($('#forgot-pwd-form-user')[0]);// Creating object of FormData class
  form_data.append("_token", token);
    $.ajax({
        url: url_check_forgotpwd,
        data: form_data,
        cache: false,
        contentType: false,
        processData: false,
        type: "POST",
        beforeSend: function()
        {
          $("#doForgetPwdBtn").prop('disabled', true);
        },
        success: function (res)
        {
          if(res.rc == 2)
          {
            $("input#resetEmail").removeAttr('style');
            $('input#resetEmail').focus().css({'border-color':'#f44','box-shadow':'0 0 8px #f44'});
            $("#reset_email_err").empty();
            $("#reset_email_err").html(res.rd);
            $(":input").bind("keyup change", function(e) {
              $("input#resetEmail").removeAttr('style');
              $("#reset_email_err").empty();
            });
            $("#doForgetPwdBtn").removeAttr('disabled');
          }
            else if(res.rc == 1)
            {
                $('#forgot-pwd-form-user').parent().empty().prepend("<div class='alert alert-success'>"+res.rd+"</div>");

            }
        else {
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
});
/*Admin Forget-password-form-data validation*/

$("#adminforgotform").validate({
    rules: {
        resetEmail: {
            required: true, email: true
        }
    }
    , messages: {
      resetEmail: {
          required: "Please Enter your Email",
          email: "Please enter a valid email address."
      }
    },
submitHandler: function(form)
{
  var email = $('input#resetEmail').val();
  var type = 1;

    $.ajax({
        method: 'POST',
        url: urlForgotPwd,
        data: {email: email, userType:type, _token: token},
        beforeSend: function()
        {
          $("#doForgetPwdBtn").prop('disabled', true);
            console.log("Done");
        },
        success: function (res)
        {

          if(res.rc == 2)
          {
            $("input#resetEmail").removeAttr('style');
            $('input#resetEmail').focus().css({'border-color':'#f44','box-shadow':'0 0 8px #f44'});
            $("#reset_email_err").empty();
            $("#reset_email_err").html(res.rd);
            $(":input").bind("keyup change", function(e) {
              $("input#resetEmail").removeAttr('style');
              $("#reset_email_err").empty();
            });
            $("#doForgetPwdBtn").removeAttr('disabled');
          }
            else if(res.rc == 1)
            {
                $('#adminforgotform').parent().empty().prepend("<div class='alert alert-success'>"+res.rd+"</div>");

            }
        else {
        console.log(res);
        }
        }
      });
    }
});
/* Update Password*/

$("#change-user-pwd").validate({
    rules: {
        newPwd: {
          required: true, minlength: 5, maxlength: 10
        },
         rePwd: {
          equalTo: "#newPwd"
        }
    }
    , messages: {
      newPwd: {
        required: "Please Enter your password",
        minlength: "Password must be at least 5 characters long",
        maxlength: "Password must be at 10 characters long"
      },
      rePwd: {
        equalTo: "Password must be same",
      }
    },
submitHandler: function(form)
{
  let form_data = new FormData($('#change-user-pwd')[0]);// Creating object of FormData class
  form_data.append("_token", token);
    $.ajax({
        url: url_change_pwd,
        data: form_data,
        cache: false,
        contentType: false,
        processData: false,
        type: "POST",
        success: function (res)
        {
            if(res.rc == 1)
            {
                $('#change-user-pwd').parent().empty().prepend('<div class="alert alert-success">'+res.rd+' <a data-toggle="modal" href="javascript:void(0)" data-target="#myModal"><i class="fa fa-user"></i> Login to continue</a></div>');
            }
          else {
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
});

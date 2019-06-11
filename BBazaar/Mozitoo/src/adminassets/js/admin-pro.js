$(document).ready(function(){
    // use jQuery correctly with strict
        (function($) {
            "use strict";
            // your code
    
        /*------------------------------
        Currency Filter
        ------------------------------*/
            $('.dropdownFilters .dropdown-menu').find('a').click(function(e) {
                e.preventDefault();
                var param = $(this).attr("href").replace("#","");
                var concept = $(this).find('span').text();
                $('.dropdownFilters span#filterValue').text(concept)
                //$('.input-group #search_param').val(param)
            });
        /*------------------------------
        Go Top
        ------------------------------*/
            $('a[href="#top"]').click(function () {
                $('html, body').animate({ scrollTop: 0 }, 800);
                return false
            });
    
        /*----------------------------------------------------*/
        /*  Phone Number Show
        /*----------------------------------------------------*/
            $('.phone_trigger').on('click', function() {
                $(this).toggleClass('active');
                $(this).parent().parent().find('.phoneNumber').toggleClass('active');
            });
    
        /*----------------------------------------------------*/
        /*  Additional Details
        /*----------------------------------------------------*/
            $('.add_new_field').on('click',function(){
                $('.additional_details').append(
                    '<div class="row m0 alert" role="alert">'+
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'+
                        '<div class="fleft title_box form-group">'+
                            '<label for="">Title</label>'+
                            '<input type="text" class="form-control" name="" id="">'+
                        '</div>'+
                        '<div class="fleft value_box form-group">'+
                            '<label for="">Value</label>'+
                            '<input type="text" class="form-control" name="" id="">'+
                        '</div>'+
                    '</div>'
                )
            });
    
    
        /*----------------------------------------------------*/
        /* User Form Select
        /*----------------------------------------------------*/
            $('input#user_type').on('click',function() {
                if ($(this).is(':checked')) {
                    $('.new_user_form').addClass('hide');
                    $('.new_user_form').removeClass('show');
                    $('.existing_user_form').addClass('show');
                    $('.existing_user_form').removeClass('hide');
                    var oldUser = 2;
                    $("input#user_type_val").val(oldUser);
                } else {
                    $('.new_user_form').addClass('show');
                    $('.new_user_form').removeClass('hide');
                    $('.existing_user_form').addClass('hide');
                    $('.existing_user_form').removeClass('show');
                    var newUser = 1;
                    $("input#user_type_val").val(newUser);
                }
            })
            $('input#input-terms').on('click',function() {
                if ($(this).is(':checked')) {
                    $('button#doSignUp').removeAttr('disabled');
                } else {
                    $('button#doSignUp').prop('disabled', true);
                }
            })
        //Furniture age hide and show
          $('#ageFurn').hide();
          $('#property_furnishing_age').val("0");
          $("#property_furnishing_status").change(function(){
          var fullFurn = $('#property_furnishing_status').val();
          if(fullFurn == 3)
          {
            $('#ageFurn').show();
            $("#property_furnishing_age").attr('name', 'property_furnishing_age');
            
          }
          else {
              $('#ageFurn').hide();
              $('#property_furnishing_age').val("0");
          }
        })
        //Get all the 
        $("body").on('change',"select#rental-type", function(event){
            let level_val_array = new Array();
            let level_txt_array = new Array();
            $.each($("#rental-type option:selected"), function(){
        
                level_val_array.push($(this).val());
                level_txt_array.push($(this).text());
        
            });
            $('.field2').find('div[id=rent-categories]').children().remove();
            if(level_val_array.length > 0 )
            {
                let i;
                for(i=0; i< level_val_array.length; i++)
                {
    
                let html_row = $('<div class="row">')
                             .append($('<div class="col-sm-4">')
                             .append($('<div class="form-group">')
                             .append('<label for="prop-invnt-level['+i+']">Category</label>')
                             .append('<input type="text" id="prop-invnt-level['+i+']" class="form-control" value="'+level_txt_array[i]+'" disabled>')))
                             .append($('<div class="" style="display:none">')
                             .append($('<div class="form-group">')
                             .append('<input type="text" name="prop_invnt_level['+i+']" class="form-control" value="'+level_val_array[i]+'">')))
                             .append($('<div class="col-sm-4">')
                             .append($('<div class="form-group">')
                             .append('<label for="exp-rent['+i+']">Expected Rent</label>')
                             .append('<input type="text" name="exp_rent['+i+']" id="exp-rent['+i+']" class="form-control">')))
                             .append($('<div class="col-sm-4">')
                             .append($('<div class="form-group">')
                             .append('<label for="exp-depo['+i+']">Expected Deposit</label>')
                             .append('<input type="text" name="exp_depo['+i+']" id="exp-depo['+i+']" class="form-control">')));
                             $('.field2').find('div[id=rent-categories]').append(html_row);
                            //Add rule
                             $('input[name="exp_rent['+i+']"]').rules("add",
                             {
                             required: true,
                             number:true,
                             messages : { 
                                     required: "Please Enter expected rent",
                                     number: "Please enter a valid number"
                             }
                             });
                             $('input[name="exp_depo['+i+']"]').rules("add",
                             {
                             required: true,
                             number:true,
                             messages : { 
                                     required: "Please Enter expected deposit",
                                     number: "Please enter a valid number"
                             }
                             });
                           
                }
    
            }
        })
    //Load Cities When States is selcted
    $("#inputState").change(function(){
    
        var inputState = $('select#inputState').val();
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
      
                    $("select#inputCity").empty();
                    $("select#inputCity").append("<option value=''>Select</option>");
                     $("select#inputCity").selectpicker("refresh");
                    for (var i = 0; i < res.rd.length; i++)
                    { 
      
                     let html = $("<option value='"+res.rd[i].name+"'>"+res.rd[i].name+"</option>");
                      $("select#inputCity").append(html);
                      $("select#inputCity").selectpicker("refresh");
                    }
                    $("select#inputCity").append("<option value='Other'>Other</option>");
                    $("select#inputCity").selectpicker("refresh");
                }
                 else if(res.rc == 2)
                  {
                    $("select#inputCity").empty();
                    $("select#inputCity").append("<option value=''>Select</option>");
                    $("select#inputCity").selectpicker("refresh");
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
        
      
      })
        // Bootstrap Datepicker
	$('.datepicker').datepicker({
        format:'d-MM-yyyy',
        startDate: '0d',
        todayHighlight: true,
        autoclose: true
    });
    $('#rental-type').SumoSelect({selectAll:true});

    $('#payment-option-modal').modal('show');
    
        })(jQuery)
    });
    
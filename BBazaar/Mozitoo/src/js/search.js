/* Property search with form*/
// $("#dektopPropSearch").validate({
//   ignore: [],
//   errorClass: 'invalid',
//   validClass: 'success',
//     rules: {
//       inputLat: {
//           required: true,
//           min: 1
//       },
//       inputLng: {
//           required: true,
//           min: 1
//       }
//     },
//     messages: {
//       inputLat: {
//           required: "Please Select location",
//           min: "Please Select location"
//       },
//         inputLng: {
//           required: "Please Select location",
//           min: "Please Select location"
//         }
//     },
//     errorPlacement: function(error, element) {
//     if (element.attr("name") == "inputLat")
//     error.appendTo("#locationNotSelected");
//     else
//        error.insertAfter(element);
//   },
// submitHandler: function(form)
// {
//   var inputLat = $('input#inputLat').val();
//   var inputLng = $('input#inputLng').val();
//
//   if(!inputLat)
//   {
//     inputLat = 12.9716;
//     inputLng = 77.5946;
//   }
//   console.log(inputLat);
//
//   $.ajax({
//         method: 'GET',
//         url: urlSearchProp,
//         data: {inputLat : inputLat, inputLng : inputLng, _token : token},
//         beforeSend: function()
//         {
//             console.log("Done");
//         },
//         success: function (res)
//         {
//           console.log(res);
//
//         }
//         });
// }
// });
//Desktop Search
$("#dektopPropSearch").validate({
  ignore: [],
  errorClass: 'invalid',
  validClass: 'success',
    rules: {
      inputLat: {
          required: true,
          min: 1
      },
      inputLng: {
          required: true,
          min: 1
      }
    },
    messages: {
      inputLat: {
          required: "Please Select location",
          min: "Please Select location"
      },
        inputLng: {
          required: "Please Select location",
          min: "Please Select location"
        }
    },
    errorPlacement: function(error, element) {
    if (element.attr("name") == "inputLat")
    error.appendTo("#locationNotSelected");
    else
       error.insertAfter(element);
  },
submitHandler: function(form)
{
  var inputLocation = $('input#LocationSelect').val();
  var inputLat = $('input#inputLat').val();
  var inputLng = $('input#inputLng').val();

  if(!inputLat)
  {
    inputLat = 12.9716;
    inputLng = 77.5946;
  }
  window.location = 'property/rent/'+encodeURIComponent(inputLocation)+'?'+'lat='+encodeURIComponent(inputLat)+'&lng='+encodeURIComponent(inputLng);
}
});
//Mobile SearchBtn
$("#mobilePropSearch").validate({
  ignore: [],
  errorClass: 'invalid',
  validClass: 'success',
    rules: {
      inputLat1: {
          required: true,
          min: 1
      },
      inputLng1: {
          required: true,
          min: 1
      }
    },
    messages: {
      inputLat1: {
          required: "Please Select location",
          min: "Please Select location"
      },
        inputLng1: {
          required: "Please Select location",
          min: "Please Select location"
        }
    },
    errorPlacement: function(error, element) {
    if (element.attr("name") == "inputLat1")
    error.appendTo("#locationNotSelected1");
    else
       error.insertAfter(element);
  },
submitHandler: function(form)
{
  var inputLocation = $('input#LocationSelect1').val();
  var inputLat = $('input#inputLat1').val();
  var inputLng = $('input#inputLng1').val();

  if(!inputLat1)
  {
    inputLat = 12.9716;
    inputLng = 77.5946;
  }
  window.location = 'property/rent/'+encodeURIComponent(inputLocation)+'?'+'lat='+encodeURIComponent(inputLat)+'&lng='+encodeURIComponent(inputLng);
}
});
// Custom serach
var atypes = new Array();
var ptypes = new Array();
var ftypes = new Array();
$('.flsearch').on('click',function() {
  var type=$(this).data("type");
  var cValue=$(this).data("value");

    if ($(this).is(':checked')) {
       atypes.push(cValue);
    }
    else {

      atypes.splice($.inArray(cValue, atypes),1);

    }

  $.ajax({
      method: 'GET',
      url: UrlSearchCustom,
      data: {atypes: atypes.reverse()},
      beforeSend: function()
      {
         $(".default").css("opacity", 0.2);
      },
      success: function (res)
      {

          $(".default").removeAttr('style');
          $('#defaultSearch').remove();
         $('#mainSearch').html(res.html);
      }
  });
});
$('.flsearch1').on('click',function() {
  var type=$(this).data("type");
  var cValue=$(this).data("value");

    if ($(this).is(':checked')) {
       ptypes.push(cValue);
    }
    else {

      ptypes.splice($.inArray(cValue, ptypes),1);

    }

  $.ajax({
      method: 'GET',
      url: UrlSearchCustom1,
      data: {ptypes: ptypes.reverse(), atypes: atypes.reverse()},
      beforeSend: function()
      {
         $(".default").css("opacity", 0.2);
      },
      success: function (res)
      {

          $(".default").removeAttr('style');
          $('#defaultSearch').remove();
         $('#mainSearch').html(res.html);
      }
  });
});
$('.flsearch2').on('click',function() {
  var type=$(this).data("type");
  var cValue=$(this).data("value");

    if ($(this).is(':checked')) {
       ftypes.push(cValue);
    }
    else {

      ftypes.splice($.inArray(cValue, ftypes),1);

    }
  $.ajax({
      method: 'GET',
      url: UrlSearchCustom2,
      data: {ftypes: ftypes.reverse()},
      beforeSend: function()
      {
         $(".default").css("opacity", 0.2);
      },
      success: function (res)
      {
          $(".default").removeAttr('style');
          $('#defaultSearch').remove();
         $('#mainSearch').html(res.html);
      }
  });
});

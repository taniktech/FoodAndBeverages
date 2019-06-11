//Load Next Form when Media is selcted
$('#headerSectionID').find('select[id=mediaSelect]').on('change', function(event){

	var mediaID=$(this).val();
	var token = "check_Adv_Req_Data";

	$.ajax({
	method: 'POST',
	url: 'process',
	data: {mediaID: mediaID, _token: token},
	beforeSend: function()
	{
	   // $("body").css("opacity", 0.2);
	},
	success: function (data)
	{
		var res = jQuery.parseJSON(data);
		if(res.rc == 1)
		{
			var ts_media_id = res.rd.ts_media_id;
			if(ts_media_id == mediaID)
			{
				if(ts_media_id == 1)
				{
					//Newspaper Section
					$('div#secondSectionID').children().remove();

					// Show Second Section
					$('#secondSectionID').css('display','block');
					
					//Change background
					$('.headerSectionClass').css('background-image','url("assets/images/background/first-section/newspaper.png")');

					// Newspaper Form
				   var formData = $('<form id="newspaperDynForm">')
				   		.append($('<div id="newspaperSmartWizard">')
						.append($('<ul>')
						.append('<li><a href="#step-1">Step 1<br /><small>This is step description</small></a></li>')
						.append('<li><a href="#step-2">Step 1<br /><small>This is step description</small></a></li>')
						.append('<li><a href="#step-3">Step 1<br /><small>This is step description</small></a></li>')
						.append('<li><a href="#step-4">Step 1<br /><small>This is step description</small></a></li>')
						.append('</ul>'))
						
						.append($('<div class="py-5">')

						.append($('<div id="step-1" class="">')
						.append($('<div class="row justify-content-center">')
						.append($('<div class="col-sm-6">')
						.append('<p class="font-weight-normal text-center">Select City/Area you want to advertise in</p>')
						.append($('<div class="form-group">')
						.append($('<select class="form-control" multiple="multiple" name="npCitySelect" id="npCitySelect" required="required">')))))
						.append($('<div class="row justify-content-center">')
						.append($('<div class="col-sm-6">')
						.append('<p class="font-weight-normal text-center">Select Newspaper</p>')
						.append($('<div class="form-group">')
						.append($('<select class="form-control" multiple="multiple" name="npSelect" id="npSelect" required="required">'))))))
							

						.append($('<div id="step-2" class="">')
						.append($('<div class="row justify-content-center">')
						.append($('<div class="col-sm-6">')
						.append('<p class="font-weight-normal text-center">Select Category of advertisement</p>')
						.append($('<div class="form-group">')
						.append($('<select class="form-control" name="npAdCatSelect" id="npAdCatSelect" required="required">')))))
						.append($('<div class="row justify-content-center">')
						.append($('<div class="col-sm-6">')
						.append('<p class="font-weight-normal text-center">Select Size of advertisement</p>')
						.append($('<div class="form-group">')
						.append($('<select class="form-control" name="npAdSizeSelect" id="npAdSizeSelect" required="required">')))))
						
						.append($('<div class="row justify-content-center" id="adSizeImgDiv" style="display:none;">')
						.append($('<div class="col-sm-6">')
						.append('<img src="" alt="Ad Size" id="npAdSizeImg" class="img-fluid mx-auto d-block">')))

						.append($('<div class="row justify-content-center">')
						.append($('<div class="col-sm-6">')
						.append($('<div class="form-group">')
						.append('<label for="npAdColor">Your Choice Of color</label>')
						.append('<input type="color" class="form-control" id="npAdColor" name="npAdColor" placeholder="Color">')))))


						.append($('<div id="step-3" class="">')
						.append($('<div class="row justify-content-center">')
						.append($('<div class="col-sm-6">')
						.append($('<div class="form-group">')
						.append('<label for="contentTextarea">Type Content you want to advertise</label>')
						.append('<textarea class="form-control" id="contentTextarea" name="contentTextarea" rows="3"></textarea>'))))
						.append($('<div class="row justify-content-center">')
						.append($('<div class="col-sm-6">')
						.append($('<div class="custom-file">')
						.append('<input type="file" class="custom-file-input" id="npAdFile" name="npAdFile">')	
						.append('<label class="custom-file-label" for="npAdFile">Choose file</label>'))))
						.append($('<div class="row justify-content-center">')
						.append($('<div class="col-sm-6">')
						.append($('<div class="form-group">')
						.append('<label for="npAdReleaseDate">Tentative date of ad release</label>')
						.append('<input type="date" class="form-control" id="npAdReleaseDate" name="npAdReleaseDate" placeholder="Date">')))))

						.append($('<div id="step-4" class="">')
						.append($('<div class="row">')
						// First Column
						.append($('<div class="col-sm-5 offset-sm-1 text-left">')

						.append($('<div class="form-group row">')
						.append('<label for="inputName" class="col-sm-2 col-form-label">Name</label>')
						.append($('<div class="col-sm-10">')
						.append('<input type="text" class="form-control" id="inputName" name="inputName" placeholder="Name">')))

						.append($('<div class="form-group row">')
						.append('<label for="inputMobile" class="col-sm-2 col-form-label">Mobile</label>')
						.append($('<div class="col-sm-10">')
						.append('<input type="text" class="form-control" id="inputMobile" name="inputMobile" placeholder="Mobile">')))

						.append($('<div class="form-group row">')
						.append('<label for="inputAddress" class="col-sm-2 col-form-label">Address</label>')
						.append($('<div class="col-sm-10">')
						.append('<textarea class="form-control" id="inputAddress" name="inputAddress" rows="3"></textarea>'))))


						// Second Column
						.append($('<div class="col-sm-5 offset-sm-1 text-left">')

						.append($('<div class="form-group row">')
						.append('<label for="inputEmail" class="col-sm-2 col-form-label">Email<label>')
						.append($('<div class="col-sm-10">')
						.append('<input type="text" class="form-control" id="inputEmail" name="inputEmail" placeholder="Email">')))

						.append($('<div class="form-group row">')
						.append('<label for="inputGst" class="col-sm-2 col-form-label">GST</label>')
						.append($('<div class="col-sm-10">')
						.append('<input type="text" class="form-control" id="inputGst" name="inputGst" placeholder="GST No.">')))

						.append($('<div class="form-group row mt-5">')
						.append($('<div class="col-sm-2 offset-sm-8">')
						.append('<button class="btn btn-primary" type="submit">Submit form</button>'))))))));

			//Append Dynamic form to Smartwizard
			$("#smartWizardSection").html(formData);
			//Intialize SmartWizard
			$('#newspaperSmartWizard').smartWizard({
				selected: 0,
				theme: 'arrows',
				transitionEffect:'fade',
				showStepURLhash: false,
				toolbarSettings: 
				{
				  toolbarPosition: 'bottom'
				}

			});
			// Step show event
			$("#newspaperSmartWizard").on("showStep", function(e, anchorObject, stepNumber, stepDirection, stepPosition) {
			   //alert("You are on step "+stepNumber+" now");
			   if(stepPosition === 'first'){
				   $("#prev-btn").addClass('disabled');
			   }else if(stepPosition === 'final'){
				   $("#next-btn").addClass('disabled');
			   }else{
				   $("#prev-btn").removeClass('disabled');
				   $("#next-btn").removeClass('disabled');
			   }
			});
			var scrolled = 0;
            scrolled = scrolled + 600;
			//Load Location Using Ajax
            var token = "load_np_location";
            $.ajax({
              method: 'POST',
              url: 'process',
              data: {_token: token},
              success: function (data)
                    {

                    var res = jQuery.parseJSON(data);
                    if(res.rc == 1)
                    {

                      $("select#npCitySelect").empty();
                      var MySelect = $('select#npCitySelect')[0].sumo;
                      for (var i = 0; i < res.rd.length; i++)
                      {
                        MySelect.add(res.rd[i].newspaper_location,res.rd[i].newspaper_location);
                      	
                      }
                      
                    }
                   else if(res.rc == 2)
                    {
                      $("select#npCitySelect").empty();
                      $("select#npSelect").empty();
                    }

                    }
                });
            //Load Categories
            var token = "load_np_categories";
            $.ajax({
              method: 'POST',
              url: 'process',
              data: {_token: token},
              success: function (data)
                    {

                    var res = jQuery.parseJSON(data);
                    if(res.rc == 1)
                    {

                      $("select#npAdCatSelect").empty();
                      var MySelect = $('select#npAdCatSelect')[0].sumo;
                      MySelect.add('',"Select Category")
                      for (var i = 0; i < res.rd.length; i++)
                      {
                        MySelect.add(res.rd[i].category,res.rd[i].category);
                      	
                      }
                      
                    }

                    }
                });
            //Newspaer City Select
            $('select#npCitySelect').SumoSelect({
                csvDispCount: 4,
                search: true,
                searchText:'Enter here.',
                up:false});
            //Newspaper select
           	$('select#npSelect').SumoSelect({
            csvDispCount: 4,
            search: true,
            searchText:'Enter here.',
            up:false});
           	//Category select
           	$('select#npAdCatSelect').SumoSelect({
            csvDispCount: 4,
            search: true,
            searchText:'Enter here.',
            up:false});
            //Ad size select
           	$('select#npAdSizeSelect').SumoSelect({
            csvDispCount: 4,
            search: true,
            searchText:'Enter here.',
            up:false});

			// Scroll Down
            $('html, body').animate({scrollTop:scrolled}, 'slow');
           	var validateForm = $("#newspaperDynForm");
                    validateForm.validate({
                        rules: {
                            npCitySelect:
                            {
                              required: true,
                              minlength: 1
                            },
                            npSelect:
                            {
                              required: true,
                              minlength: 1
                            },
                            npAdCatSelect:
                            {
                            	required: true
                            },
                            npAdSizeSelect:
                            {
                              required: true
                            },
                            contentTextarea:
                            {
                            	required: true
                            },
                            inputName:
                            {
                            	required: true
                            },
                            inputMobile:
                            {
                            	required: true,
                            	number: true,
					            minlength: 10,
					            maxlength: 10
                            },
                            inputAddress:
                            {
                            	required: true
                            },
                            inputEmail:
                            {
                            	required: true,
                            	email: true
                            },
                            inputGst:
                            {
                            	required: true
                            }
                        },
                        message:
                        {
                        	npAdSizeSelect:
                        	{
                        		min: "This field is required"
                        	}
                        },

						submitHandler: function(validateForm)
						{
						
						var token = "np_final_data";

				       	var form = $('#newspaperDynForm')[0]; // You need to use standard javascript object here
						var formData = new FormData(form);
						formData.append('_token', token);

					    $.ajax({
			            url: "process",
                        data: formData,   // Setting the data attribute of ajax with file_data
                        cache: false,
                        contentType: false,
                        processData: false,
                        type: "POST",
                        beforeSend: function()
                        {
                          //$("body").css("opacity", 0.2);
                        },
		              	success: function (data)
		                    {
		                    	console.log(data);

		                    }
		                });
						}
                    });

			// Validating form on step change
			$("#newspaperSmartWizard").on("leaveStep", function(e, anchorObject, stepNumber, stepDirection) {
                
                // stepDirection === 'forward' :- this condition allows to do the form validation
                // only on forward navigation, that makes easy navigation on backwards still do the validation when going next
                if(stepDirection === 'forward'){

                    return validateForm.valid();
                }
                return true;
            });
			//End of Newspaper Section
				}
				else if(ts_media_id == 2)
				{
					//Digital Section
					$('div#secondSectionID').children().remove();

					// Show Second Section
					$('#secondSectionID').css('display','block');

					//Change background
					$('.headerSectionClass').css('background-image','url("assets/images/background/first-section/cinema.png")');
					
					// Digital Form
				   var formData = $('<form id="digitalDynForm">')
				   		.append($('<div id="digitalSmartWizard">')
						.append($('<ul>')
						.append('<li><a href="#step-1">Step 1<br /><small>This is step description</small></a></li>')
						.append('<li><a href="#step-2">Step 1<br /><small>This is step description</small></a></li>')
						.append('</ul>'))
						
						.append($('<div class="py-5">')

						.append($('<div id="step-1" class="">')
						.append($('<div class="row justify-content-center">')
						.append($('<div class="col-sm-6">')
						.append($('<div class="form-group">')
						.append('<label for="detailsTextarea">Enter Details</label>')
						.append('<textarea class="form-control" id="detailsTextarea" name="detailsTextarea" rows="3"></textarea>'))))
						.append($('<div class="row justify-content-center">')
						.append($('<div class="col-sm-6">')
						.append($('<div class="form-group">')
						.append('<label for="periodOfAct">Period of Activity</label>')
						.append('<input type="date" class="form-control" id="periodOfAct" name="periodOfAct" placeholder="Period of Activity">')))))

						.append($('<div id="step-2" class="">')
						.append($('<div class="row">')
						// First Column
						.append($('<div class="col-sm-5 offset-sm-1 text-left">')

						.append($('<div class="form-group row">')
						.append('<label for="inputName" class="col-sm-2 col-form-label">Name</label>')
						.append($('<div class="col-sm-10">')
						.append('<input type="text" class="form-control" id="inputName" name="inputName" placeholder="Name">')))

						.append($('<div class="form-group row">')
						.append('<label for="inputMobile" class="col-sm-2 col-form-label">Mobile</label>')
						.append($('<div class="col-sm-10">')
						.append('<input type="text" class="form-control" id="inputMobile" name="inputMobile" placeholder="Mobile">')))

						.append($('<div class="form-group row">')
						.append('<label for="inputAddress" class="col-sm-2 col-form-label">Address</label>')
						.append($('<div class="col-sm-10">')
						.append('<textarea class="form-control" id="inputAddress" name="inputAddress" rows="3"></textarea>'))))


						// Second Column
						.append($('<div class="col-sm-5 offset-sm-1 text-left">')

						.append($('<div class="form-group row">')
						.append('<label for="inputEmail" class="col-sm-2 col-form-label">Email<label>')
						.append($('<div class="col-sm-10">')
						.append('<input type="text" class="form-control" id="inputEmail" name="inputEmail" placeholder="Email">')))

						.append($('<div class="form-group row">')
						.append('<label for="inputGst" class="col-sm-2 col-form-label">GST</label>')
						.append($('<div class="col-sm-10">')
						.append('<input type="text" class="form-control" id="inputGst" name="inputGst" placeholder="GST No.">')))

						.append($('<div class="form-group row mt-5">')
						.append($('<div class="col-sm-2 offset-sm-8">')
						.append('<button class="btn btn-primary" type="submit">Submit form</button>'))))))));


			//Append Dynamic form to Smartwizard
			$("#smartWizardSection").html(formData);
			//Intialize SmartWizard
			$('#digitalSmartWizard').smartWizard({
				selected: 0,
				theme: 'arrows',
				transitionEffect:'fade',
				showStepURLhash: false,
				toolbarSettings: 
				{
				  toolbarPosition: 'bottom'
				}

			});
			// Step show event
			$("#digitalSmartWizard").on("showStep", function(e, anchorObject, stepNumber, stepDirection, stepPosition) {
			   //alert("You are on step "+stepNumber+" now");
			   if(stepPosition === 'first'){
				   $("#prev-btn").addClass('disabled');
			   }else if(stepPosition === 'final'){
				   $("#next-btn").addClass('disabled');
			   }else{
				   $("#prev-btn").removeClass('disabled');
				   $("#next-btn").removeClass('disabled');
			   }
			});
			var scrolled = 0;
            scrolled = scrolled + 600;
			// Scroll Down
            $('html, body').animate({scrollTop:scrolled}, 'slow');

	        var validateForm = $("#digitalDynForm");
                    validateForm.validate({
                        rules: {
                            detailsTextarea:
                            {
                            	required: true
                            },
                            periodOfAct:
                            {
                            	required: true
                            },
                            inputName:
                            {
                            	required: true
                            },
                            inputMobile:
                            {
                            	required: true,
                            	number: true,
					            minlength: 10,
					            maxlength: 10
                            },
                            inputAddress:
                            {
                            	required: true
                            },
                            inputEmail:
                            {
                            	required: true,
                            	email: true
                            },
                            inputGst:
                            {
                            	required: true
                            }
                        },

						submitHandler: function(validateForm)
						{
						
						var token = "digital_final_data";

				       	var form = $('#digitalDynForm')[0]; // You need to use standard javascript object here
						var formData = new FormData(form);
						formData.append('_token', token);

					    $.ajax({
			            url: "process",
                        data: formData,   // Setting the data attribute of ajax with file_data
                        cache: false,
                        contentType: false,
                        processData: false,
                        type: "POST",
                        beforeSend: function()
                        {
                          //$("body").css("opacity", 0.2);
                        },
		              	success: function (data)
		                    {
		                    	console.log(data);

		                    }
		                });
						}
                    });

				// Validating form on step change
				$("#digitalDynForm").on("leaveStep", function(e, anchorObject, stepNumber, stepDirection) {
	                
	                // stepDirection === 'forward' :- this condition allows to do the form validation
	                // only on forward navigation, that makes easy navigation on backwards still do the validation when going next
	                if(stepDirection === 'forward'){

	                    return validateForm.valid();
	                }
	                return true;
	            }); 
				//End of Digital Section
				}
				
				else if(ts_media_id == 3)
				{
					// FM Radio Section
					$('div#secondSectionID').children().remove();

					// Show Second Section
					$('#secondSectionID').css('display','block');
					
					//Change background
					$('.headerSectionClass').css('background-image','url("assets/images/background/first-section/radio.png")');
	
					// Radio Form
				   var formData = $('<form id="fmRadioDynForm">')
				   		.append($('<div id="fmRadioSmartWizard">')
						.append($('<ul>')
						.append('<li><a href="#step-1">Step 1<br /><small>This is step description</small></a></li>')
						.append('<li><a href="#step-2">Step 1<br /><small>This is step description</small></a></li>')
						.append('<li><a href="#step-3">Step 1<br /><small>This is step description</small></a></li>')
						.append('</ul>'))
						
						.append($('<div class="py-5">')

						.append($('<div id="step-1" class="">')
						.append($('<div class="row justify-content-center">')
						.append($('<div class="col-sm-6">')
						.append('<p class="font-weight-normal text-center">Select City/Area you want to advertise in</p>')
						.append($('<div class="form-group">')
						.append($('<select class="form-control" multiple="multiple" name="fmCitySelect" id="fmCitySelect" required="required">')))))
						.append($('<div class="row justify-content-center">')
						.append($('<div class="col-sm-6">')
						.append('<p class="font-weight-normal text-center">Select FM Radio</p>')
						.append($('<div class="form-group">')
						.append($('<select class="form-control" multiple="multiple" name="fmRadioSelect" id="fmRadioSelect" required="required">'))))))
							

						.append($('<div id="step-2" class="">')
						.append($('<div class="row justify-content-center">')
						.append($('<div class="col-sm-6">')
						.append($('<div class="form-group">')
						.append('<label for="detailsTextarea">Enter Details</label>')
						.append('<textarea class="form-control" id="detailsTextarea" name="detailsTextarea" rows="3"></textarea>'))))
						.append($('<div class="row justify-content-center">')
						.append($('<div class="col-sm-6">')
						.append($('<div class="form-group">')
						.append('<label for="periodOfAct">Period of Activity</label>')
						.append('<input type="date" class="form-control" id="periodOfAct" name="periodOfAct" placeholder="Period of Activity">')))))

						.append($('<div id="step-3" class="">')
						.append($('<div class="row">')
						// First Column
						.append($('<div class="col-sm-5 offset-sm-1 text-left">')

						.append($('<div class="form-group row">')
						.append('<label for="inputName" class="col-sm-2 col-form-label">Name</label>')
						.append($('<div class="col-sm-10">')
						.append('<input type="text" class="form-control" id="inputName" name="inputName" placeholder="Name">')))

						.append($('<div class="form-group row">')
						.append('<label for="inputMobile" class="col-sm-2 col-form-label">Mobile</label>')
						.append($('<div class="col-sm-10">')
						.append('<input type="text" class="form-control" id="inputMobile" name="inputMobile" placeholder="Mobile">')))

						.append($('<div class="form-group row">')
						.append('<label for="inputAddress" class="col-sm-2 col-form-label">Address</label>')
						.append($('<div class="col-sm-10">')
						.append('<textarea class="form-control" id="inputAddress" name="inputAddress" rows="3"></textarea>'))))


						// Second Column
						.append($('<div class="col-sm-5 offset-sm-1 text-left">')

						.append($('<div class="form-group row">')
						.append('<label for="inputEmail" class="col-sm-2 col-form-label">Email<label>')
						.append($('<div class="col-sm-10">')
						.append('<input type="text" class="form-control" id="inputEmail" name="inputEmail" placeholder="Email">')))

						.append($('<div class="form-group row">')
						.append('<label for="inputGst" class="col-sm-2 col-form-label">GST</label>')
						.append($('<div class="col-sm-10">')
						.append('<input type="text" class="form-control" id="inputGst" name="inputGst" placeholder="GST No.">')))

						.append($('<div class="form-group row mt-5">')
						.append($('<div class="col-sm-2 offset-sm-8">')
						.append('<button class="btn btn-primary" type="submit">Submit form</button>'))))))));


			//Append Dynamic form to Smartwizard
			$("#smartWizardSection").html(formData);    
			//Intialize SmartWizard
			$('#fmRadioSmartWizard').smartWizard({
				selected: 0,
				theme: 'arrows',
				transitionEffect:'fade',
				showStepURLhash: false,
				toolbarSettings: 
				{
				  toolbarPosition: 'bottom'
				}

			});
			// Step show event
			$("#fmRadioSmartWizard").on("showStep", function(e, anchorObject, stepNumber, stepDirection, stepPosition) {
			   //alert("You are on step "+stepNumber+" now");
			   if(stepPosition === 'first'){
				   $("#prev-btn").addClass('disabled');
			   }else if(stepPosition === 'final'){
				   $("#next-btn").addClass('disabled');
			   }else{
				   $("#prev-btn").removeClass('disabled');
				   $("#next-btn").removeClass('disabled');
			   }
			});
			//Load Location Using Ajax
            var token = "load_fm_location";
            $.ajax({
              method: 'POST',
              url: 'process',
              data: {_token: token},
              success: function (data)
                    {

                    var res = jQuery.parseJSON(data);
                    if(res.rc == 1)
                    {

                      $("select#fmCitySelect").empty();
                      var MySelect = $('select#fmCitySelect')[0].sumo;
                      for (var i = 0; i < res.rd.length; i++)
                      {
                        MySelect.add(res.rd[i].fm_location,res.rd[i].fm_location);
                      	
                      }
                      
                    }
                   else if(res.rc == 2)
                    {
                      $("select#fmCitySelect").empty();
                      $("select#fmRadioSelect").empty();
                    }

                    }
                });

            var scrolled = 0;
            scrolled = scrolled + 600;
            //City Select
            $('select#fmCitySelect').SumoSelect({
                csvDispCount: 4,
                search: true,
                searchText:'Enter here.',
                up:false});
            //FM channel select
           	$('select#fmRadioSelect').SumoSelect({
            csvDispCount: 4,
            search: true,
            searchText:'Enter here.',
            up:false});
            // Scroll Down
            $('html, body').animate({scrollTop:scrolled}, 'slow');

	        var validateForm = $("#fmRadioDynForm");
                    validateForm.validate({
                        rules: {
                            fmCitySelect:
                            {
                              required: true,
                              minlength: 1
                            },
                            fmRadioSelect:
                            {
                              required: true,
                              minlength: 1
                            },
                            detailsTextarea:
                            {
                            	required: true
                            },
                            periodOfAct:
                            {
                            	required: true
                            },
                            inputName:
                            {
                            	required: true
                            },
                            inputMobile:
                            {
                            	required: true,
                            	number: true,
					            minlength: 10,
					            maxlength: 10
                            },
                            inputAddress:
                            {
                            	required: true
                            },
                            inputEmail:
                            {
                            	required: true,
                            	email: true
                            },
                            inputGst:
                            {
                            	required: true
                            }
                        },

						submitHandler: function(validateForm)
						{
						
						var token = "fm_radio_final_data";

				       	var form = $('#fmRadioDynForm')[0]; // You need to use standard javascript object here
						var formData = new FormData(form);
						formData.append('_token', token);

					    $.ajax({
			            url: "process",
                        data: formData,   // Setting the data attribute of ajax with file_data
                        cache: false,
                        contentType: false,
                        processData: false,
                        type: "POST",
                        beforeSend: function()
                        {
                          //$("body").css("opacity", 0.2);
                        },
		              	success: function (data)
		                    {
		                    	console.log(data);

		                    }
		                });
						}
                    });

			// Validating form on step change
			$("#fmRadioSmartWizard").on("leaveStep", function(e, anchorObject, stepNumber, stepDirection) {
                
                // stepDirection === 'forward' :- this condition allows to do the form validation
                // only on forward navigation, that makes easy navigation on backwards still do the validation when going next
                if(stepDirection === 'forward'){

                    return validateForm.valid();
                }
                return true;
            });
            // End of FM Radion Section
			}
			else if(ts_media_id == 4)
			{

			// TV Section
			$('div#secondSectionID').children().remove();
			// Show Second Section
			$('#secondSectionID').css('display','block');
			
			//Change background
			$('.headerSectionClass').css('background-image','url("assets/images/background/first-section/television.png")');

			// TV Form
		   var formData = $('<form id="tvDynForm">')
		   		.append($('<div id="tvSmartWizard">')
				.append($('<ul>')
				.append('<li><a href="#step-1">Step 1<br /><small>This is step description</small></a></li>')
				.append('<li><a href="#step-2">Step 1<br /><small>This is step description</small></a></li>')
				.append('<li><a href="#step-3">Step 1<br /><small>This is step description</small></a></li>')
				.append('</ul>'))
				
				.append($('<div class="py-5">')

				.append($('<div id="step-1" class="">')
				.append($('<div class="row justify-content-center">')
				.append($('<div class="col-sm-6">')
				.append('<p class="font-weight-normal text-center">Select Language you want to advertise in</p>')
				.append($('<div class="form-group">')
				.append($('<select class="form-control" multiple="multiple" name="tvLanguageSelect" id="tvLanguageSelect" required="required">')))))
				.append($('<div class="row justify-content-center">')
				.append($('<div class="col-sm-6">')
				.append('<p class="font-weight-normal text-center">Select TV Channel</p>')
				.append($('<div class="form-group">')
				.append($('<select class="form-control" multiple="multiple" name="tvChannelSelect" id="tvChannelSelect" required="required">'))))))
					

				.append($('<div id="step-2" class="">')
				.append($('<div class="row justify-content-center">')
				.append($('<div class="col-sm-6">')
				.append($('<div class="form-group">')
				.append('<label for="detailsTextarea">Enter Details</label>')
				.append('<textarea class="form-control" id="detailsTextarea" name="detailsTextarea" rows="3"></textarea>'))))
				.append($('<div class="row justify-content-center">')
				.append($('<div class="col-sm-6">')
				.append($('<div class="form-group">')
				.append('<label for="periodOfAct">Period of Activity</label>')
				.append('<input type="date" class="form-control" id="periodOfAct" name="periodOfAct" placeholder="Period of Activity">')))))

				.append($('<div id="step-3" class="">')
				.append($('<div class="row">')
				// First Column
				.append($('<div class="col-sm-5 offset-sm-1 text-left">')

				.append($('<div class="form-group row">')
				.append('<label for="inputName" class="col-sm-2 col-form-label">Name</label>')
				.append($('<div class="col-sm-10">')
				.append('<input type="text" class="form-control" id="inputName" name="inputName" placeholder="Name">')))

				.append($('<div class="form-group row">')
				.append('<label for="inputMobile" class="col-sm-2 col-form-label">Mobile</label>')
				.append($('<div class="col-sm-10">')
				.append('<input type="text" class="form-control" id="inputMobile" name="inputMobile" placeholder="Mobile">')))

				.append($('<div class="form-group row">')
				.append('<label for="inputAddress" class="col-sm-2 col-form-label">Address</label>')
				.append($('<div class="col-sm-10">')
				.append('<textarea class="form-control" id="inputAddress" name="inputAddress" rows="3"></textarea>'))))


				// Second Column
				.append($('<div class="col-sm-5 offset-sm-1 text-left">')

				.append($('<div class="form-group row">')
				.append('<label for="inputEmail" class="col-sm-2 col-form-label">Email<label>')
				.append($('<div class="col-sm-10">')
				.append('<input type="text" class="form-control" id="inputEmail" name="inputEmail" placeholder="Email">')))

				.append($('<div class="form-group row">')
				.append('<label for="inputGst" class="col-sm-2 col-form-label">GST</label>')
				.append($('<div class="col-sm-10">')
				.append('<input type="text" class="form-control" id="inputGst" name="inputGst" placeholder="GST No.">')))

				.append($('<div class="form-group row mt-5">')
				.append($('<div class="col-sm-2 offset-sm-8">')
				.append('<button class="btn btn-primary" type="submit">Submit form</button>'))))))));


				//Append Dynamic form to Smartwizard
				$("#smartWizardSection").html(formData);  

				//Intialize SmartWizard
				$('#tvSmartWizard').smartWizard({
					selected: 0,
					theme: 'arrows',
					transitionEffect:'fade',
					showStepURLhash: false,
					toolbarSettings: 
					{
					  toolbarPosition: 'bottom'
					}

				});
				// Step show event
				$("#tvSmartWizard").on("showStep", function(e, anchorObject, stepNumber, stepDirection, stepPosition) {
				   //alert("You are on step "+stepNumber+" now");
				   if(stepPosition === 'first'){
					   $("#prev-btn").addClass('disabled');
				   }else if(stepPosition === 'final'){
					   $("#next-btn").addClass('disabled');
				   }else{
					   $("#prev-btn").removeClass('disabled');
					   $("#next-btn").removeClass('disabled');
				   }
				});
			//Load Languages Using Ajax
            var token = "load_tv_language";
            $.ajax({
              method: 'POST',
              url: 'process',
              data: {_token: token},
              success: function (data)
                    {

                    var res = jQuery.parseJSON(data);
                    if(res.rc == 1)
                    {

                      $("select#tvLanguageSelect").empty();
                      var MySelect = $('select#tvLanguageSelect')[0].sumo;
                      for (var i = 0; i < res.rd.length; i++)
                      {
                        MySelect.add(res.rd[i].tv_language,res.rd[i].tv_language);
                      	
                      }
                      
                    }
                   else if(res.rc == 2)
                    {
                      $("select#tvLanguageSelect").empty();
                      $("select#tvChannelSelect").empty();
                    }

                    }
                });

            var scrolled = 0;
            scrolled = scrolled + 600;
            //TV language Select
            $('select#tvLanguageSelect').SumoSelect({
                csvDispCount: 4,
                search: true,
                searchText:'Enter here.',
                up:false});
            //TV channel select
           	$('select#tvChannelSelect').SumoSelect({
            csvDispCount: 4,
            search: true,
            searchText:'Enter here.',
            up:false});
            // Scroll Down
            $('html, body').animate({scrollTop:scrolled}, 'slow');
           	var validateForm = $("#tvDynForm");
                    validateForm.validate({
                        rules: {
                            tvLanguageSelect:
                            {
                              required: true,
                              minlength: 1
                            },
                            tvChannelSelect:
                            {
                              required: true,
                              minlength: 1
                            },
                            detailsTextarea:
                            {
                            	required: true
                            },
                            periodOfAct:
                            {
                            	required: true
                            },
                            inputName:
                            {
                            	required: true
                            },
                            inputMobile:
                            {
                            	required: true,
                            	number: true,
					            minlength: 10,
					            maxlength: 10
                            },
                            inputAddress:
                            {
                            	required: true
                            },
                            inputEmail:
                            {
                            	required: true,
                            	email: true
                            },
                            inputGst:
                            {
                            	required: true
                            }
                        },

						submitHandler: function(validateForm)
						{
						
						var token = "tv_final_data";

				       	var form = $('#tvDynForm')[0]; // You need to use standard javascript object here
						var formData = new FormData(form);
						formData.append('_token', token);

					    $.ajax({
			            url: "process",
                        data: formData,   // Setting the data attribute of ajax with file_data
                        cache: false,
                        contentType: false,
                        processData: false,
                        type: "POST",
                        beforeSend: function()
                        {
                          //$("body").css("opacity", 0.2);
                        },
		              	success: function (data)
		                    {
		                    	console.log(data);

		                    }
		                });
						}
                    });

			// Validating form on step change
			$("#tvDynForm").on("leaveStep", function(e, anchorObject, stepNumber, stepDirection) {
                
                // stepDirection === 'forward' :- this condition allows to do the form validation
                // only on forward navigation, that makes easy navigation on backwards still do the validation when going next
                if(stepDirection === 'forward'){

                    return validateForm.valid();
                }
                return true;
            });
			//End of TV Section	
			}
			else if(ts_media_id == 5)
			{
				//Cinema Section
				$('div#secondSectionID').children().remove();

				// Show Second Section
				$('#secondSectionID').css('display','block');

				//Change background
				$('.headerSectionClass').css('background-image','url("assets/images/background/first-section/cinema.png")');

				// Cinema Form
			   var formData = $('<form id="cinemaDynForm">')
			   	.append($('<div id="cinemaSmartWizard">')
			   	.append($('<ul>')
				.append('<li><a href="#step-1">Step 1<br /><small>This is step description</small></a></li>')
				.append('<li><a href="#step-2">Step 1<br /><small>This is step description</small></a></li>')
				.append('<li><a href="#step-3">Step 1<br /><small>This is step description</small></a></li>')
				.append('</ul>'))
				
				.append($('<div class="py-5">')

				.append($('<div id="step-1" class="">')
				.append($('<div class="row justify-content-center">')
				.append($('<div class="col-sm-6">')
				.append('<p class="font-weight-normal text-center">Select City/Area you want to advertise in</p>')
				.append($('<div class="form-group">')
				.append($('<select class="form-control" multiple="multiple" name="cinemaCitySelect" id="cinemaCitySelect" required="required">'))))))
					

				.append($('<div id="step-2" class="">')
				.append($('<div class="row justify-content-center">')
				.append($('<div class="col-sm-6">')
				.append($('<div class="form-group">')
				.append('<label for="detailsTextarea">Enter Details</label>')
				.append('<textarea class="form-control" id="detailsTextarea" name="detailsTextarea" rows="3"></textarea>'))))
				.append($('<div class="row justify-content-center">')
				.append($('<div class="col-sm-6">')
				.append($('<div class="form-group">')
				.append('<label for="periodOfAct">Period of Activity</label>')
				.append('<input type="date" class="form-control" id="periodOfAct" name="periodOfAct" placeholder="Period of Activity">')))))

				.append($('<div id="step-3" class="">')
				.append($('<div class="row">')
				// First Column
				.append($('<div class="col-sm-5 offset-sm-1 text-left">')

				.append($('<div class="form-group row">')
				.append('<label for="inputName" class="col-sm-2 col-form-label">Name</label>')
				.append($('<div class="col-sm-10">')
				.append('<input type="text" class="form-control" id="inputName" name="inputName" placeholder="Name">')))

				.append($('<div class="form-group row">')
				.append('<label for="inputMobile" class="col-sm-2 col-form-label">Mobile</label>')
				.append($('<div class="col-sm-10">')
				.append('<input type="text" class="form-control" id="inputMobile" name="inputMobile" placeholder="Mobile">')))

				.append($('<div class="form-group row">')
				.append('<label for="inputAddress" class="col-sm-2 col-form-label">Address</label>')
				.append($('<div class="col-sm-10">')
				.append('<textarea class="form-control" id="inputAddress" name="inputAddress" rows="3"></textarea>'))))


				// Second Column
				.append($('<div class="col-sm-5 offset-sm-1 text-left">')

				.append($('<div class="form-group row">')
				.append('<label for="inputEmail" class="col-sm-2 col-form-label">Email<label>')
				.append($('<div class="col-sm-10">')
				.append('<input type="text" class="form-control" id="inputEmail" name="inputEmail" placeholder="Email">')))

				.append($('<div class="form-group row">')
				.append('<label for="inputGst" class="col-sm-2 col-form-label">GST</label>')
				.append($('<div class="col-sm-10">')
				.append('<input type="text" class="form-control" id="inputGst" name="inputGst" placeholder="GST No.">')))

				.append($('<div class="form-group row mt-5">')
				.append($('<div class="col-sm-2 offset-sm-8">')
				.append('<button class="btn btn-primary" type="submit">Submit form</button>'))))))));


				//Append Dynamic form to Smartwizard
				$("#smartWizardSection").html(formData);  

		//Intialize SmartWizard
		$('#cinemaSmartWizard').smartWizard({
			selected: 0,
			theme: 'arrows',
			transitionEffect:'fade',
			showStepURLhash: false,
			toolbarSettings: 
			{
			  toolbarPosition: 'bottom'
			}

		});
		// Step show event
		$("#cinemaSmartWizard").on("showStep", function(e, anchorObject, stepNumber, stepDirection, stepPosition) {
		   //alert("You are on step "+stepNumber+" now");
		   if(stepPosition === 'first'){
			   $("#prev-btn").addClass('disabled');
		   }else if(stepPosition === 'final'){
			   $("#next-btn").addClass('disabled');
		   }else{
			   $("#prev-btn").removeClass('disabled');
			   $("#next-btn").removeClass('disabled');
		   }
		});
		var scrolled = 0;
        scrolled = scrolled + 600;
        //Load Locations Using Ajax
            var token = "load_cinema_location";
            $.ajax({
              method: 'POST',
              url: 'process',
              data: {_token: token},
              success: function (data)
                    {

                    var res = jQuery.parseJSON(data);
                    if(res.rc == 1)
                    {

                      $("select#cinemaCitySelect").empty();
                      var MySelect = $('select#cinemaCitySelect')[0].sumo;
                      for (var i = 0; i < res.rd.length; i++)
                      {
                        MySelect.add(res.rd[i].newspaper_location,res.rd[i].newspaper_location);
                      	
                      }
                      
                    }
                   else if(res.rc == 2)
                    {
                      $("select#cinemaCitySelect").empty();

                    }

                    }
                });
        //Cinema City Select
        $('select#cinemaCitySelect').SumoSelect({
            csvDispCount: 4,
            search: true,
            searchText:'Enter here.',
            up:false});
		// Scroll Down
        $('html, body').animate({scrollTop:scrolled}, 'slow');
        //Validate Form
        var validateForm = $("#cinemaDynForm");
                validateForm.validate({
                    rules: {
                    	cinemaCitySelect:
                    	{
                          required: true,
                          minlength: 1
                        },
                        detailsTextarea:
                        {
                        	required: true
                        },
                        periodOfAct:
                        {
                        	required: true
                        },
                        inputName:
                        {
                        	required: true
                        },
                        inputMobile:
                        {
                        	required: true,
                        	number: true,
				            minlength: 10,
				            maxlength: 10
                        },
                        inputAddress:
                        {
                        	required: true
                        },
                        inputEmail:
                        {
                        	required: true,
                        	email: true
                        },
                        inputGst:
                        {
                        	required: true
                        }
                    },

					submitHandler: function(validateForm)
					{
					
					var token = "digital_final_data";

			       	var form = $('#cinemaDynForm')[0]; // You need to use standard javascript object here
					var formData = new FormData(form);
					formData.append('_token', token);

				    $.ajax({
		            url: "process",
                    data: formData,   // Setting the data attribute of ajax with file_data
                    cache: false,
                    contentType: false,
                    processData: false,
                    type: "POST",
                    beforeSend: function()
                    {
                      //$("body").css("opacity", 0.2);
                    },
	              	success: function (data)
	                    {
	                    	console.log(data);

	                    }
	                });
					}
                });

			// Validating form on step change
			$("#cinemaSmartWizard").on("leaveStep", function(e, anchorObject, stepNumber, stepDirection) {
                
                // stepDirection === 'forward' :- this condition allows to do the form validation
                // only on forward navigation, that makes easy navigation on backwards still do the validation when going next
                if(stepDirection === 'forward'){

                    return validateForm.valid();
                }
                return true;
            });
            //End of Cinema Section
			}
			else if(ts_media_id == 6)
			{
				//Auto Section
				$('div#secondSectionID').children().remove();

				// Show Second Section
				$('#secondSectionID').css('display','block');

				//Change background
				$('.headerSectionClass').css('background-image','url("assets/images/background/first-section/auto.png")');

				// Auto Form
			   var formData = $('<form id="autoDynForm">')
			   	.append($('<div id="autoSmartWizard">')
			   	.append($('<ul>')
				.append('<li><a href="#step-1">Step 1<br /><small>This is step description</small></a></li>')
				.append('<li><a href="#step-2">Step 1<br /><small>This is step description</small></a></li>')
				.append('<li><a href="#step-3">Step 1<br /><small>This is step description</small></a></li>')
				.append('</ul>'))
				
				.append($('<div class="py-5">')

				.append($('<div id="step-1" class="">')
				.append($('<div class="row justify-content-center">')
				.append($('<div class="col-sm-6">')
				.append('<p class="font-weight-normal text-center">Select City/Area you want to advertise in</p>')
				.append($('<div class="form-group">')
				.append($('<select class="form-control" multiple="multiple" name="autoCitySelect" id="autoCitySelect" required="required">'))))))
					

				.append($('<div id="step-2" class="">')
				.append($('<div class="row justify-content-center">')
				.append($('<div class="col-sm-6">')
				.append($('<div class="form-group">')
				.append('<label for="detailsTextarea">Enter Details</label>')
				.append('<textarea class="form-control" id="detailsTextarea" name="detailsTextarea" rows="3"></textarea>'))))
				.append($('<div class="row justify-content-center">')
				.append($('<div class="col-sm-6">')
				.append($('<div class="form-group">')
				.append('<label for="periodOfAct">Period of Activity</label>')
				.append('<input type="date" class="form-control" id="periodOfAct" name="periodOfAct" placeholder="Period of Activity">')))))

				.append($('<div id="step-3" class="">')
				.append($('<div class="row">')
				// First Column
				.append($('<div class="col-sm-5 offset-sm-1 text-left">')

				.append($('<div class="form-group row">')
				.append('<label for="inputName" class="col-sm-2 col-form-label">Name</label>')
				.append($('<div class="col-sm-10">')
				.append('<input type="text" class="form-control" id="inputName" name="inputName" placeholder="Name">')))

				.append($('<div class="form-group row">')
				.append('<label for="inputMobile" class="col-sm-2 col-form-label">Mobile</label>')
				.append($('<div class="col-sm-10">')
				.append('<input type="text" class="form-control" id="inputMobile" name="inputMobile" placeholder="Mobile">')))

				.append($('<div class="form-group row">')
				.append('<label for="inputAddress" class="col-sm-2 col-form-label">Address</label>')
				.append($('<div class="col-sm-10">')
				.append('<textarea class="form-control" id="inputAddress" name="inputAddress" rows="3"></textarea>'))))


				// Second Column
				.append($('<div class="col-sm-5 offset-sm-1 text-left">')

				.append($('<div class="form-group row">')
				.append('<label for="inputEmail" class="col-sm-2 col-form-label">Email<label>')
				.append($('<div class="col-sm-10">')
				.append('<input type="text" class="form-control" id="inputEmail" name="inputEmail" placeholder="Email">')))

				.append($('<div class="form-group row">')
				.append('<label for="inputGst" class="col-sm-2 col-form-label">GST</label>')
				.append($('<div class="col-sm-10">')
				.append('<input type="text" class="form-control" id="inputGst" name="inputGst" placeholder="GST No.">')))

				.append($('<div class="form-group row mt-5">')
				.append($('<div class="col-sm-2 offset-sm-8">')
				.append('<button class="btn btn-primary" type="submit">Submit form</button>'))))))));


				//Append Dynamic form to Smartwizard
				$("#smartWizardSection").html(formData);  

		//Intialize SmartWizard
		$('#autoSmartWizard').smartWizard({
			selected: 0,
			theme: 'arrows',
			transitionEffect:'fade',
			showStepURLhash: false,
			toolbarSettings: 
			{
			  toolbarPosition: 'bottom'
			}

		});
		// Step show event
		$("#autoSmartWizard").on("showStep", function(e, anchorObject, stepNumber, stepDirection, stepPosition) {
		   //alert("You are on step "+stepNumber+" now");
		   if(stepPosition === 'first'){
			   $("#prev-btn").addClass('disabled');
		   }else if(stepPosition === 'final'){
			   $("#next-btn").addClass('disabled');
		   }else{
			   $("#prev-btn").removeClass('disabled');
			   $("#next-btn").removeClass('disabled');
		   }
		});
		var scrolled = 0;
        scrolled = scrolled + 600;
        //Load Locations Using Ajax
            var token = "load_auto_location";
            $.ajax({
              method: 'POST',
              url: 'process',
              data: {_token: token},
              success: function (data)
                    {

                    var res = jQuery.parseJSON(data);
                    if(res.rc == 1)
                    {

                      $("select#autoCitySelect").empty();
                      var MySelect = $('select#autoCitySelect')[0].sumo;
                      for (var i = 0; i < res.rd.length; i++)
                      {
                        MySelect.add(res.rd[i].newspaper_location,res.rd[i].newspaper_location);
                      	
                      }
                      
                    }
                   else if(res.rc == 2)
                    {
                      $("select#autoCitySelect").empty();

                    }

                    }
                });
        //Auto City Select
        $('select#autoCitySelect').SumoSelect({
            csvDispCount: 4,
            search: true,
            searchText:'Enter here.',
            up:false});
		// Scroll Down
        $('html, body').animate({scrollTop:scrolled}, 'slow');
        //Validate Form
        var validateForm = $("#autoDynForm");
                validateForm.validate({
                    rules: {
                    	autoCitySelect:
                    	{
                          required: true,
                          minlength: 1
                        },
                        detailsTextarea:
                        {
                        	required: true
                        },
                        periodOfAct:
                        {
                        	required: true
                        },
                        inputName:
                        {
                        	required: true
                        },
                        inputMobile:
                        {
                        	required: true,
                        	number: true,
				            minlength: 10,
				            maxlength: 10
                        },
                        inputAddress:
                        {
                        	required: true
                        },
                        inputEmail:
                        {
                        	required: true,
                        	email: true
                        },
                        inputGst:
                        {
                        	required: true
                        }
                    },

					submitHandler: function(validateForm)
					{
					
					var token = "auto_final_data";

			       	var form = $('#autoDynForm')[0]; // You need to use standard javascript object here
					var formData = new FormData(form);
					formData.append('_token', token);

				    $.ajax({
		            url: "process",
                    data: formData,   // Setting the data attribute of ajax with file_data
                    cache: false,
                    contentType: false,
                    processData: false,
                    type: "POST",
                    beforeSend: function()
                    {
                      //$("body").css("opacity", 0.2);
                    },
	              	success: function (data)
	                    {
	                    	console.log(data);

	                    },
                    error: function ()
                    {
                    	console.log("Unable to connect now");

                    }
	                });
					}
                });

			// Validating form on step change
			$("#autoSmartWizard").on("leaveStep", function(e, anchorObject, stepNumber, stepDirection) {
                
                // stepDirection === 'forward' :- this condition allows to do the form validation
                // only on forward navigation, that makes easy navigation on backwards still do the validation when going next
                if(stepDirection === 'forward'){

                    return validateForm.valid();
                }
                return true;
            });
            //End of Auto Section
			}
			}
			else
			{
				location.reload();
			}
		}
		else
		{
			location.reload();
		}
	  // $("body").removeAttr('style');

	}
	});
});

// Load Related FM channels based on location selection
$("body").on('change',"select#fmCitySelect", function(event){
	var token = "load_fm_channels";
	var selectedCityArray = new Array();
	$.each($("#fmCitySelect option:selected"), function(){

	selectedCityArray.push($(this).val());

	});
	if(selectedCityArray.length > 0 )
	{
	  $.ajax({
	  method: 'POST',
	  url: 'process',
	  data: {_token: token, cities: selectedCityArray},
	  success: function (data)
			{

			var res = jQuery.parseJSON(data);
			if(res.rc == 1)
			{
				
				var MySelect = $('select#fmRadioSelect')[0].sumo;
				MySelect.unload();
			    $("select#fmRadioSelect").empty();
			  
				for (var i = 0; i < res.rd.length; i++)
				{

				 MySelect.add(res.rd[i].channel_name,res.rd[i].channel_name);

				}
			}
		   else if(res.rc == 2)
			{
				var MySelect = $('select#fmRadioSelect')[0].sumo;
				MySelect.unload();
				$("select#fmRadioSelect").empty();
				MySelect.add('','No channel found');

			}
			else
			{
				location.reload();
			}
			//FM channel select
           	$('select#fmRadioSelect').SumoSelect({
            csvDispCount: 4,
            search: true,
            searchText:'Enter here.',
            up:false});

			}
		});
	}
	else
	{
		var MySelect = $('select#fmRadioSelect')[0].sumo;
		MySelect.unload();
		$("select#fmRadioSelect").empty();
		MySelect.add('','No channel found');
		$('select#fmRadioSelect').SumoSelect({
            csvDispCount: 4,
            search: true,
            searchText:'Enter here.',
            up:false});
	}


});

// Load Related TV channels based on Language selection
$("body").on('change',"select#tvLanguageSelect", function(event){
	var token = "load_tv_channels";
	var selectedLangArray = new Array();
	$.each($("#tvLanguageSelect option:selected"), function(){

	selectedLangArray.push($(this).val());

	});
	if(selectedLangArray.length > 0 )
	{
	  $.ajax({
	  method: 'POST',
	  url: 'process',
	  data: {_token: token, langs: selectedLangArray},
	  success: function (data)
			{

			var res = jQuery.parseJSON(data);
			if(res.rc == 1)
			{
				
				var MySelect = $('select#tvChannelSelect')[0].sumo;
				MySelect.unload();
			    $("select#tvChannelSelect").empty();
			  
				for (var i = 0; i < res.rd.length; i++)
				{

				 MySelect.add(res.rd[i].channel_name,res.rd[i].channel_name);

				}
			}
		   else if(res.rc == 2)
			{
				var MySelect = $('select#tvChannelSelect')[0].sumo;
				MySelect.unload();
				$("select#tvChannelSelect").empty();
				MySelect.add('','No channel found');

			}
			else
			{
				location.reload();
			}
			//FM channel select
           	$('select#tvChannelSelect').SumoSelect({
            csvDispCount: 4,
            search: true,
            searchText:'Enter here.',
            up:false});

			}
		});
	}
	else
	{
		var MySelect = $('select#tvChannelSelect')[0].sumo;
		MySelect.unload();
		$("select#tvChannelSelect").empty();
		MySelect.add('','No channel found');
		$('select#tvChannelSelect').SumoSelect({
            csvDispCount: 4,
            search: true,
            searchText:'Enter here.',
            up:false});
	}


});
// Load Related Newspaper based on City selection
$("body").on('change',"select#npCitySelect", function(event){
	var token = "load_newspaper";
	var selectedCityArray = new Array();
	$.each($("#npCitySelect option:selected"), function(){

	selectedCityArray.push($(this).val());

	});
	if(selectedCityArray.length > 0 )
	{
	  $.ajax({
	  method: 'POST',
	  url: 'process',
	  data: {_token: token, cities: selectedCityArray},
	  success: function (data)
			{

			var res = jQuery.parseJSON(data);
			if(res.rc == 1)
			{
				
				var MySelect = $('select#npSelect')[0].sumo;
				MySelect.unload();
			    $("select#npSelect").empty();
			  
				for (var i = 0; i < res.rd.length; i++)
				{

				 MySelect.add(res.rd[i].newspaper,res.rd[i].newspaper);

				}
			}
		   else if(res.rc == 2)
			{
				var MySelect = $('select#npSelect')[0].sumo;
				MySelect.unload();
				$("select#npSelect").empty();
				MySelect.add('','No Newspaper Found');

			}
			else
			{
				location.reload();
			}
			//FM channel select
           	$('select#npSelect').SumoSelect({
            csvDispCount: 4,
            search: true,
            searchText:'Enter here.',
            up:false});

			}
		});
	}
	else
	{
		var MySelect = $('select#npSelect')[0].sumo;
		MySelect.unload();
		$("select#npSelect").empty();
		MySelect.add('','No Newspaper Found');
		$('select#npSelect').SumoSelect({
            csvDispCount: 4,
            search: true,
            searchText:'Enter here.',
            up:false});
	}


});
// Load Ad Size based on category
$("body").on('change',"select#npAdCatSelect", function(event){
	var token = "load_ad_sizes";
	var category = $('select#npAdCatSelect').val();
  if (category)
   {
	  $.ajax({
	  method: 'POST',
	  url: 'process',
	  data: {_token: token, category: category},
	  success: function (data)
			{

			var res = jQuery.parseJSON(data);
			if(res.rc == 1)
			{
				
				var MySelect = $('select#npAdSizeSelect')[0].sumo;
				MySelect.unload();
			    $("select#npAdSizeSelect").empty();
			  	MySelect.add('','Select Ad Size');
				for (var i = 0; i < res.rd.length; i++)
				{
					text = res.rd[i].replace(/\.[^/.]+$/, "")

				 	MySelect.add(res.rd[i],text);

				}

			}
			else
			{
				location.reload();
			}
			//FM channel select
           	$('select#npAdSizeSelect').SumoSelect({
            csvDispCount: 4,
            search: true,
            searchText:'Enter here.',
            up:false});

			}
		});
	}
	else
	{
		var MySelect = $('select#npAdSizeSelect')[0].sumo;
		MySelect.unload();
		$("select#npAdSizeSelect").empty();
		MySelect.add('','No Ad Size Found');
		$('select#npAdSizeSelect').SumoSelect({
            csvDispCount: 4,
            search: true,
            searchText:'Enter here.',
            up:false});
	}


});
// Load Ad Size Image based on value selcted
$("body").on('change',"select#npAdSizeSelect", function(event){

	var adCategory = $('select#npAdCatSelect').val();
	var adSize = $('select#npAdSizeSelect').val();
	var path = "assets/images/Ad_Size_pics/"+adCategory+"/"+adSize;
	  if (adSize)
	   {
	   	$('#adSizeImgDiv').show();
	   	$('#npAdSizeImg').attr('src',path);
	   }
	   if(adSize == '')
	   {
	   		$('#adSizeImgDiv').hide();
	   }


});
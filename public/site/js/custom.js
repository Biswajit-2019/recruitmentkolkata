$(document).ready(function(){
	var base_url = $('footer').data('baseurl');
	$("input:radio:checked").data("chk",true);
	//$('#closingDate').attr('readonly', true);
	//$('#casteAttachFile').hide();
	$('.star').each(function() {
        $(".star").css("color", "#f00");
    });
    if($('input[type=radio][name=category]').is(':checked')) {
			var category = $('input[type=radio][name=category]:checked').val();
        	if(category=='general'){
        		 $('#casteAttachFileHide').hide();
        	}else{
        		$('#casteAttachFileHide').show();
        	}         
        }else{
            $('#casteAttachFileHide').show();
        }
	$(document).on('keyup change','#advertiseNo,#dateOfBirth',function(){
		var advertiseNo = $('#advertiseNo').val();
		var dateOfBirth = $('#dateOfBirth').val();
			$.ajax({
				type: "POST",
				url: base_url+'/user/age_calculate/',
				data: {advertiseNo:advertiseNo,dateOfBirth:dateOfBirth},
				dataType: 'JSON',
				success: function (data) {
					console.log(data);
					if(data.status=='No')
					{
						$('#advertiseNoCheck').html(data.advertiseNoCheck);
						$( "#submit" ).prop( "disabled", false );
						$( "#submit" ).removeClass( "disabled");
						//$('#closingDate').val(data.format);
					}else{
						$('#advertiseNoCheck').html(data.advertiseNoCheck);
						$( "#submit" ).prop( "disabled", true );
						$( "#submit" ).addClass( "disabled");
						//$('#closingDate').val(data.format);
					}
					
				}
			});
		
	});
	$('#training-user-login').submit(function(event){
		event.preventDefault();
		if ($(this).valid()){
			var otp = $('#otp').val();
			if(!otp){
				var url = base_url+'/training/send_otp/';
			}else{
				var url = base_url+'/training/otp_verification/';
			}
			var form_data = new FormData(this);
			$.ajax({
				type: "POST",
				url: url,
				data: form_data,
				processData: false,
				cache: false,
				contentType: false,
				dataType: 'JSON',
				success: function (result) {
					//console.log(result);
					if(result.type=='send'){
						$('#email').attr('readonly', true);
						$('#btnAddProfile').text('SIGN IN');
						var html ='';
						html+='<div class="form-group">';
	                    html+='<label >OTP*</label>';
	                    html+='<input type="text" class="form-control" id="otp" name="otp" placeholder="OTP code" required="required" autocomplete="off"></div>';
	                    $('#form-group').html(html);
	                    $(document).find('.resendotp').show();
					}else{
						if(result.status==0){
							$('#message').html('<p class="errormessage">' + result.message + '</p>');
						}else{
							window.location.href = base_url+'/training/dashboard'; 
						}

					}
					
				}
			})
		}
	});
	$(document).on('click','#trainingResendOtp',function(){
		var email = $('#email').val();
		$.ajax({
				type: "POST",
				url: base_url+'/training/send_otp/',
				data: {email:email},
				dataType: 'JSON',
				success: function (result) {
					$(document).find('#message').html('<p class="successmessage">' + result.message + '</p>');
				}
			})

	});
	$('#user-login').submit(function(event){
		event.preventDefault();
		if ($(this).valid()){
			var otp = $('#otp').val();
			if(!otp){
				var url = base_url+'/login/send_otp/';
			}else{
				var url = base_url+'/login/otp_verification/';
			}
			var form_data = new FormData(this);
			$.ajax({
				type: "POST",
				url: url,
				data: form_data,
				processData: false,
				cache: false,
				contentType: false,
				dataType: 'JSON',
				success: function (result) {
					//console.log(result);
					if(result.type=='send'){
						$('#email').attr('readonly', true);
						$('#btnAddProfile').text('SIGN IN');
						var html ='';
						html+='<div class="form-group">';
	                    html+='<label >OTP*</label>';
	                    html+='<input type="text" class="form-control" id="otp" name="otp" placeholder="OTP code" required="required" autocomplete="off"></div>';
	                    $('#form-group').html(html);
	                    $(document).find('.resendotp').show();
					}else{
						if(result.status==0){
							$('#message').html('<p class="errormessage">' + result.message + '</p>');
						}else{
							window.location.href = base_url+'dashboard'; 
						}

					}
					
				}
			})
		}
	});
	$(document).on('click','#resendOtp',function(){
		var email = $('#email').val();
		$.ajax({
				type: "POST",
				url: base_url+'/login/send_otp/',
				data: {email:email},
				dataType: 'JSON',
				success: function (result) {
					$(document).find('#message').html('<p class="successmessage">' + result.message + '</p>');
				}
			})

	});
	$('#applicationForm').submit(function(event){
		var text = $('#applicationForm #submit').text();
		event.preventDefault();
		if ($(this).valid())
		{
			var form_data = new FormData(this);
			$.ajax({
				type: 'POST',
				url: base_url+'/user/create_application/',
				data: form_data,
				processData: false,
				cache: false,
				contentType: false,
				dataType: 'JSON',
				/*beforeSend: function (xhr, plainObject) {
					$('#applicationForm #submit').html("Processing...");
				},*/
				success: function (data)
				{
					console.log(data);
					$('#applicationForm #submit').text(text);
					if(data.status=='No')
					{
						if(data.message){
							$.each(data.message, function(key, value) {
								$(document).find('#'+key+'-error').remove();
								$(document).find('#'+key).after('<span id="'+key+'-error" class="error help-inline">'+value+'</span>');
							})
						}
						if(data.multipleErrorMessage){
							$.each(data.multipleErrorMessage, function(key, value) {
								$("span[id='"+key+"-error']").remove();
								$(document).find("input[name='"+key+"']").after('<span id="'+key+'-error" class="error help-inline">'+value+'</span>');
							})
						}
						if(data.radioErrorMessage){
							$.each(data.radioErrorMessage, function(key, value) {
								$("span[id='"+key+"-error']").remove();
								$(document).find('#'+key).after('<span id="'+key+'-error" class="error help-inline">'+value+'</span>');
							})
						}
						
					}else{
						window.location.href = base_url+'user/format_of_certificate';
					}
				}
			});
		}
	});
	$('#certificateForm').submit(function(event){
		var text = $('#certificateForm #certificateBtn').text();
		event.preventDefault();
		if ($(this).valid()){
			var form_data = new FormData(this);
			$.ajax({
				type: 'POST',
				url: base_url+'/user/update_certificate_form/',
				data: form_data,
				processData: false,
				cache: false,
				contentType: false,
				dataType: 'JSON',
				beforeSend: function (xhr, plainObject) {
					$('#certificateForm #certificateBtn').html("Processing...");
				},
				success: function (data)
				{
					console.log(data);
					$('#certificateForm #certificateBtn').text(text);
					if(data.status=='No')
					{
						if(data.message){
							$.each(data.message, function(key, value) {
								$(document).find('#'+key+'-error').remove();
								$(document).find('#'+key).after('<span id="'+key+'-error" class="error help-inline">'+value+'</span>');
							})
						}
					}else{
						window.location.href = base_url+'summary';
					}
				}
			});
		}
	});
	/*$('#summaryForm').submit(function(event){
		var text = $('#summaryForm #summaryBtn').text();
		event.preventDefault();
		$.ajax({
			type: 'POST',
			url: base_url+'/user/update_summary_form/',
			data: {},
			dataType: 'JSON',
			beforeSend: function (xhr, plainObject) {
				$('#certificateForm #certificateBtn').html("Processing...");
			},
			success: function (data)
			{
				console.log(data);
				$('#summaryForm #certificateBtn').text(text);
				if(data.status=='No')
				{
				}else{
					window.location.href = base_url+'dashboard/status';
				}
			}
		});
	});*/
	$('#summaryForm').submit(function(event){
		var text = $('#summaryForm #summaryBtn').text();
		event.preventDefault();
		if ($(this).valid())
		{
			var form_data = new FormData(this);
			$.ajax({
				type: 'POST',
				url: base_url+'/summary/update_summary_form/',
				data: form_data,
				processData: false,
				cache: false,
				contentType: false,
				dataType: 'JSON',
				beforeSend: function (xhr, plainObject) {
					$('#summaryForm #summaryBtn').html("Processing...");
				},
				success: function (data)
				{
					console.log(data);
					$('#summaryForm #summaryBtn').text(text);
					if(data.status=='No')
					{
						if(data.message){
							$.each(data.message, function(key, value) {
								$(document).find('#'+key+'-error').remove();
								$(document).find('#'+key).after('<span id="'+key+'-error" class="error help-inline">'+value+'</span>');
							})
						}
						if(data.radioErrorMessage){
							$.each(data.radioErrorMessage, function(key, value) {
								$("span[id='"+key+"-error']").remove();
								$(document).find('#'+key).after('<span id="'+key+'-error" class="error help-inline">'+value+'</span>');
							})
						}
					}else{
						window.location.href = base_url+'dashboard/thank-you?id='+data.application_no;
					}
				}
			});
		}
		
	});
	$(document).on('keyup change','input:file',function(){
			//var form_data = new FormData(document.getElementById($('form').attr('id')));
			var fileName = $(this).attr('name');
			//console.log(fileName);
			if(fileName=='refereesEmployProof1' || fileName=='formatOfCertificate' || fileName=='hq_certificate' || fileName=='certificate' || fileName=='birthDateProof' || fileName=='casteAttachFile' || fileName=='userImage' || fileName=='attachNoc'|| fileName=='attachNocFile'|| fileName=='refereesEmployProof'|| fileName=='signature'){
				var url = base_url+'/user/ajax_single_file_check/';	
			}else{
				var url = base_url+'/user/ajax_multiple_file_check/';
			}
			var formData = new FormData();
			$(this)[0].files[0];
			formData.append($(this).attr('name'), $(this)[0].files[0]);
			$.ajax({
				url: url,
				type:"post",
				data:formData,
        		processData: false,
        		contentType: false,
        		cache: false,
        		dataType: 'JSON',
				success: function(data){
					if(data.status=='No'){
						 $("span[id='"+fileName+"-error']").remove();				
							 $(document).find("input[name='"+fileName+"']").after('<span id="'+fileName+'-error" class="error help-inline">'+data.message+'</span>');
							 $(document).find("input[name='"+fileName+"']").val('');
					}else{
						$("span[id='"+fileName+"-error']").remove();
					}
				}
			});		
	})
	 $("input:radio").click(function(){
        $("input[name='"+$(this).attr("name")+"']:radio").not(this).removeData("chk");
        $(this).data("chk",!$(this).data("chk"));
        $(this).prop("checked",$(this).data("chk"));

       if($('input[type=radio][name=category]').is(':checked')) {
			var category = $('input[type=radio][name=category]:checked').val();
        	if(category=='general'){
        		 $('#casteAttachFileHide').hide();
        		  $("#casteAttachFile").prop("required", false);
        	}else{
        		$('#casteAttachFileHide').show();
        		$("#casteAttachFile").attr("required", "true");
        	}         
        }else{
            $('#casteAttachFileHide').show();
            $("#casteAttachFile").prop("required", false);
        }
    });
	 $(document).on('click','.addQualification',function(){
	 	var count = $(this).data('id');
	 	var id = $(this).val();
	 	var education = $('input[name^="education"]').map(function(){return $(this).val();}).get();
	 	//var file = $("input[name='educationCertificate["+id+"]']").map(function(){return $(this).val();}).get();
	 	var newval = education.filter(function(v){return v !=''});
	 	if(education.length != parseInt(newval.length)+parseInt(count)){
	 	}else{
	 		

	 	}
	 		var key = parseInt(id) +1;
		 	var rowCount = $('.qualificationList >.row').length;
		 	var incid= rowCount+1 ;
		 	var input= '';
		 	input +='<div class="row td-row"><div class="td-col"><input type="text" class="form-control" name="education['+key+'][examPassed]"  value="" required="" placeholder=""></div>';
		 	input +='<div class="td-col"><input type="text" class="form-control" name="education['+key+'][examBoard]" value="" required="" placeholder=""></div>';
		 	input +='<div class="td-col"><input type="text" class="form-control" name="education['+key+'][yearOfEnrolment]" value="" required="" placeholder=""></div>';
		 	input +='<div class="td-col"><input type="text" class="form-control" name="education['+key+'][yearOfCompletion]" value="" required="" placeholder=""></div>';
		 	input +='<div class="td-col"><input type="text" class="form-control" name="education['+key+'][subjectDegreeAwarded]" value="" required="" placeholder=""></div>';
		 	input +='<div class="td-col"><input type="text" class="form-control" name="education['+key+'][specialisationAdvt]" value="" required="" placeholder=""></div>';
		 	input +='<div class="td-col"><input type="text" class="form-control" name="education['+key+'][percentageOfMarks]" value="" required="" placeholder=""></div>';
		 	input +='<div class="td-col"><input type="text" class="form-control" name="education['+key+'][division]" value="" required="" placeholder=""></div>';
		 	input +='<div class="td-col"><input type="text" class="form-control" name="education['+key+'][rankPosotionInUniv]" value="" required="" placeholder=""></div>';
		 	input +='<div class="td-col"><input type="file" class="form-control addEducationCertificate" required="" name="educationCertificate['+key+']"  accept="application/pdf"><span class="text-placeholder">pdf - 1MB max</span><button type="button" class="btn btn-danger remove-me" >Remove</button></div></div>';
		 	$('.qualificationList').append(input);
		 	$('.addQualification').val(key);
	 	
	 });
	
	  $(document).on('click','.addProfessionalTraining',function(){
	  	var count = $(this).data('id');
	  	var id = $(this).val();
	  	var professional = $('input[name^="professionalTraining"]').map(function(){return $(this).val();}).get();
	  	var newval = professional.filter(function(v){return v !=''});
	  	if(professional.length != parseInt(newval.length)+parseInt(count)){
	 	}else{
	 		
	 	}
	 		var incid = parseInt(id) +1;
		 	var input= '';
		 	input +='<div class="row td-row"><div class="td-col"><input type="text" class="form-control"  name="professionalTraining['+incid+'][organisation]"  value="" placeholder=""></div>';
		 	input +='<div class="td-col"><input type="text" class="form-control" name="professionalTraining['+incid+'][periodFrom]"  value="" placeholder=""></div>';
		 	input +='<div class="td-col"><input type="text" class="form-control" name="professionalTraining['+incid+'][periodTo]"  value="" placeholder=""></div>';
		 	input +='<div class="td-col"><input type="text" class="form-control" name="professionalTraining['+incid+'][detailsOfTraining]"  value="" placeholder=""></div>';
		 	input +='<div class="td-col"><input type="file" class="form-control addProfessionalTrainingCertificate" name="professionalTrainingCertificate['+incid+']"  accept="application/pdf"><span class="text-placeholder">pdf - 1MB max</span><button type="button" class="btn btn-danger remove-me" >Remove</button></div></div>';
		 	$('.professionalTrainingList').append(input);
		 	$('.addProfessionalTraining').val(incid);
	 	
	  });
	  $(document).on('click','.addEmploymentRecord',function(){
	  	var count = $(this).data('id');
	  	var id = $(this).val();
	  	var employmentRecord = $('input[name^="employmentRecord"]').map(function(){return $(this).val();}).get();
	  	var newval = employmentRecord.filter(function(v){return v !=''});
	  	if(employmentRecord.length != parseInt(newval.length)+parseInt(count)){
	 	}else{
	 		
	 	}
	 		var incid = parseInt(id) +1;
		 	var input= '';
		 	input +='<div class="row td-row"><div class="td-col"><input type="text" class="form-control" name="employmentRecord['+incid+'][name]" value="" placeholder=""></div>';
		 	input +='<div class="td-col"><input type="text" class="form-control" name="employmentRecord['+incid+'][periodOfServiceFrom]"  value="" placeholder=""></div>';
		 	input +='<div class="td-col"><input type="text" class="form-control" name="employmentRecord['+incid+'][periodOfServiceTo]"  value="" placeholder=""></div>';
		 	input +='<div class="td-col"><input type="text" class="form-control" name="employmentRecord['+incid+'][designation]"  value="" placeholder=""></div>';
		 	input +='<div class="td-col"><input type="text" class="form-control" name="employmentRecord['+incid+'][scaleOfPayOfEachPost]"  value="" placeholder=""></div>';
		 	input +='<div class="td-col"><input type="text" class="form-control" name="employmentRecord['+incid+'][brief]"  value="" placeholder=""></div>';
		 	input +='<div class="td-col"><input type="text" class="form-control" name="employmentRecord['+incid+'][reasonForLeaving]"  value="" placeholder=""></div>';
		 	input +='<div class="td-col"><input type="file" class="form-control addEmploymentRecordCertificate" name="employmentRecordCertificate['+incid+']"  accept="application/pdf"><span class="text-placeholder">pdf - 1MB max</span><button type="button" class="btn btn-danger remove-me" >Remove</button></div></div>';
		 	$('.employmentRecordList').append(input);
		 	$('.addEmploymentRecord').val(incid);
	 	
	  });
	   $(document).on('click','.remove-me',function(){
	 	$(this).parent().closest('.row').remove();
	 });
	    $.validator.addMethod("dateFormat",function(value, element) {
			var re = /^([0]?[1-9]|[1|2][0-9]|[3][0|1])[./-]([0]?[1-9]|[1][0-2])[./-]([0-9]{4}|[0-9]{2})$/ ; 
			if (! re.test(value) ) return false
			// parseDate throws exception if the value is invalid
			try{jQuery.datepicker.parseDate( 'dd-mm-yy', value);return true ;}
			catch(e){
				return false;} 
			},
			"Please enter a valid date format dd-mm-yyyy"
			);
	  $("#summaryForm").validate({
	  	 errorElement: 'span',
	  	 errorClass: 'error help-inline',
	  	 rules: {
        	advertiseNo:{
        		required:true,
        		remote :  base_url+'/user/check_advt_no/'
        	},
        	discipline:{
        		required:true,
        	},
        	post:{
        		required:true,
        	},
        	postCode:{
        		required:true,
        	},
        	name:{
        		required:true,
        	},
        	dateOfBirth:{
        		required:true,
        		dateFormat: true,
        	},
        	nationality:{
        		required:true,
        	},
        	closingDate:{
        		required:true,
        	},
        	examUniversityRank:{
        		required:true,
        	},
        	university:{
        		required:true,
        	},
        	subject:{
        		required:true,
        	},
        	month:{
        		required:true,
        	},
        	year:{
        		required:true,
        	},
        	average:{
        		required:true,
        	},
        	grade:{
        		required:true,
        	},
        	certificate:{
        		required:true,
        		extension: "pdf",
        	},
        	hq_examUniversityRank:{
        		required:true,
        	},
        	hq_university:{
        		required:true,
        	},
        	hq_subject:{
        		required:true,
        	},
        	hq_month:{
        		required:true,
        	},
        	hq_year:{
        		required:true,
        	},
        	hq_average:{
        		required:true,
        	},
        	hq_grade:{
        		required:true,
        	},
        	hq_certificate:{
        		required:true,
        		extension: "pdf",
        	},        	
        	postalAddressCommunication:{
        		required:true,
        	},
        	pin:{
        		required:true,
        	},
        	mobile:{
				required: true,
				number: true,
				minlength: 10,
				maxlength: 10
        	},
        	email:{
        		required:true,
        		email: true
        	},
        },
		  messages: {
	        	advertiseNo: {
	              required: "This field is required.",
	              remote :"Advt. No. not valid."
	            },
	           
	        },
	        errorPlacement: function(error, element) {
	            if (element.is(":radio")){
	                error.appendTo(element.parents('.radio'));
	            }else{
	                error.insertAfter(element);
	            }
	        }
	     });
	 

	 $("#applicationForm").validate({
         errorElement: 'span',
        errorClass: 'error help-inline',
        rules: {
        	advertiseNo:{
        		required:true,
        		remote :  base_url+'/user/check_advt_no/'
        	},
        	postFor:{
        		required:true,
        	},
        	discipline:{
        		required:true,
        	},
        	postCode:{
        		required:true,
        	},
        	name:{
        		required:true,
        	},
        	closingDate:{
        		required:true,
        	},
        	dateOfBirth:{
        		required:true,
        		dateFormat: true,
        	},
            sex:{
                required:true,
            },
            maritalStatus: {
                required:true,
            },
            nationality:{
            	required:true,
            },
           
            address:{
            	required:true,
            },
            permanentAddress:{
            	required:true,
            },
            conditionAccept:{
            	required:true,
            }

        },
        messages: {
        	advertiseNo: {
              required: "This field is required.",
              remote :"Advt. No. not valid."
            },
           
        },
        errorPlacement: function(error, element) {
            if (element.is(":radio")){
                error.appendTo(element.parents('.radio'));
            }else{
                error.insertAfter(element);
            }
        }
     });
     $('.addUserImage').each(function() {
	        $(this).rules("add", {
	        	required: true,
	            extension: "jpg|jpeg|png",
	            messages: {
	                required: "This field is required."
	            }
	        });
    	});
     $('.editUserImage').each(function() {
	        $(this).rules("add", {
	            extension: "jpg|jpeg|png",
	            messages: {
	                required: "This field is required."
	            }
	        });
    	});
      $('.addBirthDateProof').each(function() {
	        $(this).rules("add", {
	        	required: true,
	            extension: "pdf",
	            messages: {
	                required: "This field is required."
	            }
	        });
    	});
     $('.editBirthDateProof').each(function() {
	        $(this).rules("add", {
	            extension: "pdf",
	            messages: {
	                required: "This field is required."
	            }
	        });
    	});
     
     
     
     
     $('.addRefereesEmployProof').each(function() {
	        $(this).rules("add", {
	        	//required: true,
	            extension: "pdf",
	            messages: {
	                required: "This field is required."
	            }
	        });
    	});
     $('.editRefereesEmployProof').each(function() {
	        $(this).rules("add", {
	            extension: "pdf",
	            messages: {
	                required: "This field is required."
	            }
	        });
    	});
     $('.addRefereesEmployProof1').each(function() {
	        $(this).rules("add", {
	        	//required: true,
	            extension: "pdf",
	            messages: {
	                required: "This field is required."
	            }
	        });
    	});
     $('.editRefereesEmployProof1').each(function() {
	        $(this).rules("add", {
	            extension: "pdf",
	            messages: {
	                required: "This field is required."
	            }
	        });
    	});
      $('.addSignature').each(function() {
	        $(this).rules("add", {
	        	required: true,
	            extension: "jpg|jpeg|png",
	            messages: {
	                required: "This field is required."
	            }
	        });
    	});
     $('.editSignature').each(function() {
	        $(this).rules("add", {
	            extension: "jpg|jpeg|png",
	            messages: {
	                required: "This field is required."
	            }
	        });
    	});
     /* Educational Qualifications Validation*/  
    var education = $('input[name^="education"]');
      	education.filter('input[name$="[examPassed]"]').each(function() {
	        $(this).rules("add", {
	            required: true,
	            messages: {
	                required: "This field is required."
	            }
	        });
    	});
    	education.filter('input[name$="[examBoard]"]').each(function() {
	        $(this).rules("add", {
	            required: true,
	            messages: {
	                required: "This field is required."
	            }
	        });
    	});
    	education.filter('input[name$="[yearOfEnrolment]"]').each(function() {
	        $(this).rules("add", {
	            required: true,
	            messages: {
	                required: "This field is required."
	            }
	        });
    	});
    	education.filter('input[name$="[yearOfCompletion]"]').each(function() {
	        $(this).rules("add", {
	            required: true,
	            messages: {
	                required: "This field is required."
	            }
	        });
    	});
    	education.filter('input[name$="[subjectDegreeAwarded]"]').each(function() {
	        $(this).rules("add", {
	            required: true,
	            messages: {
	                required: "This field is required."
	            }
	        });
    	});
    	education.filter('input[name$="[specialisationAdvt]"]').each(function() {
	        $(this).rules("add", {
	            required: true,
	            messages: {
	                required: "This field is required."
	            }
	        });
    	});
    	education.filter('input[name$="[percentageOfMarks]"]').each(function() {
	        $(this).rules("add", {
	            required: true,
	            messages: {
	                required: "This field is required."
	            }
	        });
    	});
    	education.filter('input[name$="[division]"]').each(function() {
	        $(this).rules("add", {
	            required: true,
	            messages: {
	                required: "This field is required."
	            }
	        });
    	});
    	education.filter('input[name$="[rankPosotionInUniv]"]').each(function() {
	        $(this).rules("add", {
	            required: true,
	            messages: {
	                required: "This field is required."
	            }
	        });
    	});

    	 $('.addEducationCertificate').each(function() {
	        $(this).rules("add", {
	            required: true,
	            extension: "pdf",
	            messages: {
	                required: "This field is required."
	            }
	        });
    	});

    	$('.editEducationCertificate').each(function() {
	        $(this).rules("add", {
	            extension: "pdf",
	            messages: {
	                required: "This field is required."
	            }
	        });
    	});
    	
    	 /* Educational Qualifications Validation End*/

    	  

});
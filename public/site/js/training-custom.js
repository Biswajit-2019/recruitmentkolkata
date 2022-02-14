$(document).ready(function(){
	$('#golTrainee').hide();
	var base_url = $('footer').data('baseurl');
	$('.star').each(function() {
        $(".star").css("color", "#f00");
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
	$(document).on('keyup change','input:file',function(){
			var fileName = $(this).attr('name');
			var url = base_url+'/training/ajax_single_file_check/';	
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
					if(data!=''){
						if(data.status=='No'){
							 $("span[id='"+fileName+"-error']").remove();				
								 $(document).find("input[name='"+fileName+"']").after('<span id="'+fileName+'-error" class="error help-inline">'+data.message+'</span>');
								 $(document).find("input[name='"+fileName+"']").val('');
						}else{
							$("span[id='"+fileName+"-error']").remove();
						}
					}
					
				}
			});		
	});
	$('#trainingApplicationForm').submit(function(event){
		var text = $('#trainingApplicationForm #submit').text();
		event.preventDefault();
		if ($(this).valid())
		{
			var form_data = new FormData(this);
			$.ajax({
				type: 'POST',
				url: base_url+'/training/update_training_form/',
				data: form_data,
				processData: false,
				cache: false,
				contentType: false,
				dataType: 'JSON',
				beforeSend: function (xhr, plainObject) {
					$('#trainingApplicationForm #submit').prop('disabled', true);
					$('#trainingApplicationForm #submit').html("Processing...");
				},
				success: function (data)
				{
					console.log(data);
					$('#trainingApplicationForm #submit').text(text);
					$('#trainingApplicationForm #submit').prop('disabled', false);
					if(data!=''){
						if(data.status=='No')
						{
							if(data.message){
								$.each(data.message, function(key, value) {
									$(document).find('#'+key+'-error').remove();
									$(document).find('#'+key).after('<span id="'+key+'-error" class="error help-inline">'+value+'</span>');
								})
							}

						}else{
							window.location.href = base_url+'training/thank-you';
						}

					}
					
				}
			});
		}
	});
	$(document).on('keyup change','#applying',function(){
		var applyingId = $(this).val();
		if(applyingId==4 || applyingId==5){
			$('#golTrainee').show();
			$('#nonGolTrainee').hide();
		}else{
			$('#golTrainee').hide();
			$('#nonGolTrainee').show();
		}
	});
	 $("#trainingApplicationForm").validate({
	 	errorElement: 'span',
	 	errorClass: 'error help-inline',
	 	 rules: {
        	candidateName:{
        		required:true
        	},
        	institutionName:{
        		required:true
        	},
        	qualification:{
        		required:true
        	},
        	contact:{
        		required: true,
				number: true,
				minlength: 10,
				maxlength: 10
        	},
        	email:{
        		required:true
        	},
        	applying:{
        		required:true,
        		remote :  base_url+'/training/check_applying/'
        	},
        	permanentAddress:{
        		required:true
        	},
        	messages:{
        		required:true
        	},   	
        	uploadResume:{
        		required:true,
        		extension: "pdf",
        	},
        	document1:{
        		required:true,
        		extension: "pdf",
        	},
        	document2:{
        		required:true,
        		extension: "pdf",
        	},
        	markSheet:{
        		required:true,
        		extension: "pdf",
        	},
        	certificate:{
        		required:true,
        		extension: "pdf",
        	},
        },
        messages: {
        	applying: {
	              required: "This field is required.",
	              remote :"you have already applied."
	            },
        }
	 });
});

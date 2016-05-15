$(document).ready(function(){
		$.ajaxSetup({
        cache: false
    });
		 $('.modal-trigger').leanModal();
	//Side nav active
	$(".sideNavDash li").click(function(){
		$(".sideNavDash li").removeClass("active");
		$(this).addClass("active");
	});
	//Initialize select
	$('select').material_select();
	$('ul.tabs').tabs();
	// Initialize slider
	$('.slider').slider( {height: 500} );
	// Initialize collapse button
	  $(" .nav-wrapper-index-hp .button-collapse").sideNav();
	  // Initialize collapsible (uncomment the line below if you use the dropdown variation)
	  //$('.collapsible').collapsible();

	  //Search Button Home Page
	  $('#searchbtn').click(function(){
	  		$("#hpnav").addClass("hide");
	  		$("#searchbar").removeClass("hide");
	  });
	  $("#searchbtnclose").click(function(){
	  		$("#searchbar").addClass("hide");
	  		$("#hpnav").removeClass("hide");
	  });

	  // Faculty Page Login Register Switch Animation
	  $("#faculty_registerbtn").click(function(){
	  		$("#faculty_login").slideUp();
	  		$("#faculty_register").slideDown();
	  		$("#login_register").text("Register");
	  		$("#faculty_login")[0].reset();
	  		$("#faculty_login input").closest(".input-field").find("label").removeClass("active");
	  });
	  $("#faculty_loginbtn").click(function(){
	  		$("#faculty_register").slideUp();
	  		$("#faculty_login").slideDown();
	  		$("#login_register").text("Login");
	  		$("#faculty_register")[0].reset();
	  		$("#faculty_register input").closest(".input-field").find("label").removeClass("active");
	  });
	  
	  //Faculty Register on blur
	  $("#faculty_register input").blur(function(){
	  		var trimmed = $(this).val().trim();
	  		//Blank input validation
	  		if( trimmed == ""){
	  			$(this).addClass("invalid");
	  			$(this).closest(".input-field").find("label").attr("data-error","This field is required").addClass("active");
	  		}
	  		//First name validation
	  		else if( $(this).attr("id") == "first_name"){
	  			if( !$.trim( $(this).val() ).match(/([A-Za-z']+( [A-Za-z']+)*){3,30}$/) ){
	  				$(this).addClass("invalid");
	  				$(this).closest(".input-field").find("label").attr("data-error","Enter a valid name").addClass("active");
	  			}
	  		}
	  		//Last name validation
	  		else if( $(this).attr("id") == "last_name" ){
	  			if( !$.trim( $(this).val() ).match(/([A-Za-z']+( [A-Za-z']+)*){3,30}$/) ){
	  				$(this).addClass("invalid");
	  				$(this).closest(".input-field").find("label").attr("data-error","Enter a valid name").addClass("active");
	  			}
	  		}
	  		//Employee Id validation
	  		else if( $(this).attr("id") == "employee_id" ){
	  			if( !$.trim( $(this).val() ).match(/(\d{4})\-(\d{3})/) || $.trim( $(this).val() ).length == 9){
	  				$(this).addClass("invalid");
	  				$(this).closest(".input-field").find("label").attr("data-error","Enter a valid Id").addClass("active");
	  			}
	  		}
	  		//Password validation
	  		else if( $(this).attr("id") == "password" ){
	  			if( !$.trim( $(this).val() ).match(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/) ){
	  				$(this).addClass("invalid");
	  				$(this).closest(".input-field").find("label").attr("data-error","Characeter length is at least 8 with at least one upper case letter, one lower case letter, and one digit").addClass("active");
	  			}
	  		}
	  		//Re-type password validation
	  		else if( $(this).attr("id") == "repassword" ){
	  			if( $(this).val() !== $("#password").val() ){
	  				$(this).addClass("invalid");
	  				$(this).closest(".input-field").find("label").attr("data-error","Password does not match").addClass("active");
	  			}
	  		}
	  });

	  //Faculty Register on submit
	  $("#faculty_register").submit(function(e){
	  	e.preventDefault();
	  	//Check if input values are blank on submit
	  	$('#faculty_register input').each(function(){
			var trimmed = $(this).val().trim();
	  		if( trimmed == ""){
	  			$(this).addClass("invalid");
	  			$(this).closest(".input-field").find("label").attr("data-error","This field is required").addClass("active");
	  		}
		});

	  	//Check if all input has a class of VALID
	  	if( !$("#faculty_register input").hasClass("invalid") ){
	  		//ajax starts here
			
	  		$.ajax({
	  			type: "POST",
	  			url: "sql.php",
	  			data: $("#faculty_register").serialize(),
	  			success: function(data){
	  				var obj = JSON.parse(data);
	  				if( obj.success ){
	  					$("#facultysuccess").html(  "Account has been created. Please <a href='portal-signin.php'>Login</a>");
	  					$('#modal1').openModal();
	  					$("#faculty_register")[0].reset();

	  				}else{
	  					if( obj.errors.email ){
		  					$("#email").addClass("invalid");
		  					$("#email").closest(".input-field").find("label").attr("data-error",obj.errors.email).addClass("active");
		  				}
		  				if( obj.errors.employee_id ){
		  					$("#employee_id").addClass("invalid");
		  					$("#employee_id").closest(".input-field").find("label").attr("data-error",obj.errors.employee_id).addClass("active");
		  				}
		  				if( obj.errors.employee_id_notreg ){
		  					$("#employee_id").addClass("invalid");
		  					$("#employee_id").closest(".input-field").find("label").attr("data-error",obj.errors.employee_id_notreg).addClass("active");
		  				}
		  			
	  				}
	  				
	  				
	  			}

	  		});
			



	  	}

	  });//end of submit 

	//Faculty Login
	$("#faculty_login").submit(function(e){
		e.preventDefault();
		//Check if input values are blank on submit
		$('#faculty_login input').each(function(){
			var trimmed = $(this).val().trim();
	  		if( trimmed == ""){
	  			$(this).addClass("invalid");
	  			$(this).closest(".input-field").find("label").attr("data-error","This field is required").addClass("active");
	  		}
		});
		//Check if all input has a class of VALID
	  	if( !$("#faculty_login input").hasClass("invalid") ){
			$.ajax({
				type: "POST",
				url: "../sql.php",
				data: $("#faculty_login").serialize(),
				success: function(data){
					var obj = JSON.parse(data);
					if( obj.success ){
						$("#loginalert").addClass("hide");
						window.location.href = "faculty/dashboard.php";
	  				}else{
	  					if( obj.errors.faculty_login ){
	  						$("#faculty_empid_login").addClass("invalid");
	  						$("#faculty_password_login").addClass("invalid");
	  						$("#faculty_empid_login").closest(".input-field").find("label").attr("data-error","").addClass("active");
	  						$("#faculty_password_login").closest(".input-field").find("label").attr("data-error","").addClass("active");
	  						$("#loginalert").html(obj.errors.faculty_login);
	  						$("#loginalert").removeClass("hide");
	  						$("#loginalert").addClass("show")

	  					}
	  				}

				}

			});
		}
	});//end of submit
	//Faculty 
	$('.nav-wrapper-faculty a.button-collapse').sideNav({
	      menuWidth: 300, // Default is 240
	      closeOnClick: true
	    }
	);
	$(".faculty-search").click(function(e){
		e.preventDefault();
		$(".nav-wrap-show").addClass("hide");
		$("#search-faculty-content").removeClass("hide");
	})	  	
	$(".close-search-faculty").click(function(){
		$(".nav-wrap-show").removeClass("hide").addClass("show");
		$("#search-faculty-content").removeClass("show").addClass("hide");
		$("#search-faculty-content")[0].reset()
	});


	//Login Alert on focus
	$("#faculty_empid_login").focus(function(){
		$("#loginalert").removeClass("show");
		$("#loginalert").addClass("hide");
	});
		$("#faculty_password_login").focus(function(){
		$("#loginalert").removeClass("show");
		$("#loginalert").addClass("hide");
	});





	//Faculty Profile
	//Faculty Account info
	//Show password
	$(".show-password-faculty").click(function(e){
		e.preventDefault();
		$(".show-password-faculty .fa-eye-faculty").removeClass("visible-input").addClass("hidden-input");
		$(".hide-password-faculty .fa-eye-slash-faculty").removeClass("hidden-btn").addClass("visible-input");
		$("#faculty-new-pass-input").prop('type', 'text');
	});
	$(".hide-password-faculty").click(function(e){
		e.preventDefault();
		$(".show-password-faculty .fa-eye-faculty").removeClass("hidden-input").addClass("visible-input");
		$(".hide-password-faculty .fa-eye-slash-faculty").removeClass("visible-input").addClass("hidden-btn");
		$("#faculty-new-pass-input").prop('type', 'password');
	});	
	$(".update-account-info-btn-faculty").click(function(e){
		e.preventDefault();
		$(".save-account-info-btn-faculty").removeClass("hidden-input").addClass("visible-input");
		$(".cancel-account-info-btn-faculty").removeClass("hidden-input").addClass("visible-input");
		$(".update-account-info-btn-faculty").removeClass("visible-input").addClass("hidden-input");
		$("#account-info-faculty .account-info-data-faculty .hidden-input").removeClass("hidden-input").addClass("visible-input");
		$("#account-info-faculty .account-info-data-faculty .grey-info").removeClass("visible-input").addClass("hidden-input");
		$("#faculty-avatar-form").removeClass("hidden-input").addClass("visible-input");
		$(".fa-eye-slash-faculty").removeClass("visible-input").addClass("hidden-btn");
		$("#faculty-empid").removeClass("visible-input").addClass("hidden-input");
		$("#faculty-password").removeClass("visible-input").addClass("hidden-input");
	});
	// Faculty profile basic information input hidden - visible 
	$(".basic-info-btn-edit-faculty").click(function(e){
		e.preventDefault();
		$(".basic-info-btn-save-faculty").removeClass("hidden-input").addClass("visible-input");
		$(".basic-info-btn-back-faculty").removeClass("hidden-input").addClass("visible-input");
		$(".basic-info-btn-edit-faculty").removeClass("visible-input").addClass("hidden-input");
		$("#basic-information-faculty .basic-info-data-faculty .hidden-input").removeClass("hidden-input").addClass("visible-input");
		$("#basic-information-faculty .basic-info-data-faculty .grey-info").removeClass("visible-input").addClass("hidden-input");
		$("#complete-name-faculty").removeClass("visible-input").addClass("hidden-input");
		$("#gender-faculty").removeClass("visible-input").addClass("hidden-input");
		$("#dob-faculty").removeClass("visible-input").addClass("hidden-input");
		$("#address-faculty").removeClass("visible-input").addClass("hidden-input");
	});
	// Faculty profile contanct information input hidden - visible
	$(".contact-info-btn-edit-contact-faculty").click(function(e){
		e.preventDefault();
		$(".contact-info-btn-save-contact-faculty").removeClass("hidden-input").addClass("visible-input");
		$(".contact-info-btn-back-contact-faculty").removeClass("hidden-input").addClass("visible-input");
		$(".contact-info-btn-edit-contact-faculty").removeClass("visible-input").addClass("hidden-input");
		$("#contact-information-faculty .contact-info-data-faculty .hidden-input").removeClass("hidden-input").addClass("visible-input");
		$("#contact-information-faculty .contact-info-data-faculty .grey-info").removeClass("visible-input").addClass("hidden-input");
		$("#position-faculty").removeClass("visible-input").addClass("hidden-input");
		$("#email-faculty").removeClass("visible-input").addClass("hidden-input");
		$("#phone-faculty").removeClass("visible-input").addClass("hidden-input");
	});
	$.ajax({
		type: "POST",
		url: "../faculty/function.php",
		success: function(data){
			obj = JSON.parse(data);
			if( obj.facultyProfileInfo.employee_id == ""){
				$(".empid-faculty-grey").removeClass("hidden-input").addClass("visible-input");
			}else{
				$(".empid-faculty-grey").removeClass("visible-input").addClass("hidden-input");
				$("#faculty-empid").html(" " + obj.facultyProfileInfo.employee_id).addClass("black-text");
				$("#faculty-empid-input").val(obj.facultyProfileInfo.employee_id);
				$("#faculty-empid-nav").text(obj.facultyProfileInfo.employee_id);
			}
			if( obj.facultyProfileInfo.password == ""){
				$(".password-faculty-grey").removeClass("hidden-input").addClass("visible-input");
			}else{
				var $asterisk = obj.facultyProfileInfo.password.replace(/./g, '*');
				$(".password-faculty-grey").removeClass("visible-input").addClass("hidden-input");
				$("#faculty-password").html(" " + $asterisk).addClass("black-text");
			}
			if( obj.facultyProfileInfo.firstname === "" && obj.facultyProfileInfo.middlename === "" && obj.facultyProfileInfo.lastname === ""){
				$(".complete-namefaculty").removeClass("hidden-input").addClass("visible-input");
			}else{
				$(".complete-namefaculty").removeClass("visible-input").addClass("hidden-input");
				$("#complete-name-faculty").html(obj.facultyProfileInfo.firstname + " " + obj.facultyProfileInfo.middlename + " " + obj.facultyProfileInfo.lastname);
				$("#firstnm-faculty").val(obj.facultyProfileInfo.firstname);
				$("#middlenm-faculty").val(obj.facultyProfileInfo.middlename);
				$("#lastnm-faculty").val(obj.facultyProfileInfo.lastname);
			}
			if( obj.facultyProfileInfo.gender == ""){
				$(".gender-grey-faculty").removeClass("hidden-input").addClass("visible-input");
			}else{
				$(".gender-grey-faculty").removeClass("visible-input").addClass("hidden-input");
				$("#gender-faculty").html(" " + obj.facultyProfileInfo.gender);
				$("#gender-faculty-input").val(obj.facultyProfileInfo.gender);
			}
			if( obj.facultyProfileInfo.dob == ""){
				$(".dob-grey-faculty").removeClass("hidden-input").addClass("visible-input");
			}else{
				$(".dob-grey-faculty").removeClass("visible-input").addClass("hidden-input");
				$("#dob-faculty-input").val(obj.facultyProfileInfo.dob);
					dob = obj.facultyProfileInfo.dob;
					day = dob.substring(3, 5);
					year = dob.substring(6, 10);
					var month;
					if( dob.substring(0, 2) == 01 ){
						month = "January";
					}
					if( dob.substring(0, 2) == 02 ){
						month = "February";
					}
					if( dob.substring(0, 2) == 03 ){
						month = "March";
					}
					if( dob.substring(0, 2) == 04 ){
						month = "April";
					}
					if( dob.substring(0, 2) == 05 ){
						month = "May";
					}
					if( dob.substring(0, 2) == 06 ){
						month = "June";
					}
					if( dob.substring(0, 2) == 07 ){
						month = "July";
					}
					if( dob.substring(0, 2) == 08 ){
						month = "August";
					}
					if( dob.substring(0, 2) == 09 ){
						month = "September";
					}
					if( dob.substring(0, 2) == 10 ){
						month = "October";
					}
					if( dob.substring(0, 2) == 11 ){
						month = "November";
					}
					if( dob.substring(0, 2) == 12 ){
						month = "December";
					}
				$("#dob-faculty").html(" " + month + " " + day + ", " + year);

			}
			if( obj.facultyProfileInfo.address == ""){
				$(".address-grey-faculty").removeClass("hidden-input").addClass("visible-input");
			}else{
				$(".address-grey-faculty").removeClass("visible-input").addClass("hidden-input");
				$("#address-faculty").html(" " + obj.facultyProfileInfo.address);
				$("#address-faculty-input").val(obj.facultyProfileInfo.address);
			}
			if( obj.facultyProfileInfo.position == ""){
				$(".position-grey-faculty").removeClass("hidden-input").addClass("visible-input");
			}else{
				$(".position-grey-faculty").removeClass("visible-input").addClass("hidden-input");
				$("#position-faculty").html(" " + obj.facultyProfileInfo.position + " in CC Smart Kidz");
				$("#position-faculty-input").val(obj.facultyProfileInfo.position);
			}
			if( obj.facultyProfileInfo.email == ""){
				$(".email-grey-faculty").removeClass("hidden-input").addClass("visible-input");
			}else{
				$(".email-grey-faculty").removeClass("visible-input").addClass("hidden-input");
				$("#email-faculty").html(" " + obj.facultyProfileInfo.email);
				$("#email-faculty-input").val(obj.facultyProfileInfo.email);
			}
			if( obj.facultyProfileInfo.phone == ""  ){
				$(".phone-grey-faculty").removeClass("hidden-input").addClass("visible-input");
			}else{
				$(".phone-grey-faculty").removeClass("visible-input").addClass("hidden-input");
				$("#phone-faculty").html(" " + obj.facultyProfileInfo.phone);
				$("#phone-faculty-input").val(obj.facultyProfileInfo.phone);
			}
			if( obj.facultyProfileInfo.image_src == "" ){
				$(".profile-faculty-avatar-default").removeClass("hidden-input").addClass("visible-input");
			}else{
				$(".profile-faculty-avatar-default").removeClass("visible-input").addClass("hidden-input");
				$(".profile-faculty-avatar").removeClass("hidden-input").addClass("visible-input");
				$(".profile-faculty-avatar").attr("src", obj.facultyProfileInfo.image_src);
				$(".faculty-avatar-img").attr("src", obj.facultyProfileInfo.image_src);
			}

			// Save account information btn
			$(".save-account-info-btn-faculty").click(function(e){
				e.preventDefault();
				if( $("#faculty-new-pass-input").val() !== ""){
					if( $("#faculty-old-pass-input").val() !== obj.facultyProfileInfo.password ){
						$("#faculty-old-pass-input").removeClass("valid").addClass("invalid");
						$(".err-old-pass-faculty").html("<i class='fa fa-exclamation-triangle fa-lg'></i>&nbsp;&nbsp;&nbsp;Incorrect password. ");
					}else{
						$("#faculty-old-pass-input").removeClass("invalid").addClass("valid");
						$(".err-old-pass-faculty").html("");
						if( $("#faculty-new-pass-input").val() === obj.facultyProfileInfo.password ){
							$("#faculty-new-pass-input").removeClass("valid").addClass("invalid");
							$(".err-new-pass-faculty").html("<i class='fa fa-exclamation-triangle fa-lg'></i>&nbsp;&nbsp;&nbsp;New password must not match the current password. ");
						}else{
							$("#faculty-new-pass-input").removeClass("invalid").addClass("valid");
							if( !$.trim( $("#faculty-new-pass-input").val() ).match(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/) ){
								$("#faculty-new-pass-input").removeClass("valid").addClass("invalid");
								$(".err-new-pass-faculty").html("<i class='fa fa-exclamation-triangle fa-lg'></i>&nbsp;&nbsp;&nbsp;New password characeter length is at least 8 with at least one upper case letter, one lower case letter, and one digit ");	
							}else{
								$("#faculty-new-pass-input").removeClass("invalid").addClass("valid");
								$(".err-new-pass-faculty").html("");
								$(".err-old-pass-faculty").html("");
								$(".success-new-pass-faculty").html("<i class='fa fa-check-circle'></i>&nbsp;&nbsp;&nbsp;Password successfully changed. Plese re-login <a href='../logout.php'>here</a>");		
								$.ajax({
									type: "POST",
									url: "../faculty/function.php",
									data: {
										faculty_new_pass: $("#faculty-new-pass-input").val(),
									},
									success: function(data){
										if( data.success ){
											$(".faculty-password-update").removeClass("hidden-input").addClass("visible-input");
										}
									}
								});
							}
						}
					}
				
				}
			});	// end of save button account info
			//Faculty account info cancel btn
			$(".cancel-account-info-btn-faculty").click(function(e){
				e.preventDefault();
				// Load default info from database
				$(".save-account-info-btn-faculty").removeClass("visible-input").addClass("hidden-input");
				$(".cancel-account-info-btn-faculty").removeClass("visible-input").addClass("hidden-input");
				$(".update-account-info-btn-faculty").removeClass("hidden-input").addClass("visible-input");
				$("#faculty-avatar-form").removeClass("visible-input").addClass("hidden-input");
				$("#account-info-faculty .account-info-data-faculty .visible-input").removeClass("visible-input").addClass("hidden-input");
				$("#faculty-empid-input").val(obj.facultyProfileInfo.employee_id);
				$("#faculty-avatar-form").get(0).reset();
				$("#faculty-old-pass-input").val("");
				$("#faculty-new-pass-input").val("");
				$(".success-msg-account-info-faculty").html("");
				$(".error-msg-account-info-faculty").html("");
				$(".account-info-data-faculty input.hidden-input").removeClass("valid invalid");
				if( $("#faculty-empid-input").val() === "" ){
					$(".empid-faculty-grey").removeClass("hidden-input").addClass("visible-input");
				}else{
					$(".empid-faculty-grey").removeClass("visible-input").addClass("hidden-input");
					$("#faculty-empid").removeClass("hidden-input").addClass("visible-input");
				}
				$("#faculty-password").removeClass("hidden-input").addClass("visible-input");
			});
			//Faculty avatar
			$("#faculty-avatar-form").submit(function(e){
				e.preventDefault();
				if( $("#faculty_avatar-input")[0].files.length == 0 ){

				}else{
					$.ajax({
			        	url: "../faculty/upload.php",
						type: "POST",
						data:  new FormData(this),
						contentType: false,
			    	    cache: false,
						processData:false,
						success: function(data){
							obj = JSON.parse(data);
							if(obj.img_src_faculty == true){
								$(".success-img-faculty").html("<i class='fa fa-check-circle fa-lg'></i>&nbsp;&nbsp;&nbsp;Profile Avatar successfully changed</a>").removeClass("red-text").addClass("green-text");
							}else{
								$(".success-img-faculty").html("<i class='fa fa-exclamation-circle fa-lg'></i>&nbsp;&nbsp;&nbsp;"+obj.img_src_faculty+"</a>").removeClass("green-text").addClass("red-text");
							}
					    }
		   			});
				}
					
			});
			// Save basic information - faculty
			$(".basic-info-btn-save-faculty").click(function(e){
				e.preventDefault();
				if( $("#firstnm-faculty").val() === obj.facultyProfileInfo.firstname ){
					$.ajax({
						type: "POST",
						url: "../faculty/function.php",
						data: {
								faculty_firstname : $("#firstnm-faculty").val(),
							}
					});
				}else if( !$.trim( $("#firstnm-faculty").val() ).match(/([A-Za-z']+( [A-Za-z']+)*){3,30}$/) ){
					$("#firstnm-faculty").removeClass("valid").addClass("invalid");
					$(".err-name-faculty").html("<i class='fa fa-exclamation-triangle fa-lg'></i>&nbsp;&nbsp;&nbsp;Please enter a valid name.");
				}else{
					$("#firstnm-faculty").removeClass("invalid").addClass("valid");
					if( !$("#firstnm-faculty").hasClass("invalid") && !$("#lastnm-faculty").hasClass("invalid") ){
						$(".err-name-faculty").html("");
						$.ajax({
							type: "POST",
							url: "../faculty/function.php",
							data: {
									faculty_firstname : $("#firstnm-faculty").val(),
							},
							success: function(data){
								obj = JSON.parse(data);
								if( obj.facultyProfileInfoUpdate.update_firstname ){
									$(".success-name-faculty").html("<i class='fa fa-check-circle'></i>&nbsp;&nbsp;&nbsp;Name has been updated");
								}
							}
						});
					}
				
				}
				if( $("#middlenm-faculty").val() === obj.facultyProfileInfo.middlename ){
					$.ajax({
						type: "POST",
						url: "../faculty/function.php",
						data: {
								faculty_middlename : $("#middlenm-faculty").val(),
							}
					});
				}else if( !$.trim( $("#middlenm-faculty").val() ).match(/([A-Za-z']+( [A-Za-z']+)*){3,30}$/) ){
					$("#middlenm-faculty").removeClass("valid").addClass("invalid");
					$(".err-name-faculty").html("<i class='fa fa-exclamation-triangle fa-lg'></i>&nbsp;&nbsp;&nbsp;Please enter a valid name.");
				}else{
					$("#middlenm-faculty").removeClass("invalid").addClass("valid");
					if( !$("#firstnm-faculty").hasClass("invalid") && !$("#lastnm-admin").hasClass("invalid") ){
						$(".err-name-faculty").html("");
						$.ajax({
							type: "POST",
							url: "../faculty/function.php",
							data: {
									faculty_middlename : $("#middlenm-faculty").val(),
							},
							success: function(data){
								obj = JSON.parse(data);
								if( obj.facultyProfileInfoUpdate.update_middlename ){
									$(".success-name-faculty").html("<i class='fa fa-check-circle'></i>&nbsp;&nbsp;&nbsp;Name has been updated");
								}	
							}
						});
					}
				}
				if( $("#lastnm-faculty").val() === obj.facultyProfileInfo.lastname ){
					$.ajax({
						type: "POST",
						url: "../faculty/function.php",
						data: {
								faculty_lastname : $("#lastnm-faculty").val(),
							}
					});
				}else if( !$.trim( $("#lastnm-faculty").val() ).match(/([A-Za-z']+( [A-Za-z']+)*){3,30}$/) ){
					$("#lastnm-faculty").removeClass("valid").addClass("invalid");
					$(".err-name-faculty").html("<i class='fa fa-exclamation-triangle fa-lg'></i>&nbsp;&nbsp;&nbsp;Please enter a valid name.");
				}else{
					$("#lastnm-faculty").removeClass("invalid").addClass("valid");
					if( !$("#firstnm-faculty").hasClass("invalid") && !$("#middlenm-faculty").hasClass("invalid") ){
						$(".err-name-faculty").html("");
						
						$.ajax({
							type: "POST",
							url: "../faculty/function.php",
							data: {
									faculty_lastname : $("#lastnm-faculty").val(),
							},
							success: function(data){
								obj = JSON.parse(data);
								if( obj.facultyProfileInfoUpdate.update_lastname ){
									$(".success-name-faculty").html("<i class='fa fa-check-circle'></i>&nbsp;&nbsp;&nbsp;Name has been updated");
								}	
							}
						});
					}
				}
				if( $("#gender-faculty-input").val() === obj.facultyProfileInfo.gender ){
					$.ajax({
						type: "POST",
						url: "../faculty/function.php",
						data: {
								faculty_gender : $("#gender-faculty-input").val(),
							}
					});
				}else{
					
					$.ajax({
						type: "POST",
						url: "../faculty/function.php",
						data: {
								faculty_gender : $("#gender-faculty-input").val(),
						},
						success: function(data){
							obj = JSON.parse(data);
							if( obj.facultyProfileInfoUpdate.update_gender ){
								$(".success-gender-faculty").html("<i class='fa fa-check-circle'></i>&nbsp;&nbsp;&nbsp;Gender has been updated");
							}
						}
					});
				}
				// Validation
				if( $("#dob-faculty-input").val() === obj.facultyProfileInfo.dob ){
					$.ajax({
						type: "POST",
						url: "../faculty/function.php",
						data: {
								faculty_dob : $("#dob-faculty-input").val(),
							}
					});
				}else if( !$.trim( $("#dob-faculty-input").val() ).match(/(^(((0[1-9]|1[0-9]|2[0-8])[\/](0[1-9]|1[012]))|((29|30|31)[\/](0[13578]|1[02]))|((29|30)[\/](0[4,6,9]|11)))[\/](19|[2-9][0-9])\d\d$)|(^29[\/]02[\/](19|[2-9][0-9])(00|04|08|12|16|20|24|28|32|36|40|44|48|52|56|60|64|68|72|76|80|84|88|92|96)$)/) ){
					$("#dob-faculty-input").removeClass("valid").addClass("invalid");
					$(".err-dob-faculty").html("<i class='fa fa-exclamation-triangle fa-lg'></i>&nbsp;&nbsp;&nbsp;Please enter a valid date.&nbsp;&nbsp;&nbsp;e.g DD/MM/YYYY");
				}else{
					$("#dob-faculty-input").removeClass("invalid").addClass("valid");
					$(".err-dob-faculty").html("");
					$.ajax({
						type: "POST",
						url: "../faculty/function.php",
						data: {
								faculty_dob : $("#dob-faculty-input").val(),
						},
						success: function(data){
							obj = JSON.parse(data);
							if( obj.facultyProfileInfoUpdate.update_dob ){
								$(".success-dob-faculty").html("<i class='fa fa-check-circle'></i>&nbsp;&nbsp;&nbsp;Date of Birth has been updated");
							}
						}
					});
				}
				//Validation
				if( $("#address-faculty-input").val() === obj.facultyProfileInfo.address ){
					$.ajax({
						type: "POST",
						url: "../faculty/function.php",
						data: {
								faculty_address : $("#address-faculty-input").val(),
							}
					});
				}else if( !$.trim( $("#address-faculty-input").val() ).match(/([A-Za-z']+( [A-Za-z']+)*){3,30}$/) ){
					$("#address-faculty-input").removeClass("valid").addClass("invalid");
					$(".err-address-faculty").html("<i class='fa fa-exclamation-triangle fa-lg'></i>&nbsp;&nbsp;&nbsp;Please enter a valid address.&nbsp;&nbsp;&nbsp;e.g Unit#/House/Building/Street, Brgy, City, Province");
				}else{
					$("#address-faculty-input").removeClass("invalid").addClass("valid");
					$(".err-address-faculty").html("");
					$.ajax({
						type: "POST",
						url: "../faculty/function.php",
						data: {
								faculty_address : $("#address-faculty-input").val(),
						},
						success: function(data){
							obj = JSON.parse(data);
							if( obj.facultyProfileInfoUpdate.update_address ){
								$(".success-address-faculty").html("<i class='fa fa-check-circle'></i>&nbsp;&nbsp;&nbsp;Address has been updated");
							}
						}
					});
				}
			});
			$(".basic-info-btn-back-faculty").click(function(e){
				e.preventDefault();
				// Load default info from database
				$(".basic-info-btn-save-faculty").removeClass("visible-input").addClass("hidden-input");
				$(".basic-info-btn-back-faculty").removeClass("visible-input").addClass("hidden-input");
				$(".basic-info-btn-edit-faculty").removeClass("hidden-input").addClass("visible-input");
				$("#basic-information-faculty .basic-info-data-faculty .visible-input").removeClass("visible-input").addClass("hidden-input");
				$(".success-msg-faculty").html("");
				$(".error-msg-faculty").html("");
				$("#firstnm-faculty").val(obj.facultyProfileInfo.firstname);
				$("#middlenm-faculty").val(obj.facultyProfileInfo.middlename);
				$("#lastnm-faculty").val(obj.facultyProfileInfo.lastname);
				$("#gender-faculty-input").val(obj.facultyProfileInfo.gender);
				$("#dob-faculty-input").val(obj.facultyProfileInfo.dob);
				$("#address-faculty-input").val(obj.facultyProfileInfo.address);
				$(".basic-info-data-faculty input.hidden-input").removeClass("valid invalid");
				if( $("#firstnm-faculty").val() === "" && $("#middlenm-faculty").val() === "" && $("#lastnm-faculty").val() === "" ){
					$(".complete-name-faculty").removeClass("hidden-input").addClass("visible-input");
				}else{
					$(".complete-namefaculty").removeClass("visible-input").addClass("hidden-input");
					$("#complete-name-faculty").removeClass("hidden-input").addClass("visible-input");
				}
				if( $("#gender-faculty-input").val() === null ){
					$(".gender-grey-faculty").removeClass("hidden-input").addClass("visible-input");
				}else{
					$(".gender-grey-faculty").removeClass("visible-input").addClass("hidden-input");
					$("#gender-faculty").removeClass("hidden-input").addClass("visible-input");
				}
				if( $("#dob-faculty-input").val() === "" ){
					$(".dob-grey-faculty").removeClass("hidden-input").addClass("visible-input");
				}else{
					$(".dob-grey-faculty").removeClass("visible-input").addClass("hidden-input");
					$("#dob-faculty").removeClass("hidden-input").addClass("visible-input");
				}
				if( $("#address-faculty-input").val() === "" ){
					$(".address-grey-faculty").removeClass("hidden-input").addClass("visible-input");
				}else{
					$(".address-grey-faculty").removeClass("visible-input").addClass("hidden-input");
					$("#address-faculty").removeClass("hidden-input").addClass("visible-input");
				}
			});

			// Save contact information - faculty
			$(".contact-info-btn-save-contact-faculty").click(function(e){
				e.preventDefault();
				if( $("#position-faculty-input").val() === obj.facultyProfileInfo.position ){
					$.ajax({
						type: "POST",
						url: "../faculty/function.php",
						data: {
								faculty_position : $("#position-faculty-input").val(),
							}
					});
				}else if(!$.trim( $("#position-faculty-input").val() ).match(/([A-Za-z']+( [A-Za-z']+)*){3,30}$/)){
					$("#position-faculty-input").removeClass("valid").addClass("invalid");
					$(".err-position-faculty").html("<i class='fa fa-exclamation-triangle fa-lg'></i>&nbsp;&nbsp;&nbsp;Please enter a valid Position/Title in the School.");
				}else{
					$("#position-faculty-input").removeClass("invalid").addClass("valid");
					$(".err-position-faculty").html("");
					$.ajax({
						type: "POST",
						url: "../faculty/function.php",
						data: {
								faculty_position : $("#position-faculty-input").val(),
						},
						success: function(data){
							obj = JSON.parse(data);
							if( obj.facultyProfileInfoUpdate.update_position ){
								$(".success-position-faculty").html("<i class='fa fa-check-circle fa-lg'></i>&nbsp;&nbsp;&nbsp;Position has been updated.");
							}
						}
					});
				}
				if( $("#phone-faculty-input").val() === obj.facultyProfileInfo.phone ){
					$.ajax({
						type: "POST",
						url: "../faculty/function.php",
						data: {
								faculty_phone : $("#phone-faculty-input").val(),
							}
					});
				}else if( !$.trim( $("#phone-faculty-input").val() ).match(/(\d){11,12}/) && $.trim( $("#phone-faculty-input").val()).length < 11){
					$("#phone-faculty-input").removeClass("valid").addClass("invalid");
					$(".err-phone-faculty").html("<i class='fa fa-exclamation-triangle fa-lg'></i>&nbsp;&nbsp;&nbsp;Please enter a valid Phone number.");
				}else{
					$("#phone-faculty-input").removeClass("invalid").addClass("valid");
					$(".err-phone-faculty").html("");
					$.ajax({
						type: "POST",
						url: "../faculty/function.php",
						data: {
								faculty_phone : $("#phone-faculty-input").val(),
						},
						success: function(data){
							obj = JSON.parse(data);
							if( obj.facultyProfileInfoUpdate.update_phone ){
								$(".success-phone-faculty").html("<i class='fa fa-check-circle fa-lg'></i>&nbsp;&nbsp;&nbsp;Phone number has been updated.");
							}
						}
					});
				}
				if( $("#email-faculty-input").val() === obj.facultyProfileInfo.email ){
					$.ajax({
						type: "POST",
						url: "../faculty/function.php",
						data: {
								faculty_email : $("#email-faculty-input").val(),
							}
					});
				}else if( !$.trim( $("#email-faculty-input").val() ).match(/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/) ){
					$("#email-faculty-input").removeClass("valid").addClass("invalid");
					$(".err-email-faculty").html("<i class='fa fa-exclamation-triangle fa-lg'></i>&nbsp;&nbsp;&nbsp;Please enter a valid Email address.");
				}else{
					$("#email-faculty-input").removeClass("invalid").addClass("valid");
					$(".err-email-faculty").html("");
					$.ajax({
						type: "POST",
						url: "../faculty/function.php",
						data: {
								faculty_email : $("#email-faculty-input").val(),
						},
						success: function(data){
							obj = JSON.parse(data);
							if( obj.facultyProfileInfoUpdate.update_email ){
								$(".success-email-faculty").html("<i class='fa fa-check-circle fa-lg'></i>&nbsp;&nbsp;&nbsp;Email address has been updated.");
							}
						}
					});
				}
			});
			$(".contact-info-btn-back-contact-faculty").click(function(e){
				e.preventDefault();
				// Load default info from database
				$(".contact-info-btn-save-contact-faculty").removeClass("visible-input").addClass("hidden-input");
				$(".contact-info-btn-back-contact-faculty").removeClass("visible-input").addClass("hidden-input");
				$(".contact-info-btn-edit-contact-faculty").removeClass("hidden-input").addClass("visible-input");
				$("#contact-information-faculty .contact-info-data-faculty .visible-input").removeClass("visible-input").addClass("hidden-input");
				$("#position-faculty-input").val(obj.facultyProfileInfo.position);
				$("#email-faculty-input").val(obj.facultyProfileInfo.email);
				$("#phone-faculty-input").val(obj.facultyProfileInfo.phone);
				$("#address-faculty-contact-input").val(obj.facultyProfileInfo.address);
				$(".success-msg-contact-info-faculty").html("");
				$(".error-msg-contact-info-faculty").html("");
				$(".contact-info-data-faculty input.hidden-input").removeClass("valid invalid");
				if( $("#position-faculty-input").val() === "" ){
					$(".position-grey-faculty").removeClass("hidden-input").addClass("visible-input");
				}else{
					$(".position-grey-faculty").removeClass("visible-input").addClass("hidden-input");
					$("#position-faculty").removeClass("hidden-input").addClass("visible-input");
				}
				if( $("#email-faculty-input").val() === "" ){
					$(".email-grey-faculty").removeClass("hidden-input").addClass("visible-input");
				}else{
					$(".email-grey-faculty").removeClass("visible-input").addClass("hidden-input");
					$("#email-faculty").removeClass("hidden-input").addClass("visible-input");
				}
				if( $("#phone-faculty-input").val() === "" ){
					$(".phone-grey-faculty").removeClass("hidden-input").addClass("visible-input");
				}else{
					$(".phone-grey-faculty").removeClass("visible-input").addClass("hidden-input");
					$("#phone-faculty").removeClass("hidden-input").addClass("visible-input");
				}
			});
					

		}
	});
	// Faculty Get Attendance List
	$.ajax({
		type: "GET",
		url: "../faculty/function.php",
		success: function(data){
			obj = JSON.parse(data);
			$("#selectstudentlistforattendance").after(obj.studentlistforprof);
			if(obj.attendancelist == "0"){
				$(".noattendance").removeClass("hidden-input").addClass("visible-input");
			}else{
				$(".noattendance").removeClass("visible-input").addClass("hidden-input");
				$("#tbody_attendance").prepend(obj.attendancelist);
			}
		var updatethisid;
		var student_id_update;
			$(".btn-update-attendance").click(function(e){
				e.preventDefault();
				 updatethisid = $(this).attr("id");
				var academic_year_update = $(this).closest("tr").find("td:eq( 0 )").text();
				 student_id_update = $(this).closest("tr").find("td:eq( 1 )").text();
				var fullname = $(this).closest("tr").find("td:eq( 2 )").text();
				var month_update = $(this).closest("tr").find("td:eq( 3 )").text();
				var days_present_update = $(this).closest("tr").find("td:eq( 4 )").text();
				var days_late_update = $(this).closest("tr").find("td:eq( 5 )").text();
				var days_absent_update = $(this).closest("tr").find("td:eq( 6 )").text();

				$("#update-form-attendance").openModal();
				$(".attof").html(fullname);
				$("#academic_year_att_update").val(academic_year_update);
				$("#student_id_att_update").val(student_id_update);
				$("#month_att_update").val(month_update);
				$("#days_present_att_update").val(days_present_update);
				$("#days_late_att_update").val(days_late_update);
				$("#days_absent_att_update").val(days_absent_update);
			});

			$("#form-update-attendance").submit(function(e){
				e.preventDefault();

			if($.trim($("#academic_year_att_update").val()) == ""){
				$("#academic_year_att_update").removeClass("valid").addClass("invalid");
			}else{
				$("#academic_year_att_update").removeClass("invalid").addClass("valid");
			}
			if($.trim($("#student_id_att_update").val()) == ""){
				$("#student_id_att_update").removeClass("valid").addClass("invalid");
			}else{
				$("#student_id_att_update").removeClass("invalid").addClass("valid");
			}
			if($.trim($("#month_att_update").val()) == ""){
				$("#month_att_update").removeClass("valid").addClass("invalid");
			}else{
				$("#month_att_update").removeClass("invalid").addClass("valid");
			}

			if( !$(".attendance_input_update").hasClass("invalid")){
				var data = $('#form-update-attendance').serializeArray();
				data.push({name: 'id_update', value: updatethisid});
				data.push({name: 'student_id_att_update', value: student_id_update});
				$.ajax({
					type: "POST",
					url: "../faculty/function.php",
					data: data,
					beforeSend: function(){
						$("#btn-update-ani").html("Updating..");
					},
					success:function(data){
						obj = JSON.parse(data);
						if(obj.updateattendance == true){
							$("#btn-update-ani").html("Update");
							$("#updatelabelattendance").openModal();
							$(".successlabelforattendance").html("Attendance updated!").addClass("green-text");
						}
					}
				});
			}

			});

			var deletethisid;
			$(".btn-delete-attendance").click(function(e){
				e.preventDefault();
					deletethisid = $(this).attr("id");
				var nametodel = $(this).closest("tr").find("td:eq( 2 )").text();
				$("#deletelabelattendance").openModal();
				$(".delfrom").html(nametodel);
			});
			$("#delattendaceyes").click(function(e){
				e.preventDefault();
				$(".qeustiondelatt").addClass("hidden-input");
				$.ajax({
					type: "POST",
					url: "../faculty/function.php",
					data: {
						deletethisid: deletethisid
					},
					success:function(data){
						obj = JSON.parse(data);
					
						if(obj.deleteattendanceupdates == true){
							$(".pfordellabel").removeClass("hidden-input");
						}
						
					}
				});
			});
		}
	});

	$(".btn-add-attendance").click(function(e){
		e.preventDefault();
		$("#add-attendance").openModal();
	});
	$("#form-attendance").submit(function(e){
		e.preventDefault();
			var academic_year = $.trim($("#academic_year_att").val());
			var student_id_att = $.trim($("#student_id_att").val());
			var month_att = $.trim($("#month_att").val());
			var month_days_att = $.trim($("#month_days_att").val());
			var days_present_att = $.trim($("#days_present_att").val());
			var days_late_att = $.trim($("#days_late_att").val());
			var days_absent_att = $.trim($("#days_absent_att").val());

			if(academic_year == ""){
				$("#academic_year_att").removeClass("valid").addClass("invalid");
			}else{
				$("#academic_year_att").removeClass("invalid").addClass("valid");
			}
			if(student_id_att == ""){
				$("#student_id_att").removeClass("valid").addClass("invalid");
			}else{
				$("#student_id_att").removeClass("invalid").addClass("valid");
			}
			if(month_att == ""){
				$("#month_att").removeClass("valid").addClass("invalid");
			}else{
				$("#month_att").removeClass("invalid").addClass("valid");
			}

			if( !$(".attendance_input").hasClass("invalid")){
				$.ajax({
					type: "POST",
					url: "../faculty/function.php",
					data: 
						$("#form-attendance").serialize()
					,
					beforeSend: function(){
						$(".add-btn-attendance").text("Adding Attendance..");
					},
					success: function(data){
						obj = JSON.parse(data);
						if(obj.add_attendance){
							$(".add-btn-attendance").text("Add Attendance");
							$("#add-success-attendance").openModal();
							$('#form-attendance')[0].reset();
						}
					}
				});
			}


	});


	//Faculty Add Students Via excel
	$(".add-students-excel").click(function(e){
		e.preventDefault();
		$("#excel-class-student").openModal();
		$("#formexcelstudentlist").submit(function(e){
			e.preventDefault();
			$.ajax({
				type: "POST",
				url: "../faculty/upload-excel.php",
				data: new FormData(this),
				contentType: false,
			   	cache: false,
				processData:false,
				beforeSend: function(){
					$("#upload-excel-studentlist").text("Uploading..");
				},
				success: function(data){
					obj= JSON.parse(data);
					if(obj.idexcel == true){
						$("#upload-excel-studentlist").text("Upload");
						$("#success-student-excel-upload").removeClass("hidden-input").addClass("visible-input");
						$("#fail-student-excel-upload").removeClass("visible-input").addClass("hidden-input");
					}else{
						$("#success-student-excel-upload").removeClass("visible-input").addClass("hidden-input");
						$("#fail-student-excel-upload").removeClass("hidden-input").addClass("visible-input");
						$(".faildiag").html(obj.idexcel);
						$("#upload-excel-studentlist").text("Upload");
					}
				}
			});
		});
	});
	//Faculty add class
	$(".btn-add-class").click(function(e){
		e.preventDefault();
		$("#addclass").openModal();
	});
	$("#add-class-form").submit(function(e){
		e.preventDefault();

		$.ajax({
			type: "POST",
			url: "../faculty/function.php",
			data:
				$("#add-class-form").serialize(),
			beforeSend: function(data){
				$("#btn-submit-class").html("Adding Class..");
			},
			success: function(data){
				obj = JSON.parse(data);
				if(obj.class){
					$("#btn-submit-class").html("Add Class");
					$("#classaddsuccess").openModal();
				}else{
					$("#classerror").openModal();
					$(".section_error").html(obj.section_error);
					$(".subject_error").html(obj.subject_error +",");
				}
			}
		});

	});	
	

	//Faculty get class list
	$.ajax({
		type: "GET",
		url: "../faculty/function.php",
		success: function(data){
			obj = JSON.parse(data);
			if(obj.classlist === "none"){
				$("#noclassh5").removeClass("hidden-input").addClass("visible-input");
				$("#hasclassh5").removeClass("visible-input").addClass("hidden-input");
			}else{
				$("#noclassh5").removeClass("visible-input").addClass("hidden-input");
				$("#hasclassh5").removeClass("hidden-input").addClass("visible-input");
				$("#ul-class").prepend(obj.classlist);
			}
			$(".remove-class").click(function(e){
				e.preventDefault();
				$("#removeclass").openModal();
				classnametoremove = $(this).closest(".li-class").find(".li-class-class").text();
				classsectiontoremove = $(this).closest(".li-class").find(".li-class-section").text();
				classsubjecttoremove = $(this).closest(".li-class").find(".li-class-subject").text();

				$(".classnametoremove").html(classnametoremove + " - " + classsectiontoremove);
				$(".studentcount").html(obj.studentlistcount);
				$(".subjecttoremove").html(classsubjecttoremove);
			});
				$(".btn-remove-class-yes").click(function(e){
					e.preventDefault();
					$.ajax({
						type: "POST",
						url: "../faculty/function.php",
						data:{
							classnametoremove: classnametoremove,
							classsectiontoremove: classsectiontoremove,
							classsubjecttoremove: classsubjecttoremove
						},
						success:function(data){
							obj = JSON.parse(data);
							if(obj.removeclass){
								$(".removesuccessfromclass").removeClass("hidden-input").addClass("visible-input");
								$(".removequestionfromclass").removeClass("visible-input").addClass("hidden-input");
							}else{
								$(".removesuccessfromclass").removeClass("visible-input").addClass("hidden-input");
								$(".removequestionfromclass").removeClass("hidden-input").addClass("visible-input");
							}
						}
					});
				});


				if(obj.selectallclassoptionforgrades === "none"){

				}else{
					$(".classoptiondisableclassforgrades").after(obj.selectallclassoptionforgrades);
				}
				//Get all class for grades
				var classselectforgrades;
				$("#grades_class").change(function(e){
					e.preventDefault();
					classselectforgrades=$(this).val();
					 $('#grades_subject option:first').prop('selected',true);
				    $('option', $("#grades_subject")).not(':eq(0)').remove();
				    $(".radio-btn").removeClass("visible-input").addClass("hidden-input");
				    $(".divgrades").removeClass("visible").addClass("invisible");
				    $('input[name=quarter]').attr('checked',false);
					$.ajax({
						type: "POST",
						url: "../faculty/function.php",
						data: {
							classselectforgrades: classselectforgrades
						},
						success: function(data){
							obj = JSON.parse(data);
							$("#grades_subject").removeClass("hidden-input").addClass("visible-input");
							$(".classoptiondisablesubjectforgrades").after(obj.subjectlistforgrades);
						}
					});
				});
				var subjectselectforgrades;
				$("#grades_subject").change(function(e){
					e.preventDefault();
					$('input[name=quarter]').attr('checked',false);
					$(".radio-btn").removeClass("hidden-input").addClass("visible-input");
					$(".divgrades").removeClass("visible").addClass("invisible");
					subjectselectforgrades=$(this).val();
					$.ajax({
						type: "POST",
						url: "../faculty/function.php",
						data: {
							subjectselectforgrades: subjectselectforgrades,
							subjectclassselectforgrades : classselectforgrades

						},
						success: function(data){
							obj = JSON.parse(data);
							//For Student list
						}
					});
				});
				
								
				var hpsval;
				var hpsfor
			$(".quarter-btn").change(function(){
			    var quarterselected = $(this).val();
			    if(quarterselected == 'sumquarterpersubject'){
			    	$(".subjofsumgrades").html(subjectselectforgrades);
			    	$(".sumofgradesdiv").removeClass("invisible").addClass("visible");
			    	$(".divgrades").removeClass("visible").addClass("invisible hidden-input");

			    }else{
			    	$(".sumofgradesdiv").removeClass("visible").addClass("invisible");
			    	$(".divgrades").removeClass("invisible hidden-input").addClass("visible");
			    }
			 	$.ajax({
			 		type: "POST",
			 		url: "../faculty/function.php",
			 		data:{
			 			quarterselected: quarterselected,
			 			subjectselectforquarter: subjectselectforgrades,
			 			classselectforquarter: classselectforgrades

			 		},
			 		success: function(data){
			 			obj = JSON.parse(data);

			 			$(".tbody-ww").html(obj.studentlistforww);
			 			$(".tbody-pt").html(obj.studentlistforpt);
			 			$(".tbody-qa").html(obj.studentlistforqa);
			 			$(".hspforww").html(obj.countstudent);
			 			$(".hspforpt").html(obj.hspforpt);
			 			$(".hspforqa").html(obj.hspforqa);
			 			$(".tbody-grade").html(obj.studentlistfor);
			 			$(".tbody-sumofgrades").html(obj.studentlistforsum);

			 			$(".btn-edit-grades-ww").click(function(e){
			 				e.preventDefault();
			 				getname = $(this).closest("tr").find(".wwname").text();
			 				getid = $(this).closest("tr").find(".wwname").attr("id");
			 				getitem1 = $(this).closest("tr").find(".item_1").text();
			 				getitem2 = $(this).closest("tr").find(".item_2").text();
			 				getitem3 = $(this).closest("tr").find(".item_3").text();
			 				getitem4 = $(this).closest("tr").find(".item_4").text();
			 				getitem5 = $(this).closest("tr").find(".item_5").text();
			 				getitem6 = $(this).closest("tr").find(".item_6").text();
			 				getitem7 = $(this).closest("tr").find(".item_7").text();
			 				getitem8 = $(this).closest("tr").find(".item_8").text();
			 				getitem9 = $(this).closest("tr").find(".item_9").text();
			 				getitem10 = $(this).closest("tr").find(".item_10").text();
			 				getitem1u = $(this).closest("tr").find(".item_1");
			 				getitem2u = $(this).closest("tr").find(".item_2");
			 				getitem3u = $(this).closest("tr").find(".item_3");
			 				getitem4u = $(this).closest("tr").find(".item_4");
			 				getitem5u = $(this).closest("tr").find(".item_5");
			 				getitem6u = $(this).closest("tr").find(".item_6");
			 				getitem7u = $(this).closest("tr").find(".item_7");
			 				getitem8u = $(this).closest("tr").find(".item_8");
			 				getitem9u = $(this).closest("tr").find(".item_9");
			 				getitem10u = $(this).closest("tr").find(".item_10");
			 				totalforuser = $(this).closest("tr").find('.totalforgradeww');
			 				psforuser = $(this).closest("tr").find('.pstotal');
			 				wsforuser = $(this).closest("tr").find('.wstotal');
			 				getotal = $(this).closest("tr").find('.totalforgradeww').text();
			 				getps = $(this).closest("tr.writtenworks").find('.pstotal').text();
			 				getws = $(this).closest("tr.writtenworks").find('.wstotal').text();
			 				var totalhsp  = parseInt($(".hspww_total").text());
			 				$("#editww").openModal();
			 				$(".nametoupdategrade").html(getname);


			 				if(getitem1 == ""){
			 					$("#item_1ww").attr("disabled",'');
			 				}else{
			 					$("#item_1ww").val(getitem1);
			 					$("label").attr("for","item_1pt").addClass("active");
			 				}
			 				if(getitem2 == ""){
			 					$("#item_2ww").attr("disabled",'');
			 				}else{
			 					$("#item_2ww").val(getitem2);
			 					$("label").attr("for","item_2pt").addClass("active");
			 				}
			 				if(getitem3 == ""){
			 					$("#item_3ww").attr("disabled",'');
			 				}else{
			 					$("#item_3ww").val(getitem3);
			 					$("label").attr("for","item_3pt").addClass("active");
			 				}
			 				if(getitem4 == ""){
			 					$("#item_4ww").attr("disabled",'');
			 				}else{
			 					$("#item_4ww").val(getitem4);
			 					$("label").attr("for","item_4pt").addClass("active");
			 				}
			 				if(getitem5 == ""){
			 					$("#item_5ww").attr("disabled",'');
			 				}else{
			 					$("#item_5ww").val(getitem5);
			 					$("label").attr("for","item_5pt").addClass("active");
			 				}
			 				if(getitem6 == ""){
			 					$("#item_6ww").attr("disabled",'');
			 				}else{
			 					$("#item_6ww").val(getitem6);
			 					$("label").attr("for","item_6pt").addClass("active");
			 				}
			 				if(getitem7 == ""){
			 					$("#item_7ww").attr("disabled",'');
			 				}else{
			 					$("#item_7ww").val(getitem7);
			 					$("label").attr("for","item_7pt").addClass("active");
			 				}
			 				if(getitem8 == ""){
			 					$("#item_8ww").attr("disabled",'');
			 				}else{
			 					$("#item_8ww").val(getitem8);
			 					$("label").attr("for","item_8pt").addClass("active");
			 				}
			 				if(getitem9 == ""){
			 					$("#item_9ww").attr("disabled",'');
			 				}else{
			 					$("#item_9ww").val(getitem9);
			 					$("label").attr("for","item_9pt").addClass("active");
			 				}
			 				if(getitem10 == ""){
			 					$("#item_10ww").attr("disabled",'');
			 				}else{
			 					$("#item_10ww").val(getitem10);
			 					$("label").attr("for","item_10pt").addClass("active");
			 				}

			 				$(".totalupdate").text(getotal);
			 				$(".psupdate").text(getps);
			 				$(".wsupdate").text(getws);
			 				var additem1;var additem3;var additem6;var additem7;var additem10;
			 				var additem2;var additem4;var additem5;var additem8;var additem9;
			 				$('.editgradeww').keypress(function(e){
			 					if (e.which == '13') {
			 						e.preventDefault();
			 						 additem1 = parseInt($("#item_1ww").val()); additem2 = parseInt($("#item_2ww").val()); additem3 = parseInt($("#item_3ww").val());
			 						 additem4 = parseInt($("#item_4ww").val()); additem5 = parseInt($("#item_5ww").val()); additem6 = parseInt($("#item_6ww").val());
			 						 additem7 = parseInt($("#item_7ww").val()); additem8 = parseInt($("#item_8ww").val()); additem9 = parseInt($("#item_9ww").val());
			 						 additem10 = parseInt($("#item_10ww").val());
			 						if(!$.isNumeric(additem1)){
			 							additem1 = 0;
			 						}
			 						if(!$.isNumeric(additem2)){
			 							additem2 = 0;
			 						}
			 						if(!$.isNumeric(additem3)){
			 							additem3 = 0;
			 						}
			 						if(!$.isNumeric(additem4)){
			 							additem4 = 0;
			 						}
			 						if(!$.isNumeric(additem5)){
			 							additem5 = 0;
			 						}
			 						if(!$.isNumeric(additem6)){
			 							additem6 = 0;
			 						}
			 						if(!$.isNumeric(additem7)){
			 							additem7 = 0;
			 						}
			 						if(!$.isNumeric(additem8)){
			 							additem8 = 0;
			 						}
			 						if(!$.isNumeric(additem9)){
			 							additem9 = 0;
			 						}
			 						if(!$.isNumeric(additem10)){
			 							additem10 = 0;
			 						}

			 						totaledit = additem1+additem2+additem3+additem4+additem5+additem6+additem7+additem8+additem9+additem10;
			 							
			 							psdivide = totaledit/totalhsp;
										pstotal = psdivide * 100;
										pstotal = pstotal.toFixed(2);
										getwswwpercent = $(".wwwspercent").attr("id");
										wswwpercent = parseFloat(getwswwpercent);
										wstotal = pstotal * wswwpercent;
										wstotal = wstotal.toFixed(2);
										if(!$.isNumeric(pstotal)){
											pstotal =0;
										}
										if(!$.isNumeric(wstotal)){
											wstotal=0;
										}
										$(".totalupdate").text(totaledit);
										$(".psupdate").text(pstotal);
										$(".wsupdate").html(wstotal);
										totalforuser.text(totaledit);
										psforuser.text(pstotal);
										wsforuser.text(wstotal);
			 						
			 						$(".btn-yes-updategrades").click(function(e){
					 					e.preventDefault();

					 					initialgrade = 0;
										wwwstotal = $("tr.writtenworks").find("td#ww"+getid+"").text();
										ptwstotal = $("tr.performancetask").find("td#pt"+getid+"").text();
										qawstotal = $("tr.quarterassesment").find("td#qa"+getid+"").text();

											if( !$.isNumeric(parseFloat(wwwstotal)) ){
												wwwstotal = 0.00;
											}
											if(!$.isNumeric(parseFloat(ptwstotal))){
												ptwstotal = 0.00;
											}
											if(!$.isNumeric(parseFloat(qawstotal))){
												qawstotal = 0.00;
											}
						 				initialgrade = parseFloat(wwwstotal) + parseFloat(ptwstotal) + parseFloat(qawstotal);

										quarterlygradeupdate =0;

										if(initialgrade == 100){
											quarterlygradeupdate = 100;
										}else if(initialgrade <= 99.99 && initialgrade >= 98.40){
											quarterlygradeupdate = 99;
										}else if(initialgrade <= 98.39 && initialgrade >= 96.80){
											quarterlygradeupdate = 98;
										}else if(initialgrade <= 96.89 && initialgrade >= 95.20){
											quarterlygradeupdate = 97;
										}else if(initialgrade <= 95.19 && initialgrade >= 93.60){
											quarterlygradeupdate = 96;
										}else if(initialgrade <= 93.59 && initialgrade >= 92.00){
											quarterlygradeupdate = 95;
										}else if(initialgrade <= 91.99 && initialgrade >= 90.40){
											quarterlygradeupdate = 94;
										}else if(initialgrade <= 90.39 && initialgrade >= 88.80){
											quarterlygradeupdate = 93;
										}else if(initialgrade <= 88.79 && initialgrade >= 87.20){
											quarterlygradeupdate = 92;
										}else if(initialgrade <= 87.19 && initialgrade >= 85.60){
											quarterlygradeupdate = 91;
										}else if(initialgrade <= 85.59 && initialgrade >= 84.00){
											quarterlygradeupdate = 90;
										}else if(initialgrade <= 83.99 && initialgrade >= 82.40){
											quarterlygradeupdate = 89;
										}else if(initialgrade <= 82.39 && initialgrade >= 80.80){
											quarterlygradeupdate = 88;
										}else if(initialgrade <= 80.79 && initialgrade >= 79.20){
											quarterlygradeupdate = 87;
										}else if(initialgrade <= 79.19 && initialgrade >= 77.60){
											quarterlygradeupdate = 86;
										}else if(initialgrade <= 77.59 && initialgrade >= 76.00){
											quarterlygradeupdate = 85;
										}else if(initialgrade <= 75.99 && initialgrade >= 74.40){
											quarterlygradeupdate = 84;
										}else if(initialgrade <= 74.39 && initialgrade >= 72.80){
											quarterlygradeupdate = 83;
										}else if(initialgrade <= 72.79 && initialgrade >= 71.20){
											quarterlygradeupdate = 82;
										}else if(initialgrade <= 71.19 && initialgrade >= 69.60){
											quarterlygradeupdate = 81;
										}else if(initialgrade <= 69.59 && initialgrade >= 68.00){
											quarterlygradeupdate = 80;
										}else if(initialgrade <= 67.99 && initialgrade >= 66.40){
											quarterlygradeupdate = 79;
										}else if(initialgrade <= 66.39 && initialgrade >= 64.80){
											quarterlygradeupdate = 78;
										}else if(initialgrade <= 64.79 && initialgrade >= 63.20){
											quarterlygradeupdate = 77;
										}else if(initialgrade <= 63.19 && initialgrade >= 61.60){
											quarterlygradeupdate = 76;
										}else if(initialgrade <= 61.59 && initialgrade >= 60.00){
											quarterlygradeupdate = 75;
										}else if(initialgrade <= 59.99 && initialgrade >= 56.00){
											quarterlygradeupdate = 74;
										}else if(initialgrade <= 55.99 && initialgrade >= 52.00){
											quarterlygradeupdate = 73;
										}else if(initialgrade <= 51.99 && initialgrade >= 48.00){
											quarterlygradeupdate = 72;
										}else if(initialgrade <= 47.99 && initialgrade >= 44.00){
											quarterlygradeupdate = 71;
										}else if(initialgrade <= 43.99 && initialgrade >= 40.00){
											quarterlygradeupdate = 70;
										}else if(initialgrade <= 39.99 && initialgrade >= 36.00){
											quarterlygradeupdate = 69;
										}else if(initialgrade <= 35.99 && initialgrade >= 32.00){
											quarterlygradeupdate = 68;
										}else if(initialgrade <= 31.99 && initialgrade >= 28.00){
											quarterlygradeupdate = 67;
										}else if(initialgrade <= 27.99 && initialgrade >= 24.00){
											quarterlygradeupdate = 66;
										}else if(initialgrade <= 23.99 && initialgrade >= 20.00){
											quarterlygradeupdate = 65;
										}else if(initialgrade <= 19.99 && initialgrade >= 16.00){
											quarterlygradeupdate = 64;
										}else if(initialgrade <= 15.99 && initialgrade >= 12.00){
											quarterlygradeupdate = 63;
										}else if(initialgrade <= 11.99 && initialgrade >= 8.00){
											quarterlygradeupdate = 62;
										}else if(initialgrade <= 7.99 && initialgrade >= 4.00){
											quarterlygradeupdate = 61;
										}else if(initialgrade <= 39.99 && initialgrade >= 0){
											quarterlygradeupdate = 60;
										}
					 					$.ajax({
					 						type: "POST",
					 						url: "../faculty/function.php",
					 						data:{
					 							studenidupdategrade: getid,
					 							studentquarterupdate: quarterselected,
					 							studentsubjectupdate: subjectselectforgrades,
					 							studentclassupdate: classselectforgrades,
					 							wwitem1: additem1,
					 							wwitem2: additem2,
					 							wwitem3: additem3,
					 							wwitem4: additem4,
					 							wwitem5: additem5,
					 							wwitem6: additem6,
					 							wwitem7: additem7,
					 							wwitem8: additem8,
					 							wwitem9: additem9,
					 							wwitem10: additem10,
					 							wwtotalupdate:  $(".totalupdate").text(),
					 							wwpsupdate:  $(".psupdate").text(),
					 							wwwsupdate:  $(".wsupdate").text(),
					 							initialgradeww: initialgrade,
					 							quarterlygradeupdateww: quarterlygradeupdate
					 						},
					 						success: function(data){
					 							obj = JSON.parse(data);
					 							var subjecttoupdate = obj.sujectupdate;
					 							var sectionupdatetoupdate = obj.sectionupdate;
					 							var studupdatetoupdate = obj.updatestud;

					 							if(obj.updategrade == true){
					 								getitem1u.text(obj.ww1);
					 								getitem2u.text(obj.ww2);
					 								getitem3u.text(obj.ww3);
					 								getitem4u.text(obj.ww4);
					 								getitem5u.text(obj.ww5);
					 								getitem6u.text(obj.ww6);
					 								getitem7u.text(obj.ww7);
					 								getitem8u.text(obj.ww8);
					 								getitem9u.text(obj.ww9);
					 								getitem10u.text(obj.ww10);
					 								
					 							}
					 							if(obj.goupdate == true){
					 								$("tr.grades").find("#ini"+obj.updatestud+"").text(obj.updateini);
					 								$("tr.grades").find("#qg"+obj.updatestud+"").text(obj.updatequarterly);
					 								$("tr.sumgrades").find("#"+obj.updatestud+"quarterone").text(obj.updatequarterly);

					 								quarteronegradeqa = parseInt(obj.updatequarterly);
					 								quartertwogradeqa = parseInt($("tr.sumgrades").find("#"+obj.updatestud+"quartertwo").text());
					 								quarterthreegradeqa = parseInt($("tr.sumgrades").find("#"+obj.updatestud+"quarterthree").text());
					 								quarterfourgradeqa = parseInt($("tr.sumgrades").find("#"+obj.updatestud+"quarterfour").text());
						 							if(!$.isNumeric(quarteronegradeqa) || !$.isNumeric(quartertwogradeqa) || !$.isNumeric(quarterthreegradeqa) || !$.isNumeric(quarterfourgradeqa)){
													}else{
														var remarks;
														sumall = quarteronegradeqa + quartertwogradeqa + quarterthreegradeqa + quarterfourgradeqa;
														finalgrades = sumall / 4;
														finalgrades = Math.round(finalgrades);
														$("#"+obj.updatestud+"finalgradesum").html("<span>"+finalgrades+"</span>");
														computefinal = finalgrades;
														if(computefinal == 100 && computefinal >= 75 ){
															remarks = "PASSED";
														}else{
															remarks = "PASSED";
														}
														
														$.ajax({
															type: "POST",
															url: "../faculty/function.php",
															data: {
																computefinal: computefinal,
																remarks: remarks,
																subjecttoupdate: subjecttoupdate,
																sectionupdatetoupdate: sectionupdatetoupdate,
																studupdatetoupdate: studupdatetoupdate
															},
															success: function(data){
																obj = JSON.parse(data);
																console.log(obj.updatewwsumgrade);
															}
														});
														
														
													}

					 							}

					 						}
					 					});
					 				});
			 					}
			 				});
			 				
			 			});

						$(".btn-edit-grades-pt").click(function(e){
							e.preventDefault();

							getname = $(this).closest("tr").find(".ptname").text();
			 				getid = $(this).closest("tr").find(".ptname").attr("id");
			 				getitem1 = $(this).closest("tr").find(".item_1").text();
			 				getitem2 = $(this).closest("tr").find(".item_2").text();
			 				getitem3 = $(this).closest("tr").find(".item_3").text();
			 				getitem4 = $(this).closest("tr").find(".item_4").text();
			 				getitem5 = $(this).closest("tr").find(".item_5").text();
			 				getitem6 = $(this).closest("tr").find(".item_6").text();
			 				getitem7 = $(this).closest("tr").find(".item_7").text();
			 				getitem8 = $(this).closest("tr").find(".item_8").text();
			 				getitem9 = $(this).closest("tr").find(".item_9").text();
			 				getitem10 = $(this).closest("tr").find(".item_10").text();
			 				getitem1u = $(this).closest("tr").find(".item_1");
			 				getitem2u = $(this).closest("tr").find(".item_2");
			 				getitem3u = $(this).closest("tr").find(".item_3");
			 				getitem4u = $(this).closest("tr").find(".item_4");
			 				getitem5u = $(this).closest("tr").find(".item_5");
			 				getitem6u = $(this).closest("tr").find(".item_6");
			 				getitem7u = $(this).closest("tr").find(".item_7");
			 				getitem8u = $(this).closest("tr").find(".item_8");
			 				getitem9u = $(this).closest("tr").find(".item_9");
			 				getitem10u = $(this).closest("tr").find(".item_10");
			 				totalforuser = $(this).closest("tr").find('td.totalforgradeww');
			 				psforuser = $(this).closest("tr").find('td.pstotal');
			 				wsforuser = $(this).closest("tr").find('td.wstotal');
			 				getotal = $(this).closest("tr").find('td.totalforgradeww').text();
			 				getps = $(this).closest("tr.performancetask").find('td.pstotal').text();
			 				getws = $(this).closest("tr.performancetask").find('td.wstotal').text();
			 				var totalhsppt  = parseInt($(".hsppt_total").text());
			 				$("#editpt").openModal();
			 				$(".nametoupdategradept").html(getname);

			 				if(getitem1 == ""){
			 					$("#item_1pt").attr("disabled",'');
			 				}else{
			 					$("#item_1pt").val(getitem1);
			 					$("label").attr("for","item_1pt").addClass("active");
			 				}
			 				if(getitem2 == ""){
			 					$("#item_2pt").attr("disabled",'');
			 				}else{
			 					$("#item_2pt").val(getitem2);
			 					$("label").attr("for","item_2pt").addClass("active");
			 				}
			 				if(getitem3 == ""){
			 					$("#item_3pt").attr("disabled",'');
			 				}else{
			 					$("#item_3pt").val(getitem3);
			 					$("label").attr("for","item_3pt").addClass("active");
			 				}
			 				if(getitem4 == ""){
			 					$("#item_4pt").attr("disabled",'');
			 				}else{
			 					$("#item_4pt").val(getitem4);
			 					$("label").attr("for","item_4pt").addClass("active");
			 				}
			 				if(getitem5 == ""){
			 					$("#item_5pt").attr("disabled",'');
			 				}else{
			 					$("#item_5pt").val(getitem5);
			 					$("label").attr("for","item_5pt").addClass("active");
			 				}
			 				if(getitem6 == ""){
			 					$("#item_6pt").attr("disabled",'');
			 				}else{
			 					$("#item_6pt").val(getitem6);
			 					$("label").attr("for","item_6pt").addClass("active");
			 				}
			 				if(getitem7 == ""){
			 					$("#item_7pt").attr("disabled",'');
			 				}else{
			 					$("#item_7pt").val(getitem7);
			 					$("label").attr("for","item_7pt").addClass("active");
			 				}
			 				if(getitem8 == ""){
			 					$("#item_8pt").attr("disabled",'');
			 				}else{
			 					$("#item_8pt").val(getitem8);
			 					$("label").attr("for","item_8pt").addClass("active");
			 				}
			 				if(getitem9 == ""){
			 					$("#item_9pt").attr("disabled",'');
			 				}else{
			 					$("#item_9pt").val(getitem9);
			 					$("label").attr("for","item_9pt").addClass("active");
			 				}
			 				if(getitem10 == ""){
			 					$("#item_10pt").attr("disabled",'');
			 				}else{
			 					$("#item_10pt").val(getitem10);
			 					$("label").attr("for","item_10pt").addClass("active");
			 				}

			 				$(".totalupdatept").text(getotal);
			 				$(".psupdatept").text(getps);
			 				$(".wsupdatept").text(getws);
			 				var ptadditem1;var ptadditem3;var ptadditem6;var ptadditem7;var ptadditem10;
			 				var ptadditem2;var ptadditem4;var ptadditem5;var ptadditem8;var ptadditem9;

			 				$('.editgradept').keypress(function(e){
			 					if (e.which == '13') {
			 						e.preventDefault();
			 						 ptadditem1 = parseInt($("#item_1pt").val()); ptadditem2 = parseInt($("#item_2pt").val()); ptadditem3 = parseInt($("#item_3pt").val());
			 						 ptadditem4 = parseInt($("#item_4pt").val()); ptadditem5 = parseInt($("#item_5pt").val()); ptadditem6 = parseInt($("#item_6pt").val());
			 						 ptadditem7 = parseInt($("#item_7pt").val()); ptadditem8 = parseInt($("#item_8pt").val()); ptadditem9 = parseInt($("#item_9pt").val());
			 						 ptadditem10 = parseInt($("#item_10pt").val());
			 						if(!$.isNumeric(ptadditem1)){
			 							ptadditem1 = 0;
			 						}
			 						if(!$.isNumeric(ptadditem2)){
			 							ptadditem2 = 0;
			 						}
			 						if(!$.isNumeric(ptadditem3)){
			 							ptadditem3 = 0;
			 						}
			 						if(!$.isNumeric(ptadditem4)){
			 							ptadditem4 = 0;
			 						}
			 						if(!$.isNumeric(ptadditem5)){
			 							ptadditem5 = 0;
			 						}
			 						if(!$.isNumeric(ptadditem6)){
			 							ptadditem6 = 0;
			 						}
			 						if(!$.isNumeric(ptadditem7)){
			 							ptadditem7 = 0;
			 						}
			 						if(!$.isNumeric(ptadditem8)){
			 							ptadditem8 = 0;
			 						}
			 						if(!$.isNumeric(ptadditem9)){
			 							ptadditem9 = 0;
			 						}
			 						if(!$.isNumeric(ptadditem10)){
			 							ptadditem10 = 0;
			 						}
			 						totaledit = ptadditem1+ptadditem2+ptadditem3+ptadditem4+ptadditem5+ptadditem6+ptadditem7+ptadditem8+ptadditem9+ptadditem10;
			 							
			 							psdivide = totaledit/totalhsppt;
										pstotal = psdivide * 100;
										pstotal = pstotal.toFixed(2);
										getwsptpercent = $(".ptwspercent").attr("id");
										wsptpercent = parseFloat(getwsptpercent);
										wstotal = pstotal * wsptpercent;
										wstotal = wstotal.toFixed(2);
										if(!$.isNumeric(pstotal)){
											pstotal =0;
										}
										if(!$.isNumeric(wstotal)){
											wstotal=0;
										}
										$(".totalupdatept").text(totaledit);
										$(".psupdatept").text(pstotal);
										$(".wsupdatept").html(wstotal);
										totalforuser.text(totaledit);
										psforuser.text(pstotal);
										wsforuser.text(wstotal);
			 						
			 						$(".btn-yes-updategradespt").click(function(e){
			 							initialgrade = 0;
										wwwstotal = $("tr.writtenworks").find("td#ww"+getid+"").text();
										ptwstotal = $("tr.performancetask").find("td#pt"+getid+"").text();
										qawstotal = $("tr.quarterassesment").find("td#qa"+getid+"").text();

											if( !$.isNumeric(parseFloat(wwwstotal)) ){
												wwwstotal = 0.00;
											}
											if(!$.isNumeric(parseFloat(ptwstotal))){
												ptwstotal = 0.00;
											}
											if(!$.isNumeric(parseFloat(qawstotal))){
												qawstotal = 0.00;
											}
						 				initialgrade = parseFloat(wwwstotal) + parseFloat(ptwstotal) + parseFloat(qawstotal);

										quarterlygradeupdate =0;

										if(initialgrade == 100){
											quarterlygradeupdate = 100;
										}else if(initialgrade <= 99.99 && initialgrade >= 98.40){
											quarterlygradeupdate = 99;
										}else if(initialgrade <= 98.39 && initialgrade >= 96.80){
											quarterlygradeupdate = 98;
										}else if(initialgrade <= 96.89 && initialgrade >= 95.20){
											quarterlygradeupdate = 97;
										}else if(initialgrade <= 95.19 && initialgrade >= 93.60){
											quarterlygradeupdate = 96;
										}else if(initialgrade <= 93.59 && initialgrade >= 92.00){
											quarterlygradeupdate = 95;
										}else if(initialgrade <= 91.99 && initialgrade >= 90.40){
											quarterlygradeupdate = 94;
										}else if(initialgrade <= 90.39 && initialgrade >= 88.80){
											quarterlygradeupdate = 93;
										}else if(initialgrade <= 88.79 && initialgrade >= 87.20){
											quarterlygradeupdate = 92;
										}else if(initialgrade <= 87.19 && initialgrade >= 85.60){
											quarterlygradeupdate = 91;
										}else if(initialgrade <= 85.59 && initialgrade >= 84.00){
											quarterlygradeupdate = 90;
										}else if(initialgrade <= 83.99 && initialgrade >= 82.40){
											quarterlygradeupdate = 89;
										}else if(initialgrade <= 82.39 && initialgrade >= 80.80){
											quarterlygradeupdate = 88;
										}else if(initialgrade <= 80.79 && initialgrade >= 79.20){
											quarterlygradeupdate = 87;
										}else if(initialgrade <= 79.19 && initialgrade >= 77.60){
											quarterlygradeupdate = 86;
										}else if(initialgrade <= 77.59 && initialgrade >= 76.00){
											quarterlygradeupdate = 85;
										}else if(initialgrade <= 75.99 && initialgrade >= 74.40){
											quarterlygradeupdate = 84;
										}else if(initialgrade <= 74.39 && initialgrade >= 72.80){
											quarterlygradeupdate = 83;
										}else if(initialgrade <= 72.79 && initialgrade >= 71.20){
											quarterlygradeupdate = 82;
										}else if(initialgrade <= 71.19 && initialgrade >= 69.60){
											quarterlygradeupdate = 81;
										}else if(initialgrade <= 69.59 && initialgrade >= 68.00){
											quarterlygradeupdate = 80;
										}else if(initialgrade <= 67.99 && initialgrade >= 66.40){
											quarterlygradeupdate = 79;
										}else if(initialgrade <= 66.39 && initialgrade >= 64.80){
											quarterlygradeupdate = 78;
										}else if(initialgrade <= 64.79 && initialgrade >= 63.20){
											quarterlygradeupdate = 77;
										}else if(initialgrade <= 63.19 && initialgrade >= 61.60){
											quarterlygradeupdate = 76;
										}else if(initialgrade <= 61.59 && initialgrade >= 60.00){
											quarterlygradeupdate = 75;
										}else if(initialgrade <= 59.99 && initialgrade >= 56.00){
											quarterlygradeupdate = 74;
										}else if(initialgrade <= 55.99 && initialgrade >= 52.00){
											quarterlygradeupdate = 73;
										}else if(initialgrade <= 51.99 && initialgrade >= 48.00){
											quarterlygradeupdate = 72;
										}else if(initialgrade <= 47.99 && initialgrade >= 44.00){
											quarterlygradeupdate = 71;
										}else if(initialgrade <= 43.99 && initialgrade >= 40.00){
											quarterlygradeupdate = 70;
										}else if(initialgrade <= 39.99 && initialgrade >= 36.00){
											quarterlygradeupdate = 69;
										}else if(initialgrade <= 35.99 && initialgrade >= 32.00){
											quarterlygradeupdate = 68;
										}else if(initialgrade <= 31.99 && initialgrade >= 28.00){
											quarterlygradeupdate = 67;
										}else if(initialgrade <= 27.99 && initialgrade >= 24.00){
											quarterlygradeupdate = 66;
										}else if(initialgrade <= 23.99 && initialgrade >= 20.00){
											quarterlygradeupdate = 65;
										}else if(initialgrade <= 19.99 && initialgrade >= 16.00){
											quarterlygradeupdate = 64;
										}else if(initialgrade <= 15.99 && initialgrade >= 12.00){
											quarterlygradeupdate = 63;
										}else if(initialgrade <= 11.99 && initialgrade >= 8.00){
											quarterlygradeupdate = 62;
										}else if(initialgrade <= 7.99 && initialgrade >= 4.00){
											quarterlygradeupdate = 61;
										}else if(initialgrade <= 39.99 && initialgrade >= 0){
											quarterlygradeupdate = 60;
										}

					 					e.preventDefault();
					 					$.ajax({
					 						type: "POST",
					 						url: "../faculty/function.php",
					 						data:{
					 							studenidupdategradept: getid,
					 							studentquarterupdatept: quarterselected,
					 							studentsubjectupdatept: subjectselectforgrades,
					 							studentclassupdatept: classselectforgrades,
					 							ptitem1: ptadditem1,
					 							ptitem2: ptadditem2,
					 							ptitem3: ptadditem3,
					 							ptitem4: ptadditem4,
					 							ptitem5: ptadditem5,
					 							ptitem6: ptadditem6,
					 							ptitem7: ptadditem7,
					 							ptitem8: ptadditem8,
					 							ptitem9: ptadditem9,
					 							ptitem10: ptadditem10,
					 							pttotalupdate:  $(".totalupdatept").text(),
					 							ptpsupdate:  $(".psupdatept").text(),
					 							ptwsupdate:  $(".wsupdatept").text(),
					 							initialgradept: initialgrade,
					 							quarterlygradeupdatept: quarterlygradeupdate
					 						},
					 						success: function(data){
					 							obj = JSON.parse(data);
					 							var subjecttoupdatept = obj.sujectupdatept;
					 							var sectionupdatetoupdatept = obj.sectionupdatept;
					 							var studupdatetoupdatept = obj.updatestudpt;

					 							if(obj.updategradept == true){
					 								getitem1u.text(obj.pt1);
					 								getitem2u.text(obj.pt2);
					 								getitem3u.text(obj.pt3);
					 								getitem4u.text(obj.pt4);
					 								getitem5u.text(obj.pt5);
					 								getitem6u.text(obj.pt6);
					 								getitem7u.text(obj.pt7);
					 								getitem8u.text(obj.pt8);
					 								getitem9u.text(obj.pt9);
					 								getitem10u.text(obj.pt10);
					 							}
					 							if(obj.goupdatept == true){
					 								$("tr.grades").find("#ini"+obj.updatestudpt+"").text(obj.updateinipt);
					 								$("tr.grades").find("#qg"+obj.updatestudpt+"").text(obj.updatequarterlypt);

					 								quarteronegradeqa = parseInt(obj.updatequarterlypt);
					 								quartertwogradeqa = parseInt($("tr.sumgrades").find("#"+obj.updatestudpt+"quartertwo").text());
					 								quarterthreegradeqa = parseInt($("tr.sumgrades").find("#"+obj.updatestudpt+"quarterthree").text());
					 								quarterfourgradeqa = parseInt($("tr.sumgrades").find("#"+obj.updatestudpt+"quarterfour").text());
						 							if(!$.isNumeric(quarteronegradeqa) || !$.isNumeric(quartertwogradeqa) || !$.isNumeric(quarterthreegradeqa) || !$.isNumeric(quarterfourgradeqa)){
													}else{
														var remarkspt;
														sumall = quarteronegradeqa + quartertwogradeqa + quarterthreegradeqa + quarterfourgradeqa;
														finalgrades = sumall / 4;
														finalgrades = Math.round(finalgrades);
														$("#"+obj.updatestudpt+"finalgradesum").html("<span>"+finalgrades+"</span>");
														computefinalpt = finalgrades;
														if(computefinalpt == 100 && computefinalpt >= 75 ){
															remarkspt = "PASSED";
														}else{
															remarkspt = "PASSED";
														}
														console.log(computefinalpt);
														$.ajax({
															type: "POST",
															url: "../faculty/function.php",
															data: {
																computefinalpt: computefinalpt,
																remarkspt: remarkspt,
																subjecttoupdatept: subjecttoupdatept,
																sectionupdatept: sectionupdatetoupdatept,
																studupdatetoupdatept: studupdatetoupdatept
															},
															success: function(data){
																obj = JSON.parse(data);
																
															}
														});
														
														
													}
					 							}
					 						}
					 					});
					 				});
			 					}
			 				});

						});
						
						$(".btn-edit-grades-qa").click(function(e){
							e.preventDefault();

							getname = $(this).closest("tr").find(".qaname").text();
			 				getid = $(this).closest("tr").find(".qaname").attr("id");
			 				examscore = $(this).closest("tr").find(".exam_score").text();
			 				examscoretoupdate = $(this).closest("tr").find(".exam_score");
			 				psforuser = $(this).closest("tr").find('td.pstotal');
			 				wsforuser = $(this).closest("tr").find('td.wstotal');
			 				getps = $(this).closest("tr.quarterassesment").find('td.pstotal').text();
			 				getws = $(this).closest("tr.quarterassesment").find('td.wstotal').text();
			 				var totalhspqa  = parseInt($(".hspqa_total").text());
			 				$("#editqa").openModal();
			 				$(".nametoupdategradeqa").html(getname);

			 				if(examscore == ""){
			 					$("#qaexamscore").attr("disabled",'');
			 				}else{
			 					$("#qaexamscore").val(examscore);
			 					$("label").attr("for","qaexamscore").addClass("active");
			 				}
			 				$(".psupdateqa").text(getps);
			 				$(".wsupdateqa").text(getws);

			 				$(".examscoreiput").keypress(function(e){
			 					if (e.which == '13') {

			 						examscoreqaupdate = $("#qaexamscore").val();
			 						totalscore = 0;
									qatotal = parseInt($("tr#quarterlyassessment").find(".hspqa_total").text());
									
									pstotal = parseInt(examscoreqaupdate) / qatotal;
									pstotal = pstotal * 100;
									pstotal = pstotal.toFixed(2);
									getwsqapercent = $(".qawspercent").attr("id");
									wsqapercent = parseFloat(getwsqapercent);
									wstotal = pstotal * wsqapercent;
									wstotal = wstotal.toFixed(2);
									if(!$.isNumeric(pstotal)){
										pstotal =0;
									}
									if(!$.isNumeric(wstotal)){
										wstotal=0;
									}

										$(".psupdateqa").text(pstotal);
										$(".wsupdateqa").html(wstotal);
										psforuser.text(pstotal);
										wsforuser.text(wstotal);

										$(".btn-yes-updategradesqa").click(function(e){
											e.preventDefault();
											initialgrade = 0;
										wwwstotal = $("tr.writtenworks").find("td#ww"+getid+"").text();
										ptwstotal = $("tr.performancetask").find("td#pt"+getid+"").text();
										qawstotal = $("tr.quarterassesment").find("td#qa"+getid+"").text();

											if( !$.isNumeric(parseFloat(wwwstotal)) ){
												wwwstotal = 0.00;
											}
											if(!$.isNumeric(parseFloat(ptwstotal))){
												ptwstotal = 0.00;
											}
											if(!$.isNumeric(parseFloat(qawstotal))){
												qawstotal = 0.00;
											}
						 				initialgrade = parseFloat(wwwstotal) + parseFloat(ptwstotal) + parseFloat(qawstotal);

										quarterlygradeupdate =0;

										if(initialgrade == 100){
											quarterlygradeupdate = 100;
										}else if(initialgrade <= 99.99 && initialgrade >= 98.40){
											quarterlygradeupdate = 99;
										}else if(initialgrade <= 98.39 && initialgrade >= 96.80){
											quarterlygradeupdate = 98;
										}else if(initialgrade <= 96.89 && initialgrade >= 95.20){
											quarterlygradeupdate = 97;
										}else if(initialgrade <= 95.19 && initialgrade >= 93.60){
											quarterlygradeupdate = 96;
										}else if(initialgrade <= 93.59 && initialgrade >= 92.00){
											quarterlygradeupdate = 95;
										}else if(initialgrade <= 91.99 && initialgrade >= 90.40){
											quarterlygradeupdate = 94;
										}else if(initialgrade <= 90.39 && initialgrade >= 88.80){
											quarterlygradeupdate = 93;
										}else if(initialgrade <= 88.79 && initialgrade >= 87.20){
											quarterlygradeupdate = 92;
										}else if(initialgrade <= 87.19 && initialgrade >= 85.60){
											quarterlygradeupdate = 91;
										}else if(initialgrade <= 85.59 && initialgrade >= 84.00){
											quarterlygradeupdate = 90;
										}else if(initialgrade <= 83.99 && initialgrade >= 82.40){
											quarterlygradeupdate = 89;
										}else if(initialgrade <= 82.39 && initialgrade >= 80.80){
											quarterlygradeupdate = 88;
										}else if(initialgrade <= 80.79 && initialgrade >= 79.20){
											quarterlygradeupdate = 87;
										}else if(initialgrade <= 79.19 && initialgrade >= 77.60){
											quarterlygradeupdate = 86;
										}else if(initialgrade <= 77.59 && initialgrade >= 76.00){
											quarterlygradeupdate = 85;
										}else if(initialgrade <= 75.99 && initialgrade >= 74.40){
											quarterlygradeupdate = 84;
										}else if(initialgrade <= 74.39 && initialgrade >= 72.80){
											quarterlygradeupdate = 83;
										}else if(initialgrade <= 72.79 && initialgrade >= 71.20){
											quarterlygradeupdate = 82;
										}else if(initialgrade <= 71.19 && initialgrade >= 69.60){
											quarterlygradeupdate = 81;
										}else if(initialgrade <= 69.59 && initialgrade >= 68.00){
											quarterlygradeupdate = 80;
										}else if(initialgrade <= 67.99 && initialgrade >= 66.40){
											quarterlygradeupdate = 79;
										}else if(initialgrade <= 66.39 && initialgrade >= 64.80){
											quarterlygradeupdate = 78;
										}else if(initialgrade <= 64.79 && initialgrade >= 63.20){
											quarterlygradeupdate = 77;
										}else if(initialgrade <= 63.19 && initialgrade >= 61.60){
											quarterlygradeupdate = 76;
										}else if(initialgrade <= 61.59 && initialgrade >= 60.00){
											quarterlygradeupdate = 75;
										}else if(initialgrade <= 59.99 && initialgrade >= 56.00){
											quarterlygradeupdate = 74;
										}else if(initialgrade <= 55.99 && initialgrade >= 52.00){
											quarterlygradeupdate = 73;
										}else if(initialgrade <= 51.99 && initialgrade >= 48.00){
											quarterlygradeupdate = 72;
										}else if(initialgrade <= 47.99 && initialgrade >= 44.00){
											quarterlygradeupdate = 71;
										}else if(initialgrade <= 43.99 && initialgrade >= 40.00){
											quarterlygradeupdate = 70;
										}else if(initialgrade <= 39.99 && initialgrade >= 36.00){
											quarterlygradeupdate = 69;
										}else if(initialgrade <= 35.99 && initialgrade >= 32.00){
											quarterlygradeupdate = 68;
										}else if(initialgrade <= 31.99 && initialgrade >= 28.00){
											quarterlygradeupdate = 67;
										}else if(initialgrade <= 27.99 && initialgrade >= 24.00){
											quarterlygradeupdate = 66;
										}else if(initialgrade <= 23.99 && initialgrade >= 20.00){
											quarterlygradeupdate = 65;
										}else if(initialgrade <= 19.99 && initialgrade >= 16.00){
											quarterlygradeupdate = 64;
										}else if(initialgrade <= 15.99 && initialgrade >= 12.00){
											quarterlygradeupdate = 63;
										}else if(initialgrade <= 11.99 && initialgrade >= 8.00){
											quarterlygradeupdate = 62;
										}else if(initialgrade <= 7.99 && initialgrade >= 4.00){
											quarterlygradeupdate = 61;
										}else if(initialgrade <= 39.99 && initialgrade >= 0){
											quarterlygradeupdate = 60;
										}

												$.ajax({
						 						type: "POST",
						 						url: "../faculty/function.php",
						 						data:{
						 							studenidupdategradeqa: getid,
						 							studentquarterupdateqa: quarterselected,
						 							studentsubjectupdateqa: subjectselectforgrades,
						 							studentclassupdateqa: classselectforgrades,
						 							examscoreqaupdate: examscoreqaupdate,
						 							qapsupdate:  $(".psupdateqa").text(),
						 							qawsupdate:  $(".wsupdateqa").text(),
						 							quarterlygradeupdateqa: quarterlygradeupdate,
						 							initialgradeqa: initialgrade

						 						},
						 						success: function(data){
						 							obj = JSON.parse(data);

						 						

						 							if(obj.updategradeqas == true){
						 								examscoretoupdate.text(obj.examscoreqa);
						 							}
						 							if(obj.goupdateqa == true){
					 								$("tr.grades").find("#ini"+obj.updatestudqa+"").text(obj.updateiniqa);
					 								$("tr.grades").find("#qg"+obj.updatestudqa+"").text(obj.updatequarterlyqa);


					 								}


						 						}
						 					});
										});

			 					}
			 				});




						});


						$(".inputgrades").keypress(function(e){
							gradevalue = $(this).val();
							hsptotalww = parseInt($(".hspww_total").text());
							parsegradevalue = parseInt(gradevalue);
							student = $(this).closest("tr").find("td:first-child").attr("id");
							gradeitem = $(this).closest("td").attr("class");
							gradefor = $(this).closest("tr").attr("class");

							var wwwstotal = 0;
							var ptwstotal = 0;
							var qawstotal = 0;
							if (e.which == '13') {
								e.preventDefault();

								if( !$.isNumeric(parsegradevalue) ){
									$("#invalidgrade").openModal();
								}else if(parsegradevalue < 0 ){
									$("#invalidgrade").openModal();
								}else{
									var closesttr = $(this).closest("tr");
									item_1 = parseInt(closesttr.find("input.item_1").val());
									item_2 = parseInt(closesttr.find("input.item_2").val());
									item_3 = parseInt(closesttr.find("input.item_3").val());
									item_4 = parseInt(closesttr.find("input.item_4").val());
									item_5 = parseInt(closesttr.find("input.item_5").val());
									item_6 = parseInt(closesttr.find("input.item_6").val());
									item_7 = parseInt(closesttr.find("input.item_7").val());
									item_8 = parseInt(closesttr.find("input.item_8").val());
									item_9 = parseInt(closesttr.find("input.item_9").val());
									item_10 = parseInt(closesttr.find("input.item_10").val());

									if(gradefor == "writtenworks"){
										if(gradeitem == "item_1"){
											gethsptext = parseInt($("tr#writtenworks").find(".item_1").text());
											if(!$.isNumeric(gethsptext)){
												gethspval = parseInt($("tr#writtenworks").find(".item_1").val());
												if(!$.isNumeric(gethspval)){
													//please enter hsp first
													$("#errorhsp").openModal();
													$(".errmsgforhsp").html("Please enter Highest Possible Score first (HSP).");
													parsegradevalue = "";
													item_1="";
												}else{
												 	if(parsegradevalue > gethspval){
												 		//print error student score must now exceed the HSP.
												 		$("#errorhsp").openModal();
												 		$(".errmsgforhsp").html("Please enter score not higher than HSP");
												 		parsegradevalue = "";
												 		item_1="";
												 	}

												 }
											}else{
											 	if(parsegradevalue > gethsptext){
											 		//print error student score must now exceed the HSP.
											 		$("#errorhsp").openModal();
											 		$(".errmsgforhsp").html("Please enter score not higher than HSP");
											 		parsegradevalue = "";
											 		item_1="";
											 	}
											}
										}
										if(gradeitem == "item_2"){
											gethsptext = parseInt($("tr#writtenworks").find(".item_2").text());
											if(!$.isNumeric(gethsptext)){
												gethspval = parseInt($("tr#writtenworks").find(".item_2").val());
												if(!$.isNumeric(gethspval)){
													//please enter hsp first
													$("#errorhsp").openModal();
													$(".errmsgforhsp").html("Please enter Highest Possible Score first (HSP).");
													parsegradevalue = "";
													item_2="";
												}else{
												 	if(parsegradevalue > gethspval){
												 		//print error student score must now exceed the HSP.
												 		$("#errorhsp").openModal();
												 		$(".errmsgforhsp").html("Please enter score not higher than HSP");
												 		parsegradevalue = "";
												 		item_2="";
												 	}

												 }
											}else{
											 	if(parsegradevalue > gethsptext){
											 		//print error student score must now exceed the HSP.
											 		$("#errorhsp").openModal();
											 		$(".errmsgforhsp").html("Please enter score not higher than HSP");
											 		parsegradevalue = "";
											 		item_2="";
											 	}
											}
										}
										if(gradeitem == "item_3"){
											gethsptext = parseInt($("tr#writtenworks").find(".item_3").text());
											if(!$.isNumeric(gethsptext)){
												gethspval = parseInt($("tr#writtenworks").find(".item_3").val());
												if(!$.isNumeric(gethspval)){
													//please enter hsp first
													$("#errorhsp").openModal();
													$(".errmsgforhsp").html("Please enter Highest Possible Score first (HSP).");
													parsegradevalue = "";
													item_3="";
												}else{
												 	if(parsegradevalue > gethspval){
												 		//print error student score must now exceed the HSP.
												 		$("#errorhsp").openModal();
												 		$(".errmsgforhsp").html("Please enter score not higher than HSP");
												 		parsegradevalue = "";
												 		item_3="";
												 	}

												 }
											}else{
											 	if(parsegradevalue > gethsptext){
											 		//print error student score must now exceed the HSP.
											 		$("#errorhsp").openModal();
											 		$(".errmsgforhsp").html("Please enter score not higher than HSP");
											 		parsegradevalue = "";
											 		item_3="";
											 	}
											}
										}
										if(gradeitem == "item_4"){
											gethsptext = parseInt($("tr#writtenworks").find(".item_4").text());
											if(!$.isNumeric(gethsptext)){
												gethspval = parseInt($("tr#writtenworks").find(".item_4").val());
												if(!$.isNumeric(gethspval)){
													//please enter hsp first
													$("#errorhsp").openModal();
													$(".errmsgforhsp").html("Please enter Highest Possible Score first (HSP).");
													parsegradevalue = "";
													item_4="";
												}else{
												 	if(parsegradevalue > gethspval){
												 		//print error student score must now exceed the HSP.
												 		$("#errorhsp").openModal();
												 		$(".errmsgforhsp").html("Please enter score not higher than HSP");
												 		parsegradevalue = "";
												 		item_4="";
												 	}

												 }
											}else{
											 	if(parsegradevalue > gethsptext){
											 		//print error student score must now exceed the HSP.
											 		$("#errorhsp").openModal();
											 		$(".errmsgforhsp").html("Please enter score not higher than HSP");
											 		parsegradevalue = "";
											 		item_4="";
											 	}
											}
										}
										if(gradeitem == "item_5"){
											gethsptext = parseInt($("tr#writtenworks").find(".item_5").text());
											if(!$.isNumeric(gethsptext)){
												gethspval = parseInt($("tr#writtenworks").find(".item_5").val());
												if(!$.isNumeric(gethspval)){
													//please enter hsp first
													$("#errorhsp").openModal();
													$(".errmsgforhsp").html("Please enter Highest Possible Score first (HSP).");
													parsegradevalue = "";
													item_5="";
												}else{
												 	if(parsegradevalue > gethspval){
												 		//print error student score must now exceed the HSP.
												 		$("#errorhsp").openModal();
												 		$(".errmsgforhsp").html("Please enter score not higher than HSP");
												 		parsegradevalue = "";
												 		item_5="";
												 	}

												 }
											}else{
											 	if(parsegradevalue > gethsptext){
											 		//print error student score must now exceed the HSP.
											 		$("#errorhsp").openModal();
											 		$(".errmsgforhsp").html("Please enter score not higher than HSP");
											 		parsegradevalue = "";
											 		item_5="";
											 	}
											}
										}
										if(gradeitem == "item_6"){
											gethsptext = parseInt($("tr#writtenworks").find(".item_6").text());
											if(!$.isNumeric(gethsptext)){
												gethspval = parseInt($("tr#writtenworks").find(".item_6").val());
												if(!$.isNumeric(gethspval)){
													//please enter hsp first
													$("#errorhsp").openModal();
													$(".errmsgforhsp").html("Please enter Highest Possible Score first (HSP).");
													parsegradevalue = "";
													item_6="";
												}else{
												 	if(parsegradevalue > gethspval){
												 		//print error student score must now exceed the HSP.
												 		$("#errorhsp").openModal();
												 		$(".errmsgforhsp").html("Please enter score not higher than HSP");
												 		parsegradevalue = "";
												 		item_6="";
												 	}

												 }
											}else{
											 	if(parsegradevalue > gethsptext){
											 		//print error student score must now exceed the HSP.
											 		$("#errorhsp").openModal();
											 		$(".errmsgforhsp").html("Please enter score not higher than HSP");
											 		parsegradevalue = "";
											 		item_6="";
											 	}
											}
										}
										if(gradeitem == "item_7"){
											gethsptext = parseInt($("tr#writtenworks").find(".item_7").text());
											if(!$.isNumeric(gethsptext)){
												gethspval = parseInt($("tr#writtenworks").find(".item_7").val());
												if(!$.isNumeric(gethspval)){
													//please enter hsp first
													$("#errorhsp").openModal();
													$(".errmsgforhsp").html("Please enter Highest Possible Score first (HSP).");
													parsegradevalue = "";
													item_1="";
												}else{
												 	if(parsegradevalue > gethspval){
												 		//print error student score must now exceed the HSP.
												 		$("#errorhsp").openModal();
												 		$(".errmsgforhsp").html("Please enter score not higher than HSP");
												 		parsegradevalue = "";
												 		item_7="";
												 	}

												 }
											}else{
											 	if(parsegradevalue > gethsptext){
											 		//print error student score must now exceed the HSP.
											 		$("#errorhsp").openModal();
											 		$(".errmsgforhsp").html("Please enter score not higher than HSP");
											 		parsegradevalue = "";
											 		item_7="";
											 	}
											}
										}
										if(gradeitem == "item_8"){
											gethsptext = parseInt($("tr#writtenworks").find(".item_8").text());
											if(!$.isNumeric(gethsptext)){
												gethspval = parseInt($("tr#writtenworks").find(".item_8").val());
												if(!$.isNumeric(gethspval)){
													//please enter hsp first
													$("#errorhsp").openModal();
													$(".errmsgforhsp").html("Please enter Highest Possible Score first (HSP).");
													parsegradevalue = "";
													item_8="";
												}else{
												 	if(parsegradevalue > gethspval){
												 		//print error student score must now exceed the HSP.
												 		$("#errorhsp").openModal();
												 		$(".errmsgforhsp").html("Please enter score not higher than HSP");
												 		parsegradevalue = "";
												 		item_8="";
												 	}

												 }
											}else{
											 	if(parsegradevalue > gethsptext){
											 		//print error student score must now exceed the HSP.
											 		$("#errorhsp").openModal();
											 		$(".errmsgforhsp").html("Please enter score not higher than HSP");
											 		parsegradevalue = "";
											 		item_8="";
											 	}
											}
										}
										if(gradeitem == "item_9"){
											gethsptext = parseInt($("tr#writtenworks").find(".item_9").text());
											if(!$.isNumeric(gethsptext)){
												gethspval = parseInt($("tr#writtenworks").find(".item_9").val());
												if(!$.isNumeric(gethspval)){
													//please enter hsp first
													$("#errorhsp").openModal();
													$(".errmsgforhsp").html("Please enter Highest Possible Score first (HSP).");
													parsegradevalue = "";
													item_9="";
												}else{
												 	if(parsegradevalue > gethspval){
												 		//print error student score must now exceed the HSP.
												 		$("#errorhsp").openModal();
												 		$(".errmsgforhsp").html("Please enter score not higher than HSP");
												 		parsegradevalue = "";
												 		item_9="";
												 	}

												 }
											}else{
											 	if(parsegradevalue > gethsptext){
											 		//print error student score must now exceed the HSP.
											 		$("#errorhsp").openModal();
											 		$(".errmsgforhsp").html("Please enter score not higher than HSP");
											 		parsegradevalue = "";
											 		item_9="";
											 	}
											}
										}
										if(gradeitem == "item_10"){
											gethsptext = parseInt($("tr#writtenworks").find(".item_10").text());
											if(!$.isNumeric(gethsptext)){
												gethspval = parseInt($("tr#writtenworks").find(".item_10").val());
												if(!$.isNumeric(gethspval)){
													//please enter hsp first
													$("#errorhsp").openModal();
													$(".errmsgforhsp").html("Please enter Highest Possible Score first (HSP).");
													parsegradevalue = "";
													item_10="";
												}else{
												 	if(parsegradevalue > gethspval){
												 		//print error student score must now exceed the HSP.
												 		$("#errorhsp").openModal();
												 		$(".errmsgforhsp").html("Please enter score not higher than HSP");
												 		parsegradevalue = "";
												 		item_1="";
												 	}

												 }
											}else{
											 	if(parsegradevalue > gethsptext){
											 		//print error student score must now exceed the HSP.
											 		$("#errorhsp").openModal();
											 		$(".errmsgforhsp").html("Please enter score not higher than HSP");
											 		parsegradevalue = "";
											 		item_10="";
											 	}
											}
										}

									}
									if(gradefor == "performancetask"){
										if(gradeitem == "item_1"){
											gethsptext = parseInt($("tr#performancetasks").find(".item_1").text());
											if(!$.isNumeric(gethsptext)){
												gethspval = parseInt($("tr#performancetasks").find(".item_1").val());
												if(!$.isNumeric(gethspval)){
													//please enter hsp first
													$("#errorhsp").openModal();
													$(".errmsgforhsp").html("Please enter Highest Possible Score first (HSP).");
													parsegradevalue = "";
													item_1="";
												}else{
												 	if(parsegradevalue > gethspval){
												 		//print error student score must now exceed the HSP.
												 		$("#errorhsp").openModal();
												 		$(".errmsgforhsp").html("Please enter score not higher than HSP");
												 		parsegradevalue = "";
												 		item_1="";
												 	}

												 }
											}else{
											 	if(parsegradevalue > gethsptext){
											 		//print error student score must now exceed the HSP.
											 		$("#errorhsp").openModal();
											 		$(".errmsgforhsp").html("Please enter score not higher than HSP");
											 		parsegradevalue = "";
											 		item_1="";
											 	}
											}
										}
										if(gradeitem == "item_2"){
											gethsptext = parseInt($("tr#performancetasks").find(".item_2").text());
											if(!$.isNumeric(gethsptext)){
												gethspval = parseInt($("tr#performancetasks").find(".item_2").val());
												if(!$.isNumeric(gethspval)){
													//please enter hsp first
													$("#errorhsp").openModal();
													$(".errmsgforhsp").html("Please enter Highest Possible Score first (HSP).");
													parsegradevalue = "";
													item_2="";
												}else{
												 	if(parsegradevalue > gethspval){
												 		//print error student score must now exceed the HSP.
												 		$("#errorhsp").openModal();
												 		$(".errmsgforhsp").html("Please enter score not higher than HSP");
												 		parsegradevalue = "";
												 		item_2="";
												 	}

												 }
											}else{
											 	if(parsegradevalue > gethsptext){
											 		//print error student score must now exceed the HSP.
											 		$("#errorhsp").openModal();
											 		$(".errmsgforhsp").html("Please enter score not higher than HSP");
											 		parsegradevalue = "";
											 		item_2="";
											 	}
											}
										}
										if(gradeitem == "item_3"){
											gethsptext = parseInt($("tr#performancetasks").find(".item_3").text());
											if(!$.isNumeric(gethsptext)){
												gethspval = parseInt($("tr#performancetasks").find(".item_3").val());
												if(!$.isNumeric(gethspval)){
													//please enter hsp first
													$("#errorhsp").openModal();
													$(".errmsgforhsp").html("Please enter Highest Possible Score first (HSP).");
													parsegradevalue = "";
													item_3="";
												}else{
												 	if(parsegradevalue > gethspval){
												 		//print error student score must now exceed the HSP.
												 		$("#errorhsp").openModal();
												 		$(".errmsgforhsp").html("Please enter score not higher than HSP");
												 		parsegradevalue = "";
												 		item_3="";
												 	}

												 }
											}else{
											 	if(parsegradevalue > gethsptext){
											 		//print error student score must now exceed the HSP.
											 		$("#errorhsp").openModal();
											 		$(".errmsgforhsp").html("Please enter score not higher than HSP");
											 		parsegradevalue = "";
											 		item_3="";
											 	}
											}
										}
										if(gradeitem == "item_4"){
											gethsptext = parseInt($("tr#performancetasks").find(".item_4").text());
											if(!$.isNumeric(gethsptext)){
												gethspval = parseInt($("tr#performancetasks").find(".item_4").val());
												if(!$.isNumeric(gethspval)){
													//please enter hsp first
													$("#errorhsp").openModal();
													$(".errmsgforhsp").html("Please enter Highest Possible Score first (HSP).");
													parsegradevalue = "";
													item_4="";
												}else{
												 	if(parsegradevalue > gethspval){
												 		//print error student score must now exceed the HSP.
												 		$("#errorhsp").openModal();
												 		$(".errmsgforhsp").html("Please enter score not higher than HSP");
												 		parsegradevalue = "";
												 		item_4="";
												 	}

												 }
											}else{
											 	if(parsegradevalue > gethsptext){
											 		//print error student score must now exceed the HSP.
											 		$("#errorhsp").openModal();
											 		$(".errmsgforhsp").html("Please enter score not higher than HSP");
											 		parsegradevalue = "";
											 		item_4="";
											 	}
											}
										}
										if(gradeitem == "item_5"){
											gethsptext = parseInt($("tr#performancetasks").find(".item_5").text());
											if(!$.isNumeric(gethsptext)){
												gethspval = parseInt($("tr#performancetasks").find(".item_5").val());
												if(!$.isNumeric(gethspval)){
													//please enter hsp first
													$("#errorhsp").openModal();
													$(".errmsgforhsp").html("Please enter Highest Possible Score first (HSP).");
													parsegradevalue = "";
													item_5="";
												}else{
												 	if(parsegradevalue > gethspval){
												 		//print error student score must now exceed the HSP.
												 		$("#errorhsp").openModal();
												 		$(".errmsgforhsp").html("Please enter score not higher than HSP");
												 		parsegradevalue = "";
												 		item_5="";
												 	}

												 }
											}else{
											 	if(parsegradevalue > gethsptext){
											 		//print error student score must now exceed the HSP.
											 		$("#errorhsp").openModal();
											 		$(".errmsgforhsp").html("Please enter score not higher than HSP");
											 		parsegradevalue = "";
											 		item_5="";
											 	}
											}
										}
										if(gradeitem == "item_6"){
											gethsptext = parseInt($("tr#performancetasks").find(".item_6").text());
											if(!$.isNumeric(gethsptext)){
												gethspval = parseInt($("tr#performancetasks").find(".item_6").val());
												if(!$.isNumeric(gethspval)){
													//please enter hsp first
													$("#errorhsp").openModal();
													$(".errmsgforhsp").html("Please enter Highest Possible Score first (HSP).");
													parsegradevalue = "";
													item_6="";
												}else{
												 	if(parsegradevalue > gethspval){
												 		//print error student score must now exceed the HSP.
												 		$("#errorhsp").openModal();
												 		$(".errmsgforhsp").html("Please enter score not higher than HSP");
												 		parsegradevalue = "";
												 		item_6="";
												 	}

												 }
											}else{
											 	if(parsegradevalue > gethsptext){
											 		//print error student score must now exceed the HSP.
											 		$("#errorhsp").openModal();
											 		$(".errmsgforhsp").html("Please enter score not higher than HSP");
											 		parsegradevalue = "";
											 		item_6="";
											 	}
											}
										}
										if(gradeitem == "item_7"){
											gethsptext = parseInt($("tr#performancetasks").find(".item_7").text());
											if(!$.isNumeric(gethsptext)){
												gethspval = parseInt($("tr#performancetasks").find(".item_7").val());
												if(!$.isNumeric(gethspval)){
													//please enter hsp first
													$("#errorhsp").openModal();
													$(".errmsgforhsp").html("Please enter Highest Possible Score first (HSP).");
													parsegradevalue = "";
													item_1="";
												}else{
												 	if(parsegradevalue > gethspval){
												 		//print error student score must now exceed the HSP.
												 		$("#errorhsp").openModal();
												 		$(".errmsgforhsp").html("Please enter score not higher than HSP");
												 		parsegradevalue = "";
												 		item_7="";
												 	}

												 }
											}else{
											 	if(parsegradevalue > gethsptext){
											 		//print error student score must now exceed the HSP.
											 		$("#errorhsp").openModal();
											 		$(".errmsgforhsp").html("Please enter score not higher than HSP");
											 		parsegradevalue = "";
											 		item_7="";
											 	}
											}
										}
										if(gradeitem == "item_8"){
											gethsptext = parseInt($("tr#performancetasks").find(".item_8").text());
											if(!$.isNumeric(gethsptext)){
												gethspval = parseInt($("tr#performancetasks").find(".item_8").val());
												if(!$.isNumeric(gethspval)){
													//please enter hsp first
													$("#errorhsp").openModal();
													$(".errmsgforhsp").html("Please enter Highest Possible Score first (HSP).");
													parsegradevalue = "";
													item_8="";
												}else{
												 	if(parsegradevalue > gethspval){
												 		//print error student score must now exceed the HSP.
												 		$("#errorhsp").openModal();
												 		$(".errmsgforhsp").html("Please enter score not higher than HSP");
												 		parsegradevalue = "";
												 		item_8="";
												 	}

												 }
											}else{
											 	if(parsegradevalue > gethsptext){
											 		//print error student score must now exceed the HSP.
											 		$("#errorhsp").openModal();
											 		$(".errmsgforhsp").html("Please enter score not higher than HSP");
											 		parsegradevalue = "";
											 		item_8="";
											 	}
											}
										}
										if(gradeitem == "item_9"){
											gethsptext = parseInt($("tr#performancetasks").find(".item_9").text());
											if(!$.isNumeric(gethsptext)){
												gethspval = parseInt($("tr#performancetasks").find(".item_9").val());
												if(!$.isNumeric(gethspval)){
													//please enter hsp first
													$("#errorhsp").openModal();
													$(".errmsgforhsp").html("Please enter Highest Possible Score first (HSP).");
													parsegradevalue = "";
													item_9="";
												}else{
												 	if(parsegradevalue > gethspval){
												 		//print error student score must now exceed the HSP.
												 		$("#errorhsp").openModal();
												 		$(".errmsgforhsp").html("Please enter score not higher than HSP");
												 		parsegradevalue = "";
												 		item_9="";
												 	}

												 }
											}else{
											 	if(parsegradevalue > gethsptext){
											 		//print error student score must now exceed the HSP.
											 		$("#errorhsp").openModal();
											 		$(".errmsgforhsp").html("Please enter score not higher than HSP");
											 		parsegradevalue = "";
											 		item_9="";
											 	}
											}
										}
										if(gradeitem == "item_10"){
											gethsptext = parseInt($("tr#performancetasks").find(".item_10").text());
											if(!$.isNumeric(gethsptext)){
												gethspval = parseInt($("tr#performancetasks").find(".item_10").val());
												if(!$.isNumeric(gethspval)){
													//please enter hsp first
													$("#errorhsp").openModal();
													$(".errmsgforhsp").html("Please enter Highest Possible Score first (HSP).");
													parsegradevalue = "";
													item_10="";
												}else{
												 	if(parsegradevalue > gethspval){
												 		//print error student score must now exceed the HSP.
												 		$("#errorhsp").openModal();
												 		$(".errmsgforhsp").html("Please enter score not higher than HSP");
												 		parsegradevalue = "";
												 		item_10="";
												 	}

												 }
											}else{
											 	if(parsegradevalue > gethsptext){
											 		//print error student score must now exceed the HSP.
											 		$("#errorhsp").openModal();
											 		$(".errmsgforhsp").html("Please enter score not higher than HSP");
											 		parsegradevalue = "";
											 		item_10="";
											 	}
											}
										}

									}
									if(gradefor == "quarterassesment"){
										if(gradeitem == "exam_score"){
											gethsptext = parseInt($("tr#quarterlyassessment").find(".item_1").text());
											if(!$.isNumeric(gethsptext)){
												gethspval = parseInt($("tr#quarterlyassessment").find(".item_1").val());
												if(!$.isNumeric(gethspval)){
													//please enter hsp first
													$("#errorhsp").openModal();
													$(".errmsgforhsp").html("Please enter Highest Possible Score first (HSP).");
													parsegradevalue = "";
													item_1="";
												}else{
												 	if(parsegradevalue > gethspval){
												 		//print error student score must now exceed the HSP.
												 		$("#errorhsp").openModal();
												 		$(".errmsgforhsp").html("Please enter score not higher than HSP");
												 		parsegradevalue = "";
												 		item_1="";
												 	}

												 }
											}else{
											 	if(parsegradevalue > gethsptext){
											 		//print error student score must now exceed the HSP.
											 		$("#errorhsp").openModal();
											 		$(".errmsgforhsp").html("Please enter score not higher than HSP");
											 		parsegradevalue = "";
											 		item_1="";
											 	}
											}
										}
									}

									if(gradefor == 'quarterassesment'){
										totalscore = 0;
										qatotal = parseInt($("tr#quarterlyassessment").find(".item_1").text());
										if( !$.isNumeric(qatotal) ){
											pstotal = parsegradevalue / parseInt($("tr#quarterlyassessment").find("input.item_1").val());
											pstotal = pstotal * 100;
										}else{
											pstotal = parsegradevalue / qatotal;
											pstotal = pstotal * 100;
										}

										pstotal = pstotal.toFixed(2);
										getwsqapercent = $(".qawspercent").attr("id");
										wsqapercent = parseFloat(getwsqapercent);
										wstotal = pstotal * wsqapercent;
										wstotal = wstotal.toFixed(2);
										if(!$.isNumeric(pstotal)){
											pstotal =0;
										}
										if(!$.isNumeric(wstotal)){
											wstotal=0;
										}
										$(this).closest("tr").find(".pstotal").html("<span>"+pstotal+"</span>");
										$(this).closest("tr").find(".wstotal").html("<span>"+wstotal+"</span>");

										var initialgrade = 0;
										wwwstotal = $("tr.writtenworks").find("td.wstotal").text();
										ptwstotal = $("tr.performancetask").find("td.wstotal").text();
										qawstotal = $("tr.quarterassesment").find("td.wstotal").text();

										
										if( !$.isNumeric(parseFloat(wwwstotal)) ){
											wwwstotal = 0.00;
										}
										if(!$.isNumeric(parseFloat(ptwstotal))){
											ptwstotal = 0.00;
										}
										
										initialgrade = parseFloat(wwwstotal) + parseFloat(ptwstotal) + parseFloat(qawstotal);


										
									}else{
										if(!$.isNumeric(item_1)){
											item_1 = parseInt(closesttr.find("td.item_1").text());
											if(!$.isNumeric(item_1)){
												item_1 = 0;
												}
										}
										if(!$.isNumeric(item_2)){
											item_2 = parseInt(closesttr.find("td.item_2").text());
											if(!$.isNumeric(item_2)){
												item_2 = 0;
											}
										}
										if(!$.isNumeric(item_3)){
											item_3 = parseInt(closesttr.find("td.item_3").text());
											if(!$.isNumeric(item_3)){
												item_3 = 0;
											}
										}
										if(!$.isNumeric(item_4)){
											item_4 = parseInt(closesttr.find("td.item_4").text());
											if(!$.isNumeric(item_4)){
												item_4 = 0;
											}
										}
										if(!$.isNumeric(item_5)){
											item_5 = parseInt(closesttr.find("td.item_5").text());
											if(!$.isNumeric(item_5)){
												item_5 = 0;
											}
										}
										if(!$.isNumeric(item_6)){
											item_6 = parseInt(closesttr.find("td.item_6").text());
											if(!$.isNumeric(item_6)){
												item_6 = 0;
											}
										}
										if(!$.isNumeric(item_7)){
											item_7 = parseInt(closesttr.find("td.item_7").text());
											if(!$.isNumeric(item_7)){
												item_7 = 0;
											}
										}
										if(!$.isNumeric(item_8)){
											item_8 = parseInt(closesttr.find("td.item_8").text());
											if(!$.isNumeric(item_8)){
												item_8 = 0;
											}
										}
										if(!$.isNumeric(item_9)){
											item_9 = parseInt(closesttr.find("td.item_9").text());
											if(!$.isNumeric(item_9)){
												item_9 = 0;
											}
										}
										if(!$.isNumeric(item_10)){
											item_10 = parseInt(closesttr.find("td.item_10").text());
											if(!$.isNumeric(item_10)){
												item_10 = 0;
											}
										}
									}
									

									totalscore = item_1+item_2+item_3+item_4+item_5+item_6+item_7+item_8+item_9+item_10;

									
									if( gradefor == "writtenworks" ){
										psdivide = totalscore/hsptotalww;
										pstotal = psdivide * 100;
										pstotal = pstotal.toFixed(2);
										getwswwpercent = $(".wwwspercent").attr("id");
										wswwpercent = parseFloat(getwswwpercent);
										wstotal = pstotal * wswwpercent;
										wstotal = wstotal.toFixed(2);
										if(!$.isNumeric(pstotal)){
											pstotal =0;
										}
										if(!$.isNumeric(wstotal)){
											wstotal=0;
										}
										$(this).closest("tr").find(".totalforgradeww").html("<span>"+totalscore+"</span>");
										$(this).closest("tr").find(".pstotal").html("<span>"+pstotal+"</span>");
										$(this).closest("tr").find(".wstotal").html("<span>"+wstotal+"</span>");

									}
									if( gradefor == "performancetask" ){
										hsptotalpt = parseInt($(".hsppt_total").text());
										psdivide = totalscore/hsptotalpt;
										pstotal = psdivide * 100;
										pstotal = pstotal.toFixed(2);
										getwsptpercent = $(".ptwspercent").attr("id");
										wsptpercent = parseFloat(getwsptpercent);
										wstotal = pstotal * wsptpercent;
										wstotal = wstotal.toFixed(2);
										if(!$.isNumeric(pstotal)){
											pstotal =0;
										}
										if(!$.isNumeric(wstotal)){
											wstotal=0;
										}
										$(this).closest("tr").find(".totalforgradeww").html("<span>"+totalscore+"</span>");
										$(this).closest("tr").find(".pstotal").html("<span>"+pstotal+"</span>");
										$(this).closest("tr").find(".wstotal").html("<span>"+wstotal+"</span>");

									}
									var initialgrade = 0;
									wwwstotal = $("tr.writtenworks").find("td#ww"+student+"").text();
									ptwstotal = $("tr.performancetask").find("td#pt"+student+"").text();
									qawstotal = $("tr.quarterassesment").find("td#qa"+student+"").text();

									
									if( !$.isNumeric(parseFloat(wwwstotal)) ){
										wwwstotal = 0.00;
									}
									if(!$.isNumeric(parseFloat(ptwstotal))){
										ptwstotal = 0.00;
									}
									if(!$.isNumeric(parseFloat(qawstotal))){
										qawstotal = 0.00;
									}

									initialgrade = parseFloat(wwwstotal) + parseFloat(ptwstotal) + parseFloat(qawstotal);

									var quarterlygrade =0;

									if(initialgrade == 100){
										quarterlygrade = 100;
									}else if(initialgrade <= 99.99 && initialgrade >= 98.40){
										quarterlygrade = 99;
									}else if(initialgrade <= 98.39 && initialgrade >= 96.80){
										quarterlygrade = 98;
									}else if(initialgrade <= 96.89 && initialgrade >= 95.20){
										quarterlygrade = 97;
									}else if(initialgrade <= 95.19 && initialgrade >= 93.60){
										quarterlygrade = 96;
									}else if(initialgrade <= 93.59 && initialgrade >= 92.00){
										quarterlygrade = 95;
									}else if(initialgrade <= 91.99 && initialgrade >= 90.40){
										quarterlygrade = 94;
									}else if(initialgrade <= 90.39 && initialgrade >= 88.80){
										quarterlygrade = 93;
									}else if(initialgrade <= 88.79 && initialgrade >= 87.20){
										quarterlygrade = 92;
									}else if(initialgrade <= 87.19 && initialgrade >= 85.60){
										quarterlygrade = 91;
									}else if(initialgrade <= 85.59 && initialgrade >= 84.00){
										quarterlygrade = 90;
									}else if(initialgrade <= 83.99 && initialgrade >= 82.40){
										quarterlygrade = 89;
									}else if(initialgrade <= 82.39 && initialgrade >= 80.80){
										quarterlygrade = 88;
									}else if(initialgrade <= 80.79 && initialgrade >= 79.20){
										quarterlygrade = 87;
									}else if(initialgrade <= 79.19 && initialgrade >= 77.60){
										quarterlygrade = 86;
									}else if(initialgrade <= 77.59 && initialgrade >= 76.00){
										quarterlygrade = 85;
									}else if(initialgrade <= 75.99 && initialgrade >= 74.40){
										quarterlygrade = 84;
									}else if(initialgrade <= 74.39 && initialgrade >= 72.80){
										quarterlygrade = 83;
									}else if(initialgrade <= 72.79 && initialgrade >= 71.20){
										quarterlygrade = 82;
									}else if(initialgrade <= 71.19 && initialgrade >= 69.60){
										quarterlygrade = 81;
									}else if(initialgrade <= 69.59 && initialgrade >= 68.00){
										quarterlygrade = 80;
									}else if(initialgrade <= 67.99 && initialgrade >= 66.40){
										quarterlygrade = 79;
									}else if(initialgrade <= 66.39 && initialgrade >= 64.80){
										quarterlygrade = 78;
									}else if(initialgrade <= 64.79 && initialgrade >= 63.20){
										quarterlygrade = 77;
									}else if(initialgrade <= 63.19 && initialgrade >= 61.60){
										quarterlygrade = 76;
									}else if(initialgrade <= 61.59 && initialgrade >= 60.00){
										quarterlygrade = 75;
									}else if(initialgrade <= 59.99 && initialgrade >= 56.00){
										quarterlygrade = 74;
									}else if(initialgrade <= 55.99 && initialgrade >= 52.00){
										quarterlygrade = 73;
									}else if(initialgrade <= 51.99 && initialgrade >= 48.00){
										quarterlygrade = 72;
									}else if(initialgrade <= 47.99 && initialgrade >= 44.00){
										quarterlygrade = 71;
									}else if(initialgrade <= 43.99 && initialgrade >= 40.00){
										quarterlygrade = 70;
									}else if(initialgrade <= 39.99 && initialgrade >= 36.00){
										quarterlygrade = 69;
									}else if(initialgrade <= 35.99 && initialgrade >= 32.00){
										quarterlygrade = 68;
									}else if(initialgrade <= 31.99 && initialgrade >= 28.00){
										quarterlygrade = 67;
									}else if(initialgrade <= 27.99 && initialgrade >= 24.00){
										quarterlygrade = 66;
									}else if(initialgrade <= 23.99 && initialgrade >= 20.00){
										quarterlygrade = 65;
									}else if(initialgrade <= 19.99 && initialgrade >= 16.00){
										quarterlygrade = 64;
									}else if(initialgrade <= 15.99 && initialgrade >= 12.00){
										quarterlygrade = 63;
									}else if(initialgrade <= 11.99 && initialgrade >= 8.00){
										quarterlygrade = 62;
									}else if(initialgrade <= 7.99 && initialgrade >= 4.00){
										quarterlygrade = 61;
									}else if(initialgrade <= 39.99 && initialgrade >= 0){
										quarterlygrade = 60;
									}

								$("#ini"+student+"").html("<span>"+initialgrade+"</span>");
								$("#qg"+student+"").html("<span>"+quarterlygrade+"</span>");
								if(quarterselected == "quarterone"){
									$("#"+student+"quarterone").html("<span>"+quarterlygrade+"</span>");
								}else if(quarterselected == "quartertwo"){
									$("#"+student+"quartertwo").html("<span>"+quarterlygrade+"</span>");
								}else if(quarterselected == "quarterthree"){
									$("#"+student+"quarterthree").html("<span>"+quarterlygrade+"</span>");
								}else if(quarterselected == "quarterfour"){
									$("#"+student+"quarterfour").html("<span>"+quarterlygrade+"</span>");
								}

								sum1 = parseInt($("#"+student+"quarterone").text());
								sum2 = parseInt($("#"+student+"quartertwo").text());
								sum3 = parseInt($("#"+student+"quarterthree").text());
								sum4 = parseInt($("#"+student+"quarterfour").text());
								var finalgrade = 0;
								if(!$.isNumeric(sum1) || !$.isNumeric(sum2) || !$.isNumeric(sum3) || !$.isNumeric(sum4)){
								}else{
									sumall = sum1 + sum2 + sum3 + sum4;
									finalgrade = sumall / 4;
									finalgrade = Math.round(finalgrade);
									$("#"+student+"finalgradesum").html("<span>"+finalgrade+"</span>");
									if(finalgrade == 100 && finalgrade >= 75){
										remark = "PASSED";
									}else{
										remark = "FAILED";
									}
								}
								
									$.ajax({
										type: "POST",
										url: "../faculty/function.php",
										data:{
											student: student,
											gradevalue: parsegradevalue,
											gradeitem: gradeitem,
											gradefor: gradefor,
											gradequarter: quarterselected,
											gradesubject: subjectselectforgrades,
											gradesection: classselectforgrades,
											totalscore:totalscore,
											pstotal: pstotal,
											wstotal: wstotal,
											initialgrade: initialgrade,
											quarterlygrade:quarterlygrade,
											finalgrade: finalgrade
										},
										success:function(data){
											obj = JSON.parse(data);

										}
									});
								
								}


							}
						});
				
						

			 			$(".hpsinput").keypress(function(e){
			 				item = $(this).find("input").attr("class");
							hpsval = $(this).find("input").val();
							hpsfor = $(this).closest("tr").attr("id");
							parsehpsval = parseInt(hpsval);
							if (e.which == '13') {
								e.preventDefault();
								if( !$.isNumeric(parsehpsval) ){
									$("#emptyhps").openModal();
								}else if(parsehpsval <= 0 ){
									$("#emptyhps").openModal();
								}else{
									var totalscorehsp;

								if(hpsfor == "quarterlyassessment"){
									totalscorehsp = 0;
								}else{
									var closesttrhsp = $(this).closest("tr");
									item_1 = parseInt(closesttrhsp.find("input.item_1").val());
									item_2 = parseInt(closesttrhsp.find("input.item_2").val());
									item_3 = parseInt(closesttrhsp.find("input.item_3").val());
									item_4 = parseInt(closesttrhsp.find("input.item_4").val());
									item_5 = parseInt(closesttrhsp.find("input.item_5").val());
									item_6 = parseInt(closesttrhsp.find("input.item_6").val());
									item_7 = parseInt(closesttrhsp.find("input.item_7").val());
									item_8 = parseInt(closesttrhsp.find("input.item_8").val());
									item_9 = parseInt(closesttrhsp.find("input.item_9").val());
									item_10 = parseInt(closesttrhsp.find("input.item_10").val());
									
									if(!$.isNumeric(item_1)){
										item_1 = parseInt(closesttrhsp.find("span.item_1").text());
										if(!$.isNumeric(item_1)){
											item_1 = 0;
											}
									}
									if(!$.isNumeric(item_2)){
										item_2 = parseInt(closesttrhsp.find("span.item_2").text());
										if(!$.isNumeric(item_2)){
											item_2 = 0;
											}
									}
									if(!$.isNumeric(item_3)){
										item_3 = parseInt(closesttrhsp.find("span.item_3").text());
										if(!$.isNumeric(item_3)){
											item_3 = 0;
											}
									}
									if(!$.isNumeric(item_4)){
										item_4 = parseInt(closesttrhsp.find("span.item_4").text());
										if(!$.isNumeric(item_4)){
											item_4 = 0;
											}
									}
									if(!$.isNumeric(item_5)){
										item_5 = parseInt(closesttrhsp.find("span.item_5").text());
										if(!$.isNumeric(item_5)){
											item_5 = 0;
											}
									}
									if(!$.isNumeric(item_6)){
										item_6 = parseInt(closesttrhsp.find("span.item_6").text());
										if(!$.isNumeric(item_6)){
											item_6 = 0;
											}
									}
									if(!$.isNumeric(item_7)){
										item_7 = parseInt(closesttrhsp.find("span.item_7").text());
										if(!$.isNumeric(item_7)){
											item_7 = 0;
											}
									}
									if(!$.isNumeric(item_8)){
										item_8 = parseInt(closesttrhsp.find("span.item_8").text());
										if(!$.isNumeric(item_8)){
											item_8 = 0;
											}
									}
									if(!$.isNumeric(item_9)){
										item_9 = parseInt(closesttrhsp.find("span.item_9").text());
										if(!$.isNumeric(item_9)){
											item_9 = 0;
											}
									}
									if(!$.isNumeric(item_10)){
										item_10 = parseInt(closesttrhsp.find("span.item_10").text());
										if(!$.isNumeric(item_10)){
											item_10 = 0;
											}
									}

									totalscorehsp = item_1+item_2+item_3+item_4+item_5+item_6+item_7+item_8+item_9+item_10;

									if(hpsfor == "writtenworks"){
										$(".hspww_total").html(totalscorehsp);
									}

									if(hpsfor == "performancetasks"){
										$(".hsppt_total").html(totalscorehsp);
									}

								}
								
									$.ajax({
									type: "POST",
									url: "../faculty/function.php",
									data: {
										hpsval: parsehpsval,
										hpsquarter: quarterselected,
										hpsfor: hpsfor,
										hsp_subject: subjectselectforgrades,
										hsp_section: classselectforgrades,
										item: item,
										totalscorehsp: totalscorehsp
									},
									success: function(data){
										obj = JSON.parse(data);
										}
									});
								}
								
							}
							
						});
						
			 		}
			 	});
			});	
	

			
			//Get all class for eval
			if(obj.selectallclassoption === "none"){

			}else{
				$(".classoptiondisableclass").after(obj.selectallclassoption);
			}
			var classselect;
			$("#eval_class").change(function(e){
				e.preventDefault();
				    $('#eval_student option:first').prop('selected',true);
				    $('option', $("#eval_student")).not(':eq(0)').remove();
				    $(".subjectlistforstudent").removeClass("visible-input").addClass("hidden-input");
					classselect=$(this).val();
				$.ajax({
					type:"POST",
					url: "../faculty/function.php",
					data: {
						classselected : classselect
					},
					success: function(data){
						obj = JSON.parse(data);
						if( obj.studentclassselected){
							$("#eval_student").removeClass("hidden-input").addClass("visible-input");
							$(".classoptiondisablestudent").after(obj.studentclassselected);

						}
					}
				});

			});

			$("#eval_student").change(function(e){
				e.preventDefault();
				var studentselect=$(this).val();
				$.ajax({
					type: "POST",
					url: "../faculty/function.php",
					data:{
						studentselect : studentselect,
						studentclass : classselect
					},
					success:function(data){
						obj = JSON.parse(data);

						if(obj.subjectcapture){
							$(".subjectlistforstudent").removeClass("hidden-input").addClass("visible-input");
							$(".chart").removeClass("visible").addClass("invisible");
							$(".showsubjects").html(obj.subjectcapture);
							$(".radiosubject").change(function(e){
								e.preventDefault();
								$(".chart").removeClass("invisible").addClass("visible");
								if(this.checked) {
							       	subjeval = $(this).val();

							       	$.ajax({
							       		type: "POST",
							       		url: "../faculty/function.php",
							       		data: {
							       			subjeval: subjeval,
							       			studenteval: studentselect,
							       			sectioneval: classselect
							       		},
							       		success: function(data){
							       			obj = JSON.parse(data);
							       			var quarterone = parseInt(obj.quarteroneeval);
							       			var quartertwo =parseInt(obj.quartertwoeval);
							       			var quarterthree =parseInt(obj.quarterthreeeval);
							       			var quarterfour =parseInt(obj.quarterfoureval);
							       			var finalgradeevalutation =parseInt(obj.finaleval);
							       			var subjectevaluation = obj.evalsubject;

							       			if(!$.isNumeric(finalgradeevalutation)){
							       				finalgradeevalutation ="No records found";
							       			}

							       			var dps = [{label: "1st Quarter", y: quarterone }, {label: "2nd Quarter", y: quartertwo }, {label: "3rd Quarter", y: quarterthree}, {label: "4th Quarter", y: quarterfour}];
							   
										var options = { 
											animationEnabled: true, 
											animationDuration: 1500,
											axisY:{
											maximum:100,
											minimum:59,
											},
											title:{
											   text: "Final Grade: "+finalgradeevalutation+"",
											},
											axisX:{
											valueFormatString: "#",
											},

												data: [
													{
													type: "column", //change it to column, spline, line, pie, etc
													dataPoints:dps
													},

												]
										};

										$("#chartContainer").CanvasJSChart(options);

											
							       		}
							       	});


							    }
							});
						}
					}
				});
			});

			



			$(".add-student-class").click(function(e){
				e.preventDefault();
				getsection = $(this).closest("li.li-class").find(".li-class-section").text();
				getsubject = $(this).closest("li.li-class").find(".li-class-subject").text();
				$(".add-student-section-name").html("in "+" "+getsection);
				$("#add-student").openModal();


					$("#student-list-form").submit(function(e){
					e.preventDefault();

					if( $.trim($("#student_id").val()) === ""){
						$("#student_id").removeClass("valid").addClass("invalid");
					}else{
						$("#student_id").removeClass("invalid").addClass("valid");
					} 
					if( $.trim($("#student_first_name").val()) === ""){
						$("#student_first_name").removeClass("valid").addClass("invalid");
					}else{
						$("#student_first_name").removeClass("invalid").addClass("valid");
					} 
					if( $.trim($("#student_middle_name").val()) === ""){
						$("#student_middle_name").removeClass("valid").addClass("invalid");
					}else{
						$("#student_middle_name").removeClass("invalid").addClass("valid");
					}
					if( $.trim($("#student_last_name").val()) === ""){
						$("#student_last_name").removeClass("valid").addClass("invalid");
					}else{
						$("#student_last_name").removeClass("invalid").addClass("valid");
					}
					if( $.trim($("#student_address").val()) === ""){
						$("#student_address").removeClass("valid").addClass("invalid");
					}else{
						$("#student_address").removeClass("invalid").addClass("valid");
					}
					if( $.trim($("#student_guardianfn").val()) === ""){
						$("#student_guardianfn").removeClass("valid").addClass("invalid");
					}else{
						$("#student_guardianfn").removeClass("invalid").addClass("valid");
					}
					if( $.trim($("#student_guardianln").val()) === ""){
						$("#student_guardianln").removeClass("valid").addClass("invalid");
					}else{
						$("#student_guardianln").removeClass("invalid").addClass("valid");
					}
					if( !$(".inputaddstud").hasClass("invalid") ){
						var form_data = $("#student-list-form").serializeArray();
						form_data.push({ 'name' : 'student_section', 'value' : getsection });
						form_data.push({ 'name' : 'student_subject', 'value' : getsubject });

						$.ajax({
							type: "POST",
							url: "../faculty/function.php",
							data: form_data,
							beforeSend: function(data){
								$(".btn-add-student").html("Adding Student..");
							},
							success: function(data){
								obj = JSON.parse(data);
								if(obj.studentadd){
									$(".btn-add-student").html("Add Student");
									$("#student-list-form")[0].reset();
									$("#addstudentsuccess").openModal();
								}
							}
						});
					}
					});

			});


			$(".headerli").click(function(e){
				e.preventDefault();
				getlist =$(this).closest("li");
				tablehide=getlist.find(".tableforclassstudlist");
				table=getlist.find(".tableforstudent");
				lisection=getlist.find(".li-class-section").text();
				lisubject=getlist.find(".li-class-subject").text();

				$.ajax({
					type: "POST",
					url: "../faculty/function.php",
					data:{
						lisection: lisection,
						lisubject: lisubject
					},
					success: function(data){
						obj = JSON.parse(data);
						if(obj.studentlist === "none"){
							tablehide.addClass("hidden-input");
						}else{
							
							table.html(obj.studentlist);
						}
						

						$(".btn-update-student").click(function(e){
							e.preventDefault();
							getid = $(this).attr("id");
							$("#update-student").openModal();
							fullname = $(this).closest("tr").find(".td_full").text();
							firstname = $(this).closest("tr").find(".td_fn_student").text();
							middlename = $(this).closest("tr").find(".td_mn_student").text();
							lastname = $(this).closest("tr").find(".td_ln_student").text();
							lastname = lastname.replace(',', '');
							address = $(this).closest("tr").find(".td_add_student").text();
							guardian_firstname = $(this).closest("tr").find(".td_guardian_student > span.guardfn").text();
							guardian_lastname = $(this).closest("tr").find(".td_guardian_student > span.guardln").text();
							guardian_phone = $(this).closest("tr").find(".td_guardian_phone_student").text();
							$(".update-student-section-name").html(fullname);

							$("#student_first_name_update").val(firstname);
							$("#student_middle_name_update").val(middlename);
							$("#student_last_name_update").val(lastname);
							$("#student_address_update").val(address);
							$("#student_guardianfn_update").val(guardian_firstname);
							$("#student_guardianln_update").val(guardian_lastname);
							$("#guardian_phone_update").val(guardian_phone);

							$(".btn-update-student-yes").click(function(e){
								e.preventDefault();
								var form_data = $("#student-update-list-form").serializeArray();
								form_data.push({ 'name' : 'getstudentidupdate', 'value' : getid });

								$.ajax({
									type:"POST",
									url: "../faculty/function.php",
									data: form_data,
									beforeSend: function(data){
										$(".btn-update-student-yes").html("Updating..");
									},
									success: function(data){
										obj = JSON.parse(data);
										if(obj.updatestudent){
											$(".btn-update-student-yes").html("Updating..");
											$("#updatesuccessstudent").openModal();
										}
									
									}
								});
							});

						});

						$(".btn-drop-student").click(function(e){
							e.preventDefault();
							delgetid = $(this).attr("id");
							fullname = $(this).closest("tr").find(".td_full").text();
							studiddel = $(this).closest("tr").find(".td_student_id").text();
							classdel = $(this).closest("tr").attr("class");
							subjdel = $(this).closest("tr").attr("name");
							$(".dropstudname").html(fullname);
							$("#deletequestionstudent").openModal();
							$(".btn-drop-student-yes").click(function(e){
								e.preventDefault();

								$.ajax({
									type: "POST",
									url: "../faculty/function.php",
									data: {
										dropstudid : delgetid,
										studiddel: studiddel,
										classdel: classdel,
										subjdel:subjdel
									},
									success: function(data){
										obj = JSON.parse(data);
										if(obj.dropstudent){
											$(".questiondrop").addClass("hidden-input");
											$(".successdropstud").removeClass("hidden-input").addClass("visible-input");
										}
									}
								});
							});
						});
					}
				});
			});

		}
	});

		var mintoshow = 3;
		$("#recipientforfaculty").keyup(function(){
			var keyword = $("#recipientforfaculty").val();
			if (keyword.length >= mintoshow) {
				$.ajax({
					type: "POST",
					url: "../faculty/function.php",
					data: {
						keyword_faculty: keyword
					},
					success: function(data){
						obj = JSON.parse(data);
						$("#results-faculty").html(obj.keywords_faculty).removeClass("invisible");
							 $('.item').click(function() {
						    	var text = $(this).html();
						    	var to_idget = $(this).attr("id");
						    	$('#recipientforfaculty').val(text).attr("name", to_idget);
						    });
					}
				});
			}
		});	
		$("#recipientforfaculty").blur(function(){
    		$("#results-faculty").fadeOut(500);
    	}).focus(function() {		
    	    $("#results-faculty").show();
    	});

    	//Faculty Get message
	$.ajax({
		type: "GET",
		url: "../faculty/function.php",
		success: function(data){
			obj = JSON.parse(data);
			if(obj.msglistfaculty != "0"){
				$(".no-mgs-yet-faculty").addClass("hidden-input");	
				$(".ul-msg-faculty").html(obj.msglistfaculty);
			}
			$("li.li-msg-faculty").on("click",function() {
				$recieve =	$(this).find("span.inbox-receiver-faculty").attr("id");	
				$recievename =	$(this).find("span.inbox-receiver-faculty").text();	
				var callreplyfaculty = function(){			
					$.ajax({
						type: "POST",
						url: "../messaging.php",
						data: {
							getconvofaculty: $recieve
						},
						success: function(data){
							//obj = JSON.parse(data);
							$(".ul-msg-convo").html(data);
							$(".reciever-name-faculty").text($recievename).attr("id", $recieve);
							$(".delmsgfaculty").attr("id", $recieve);
							$(".no-msg").addClass("hidden-input");
							$(".full-msg-faculty-panel").removeClass("hidden-input");	
							
						}
					});
				} 
				setInterval(callreplyfaculty,1000);
				$(".content-msg-faculty").animate({ scrollTop: $('.content-msg-faculty')[0].scrollHeight }, "fast");  

			});		
		}
	});

	$(".delmsgfaculty").click(function(e){
		e.preventDefault();
		var delmsgfaculty = $(this).attr("id");
		$("#delfacultymsg").openModal();
		$("#delyesmsgfaculty").click(function(e){
			e.preventDefault();
			$.ajax({
				type: "POST",
				url: "../faculty/function.php",
				data:{
					delmsgfaculty: delmsgfaculty
				},
				success: function(data){
					obj = JSON.parse(data);
					if(obj.delmsgfaculty == true){
						location.reload();
					}
				}
			});
		});
	});

	//Faculty Reply
	$(".reply-faculty").click(function(e){
		e.preventDefault();
		$(".content-msg-faculty").animate({ scrollTop: $('.content-msg-faculty')[0].scrollHeight }, "fast");
		$.ajax({
			type: "POST",
			url: "../messaging.php",
			data: {
				facultyreply: $(".faculty-reply-msg").val(),
				facultyreplyto: $(".reciever-name-faculty").attr("id")
			},
			success: function(data){
				if(data){
					$(".faculty-reply-msg").val("").removeClass("valid invalid");
				}
			}
		});
	});

	// Faculty Message
	$("#sendmsg-faculty").click(function(e){
		e.preventDefault();
		$res = $("#recipientforfaculty").attr("name");
		$recipient = $res.substring(10);
		$subject = $("#subjectforfaculty").val();
		$message_content = $("#message_contentforfaculty").val();

		if( $.trim($recipient) === ""){
			$("#recipientforfaculty").removeClass("valid").addClass("invalid");
			$("#recipientforfaculty").closest(".input-field").find("label").attr("data-error","This field is required").addClass("active");
		}else{
			$("#recipientforfaculty").removeClass("invalid").addClass("valid");
			$("#recipientforfaculty").closest(".input-field").find("label").attr("data-error","").addClass("inactive");
		}
		if( $.trim($message_content) === ""){
			$("#message_contentforfaculty").removeClass("valid").addClass("invalid");
			$("#message_contentforfaculty").closest(".input-field").find("label").attr("data-error","This field is required").addClass("active");
		}else{
			$("#message_contentforfaculty").removeClass("invalid").addClass("valid");
			$("#message_contentforfaculty").closest(".input-field").find("label").attr("data-error","").addClass("inactive");
		}

		if( !$("#recipientforfaculty").hasClass("invalid") && !$("#message_contentforfaculty").hasClass("invalid")){
			$.ajax({
				type:"POST",
				url: "../messaging.php",
				data: {
					recipientforfaculty: $recipient,
					subjectforfaculty: $subject,
					message_contentforfaculty: $message_content
				},
				beforeSend: function(){
					$(".sendingmsg-faculty").removeClass("hide");
    			},
				success: function(data){
					if(data){
						$("#create-msg-faculty").closeModal();
						$(".sendingmsg-faculty").addClass("hide");
						$("#recipientforfaculty").val("");
						$("#subjectforfaculty").val("");
						$("#message_contentforfaculty").val("");
						$("#recipientforfaculty").removeClass("valid invalid");
						$("#subjectforfaculty").removeClass("valid invalid");
						$("#message_contentforfaculty").removeClass("valid invalid");
						$(".messagelabelforfaculty").removeClass("active");
						location.reload();
					}
				}
			});
		}
	});
	$(".modal-close-msg-faculty").click(function(e){
		e.preventDefault();
		location.reload();
		$("#recipientforfaculty").val("");
		$("#subjectforfaculty").val("");
		$("#message_contentforfaculty").val("");
		$("#recipientforfaculty").removeClass("valid invalid");
		$("#subjectforfaculty").removeClass("valid invalid");
		$("#message_contentforfaculty").removeClass("valid invalid");
		$(".messagelabelforfaculty").removeClass("active");
	});


		$.ajax({
		type: "GET",
		url: "../faculty/function.php",
		success: function(data){
			obj = JSON.parse(data);
			if(obj.classlistcheck == true){
				$(".numclass").html("You have "+obj.classnumber+" number of Classes.");
			}else{
				$(".numclass").html(obj.classnumber);
			}
			if(obj.studlistcheck == true){
				$(".numstud").html("You have "+obj.studnumber+" number of Student/s all in all.");
			}else{
				$(".numstud").html(obj.studnumber);
			}
		}
	});

});
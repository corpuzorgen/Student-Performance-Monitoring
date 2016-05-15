$(document).ready(function(){
	$.ajaxSetup({
        cache: false
    });

	//Side nav active
	$(".sideNavDash li").click(function(){
		$(".sideNavDash li").removeClass("active");
		$(this).addClass("active");
	});
	//profile image 
	
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



	// Admin
	$('.nav-wrapper-admin a.button-collapse').sideNav({
	      menuWidth: 300, // Default is 240
	      closeOnClick: true
	    }
	);
	$(".admin-search").click(function(e){
		e.preventDefault();
		$(".nav-wrap-show").addClass("hide");
		$("#search-admin-content").removeClass("hide");
	})	  	
	$(".close-search").click(function(){
		$(".nav-wrap-show").removeClass("hide").addClass("show");
		$("#search-admin-content").removeClass("show").addClass("hide");
		$("#search-admin-content")[0].reset()
	});

	$('.modal-trigger').leanModal();

	$("#form-login-admin").submit(function(e){
		e.preventDefault();

		$.ajax({
			type: "POST",
			url: "../sql.php",
			data: $("#form-login-admin").serialize(),
			success: function(data){
				
				obj = JSON.parse(data);
				if( obj.success ){
					$("#admin-login-error-msg").hide();
					$("#form-login-admin")[0].reset();
					window.location.href = "dashboard.php";
				}else if( !obj.success ){
					$("#admin-login-error-msg").text( obj.errors.admin_login );
				}
			}
		});//ajax
	});//form submit
	// Admin profile account information input hidden - visible
	$(".update-account-info-btn").click(function(e){
		e.preventDefault();
		$(".save-account-info-btn").removeClass("hidden-input").addClass("visible-input");
		$(".cancel-account-info-btn").removeClass("hidden-input").addClass("visible-input");
		$(".update-account-info-btn").removeClass("visible-input").addClass("hidden-input");
		$("#account-info-admin .account-info-data .hidden-input").removeClass("hidden-input").addClass("visible-input");
		$("#account-info-admin .account-info-data .grey-info").removeClass("visible-input").addClass("hidden-input");
		$("#admin-avatar-form").removeClass("hidden-input").addClass("visible-input");
		$(".fa-eye-slash").removeClass("visible-input").addClass("hidden-btn");
		$("#admin-empid").removeClass("visible-input").addClass("hidden-input");
		$("#admin-password").removeClass("visible-input").addClass("hidden-input");
	});
	// Admin profile basic information input hidden - visible 
	$(".basic-info-btn-edit").click(function(e){
		e.preventDefault();
		$(".basic-info-btn-save").removeClass("hidden-input").addClass("visible-input");
		$(".basic-info-btn-back").removeClass("hidden-input").addClass("visible-input");
		$(".basic-info-btn-edit").removeClass("visible-input").addClass("hidden-input");
		$("#basic-information-admin .basic-info-data .hidden-input").removeClass("hidden-input").addClass("visible-input");
		$("#basic-information-admin .basic-info-data .grey-info").removeClass("visible-input").addClass("hidden-input");
		$("#complete-name-admin").removeClass("visible-input").addClass("hidden-input");
		$("#gender-admin").removeClass("visible-input").addClass("hidden-input");
		$("#dob-admin").removeClass("visible-input").addClass("hidden-input");
		$("#address-admin").removeClass("visible-input").addClass("hidden-input");
	});
	// Admin profile contanct information input hidden - visible
	$(".contact-info-btn-edit-contact").click(function(e){
		e.preventDefault();
		$(".contact-info-btn-save-contact").removeClass("hidden-input").addClass("visible-input");
		$(".contact-info-btn-back-contact").removeClass("hidden-input").addClass("visible-input");
		$(".contact-info-btn-edit-contact").removeClass("visible-input").addClass("hidden-input");
		$("#contact-information-admin .contact-info-data .hidden-input").removeClass("hidden-input").addClass("visible-input");
		$("#contact-information-admin .contact-info-data .grey-info").removeClass("visible-input").addClass("hidden-input");
		$("#position-admin").removeClass("visible-input").addClass("hidden-input");
		$("#email-admin").removeClass("visible-input").addClass("hidden-input");
		$("#phone-admin").removeClass("visible-input").addClass("hidden-input");
	});
	

	//Show password
	$(".show-password").click(function(e){
		e.preventDefault();
		$(".show-password .fa-eye").removeClass("visible-input").addClass("hidden-input");
		$(".hide-password .fa-eye-slash").removeClass("hidden-btn").addClass("visible-input");
		$("#admin-new-pass-input").prop('type', 'text');
	});
	$(".hide-password").click(function(e){
		e.preventDefault();
		$(".show-password .fa-eye").removeClass("hidden-input").addClass("visible-input");
		$(".hide-password .fa-eye-slash").removeClass("visible-input").addClass("hidden-btn");
		$("#admin-new-pass-input").prop('type', 'password');
	});	


	// Admin retrieve Account information
	$.ajax({
		type: "POST",
		url:"../sql.php",
		success: function(data){
			obj = JSON.parse(data);

			//Dashboard Summary
			$("#profsumname").html(obj.adminProfileInfo.firstname + " " + obj.adminProfileInfo.middlename + " " + obj.adminProfileInfo.lastname);
			$("#profsumempid").html(obj.adminProfileInfo.employee_id);
			$("#profsumposition").html(obj.adminProfileInfo.position);
			$("#accountsumfaculty").html(obj.getIdlistfaculty);
			$("#accountsumparent").html(obj.getIdlistparent);
			$("#regsumfaculty").html(obj.getreglistfaculty);
			$("#regsumparent").html(obj.getreglistparent);
			$("#newssumdash").html(obj.postadminnewscounter);
			$("#eventssumdash").html(obj.postadmineventscounter);
			

				if( obj.adminProfileInfo.employee_id == ""){
				$(".empid-admin-grey").removeClass("hidden-input").addClass("visible-input");
			}else{
				$(".empid-admin-grey").removeClass("visible-input").addClass("hidden-input");
				$("#admin-empid").html(" " + obj.adminProfileInfo.employee_id).addClass("black-text");
				$("#admin-empid-input").val(obj.adminProfileInfo.employee_id);
				$("#admin-empid-nav").text(obj.adminProfileInfo.employee_id);
			}
			if( obj.adminProfileInfo.password == ""){
				$(".password-admin-grey").removeClass("hidden-input").addClass("visible-input");
			}else{
				var $asterisk = obj.adminProfileInfo.password.replace(/./g, '*');
				$(".password-admin-grey").removeClass("visible-input").addClass("hidden-input");
				$("#admin-password").html(" " + $asterisk).addClass("black-text");
			}
			if( obj.adminProfileInfo.firstname === "" && obj.adminProfileInfo.middlename === "" && obj.adminProfileInfo.lastname === ""){
				$(".complete-name").removeClass("hidden-input").addClass("visible-input");
			}else{
				$(".complete-name").removeClass("visible-input").addClass("hidden-input");
				$("#complete-name-admin").html(obj.adminProfileInfo.firstname + " " + obj.adminProfileInfo.middlename + " " + obj.adminProfileInfo.lastname);
				$("#firstnm-admin").val(obj.adminProfileInfo.firstname);
				$("#middlenm-admin").val(obj.adminProfileInfo.middlename);
				$("#lastnm-admin").val(obj.adminProfileInfo.lastname);
			}
			if( obj.adminProfileInfo.gender == ""){
				$(".gender-grey-admin").removeClass("hidden-input").addClass("visible-input");
			}else{
				$(".gender-grey-admin").removeClass("visible-input").addClass("hidden-input");
				$("#gender-admin").html(" " + obj.adminProfileInfo.gender);
				$("#gender-admin-input").val(obj.adminProfileInfo.gender);
			}
			if( obj.adminProfileInfo.dob == ""){
				$(".dob-grey-admin").removeClass("hidden-input").addClass("visible-input");
			}else{
				$(".dob-grey-admin").removeClass("visible-input").addClass("hidden-input");
				$("#dob-admin-input").val(obj.adminProfileInfo.dob);
					dob = obj.adminProfileInfo.dob;
					day = dob.substring(3, 5);
					year = dob.substring(6, 10);
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
				$("#dob-admin").html(" " + month + " " + day + ", " + year);

			}
			if( obj.adminProfileInfo.address == ""){
				$(".address-grey-admin").removeClass("hidden-input").addClass("visible-input");
			}else{
				$(".address-grey-admin").removeClass("visible-input").addClass("hidden-input");
				$("#address-admin").html(" " + obj.adminProfileInfo.address);
				$("#address-admin-input").val(obj.adminProfileInfo.address);
			}
			if( obj.adminProfileInfo.position == ""){
				$(".position-grey-admin").removeClass("hidden-input").addClass("visible-input");
			}else{
				$(".position-grey-admin").removeClass("visible-input").addClass("hidden-input");
				$("#position-admin").html(" " + obj.adminProfileInfo.position + " in CC Smart Kidz");
				$("#position-admin-input").val(obj.adminProfileInfo.position);
			}
			if( obj.adminProfileInfo.email == ""){
				$(".email-grey-admin").removeClass("hidden-input").addClass("visible-input");
			}else{
				$(".email-grey-admin").removeClass("visible-input").addClass("hidden-input");
				$("#email-admin").html(" " + obj.adminProfileInfo.email);
				$("#email-admin-input").val(obj.adminProfileInfo.email);
			}
			if( obj.adminProfileInfo.phone == ""){
				$(".phone-grey-admin").removeClass("hidden-input").addClass("visible-input");
			}else{
				$(".phone-grey-admin").removeClass("visible-input").addClass("hidden-input");
				$("#phone-admin").html(" " + obj.adminProfileInfo.phone);
				$("#phone-admin-input").val(obj.adminProfileInfo.phone);
			}
			if( obj.adminProfileInfo.image_src == "" ){
				$(".profile-admin-avatar-default").removeClass("hidden-input").addClass("visible-input");
			}else{
				$(".profile-admin-avatar-default").removeClass("visible-input").addClass("hidden-input");
				$(".profile-admin-avatar").removeClass("hidden-input").addClass("visible-input");
				$(".profile-admin-avatar").attr("src", obj.adminProfileInfo.image_src);
				$(".admin-avatar-img").attr("src", obj.adminProfileInfo.image_src);
			}
			//Admin avatar
			$("#admin-avatar-form").submit(function(e){
				e.preventDefault();
				if( $("#admin_avatar-input")[0].files.length == 0 ){

				}else{
					$.ajax({
			        	url: "../admin/upload.php",
						type: "POST",
						data:  new FormData(this),
						contentType: false,
			    	    cache: false,
						processData:false,
						success: function(data){
							obj = JSON.parse(data);
							if(obj.img_src_admin == true){
								$(".success-img-admin").html("<i class='fa fa-check-circle fa-lg'></i>&nbsp;&nbsp;&nbsp;Profile Avatar successfully changed</a>").removeClass("red-text").addClass("green-text");
							}else{
								$(".success-img-admin").html("<i class='fa fa-exclamation-circle fa-lg'></i>&nbsp;&nbsp;&nbsp;"+obj.img_src_admin+"</a>").removeClass("green-text").addClass("red-text");
							}
					    }
		   			});
				}
					
			});			
			// Save account information btn
			$(".save-account-info-btn").click(function(e){
				e.preventDefault();
				if( $("#admin-new-pass-input").val() !== ""){

					if( $("#admin-old-pass-input").val() !== obj.adminProfileInfo.password ){
												$("#admin-old-pass-input").removeClass("valid").addClass("invalid");
						$(".err-old-pass-admin").html("<i class='fa fa-exclamation-triangle fa-lg'></i>&nbsp;&nbsp;&nbsp;Incorrect password. ");
					}else{
						$("#admin-old-pass-input").removeClass("invalid").addClass("valid");
						$(".err-old-pass-admin").html("");
						if( $("#admin-new-pass-input").val() === obj.adminProfileInfo.password ){
							$("#admin-new-pass-input").removeClass("valid").addClass("invalid");
							$(".err-new-pass-admin").html("<i class='fa fa-exclamation-triangle fa-lg'></i>&nbsp;&nbsp;&nbsp;New password must not match the current password. ");
						}else{
							$("#admin-new-pass-input").removeClass("invalid").addClass("valid");
							if( !$.trim( $("#admin-new-pass-input").val() ).match(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/) ){
								$("#admin-new-pass-input").removeClass("valid").addClass("invalid");
								$(".err-new-pass-admin").html("<i class='fa fa-exclamation-triangle fa-lg'></i>&nbsp;&nbsp;&nbsp;New password characeter length is at least 8 with at least one upper case letter, one lower case letter, and one digit ");	
							}else{
								$("#admin-new-pass-input").removeClass("invalid").addClass("valid");
								$(".err-new-pass-admin").html("");
								$(".err-old-pass-admin").html("");
								$(".success-new-pass-admin").html("<i class='fa fa-check-circle'></i>&nbsp;&nbsp;&nbsp;Password successfully changed. Plese re-login <a href='../logout.php'>here</a>");		
								$.ajax({
									type: "POST",
									url: "../sql.php",
									data: {
										admin_new_pass: $("#admin-new-pass-input").val(),
									},
									success: function(data){
										if( data.success ){
											$(".admin-password-update").removeClass("hidden-input").addClass("visible-input");
										}
									}
								});
							}
						}
					}
				
				}
			});	// end of save button account info
				// Account info cancel button
			$(".cancel-account-info-btn").click(function(e){
				e.preventDefault();
				// Load default info from database
				$(".save-account-info-btn").removeClass("visible-input").addClass("hidden-input");
				$(".cancel-account-info-btn").removeClass("visible-input").addClass("hidden-input");
				$(".update-account-info-btn").removeClass("hidden-input").addClass("visible-input");
				$("#admin-avatar-form").removeClass("visible-input").addClass("hidden-input");
				$("#account-info-admin .account-info-data .visible-input").removeClass("visible-input").addClass("hidden-input");
				$("#admin-empid-input").val(obj.adminProfileInfo.employee_id);
				$("#admin-avatar-form").get(0).reset();
				$("#admin-old-pass-input").val("");
				$("#admin-new-pass-input").val("");
				$(".success-msg-account-info").html("");
				$(".error-msg-account-info").html("");
				$(".account-info-data input.hidden-input").removeClass("valid invalid");
				if( $("#admin-empid-input").val() === "" ){
					$(".empid-admin-grey").removeClass("hidden-input").addClass("visible-input");
				}else{
					$(".empid-admin-grey").removeClass("visible-input").addClass("hidden-input");
					$("#admin-empid").removeClass("hidden-input").addClass("visible-input");
				}
				$("#admin-password").removeClass("hidden-input").addClass("visible-input");
			});
			// Save basic information - admin
			$(".basic-info-btn-save").click(function(e){
				e.preventDefault();
				if( $("#firstnm-admin").val() === obj.adminProfileInfo.firstname ){
					$.ajax({
						type: "POST",
						url: "../sql.php",
						data: {
								admin_firstname : $("#firstnm-admin").val(),
							}
					});
				}else if( !$.trim( $("#firstnm-admin").val() ).match(/([A-Za-z']+( [A-Za-z']+)*){3,30}$/) ){
					$("#firstnm-admin").removeClass("valid").addClass("invalid");
					$(".err-name-admin").html("<i class='fa fa-exclamation-triangle fa-lg'></i>&nbsp;&nbsp;&nbsp;Please enter a valid name.");
				}else{
					$("#firstnm-admin").removeClass("invalid").addClass("valid");
					if( !$("#firstnm-admin").hasClass("invalid") && !$("#lastnm-admin").hasClass("invalid") ){
						$(".err-name-admin").html("");
						$.ajax({
							type: "POST",
							url: "../sql.php",
							data: {
									admin_firstname : $("#firstnm-admin").val(),
							},
							success: function(data){
								obj = JSON.parse(data);
								if( obj.adminProfileInfoUpdate.update_firstname ){
									$(".success-name-admin").html("<i class='fa fa-check-circle'></i>&nbsp;&nbsp;&nbsp;Name has been updated");
								}
							}
						});
					}
				
				}
				if( $("#middlenm-admin").val() === obj.adminProfileInfo.middlename ){
					$.ajax({
						type: "POST",
						url: "../sql.php",
						data: {
								admin_middlename : $("#middlenm-admin").val(),
							}
					});
				}else if( !$.trim( $("#middlenm-admin").val() ).match(/([A-Za-z']+( [A-Za-z']+)*){3,30}$/) ){
					$("#middlenm-admin").removeClass("valid").addClass("invalid");
					$(".err-name-admin").html("<i class='fa fa-exclamation-triangle fa-lg'></i>&nbsp;&nbsp;&nbsp;Please enter a valid name.");
				}else{
					$("#middlenm-admin").removeClass("invalid").addClass("valid");
					if( !$("#firstnm-admin").hasClass("invalid") && !$("#lastnm-admin").hasClass("invalid") ){
						$(".err-name-admin").html("");
						$.ajax({
							type: "POST",
							url: "../sql.php",
							data: {
									admin_middlename : $("#middlenm-admin").val(),
							},
							success: function(data){
								obj = JSON.parse(data);
								if( obj.adminProfileInfoUpdate.update_middlename ){
									$(".success-name-admin").html("<i class='fa fa-check-circle'></i>&nbsp;&nbsp;&nbsp;Name has been updated");
								}	
							}
						});
					}
				}
				if( $("#lastnm-admin").val() === obj.adminProfileInfo.lastname ){
					$.ajax({
						type: "POST",
						url: "../sql.php",
						data: {
								admin_lastname : $("#lastnm-admin").val(),
							}
					});
				}else if( !$.trim( $("#lastnm-admin").val() ).match(/([A-Za-z']+( [A-Za-z']+)*){3,30}$/) ){
					$("#lastnm-admin").removeClass("valid").addClass("invalid");
					$(".err-name-admin").html("<i class='fa fa-exclamation-triangle fa-lg'></i>&nbsp;&nbsp;&nbsp;Please enter a valid name.");
				}else{
					$("#lastnm-admin").removeClass("invalid").addClass("valid");
					if( !$("#firstnm-admin").hasClass("invalid") && !$("#middlenm-admin").hasClass("invalid") ){
						$(".err-name-admin").html("");
						
						$.ajax({
							type: "POST",
							url: "../sql.php",
							data: {
									admin_lastname : $("#lastnm-admin").val(),
							},
							success: function(data){
								obj = JSON.parse(data);
								if( obj.adminProfileInfoUpdate.update_lastname ){
									$(".success-name-admin").html("<i class='fa fa-check-circle'></i>&nbsp;&nbsp;&nbsp;Name has been updated");
								}	
							}
						});
					}
				}
				if( $("#gender-admin-input").val() === obj.adminProfileInfo.gender ){
					$.ajax({
						type: "POST",
						url: "../sql.php",
						data: {
								admin_gender : $("#gender-admin-input").val(),
							}
					});
				}else{
					
					$.ajax({
						type: "POST",
						url: "../sql.php",
						data: {
								admin_gender : $("#gender-admin-input").val(),
						},
						success: function(data){
							obj = JSON.parse(data);
							if( obj.adminProfileInfoUpdate.update_gender ){
								$(".success-gender-admin").html("<i class='fa fa-check-circle'></i>&nbsp;&nbsp;&nbsp;Gender has been updated");
							}
						}
					});
				}
				// Validation
				if( $("#dob-admin-input").val() === obj.adminProfileInfo.dob ){
					$.ajax({
						type: "POST",
						url: "../sql.php",
						data: {
								admin_dob : $("#dob-admin-input").val(),
							}
					});
				}else if( !$.trim( $("#dob-admin-input").val() ).match(/(^(((0[1-9]|1[0-9]|2[0-8])[\/](0[1-9]|1[012]))|((29|30|31)[\/](0[13578]|1[02]))|((29|30)[\/](0[4,6,9]|11)))[\/](19|[2-9][0-9])\d\d$)|(^29[\/]02[\/](19|[2-9][0-9])(00|04|08|12|16|20|24|28|32|36|40|44|48|52|56|60|64|68|72|76|80|84|88|92|96)$)/) ){
					$("#dob-admin-input").removeClass("valid").addClass("invalid");
					$(".err-dob-admin").html("<i class='fa fa-exclamation-triangle fa-lg'></i>&nbsp;&nbsp;&nbsp;Please enter a valid date.&nbsp;&nbsp;&nbsp;e.g DD/MM/YYYY");
				}else{
					$("#dob-admin-input").removeClass("invalid").addClass("valid");
					$(".err-dob-admin").html("");
					$.ajax({
						type: "POST",
						url: "../sql.php",
						data: {
								admin_dob : $("#dob-admin-input").val(),
						},
						success: function(data){
							obj = JSON.parse(data);
							if( obj.adminProfileInfoUpdate.update_dob ){
								$(".success-dob-admin").html("<i class='fa fa-check-circle'></i>&nbsp;&nbsp;&nbsp;Date of Birth has been updated");
							}
						}
					});
				}
				//Validation
				if( $("#address-admin-input").val() === obj.adminProfileInfo.address ){
					$.ajax({
						type: "POST",
						url: "../sql.php",
						data: {
								admin_address : $("#address-admin-input").val(),
							}
					});
				}else if( !$.trim( $("#address-admin-input").val() ).match(/([A-Za-z']+( [A-Za-z']+)*){3,30}$/) ){
					$("#address-admin-input").removeClass("valid").addClass("invalid");
					$(".err-address-admin").html("<i class='fa fa-exclamation-triangle fa-lg'></i>&nbsp;&nbsp;&nbsp;Please enter a valid address.&nbsp;&nbsp;&nbsp;e.g Unit#/House/Building/Street, Brgy, City, Province");
				}else{
					$("#address-admin-input").removeClass("invalid").addClass("valid");
					$(".err-address-admin").html("");
					$.ajax({
						type: "POST",
						url: "../sql.php",
						data: {
								admin_address : $("#address-admin-input").val(),
						},
						success: function(data){
							obj = JSON.parse(data);
							if( obj.adminProfileInfoUpdate.update_address ){
								$(".success-address-admin").html("<i class='fa fa-check-circle'></i>&nbsp;&nbsp;&nbsp;Address has been updated");
							}
						}
					});
				}
			});
			$(".basic-info-btn-back").click(function(e){
				e.preventDefault();
				// Load default info from database
				$(".basic-info-btn-save").removeClass("visible-input").addClass("hidden-input");
				$(".basic-info-btn-back").removeClass("visible-input").addClass("hidden-input");
				$(".basic-info-btn-edit").removeClass("hidden-input").addClass("visible-input");
				$("#basic-information-admin .basic-info-data .visible-input").removeClass("visible-input").addClass("hidden-input");
				$(".success-msg").html("");
				$(".error-msg").html("");
				$("#firstnm-admin").val(obj.adminProfileInfo.firstname);
				$("#middlenm-admin").val(obj.adminProfileInfo.middlename);
				$("#lastnm-admin").val(obj.adminProfileInfo.lastname);
				$("#gender-admin-input").val(obj.adminProfileInfo.gender);
				$("#dob-admin-input").val(obj.adminProfileInfo.dob);
				$("#address-admin-input").val(obj.adminProfileInfo.address);
				$(".basic-info-data input.hidden-input").removeClass("valid invalid");
				if( $("#firstnm-admin").val() === "" && $("#middlenm-admin").val() === "" && $("#lastnm-admin").val() === "" ){
					$(".complete-name").removeClass("hidden-input").addClass("visible-input");
				}else{
					$(".complete-name").removeClass("visible-input").addClass("hidden-input");
					$("#complete-name-admin").removeClass("hidden-input").addClass("visible-input");
				}
				if( $("#gender-admin-input").val() === null ){
					$(".gender-grey-admin").removeClass("hidden-input").addClass("visible-input");
				}else{
					$(".gender-grey-admin").removeClass("visible-input").addClass("hidden-input");
					$("#gender-admin").removeClass("hidden-input").addClass("visible-input");
				}
				if( $("#dob-admin-input").val() === "" ){
					$(".dob-grey-admin").removeClass("hidden-input").addClass("visible-input");
				}else{
					$(".dob-grey-admin").removeClass("visible-input").addClass("hidden-input");
					$("#dob-admin").removeClass("hidden-input").addClass("visible-input");
				}
				if( $("#address-admin-input").val() === "" ){
					$(".address-grey-admin").removeClass("hidden-input").addClass("visible-input");
				}else{
					$(".address-grey-admin").removeClass("visible-input").addClass("hidden-input");
					$("#address-admin").removeClass("hidden-input").addClass("visible-input");
				}
			});		
			// Save contact information - admin
			$(".contact-info-btn-save-contact").click(function(e){
				e.preventDefault();
				if( $("#position-admin-input").val() === obj.adminProfileInfo.position ){
					$.ajax({
						type: "POST",
						url: "../sql.php",
						dataType: "JSON",
						data: {
								admin_position : $("#position-admin-input").val(),
							}
					});
				}else if(!$.trim( $("#position-admin-input").val() ).match(/([A-Za-z']+( [A-Za-z']+)*){3,30}$/)){
					$("#position-admin-input").removeClass("valid").addClass("invalid");
					$(".err-position-admin").html("<i class='fa fa-exclamation-triangle fa-lg'></i>&nbsp;&nbsp;&nbsp;Please enter a valid Position/Title in the School.");
				}else{
					$("#position-admin-input").removeClass("invalid").addClass("valid");
					$(".err-position-admin").html("");
					$.ajax({
						type: "POST",
						url: "../sql.php",
						data: {
								admin_position : $("#position-admin-input").val(),
						},
						success: function(data){
							obj = JSON.parse(data);
							if( obj.adminProfileInfoUpdate.update_position ){
								$(".success-position-admin").html("<i class='fa fa-check-circle fa-lg'></i>&nbsp;&nbsp;&nbsp;Position has been updated.");
							}
						}
					});
				}
				if( $("#phone-admin-input").val() === obj.adminProfileInfo.phone ){
					$.ajax({
						type: "POST",
						url: "../sql.php",
						dataType: "JSON",
						data: {
								admin_phone : $("#phone-admin-input").val(),
							}
					});
				}else if( !$.trim( $("#phone-admin-input").val() ).match(/(\d){11,12}/) && $.trim( $("#phone-admin-input").val()).length < 11){
					$("#phone-admin-input").removeClass("valid").addClass("invalid");
					$(".err-phone-admin").html("<i class='fa fa-exclamation-triangle fa-lg'></i>&nbsp;&nbsp;&nbsp;Please enter a valid Phone number.");
				}else{
					$("#phone-admin-input").removeClass("invalid").addClass("valid");
					$(".err-phone-admin").html("");
					$.ajax({
						type: "POST",
						url: "../sql.php",
						data: {
								admin_phone : $("#phone-admin-input").val(),
						},
						success: function(data){
							obj = JSON.parse(data);
							if( obj.adminProfileInfoUpdate.update_phone ){
								$(".success-phone-admin").html("<i class='fa fa-check-circle fa-lg'></i>&nbsp;&nbsp;&nbsp;Phone number has been updated.");
							}
						}
					});
				}
				if( $("#email-admin-input").val() === obj.adminProfileInfo.email ){
					$.ajax({
						type: "POST",
						url: "../sql.php",
						dataType: "JSON",
						data: {
								admin_email : $("#email-admin-input").val(),
							}
					});
				}else if( !$.trim( $("#email-admin-input").val() ).match(/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/) ){
					$("#email-admin-input").removeClass("valid").addClass("invalid");
					$(".err-email-admin").html("<i class='fa fa-exclamation-triangle fa-lg'></i>&nbsp;&nbsp;&nbsp;Please enter a valid Email address.");
				}else{
					$("#email-admin-input").removeClass("invalid").addClass("valid");
					$(".err-email-admin").html("");
					$.ajax({
						type: "POST",
						url: "../sql.php",
						data: {
								admin_email : $("#email-admin-input").val(),
						},
						success: function(data){
							obj = JSON.parse(data);
							if( obj.adminProfileInfoUpdate.update_email ){
								$(".success-email-admin").html("<i class='fa fa-check-circle fa-lg'></i>&nbsp;&nbsp;&nbsp;Email address has been updated.");
							}
						}
					});
				}
			});
			$(".contact-info-btn-back-contact").click(function(e){
				e.preventDefault();
				// Load default info from database
				$(".contact-info-btn-save-contact").removeClass("visible-input").addClass("hidden-input");
				$(".contact-info-btn-back-contact").removeClass("visible-input").addClass("hidden-input");
				$(".contact-info-btn-edit-contact").removeClass("hidden-input").addClass("visible-input");
				$("#contact-information-admin .contact-info-data .visible-input").removeClass("visible-input").addClass("hidden-input");
				$("#position-admin-input").val(obj.adminProfileInfo.position);
				$("#email-admin-input").val(obj.adminProfileInfo.email);
				$("#phone-admin-input").val(obj.adminProfileInfo.phone);
				$("#address-admin-contact-input").val(obj.adminProfileInfo.address);
				$(".success-msg-contact-info").html("");
				$(".error-msg-contact-info").html("");
				$(".contact-info-data input.hidden-input").removeClass("valid invalid");
				if( $("#position-admin-input").val() === "" ){
					$(".position-grey-admin").removeClass("hidden-input").addClass("visible-input");
				}else{
					$(".position-grey-admin").removeClass("visible-input").addClass("hidden-input");
					$("#position-admin").removeClass("hidden-input").addClass("visible-input");
				}
				if( $("#email-admin-input").val() === "" ){
					$(".email-grey-admin").removeClass("hidden-input").addClass("visible-input");
				}else{
					$(".email-grey-admin").removeClass("visible-input").addClass("hidden-input");
					$("#email-admin").removeClass("hidden-input").addClass("visible-input");
				}
				if( $("#phone-admin-input").val() === "" ){
					$(".phone-grey-admin").removeClass("hidden-input").addClass("visible-input");
				}else{
					$(".phone-grey-admin").removeClass("visible-input").addClass("hidden-input");
					$("#phone-admin").removeClass("hidden-input").addClass("visible-input");
				}
			});		

		}//end of success function
	});//end of ajax
	
	//Admin Save Account ID list for Registration
	$("#btn-save-idlist-faculty").click(function(e){
		e.preventDefault();
		if( $("#account-data-empid").val() === "" ){
			$("#account-data-empid").removeClass("valid").addClass("invalid");
		}else{
			$("#account-data-empid").removeClass("invalid").addClass("valid");
		}
		if( $("#account-data-firstname").val() === "" ){
			$("#account-data-firstname").removeClass("valid").addClass("invalid");
		}else{
			$("#account-data-firstname").removeClass("invalid").addClass("valid");
		}
		if( $("#account-data-lastname").val() === "" ){
			$("#account-data-lastname").removeClass("valid").addClass("invalid");
		}else{
			$("#account-data-lastname").removeClass("invalid").addClass("valid");
		}
		if( !$(".add-account-data").hasClass("invalid") ){
			$.ajax({
				type:"POST",
				url: "../sql.php",
				data: $("#account-list").serialize(),
				success: function(data){
					obj = JSON.parse(data);
					if( obj.insertidlist ){
						$("#idlistsave").openModal();
						$(".add-account-data").removeClass("valid");
						$("#account-list")[0].reset();

					}
				}
			});
		}
	});
	$("#btn-cancel-idlist-faculty").click(function(e){
		e.preventDefault();
		$(".add-account-data").removeClass("valid invalid");
		$("#account-data-empid").val("");
		$("#account-data-firstname").val("");
		$("#account-data-lastname").val("");

	});
	$("#btn-excel-idlist-faculty").click(function(e){
		e.preventDefault();
		$('#idlist-faculty-excel').openModal();
	});
	$("#idlist-faculty-excel-form").submit(function(e){
		e.preventDefault();
			$.ajax({
			    url: "../admin/upload-excel.php",
				type: "POST",
				data:  new FormData(this),
				contentType: false,
			    cache: false,
				processData:false,
				success: function(data){
					obj = JSON.parse(data);

					if(obj.idexcel == true){
						if(obj.idexcelrow == "1"){
							row = "row";
						}else{
							row = "rows";
						}
						$(".success-idlist-faculty").html("<i class='fa fa-check-circle fa-lg'></i>&nbsp;&nbsp;&nbsp;Uploaded "+ obj.idexcelrow + " " + row + " successfully.").removeClass("red-text").addClass("green-text");
					}else{
						$(".success-idlist-faculty").html("<i class='fa fa-exclamation-circle fa-lg'></i>&nbsp;&nbsp;&nbsp;"+obj.idexcel+"").removeClass("green-text").addClass("red-text");
					}
					
					
				}
		   	});
	});
	$("#modal-close-idlist-faculty").click(function(){
		$(".success-idlist-faculty").html("");
	});

	$("#btn-save-idlist-parent").click(function(e){
		e.preventDefault();
		if( $("#account-data-pid").val() === "" ){
			$("#account-data-pid").removeClass("valid").addClass("invalid");
		}else{
			$("#account-data-pid").removeClass("invalid").addClass("valid");
		}
		if( $("#account-data-firstname-parent").val() === "" ){
			$("#account-data-firstname-parent").removeClass("valid").addClass("invalid");
		}else{
			$("#account-data-firstname-parent").removeClass("invalid").addClass("valid");
		}
		if( $("#account-data-lastname-parent").val() === "" ){
			$("#account-data-lastname-parent").removeClass("valid").addClass("invalid");
		}else{
			$("#account-data-lastname-parent").removeClass("invalid").addClass("valid");
		}
		if( !$(".add-account-data-parent").hasClass("invalid") ){
			$.ajax({
				type:"POST",
				url: "../sql.php",
				data: $("#account-list-parent").serialize(),
				success: function(data){
					obj = JSON.parse(data);
					if( obj.insertidlistparent ){
						$("#idlistsave").openModal();
						$(".add-account-data-parent").removeClass("valid");
						$("#account-list-parent")[0].reset();

					}
				}
			});
		}
	});
	$("#btn-cancel-idlist-parent").click(function(e){
		e.preventDefault();
		$(".add-account-data-parent").removeClass("valid invalid");
		$("#account-data-pid").val("");
		$("#account-data-firstname-parent").val("");
		$("#account-data-lastname-parent").val("");

	});
	$("#btn-excel-idlist-parent").click(function(e){
		e.preventDefault();
		$('#idlist-parent-excel').openModal();
	});
	$("#idlist-parent-excel-form").submit(function(e){
		e.preventDefault();
			$.ajax({
			    url: "../admin/upload-excel.php",
				type: "POST",
				data:  new FormData(this),
				contentType: false,
			    cache: false,
				processData:false,
				success: function(data){
					obj = JSON.parse(data);

					
					if(obj.idexcel == true){
						if(obj.idexcelrow == "1"){
							row = "row";
						}else{
							row = "rows";
						}
						$(".success-idlist-parent").html("<i class='fa fa-check-circle fa-lg'></i>&nbsp;&nbsp;&nbsp;Uploaded "+ obj.idexcelrow + " " + row + " successfully.").removeClass("red-text").addClass("green-text");
					}else{
						$(".success-idlist-parent").html("<i class='fa fa-exclamation-circle fa-lg'></i>&nbsp;&nbsp;&nbsp;"+obj.idexcel+"").removeClass("green-text").addClass("red-text");
					}
				}
		   	});
	});
	$("#modal-close-idlist-parent").click(function(){
		$(".success-idlist-parent").html("");
	});
	//Get Account list parent-faculty
	$.ajax({
		type:"GET",
		url: "../sql.php",
		success:function(data){
			obj = JSON.parse(data);
			$.each(obj.idlistfaculty, function(key, value){
				$("#faculty-idlist-table").prepend(value);
			});
			$(".counter-faculty-account").html(obj.getIdlistfaculty);
			$(".counter-faculty-idlist").html(obj.getIdlistfaculty+1);

			$.each(obj.idlistparent, function(key, value){
				$("#parent-idlist-table").prepend(value);
			});
			$(".counter-parent-account").html(obj.getIdlistparent);
			$(".counter-parent-idlist").html(obj.getIdlistparent+1);

			//Get registered accounts
			$.each(obj.reglistfaculty, function(key, value){
				$("#faculty-reglist-table").prepend(value);
			});
			$(".counter-faculty-account-reglist").html(obj.getreglistfaculty);
			$.each(obj.reglistparent, function(key, value){
				$("#parent-reglist-table").prepend(value);
			});
			$(".counter-parent-account-reglist").html(obj.getreglistparent);


			//Update Faculty account List
			$(".btn-update-faculty").click(function(e){
				e.preventDefault();
				updateFrom = $(this).attr("id");
				tr = $(this).closest("tr");
				empid = tr.find(".td_faculty_empid").text();
				firstnm = tr.find(".td_faculty_firstnm").text();
				lastnm = tr.find(".td_faculty_lastnm").text();
				$("#update_faculty_list").openModal();

				$("#faculty_update_empid_list").val(empid);
				$("#faculty_update_firstnm_list").val(firstnm);
				$("#faculty_update_lastnm_list").val(lastnm);

				$("#update_faculty_list_form").submit(function(e){
					e.preventDefault();
					var form_data = $('#update_faculty_list_form').serializeArray();
					form_data.push({ 'name' : 'id_update_list', 'value' : updateFrom });
					$.ajax({
						type: "POST",
						url: "../sql.php",
						data: form_data,
						beforeSend: function(){
							$("#update-btn-account-list-faculty").text("Updating..");
						},
						success: function(data){
							obj = JSON.parse(data);
							if(obj.updatefacultyaccount){
								$("#update-btn-account-list-faculty").text("Update");
								$("#update-success-faculty-account").openModal();
							}
						}
					});
				});	
			});

			// Update parent account list
			$(".btn-update-parent").click(function(e){
				e.preventDefault();
				updateFrom = $(this).attr("id");
				tr = $(this).closest("tr");
				pid = tr.find(".td_parent_pid").text();
				firstnm = tr.find(".td_parent_firstnm").text();
				lastnm = tr.find(".td_parent_lastnm").text();
				$("#update_parent_list").openModal();

				$("#parent_update_empid_list").val(pid);
				$("#parent_update_firstnm_list").val(firstnm);
				$("#parent_update_lastnm_list").val(lastnm);

				$("#update_parent_list_form").submit(function(e){
					e.preventDefault();
					var form_data = $('#update_parent_list_form').serializeArray();
					form_data.push({ 'name' : 'id_update_parent_list', 'value' : updateFrom });
					$.ajax({
						type: "POST",
						url: "../sql.php",
						data: form_data,
						beforeSend: function(){
							$("#update-btn-account-list-parent").text("Updating..");
						},
						success: function(data){
							obj = JSON.parse(data);
							if(obj.updateparentaccount){
								$("#update-btn-account-list-parent").text("Update");
								$("#update-success-parent-account").openModal();
							}
						}
					});
				});	
			});
			//Delete Faculty account List
			$(".btn-delete-faculty").click(function(e){
				e.preventDefault();
				$("#idlistdel").openModal();
				deleteFrom = $(this).attr("id");
				$("#btn-delete-yes").click(function(e){
					e.preventDefault();
					$.ajax({
						type: "POST",
						url: "../sql.php",
						data: {
						facultyidlistdel: deleteFrom,
						},
						success: function(data){
							obj = JSON.parse(data);
							if(obj.delrowfacultyidlist){
								$("#question").addClass("hidden-input");
								$("#success-delete").removeClass("hidden-input").addClass("visible-input");
								$("#success-delete-footer").removeClass("hidden-input").addClass("visible-input");
							}
						}
					});
				});
			});
			//Delete Parent account List
			$(".btn-delete-parent").click(function(e){
				e.preventDefault();
				$("#idlistdel").openModal();
				$deleteFrom = $(this).attr("id");

				$("#btn-delete-yes").click(function(e){
					e.preventDefault();
					$.ajax({
						type: "POST",
						url: "../sql.php",
						data: {
						parentidlistdel: $deleteFrom,
						},
						success: function(data){
							obj = JSON.parse(data);
							if(obj.delrowparentidlist){
								$("#question").addClass("hidden-input");
								$("#success-delete").removeClass("hidden-input").addClass("visible-input");
								$("#success-delete-footer").removeClass("hidden-input").addClass("visible-input");
							}
						}
					});
				});
			});

			//Send to email parent
			$(".btn-send-email").click(function(e){
				e.preventDefault();
				$("#send-to-email").openModal();
				parent_idemail = $(this).closest("tr").find(".td_parent_pid").text();
				firstnmemail = $(this).closest("tr").find(".td_parent_firstnm").text();
				lastnmemail = $(this).closest("tr").find(".td_parent_lastnm").text();
				
				$(".btn-sendformemail").click(function(e){
					e.preventDefault();

					if($.trim($("#emailparent").val()) == ""){
						$("#emailparent").removeClass("valid").addClass("invalid");
					}else{
						$("#emailparent").removeClass("invalid").addClass("valid");
					}

					if( !$("emailparent").hasClass("invalid")){
						$.ajax({
							type: "POST",
							url: "../sql.php",
							data:{
								parent_idemail: parent_idemail,
								firstnmemail: firstnmemail,
								lastnmemail: lastnmemail,
								emailparentsend: $("#emailparent").val()
							},
							beforeSend: function(){
								$(".btn-sendformemail").html("Sending..");
							},
							success: function(data){
								obj = JSON.parse(data);
								if(obj.emailsend == "true"){
									$("#successemail").openModal();
									$(".btn-sendformemail").html("Send");
								}else{
									$("#failemail").openModal();
								}
							}
						});
					}
				});


			});
			//Update restric 
			$("td.td_faculty_empid").each(function(index, value){
				getidcheck = $(this);
				checkid = $(this).text();
				$("td.td_facultyaccountreg").each(function(index, value){
					if( checkid === $(this).text()){
						getid = getidcheck.closest("tr").find("a.btn-update-faculty").attr("id");
						getupdatebutton = getidcheck.closest("tr").find("a.btn-update-faculty");
						getupdatebutton.click(function(){
							$("#update_faculty_list").closeModal();
							$("#update-failed").openModal();
						});
					}
				});
			});
			//Update restric 
			$("td.td_parent_pid").each(function(index, value){
				getidcheck = $(this);
				checkid = $(this).text();
				$("td.td_parentaccountreg").each(function(index, value){
					if( checkid === $(this).text()){
						getid = getidcheck.closest("tr").find("a.btn-update-parent").attr("id");
						getupdatebutton = getidcheck.closest("tr").find("a.btn-update-parent");
						getupdatebutton.click(function(){
							$("#update_parent_list").closeModal();
							$("#update-failed").openModal();
						});
					}
				});
			});
			
		}
	});

	//Admin Get message
	$.ajax({
		type: "GET",
		url: "../sql.php",
		success: function(data){
			obj = JSON.parse(data);
			if(obj.msglistadmin != "0"){
				$(".no-mgs-yet").addClass("hidden-input");
				$(".ul-msg-admin").html(obj.msglistadmin);
			}
		
			$("li.li-msg-admin").on("click",function() {
				$recieve =	$(this).find("span.inbox-receiver").attr("id");
				$recievename =	$(this).find("span.inbox-receiver").text();			
					//scoll to bottom
				var callreply = function(){
					$.ajax({
						type: "POST",
						url: "../messaging.php",
						data: {
							getconvoadmin: $recieve
						},
						success: function(data){
							//obj = JSON.parse(data);
							$(".ul-msg-convo").html(data);
							$(".reciever-name").text($recievename).attr("id", $recieve);
							$(".delmsgadmin").attr("id", $recieve);
							$(".no-msg").addClass("hidden-input");
							$(".full-msg-admin-panel").removeClass("hidden-input");	

						}
					});
				}
				setInterval(callreply,1000);
				$(".content-msg").animate({ scrollTop: $('.content-msg')[0].scrollHeight }, "fast");
				});	
			}
	});

		$(".delmsgadmin").click(function(e){
			e.preventDefault();
			var delmsgadmin = $(this).attr("id");
			$("#deladminmsg").openModal();
			$("#delyesmsgadmin").click(function(e){
				e.preventDefault();
				$.ajax({
					type: "POST",
					url: "../sql.php",
					data:{
						delmsgadmin: delmsgadmin
					},
					success: function(data){
						obj = JSON.parse(data);
						if(obj.deletemsgadmin == true){
							location.reload();
						}
					}
				});
			});
		});
	
	//Admin Reply
	$(".reply-admin").click(function(e){
		e.preventDefault();
		$(".content-msg").animate({ scrollTop: $('.content-msg')[0].scrollHeight }, "fast");
		$.ajax({
			type: "POST",
			url: "../messaging.php",
			data: {
				adminreply: $(".admin-reply-msg").val(),
				adminreplyto: $(".reciever-name").attr("id")
			},
			success: function(data){
				if(data){
					$(".admin-reply-msg").val("").removeClass("valid invalid");
				}
			}
		});
	});

		var mintoshow = 3;
		$("#recipient").keyup(function(){
			var keyword = $("#recipient").val();
			if (keyword.length >= mintoshow) {
				$.ajax({
					type: "POST",
					url: "../sql.php",
					data: {
						keyword: keyword
					},
					success: function(data){
						obj = JSON.parse(data);
						$("#results").html(obj.keywords).removeClass("invisible");
							 $('.item').click(function() {
						    	var text = $(this).html();
						    	var to_idget = $(this).attr("id");
						    	$('#recipient').val(text).attr("name", to_idget);
						    });
					}
				});
			}
		});	
		$("#recipient").blur(function(){
    		$("#results").fadeOut(500);
    	}).focus(function() {		
    	    $("#results").show();
    	});

		



	// Admin Message
	$("#sendmsg-admin").click(function(e){
		e.preventDefault();
		res = $("#recipient").attr("name");
		recipient = res.substring(8);
		subject = $("#subject").val();
		message_content = $("#message_content").val();

		if( $.trim(recipient) === ""){
			$("#recipient").removeClass("valid").addClass("invalid");
			$("#recipient").closest(".input-field").find("label").attr("data-error","This field is required").addClass("active");
		}else{
			$("#recipient").removeClass("invalid").addClass("valid");
			$("#recipient").closest(".input-field").find("label").attr("data-error","").addClass("inactive");
		}
		if( $.trim(message_content) === ""){
			$("#message_content").removeClass("valid").addClass("invalid");
			$("#message_content").closest(".input-field").find("label").attr("data-error","This field is required").addClass("active");
		}else{
			$("#message_content").removeClass("invalid").addClass("valid");
			$("#message_content").closest(".input-field").find("label").attr("data-error","").addClass("inactive");
		}

		if( !$("#recipient").hasClass("invalid") && !$("#message_content").hasClass("invalid")){
			$.ajax({
				type:"POST",
				url: "../messaging.php",
				data: {
					recipient: recipient,
					subject: subject,
					message_content: message_content
				},
				beforeSend: function(){
					$(".sendingmsg").removeClass("hide");
    			},
				success: function(data){
					if(data){
						$("#create-msg-admin").closeModal();
						$(".sendingmsg").addClass("hide");
						$("#recipient").val("");
						$("#subject").val("");
						$("#message_content").val("");
						$("#recipient").removeClass("valid invalid");
						$("#subject").removeClass("valid invalid");
						$("#message_content").removeClass("valid invalid");
						$(".messagelabel").removeClass("active");
						location.reload();

					
					}
				}
			});
		}
	});
	$(".modal-close-msg-admin").click(function(e){
		e.preventDefault();
		location.reload();
		$("#recipient").val("");
		$("#subject").val("");
		$("#message_content").val("");
		$("#recipient").removeClass("valid invalid");
		$("#subject").removeClass("valid invalid");
		$("#message_content").removeClass("valid invalid");
		$(".messagelabel").removeClass("active");
	});

	





	//Admin Gallery
	$(".change-feature-image-one").click(function(e){
		e.preventDefault();
		$("#change-feature-modal-slideone").openModal();
	});
	$("#upload-featured-image-one").submit(function(e){
		e.preventDefault();
		if( $(".featuredimageone")[0].files.length == 0 ){
		}else{
			$.ajax({
			    url: "../admin/upload.php",
				type: "POST",
				data:  new FormData(this),
				contentType: false,
			  	cache: false,
				processData:false,
				beforeSend: function(){
					$(".upload-feature").text("Uploading..");
    			},
				success: function(data){
					obj = JSON.parse(data);

					if(obj.featuredimageone == true){
						$(".upload-feature").text("Upload");
						$(".msg1").html("<span class='green-text success-upload'>&nbsp;&nbsp;&nbsp;<i class='fa fa-2x fa-check-circle' aria-hidden='true'></i>&nbsp;Upload success!</span>");
					}else{
						$(".upload-feature").text("Upload");
						$(".msg1").html("<span class='red-text success-upload'>&nbsp;&nbsp;&nbsp;<i class='fa fa-2x fa-exclamation-circle' aria-hidden='true'></i>&nbsp;"+obj.featuredimageone+"</span>");
					}
			    }
		   	});
		}
	});
	$("#featuredimageoneclose").click(function(e){
		e.preventDefault();
		$("#change-feature-modal-slideone").closeModal();
		$("#upload-featured-image-one").get(0).reset();
		$(".success-upload").html("");
	});

	$(".change-feature-image-two").click(function(e){
		e.preventDefault();
		$("#change-feature-modal-slidetwo").openModal();
	});
	$("#upload-featured-image-two").submit(function(e){
		e.preventDefault();
		if( $(".featuredimagetwo")[0].files.length == 0 ){
		}else{
			$.ajax({
			    url: "../admin/upload.php",
				type: "POST",
				data:  new FormData(this),
				contentType: false,
			  	cache: false,
				processData:false,
				beforeSend: function(){
					$(".upload-feature").text("Uploading..");
    			},
				success: function(data){
					obj = JSON.parse(data);
					if(obj.featuredimagetwo == true){
						$(".upload-feature").text("Upload");
						$(".msg2").html("<span class='green-text success-upload'>&nbsp;&nbsp;&nbsp;<i class='fa fa-2x fa-check-circle' aria-hidden='true'></i>&nbsp;Upload success!</span>");
					}else{
						$(".upload-feature").text("Upload");
						$(".msg2").html("<span class='red-text success-upload'>&nbsp;&nbsp;&nbsp;<i class='fa fa-2x fa-exclamation-circle' aria-hidden='true'></i>&nbsp;"+obj.featuredimagetwo+"</span>");
					}
			    }
		   	});
		}
	});
	$("#featuredimagetwoclose").click(function(e){
		e.preventDefault();
		$("#change-feature-modal-slidetwo").closeModal();
		$("#upload-featured-image-two").get(0).reset();
		$(".success-upload").html("");
	});	
	
	$(".change-feature-image-three").click(function(e){
		e.preventDefault();
		$("#change-feature-modal-slidethree").openModal();
	});
	$("#upload-featured-image-three").submit(function(e){
		e.preventDefault();
		if( $(".featuredimagethree")[0].files.length == 0 ){
		}else{
			$.ajax({
			    url: "../admin/upload.php",
				type: "POST",
				data:  new FormData(this),
				contentType: false,
			  	cache: false,
				processData:false,
				beforeSend: function(){
					$(".upload-feature").text("Uploading..");
    			},
				success: function(data){
					obj = JSON.parse(data);
					if(obj.featuredimagethree == true){
						$(".upload-feature").text("Upload");
						$(".msg3").html("<span class='green-text success-upload'>&nbsp;&nbsp;&nbsp;<i class='fa fa-2x fa-check-circle' aria-hidden='true'></i>&nbsp;Upload success!</span>");
					}else{
						$(".upload-feature").text("Upload");
						$(".msg3").html("<span class='red-text success-upload'>&nbsp;&nbsp;&nbsp;<i class='fa fa-2x fa-exclamation-circle' aria-hidden='true'></i>&nbsp;"+obj.featuredimagethree+"</span>");
					}

			    }
		   	});
		}
	});
	$("#featuredimagethreeclose").click(function(e){
		e.preventDefault();
		$("#change-feature-modal-slidetwo").closeModal();
		$("#upload-featured-image-three").get(0).reset();
		$(".success-upload").html("");
	});

	$(".delete-feature-image").click(function(e){
		e.preventDefault();
		type = $(this).closest(".featured-image-gallery").attr("id");

		$("#delmodal").openModal();
		$(".yesdel").click(function(e){
			e.preventDefault();
			if(type === "slide-one"){
				type="slideone";
			}
			if(type ==="slide-two"){
				type="slidetwo";
			}
			if(type ==="slide-three"){
				type="slidethree";
			}
			$.ajax({
				type: "POST",
				url: "../sql.php",
				data: {
					type : type
				},
				success: function(data){
					obj = JSON.parse(data);
					if(obj.featuredel){
						$(".successdel").removeClass("hidden-input");
						$(".delbutton").addClass("hidden-input");
					}
				}
			});	
		});
		$(".nodel").click(function(e){
			e.preventDefault();
			$("#delmodal").closeModal();
			$(".successdel").addClass("hidden-input");
			$(".delbutton").removeClass("hidden-input");
		});
	});
	$.ajax({
		type: "GET",
		url: "../sql.php",
		success: function(data){
			obj = JSON.parse(data);
			if(obj.gallery.slideone){
				$("#feature-slideone").attr("src", obj.gallery.slideone);
			}
			if(obj.gallery.slidetwo){
				$("#feature-slidetwo").attr("src", obj.gallery.slidetwo);
			}
			if(obj.gallery.slidethree){
				$("#feature-slidethree").attr("src", obj.gallery.slidethree);
			}
			
		}
	});
	//POST ADMIN
	$("#newpost").click(function(e){
		e.preventDefault();
		$("#postadmin").openModal();
	});
	$(".post-send").click(function(e){
		e.preventDefault();
		postcontente = $("#postcontent").val().replace(/\r\n|\r|\n/g,"<br />");
		if($("#catergorypost").val() === null){
			$(".error-content-category").html("<i class='fa fa-exclamation-circle' aria-hidden='true'></i>&nbsp;&nbsp;Please choose a category.");
		}else{
			$(".error-content-category").html("");
		}
		if($.trim($("#postcontent").val()) === ""){
			$(".error-content-content").html("<i class='fa fa-exclamation-circle' aria-hidden='true'></i>&nbsp;&nbsp;Please enter content.");
			$("#postcontent").removeClass("valid").addClass("invalid");	
		}else{
			$(".error-content-content").html("");
			$("#postcontent").removeClass("invalid").addClass("valid");
		}
		if($.trim($("#titlepost").val()) === ""){
			$(".error-content-title").html("<i class='fa fa-exclamation-circle' aria-hidden='true'></i>&nbsp;&nbsp;Please enter title.");
			$("#titlepost").removeClass("valid").addClass("invalid");
		}else{
			$(".error-content-title").html("");
			$("#titlepost").removeClass("invalid").addClass("valid");
		}

		if( $("#catergorypost").val() !== null && !$("#postcontent").hasClass("invalid") && !$("#titlepost").hasClass("invalid")){
			$.ajax({
				type: "POST",
				url: "../sql.php",
				data: {
					postcategory: $("#catergorypost").val(),
					posttitle: $("#titlepost").val(),
					postcontent: postcontente
				},
				success: function(data){
					obj = JSON.parse(data);
					if(obj.post){
						$(".success-content").html("<i class='fa fa-check-circle' aria-hidden='true'></i>&nbsp;&nbsp;Article successfully posted!");
					}
				}
			});
		}
	});
	$(".post-cancel").click(function(e){
		e.preventDefault();
		$("#catergorypost").val("null");
		$("#titlepost").val("");
		$("#titlepost").removeClass("valid invalid");
		$("#postcontent").val("");
		$("#postcontent").removeClass("valid invalid");
		$(".success-content").html("");
		$(".error-content").html("");
		$("#catergorypostupdate").val("null");
		$("#titlepostupdate").val("");
		$("#titlepostupdate").removeClass("valid invalid");
		$("#postcontentupdate").val("");
		$("#postcontentupdate").removeClass("valid invalid");
		$(".success-content_update").html("");
		$(".error-content").html("");

	});

	$.ajax({
		type: "GET",
		url: "../sql.php",
		success: function(data){
			obj = JSON.parse(data);
			if( obj.postadminnews === "no record"){
				$("#newssection").prepend("<p class='postarticletag'>No article yet publish <a href=''>here</a>.</p>")
			}else{
				$("#newsuladmin").addClass("collapsible").prepend(obj.postadminnews);
			}
			if( obj.postadminevents === "no record"){
				$("#eventssection").prepend("<p class='postarticletag'>No article yet publish <a href=''>here</a>.</p>")
			}else{
				$("#eventsuladmin").addClass("collapsible").prepend(obj.postadminevents);
			}
			$(".postarticletag").click(function(e){
				e.preventDefault();
				$("#postadmin").openModal();
			});

			$(".btn-update-post-news").click(function(e){
				e.preventDefault();
				getid 	= $(this).attr("id");
				closest = $(this).closest(".newliadmin");
				newstitle = closest.find(".newstitle").text();
				newscontent = closest.find(".newscontent").text();
				newscontent = newscontent.replace(/\r\n|\r|\n/g,"<br />")
				$("#updatearticlespost").openModal();
				$("#catergorypostupdate").val("news");
				$("#titlepostupdate").val(newstitle);
				$("#postcontentupdate").val(newscontent);

				$(".post-update").click(function(e){
					if( $.trim($("#titlepostupdate").val()) === ""){
					$(".error-content-title_update").html("<i class='fa fa-exclamation-circle'></i>&nbsp;&nbsp;Please enter title.");
					$("#titlepostupdate").removeClass("valid").addClass("invalid");
					}else{
						$(".error-content-title_update").html("");
						$("#titlepostupdate").removeClass("invalid").addClass("valid");
					}
					if( $.trim($("#postcontentupdate").val()) === ""){
						$(".error-content-content_update").html("<i class='fa fa-exclamation-circle'></i>&nbsp;&nbsp;Please enter content.");
						$("#postcontentupdate").removeClass("valid").addClass("invalid");
					}else{
						$(".error-content-content_update").html("");
						$("#postcontentupdate").removeClass("invalid").addClass("valid");
					}
					if( !$("#postcontentupdate").hasClass("invalid") && !$("#titlepostupdate").hasClass("invalid") ){
						$.ajax({
							type: "POST",
							url: "../sql.php",
							data: {
								postupdatecategory : $("#catergorypostupdate").val(),
								postupdatetitle : $("#titlepostupdate").val(),
								postupdatecontent : $("#postcontentupdate").val(),
								postupdateid : getid
							},
							beforeSend: function(){
								$(".post-update").text("Updating..");
							},
							success: function(data){
								obj = JSON.parse(data);
								if(obj.updatepost){
									$(".post-update").text("Update");
									$(".success-content_update").html("<i class='fa fa-check-circle'></i>&nbsp;&nbsp;Article successfully updated!");
								}
							}
						});
					}
				});
				
			});

			$(".btn-update-post-events").click(function(e){
				e.preventDefault();
				getid 	= $(this).attr("id");
				closest = $(this).closest(".eventsliadmin");
				eventstitle = closest.find(".eventstitle").text();
				eventscontent = closest.find(".eventscontent").text();
				eventscontent = eventscontent.replace(/\r\n|\r|\n/g,"<br />")
				$("#updatearticlespost").openModal();
				$("#catergorypostupdate").val("events");
				$("#titlepostupdate").val(eventstitle);
				$("#postcontentupdate").val(eventscontent);

				$(".post-update").click(function(e){
					if( $.trim($("#titlepostupdate").val()) === ""){
					$(".error-content-title_update").html("<i class='fa fa-exclamation-circle'></i>&nbsp;&nbsp;Please enter title.");
					$("#titlepostupdate").removeClass("valid").addClass("invalid");
					}else{
						$(".error-content-title_update").html("");
						$("#titlepostupdate").removeClass("invalid").addClass("valid");
					}
					if( $.trim($("#postcontentupdate").val()) === ""){
						$(".error-content-content_update").html("<i class='fa fa-exclamation-circle'></i>&nbsp;&nbsp;Please enter content.");
						$("#postcontentupdate").removeClass("valid").addClass("invalid");
					}else{
						$(".error-content-content_update").html("");
						$("#postcontentupdate").removeClass("invalid").addClass("valid");
					}
					if( !$("#postcontentupdate").hasClass("invalid") && !$("#titlepostupdate").hasClass("invalid") ){
						$.ajax({
							type: "POST",
							url: "../sql.php",
							data: {
								postupdatecategory : $("#catergorypostupdate").val(),
								postupdatetitle : $("#titlepostupdate").val(),
								postupdatecontent : $("#postcontentupdate").val(),
								postupdateid : getid
							},
							beforeSend: function(){
								$(".post-update").text("Updating..");
							},
							success: function(data){
								obj = JSON.parse(data);
								if(obj.updatepost){
									$(".post-update").text("Update");
									$(".success-content_update").html("<i class='fa fa-check-circle'></i>&nbsp;&nbsp;Article successfully updated!");
								}
							}
						});
					}
				});
			});

			//Delete Post

			$(".btn-trash-post-news").click(function(e){
				e.preventDefault();
				getid = $(this).attr("id");
				title = $(this).closest(".newliadmin").find(".newstitle").text();
				$(".deletetitlearticle").html(title);
				$("#postdelete").openModal();

				$(".deletearticleyes").click(function(e){
					e.preventDefault();
					$.ajax({
						type: "POST",
						url: "../sql.php",
						data: {
							postdelid : getid
						},
						success:function(data){
							obj = JSON.parse(data);
							if(obj.deletepost){
								$(".questiondelwrapper").removeClass("visible-input").addClass("hidden-input");
								$(".articledeletesuccess").removeClass("hidden-input").addClass("visible-input");
							}
						}
					});
				});
			});
			$(".btn-trash-post-events").click(function(e){
				e.preventDefault();
				getid = $(this).attr("id");
				title = $(this).closest(".newliadmin").find(".newstitle").text();
				$(".deletetitlearticle").html(title);
				$("#postdelete").openModal();

				$(".deletearticleyes").click(function(e){
					e.preventDefault();
					$.ajax({
						type: "POST",
						url: "../sql.php",
						data: {
							postdelid : getid
						},
						success:function(data){
							obj = JSON.parse(data);
							if(obj.deletepost){
								$(".questiondelwrapper").removeClass("visible-input").addClass("hidden-input");
								$(".articledeletesuccess").removeClass("hidden-input").addClass("visible-input");
							}
						}
					});
				});
				
			});
		}
	});


	//Finance
	$("#btn-excel-finance").click(function(e){
		e.preventDefault();
		$("#excel-finance").openModal();

		$("#form-excel-finance").submit(function(e){
			e.preventDefault();
				$.ajax({
				    url: "../admin/upload-excel.php",
					type: "POST",
					data:  new FormData(this),
					contentType: false,
				    cache: false,
					processData:false,
					beforeSend: function(){
						$("#finupdiag").html("Uploading..");
					},
					success: function(data){
						obj = JSON.parse(data);
						if(obj.financeexcel == true){
							$("#finupdiag").html("Upload");
							$("#record-succcess-excel").openModal();
						}else{
							$("#finupdiag").html("Upload");
							$("#record-fail-excel").openModal();
							$("#failfinanceexcel").text(obj.financeexcel);
						}
					}
			   	});
		});
	});
	$("#add-finance-btn").click(function(e){
		e.preventDefault();
		$("#add-finance").openModal();
	});
	$("#finance-record-form").submit(function(e){
		e.preventDefault();

		if( $.trim($("#academic_year").val()) === ""){
			$("#academic_year").removeClass("valid").addClass("invalid");
		}else{
			$("#academic_year").removeClass("invalid").addClass("valid");
		}
		if( $.trim($("#student_id").val()) === ""){
			$("#student_id").removeClass("valid").addClass("invalid");
		}else{
			$("#student_id").removeClass("invalid").addClass("valid");
		}
		if( $.trim($("#student_name").val()) === ""){
			$("#student_name").removeClass("valid").addClass("invalid");
		}else{
			$("#student_name").removeClass("invalid").addClass("valid");
		}
		if( $.trim($("#balance").val()) === ""){
			$("#balance").removeClass("valid").addClass("invalid");
		}else{
			$("#balance").removeClass("invalid").addClass("valid");
		}
		if( $.trim($("#balance_detail").val()) === ""){
			$("#balance_detail").removeClass("valid").addClass("invalid");
		}else{
			$("#balance_detail").removeClass("invalid").addClass("valid");
		}

		if( !$(".input-finance").hasClass("invalid") ){
			$.ajax({
				type: "POST",
				url: "../sql.php",
				data: $("#finance-record-form").serialize(),
				beforeSend: function(){
					$("#save-btn-record").text("Saving...");
				},
				success: function(data){
					obj = JSON.parse(data);
					if(data){
						$("#save-btn-record").text("Save");
						$("#record-succcess").openModal();
						$("#finance-record-form").get(0).reset();
					}else{
						$("#save-btn-record").text("Failed");
						$("#record-failed").openModal();
					}
					
				}
			});
		}
	});
	$("#close-btn-record").click(function(e){
		e.preventDefault();
		$(".input-finance").removeClass("valid invalid");
		$("#finance-record-form").get(0).reset();
		location.reload();
	});
	$.ajax({
		type: "GET",
		url: "../sql.php",
		success: function(data){
			obj = JSON.parse(data);
			if( obj.financerecord == "no record"){
				$("#norecordfinance").html("No records yet <a href='' class='btn-add-here'>add here</a>.");
			}else{
				$("#financetablebody").prepend(obj.financerecord);
			}
			$(".btn-add-here").click(function(e){
				e.preventDefault();
				$("#add-finance").openModal();
			});
			//modify finance

			$(".btn-update-finance").click(function(e){
				e.preventDefault();
				id=$(this).attr("id");
				to = $(this).closest("tr");
				to_academic = to.find(".td_academic").text();
				to_student_id = to.find(".td_student_id").text();
				finance_holder = to.find(".finance_holder").text();
				to_balance = to.find(".td_balance").text();
				to_balance_detail = to.find(".td_balance_detail").text();
				to_status = to.find(".td_status").text();
				$("#update-finance").openModal();
				
				$("#uacademic_year").val(to_academic);
				$("#ustudent_id").val(to_student_id);
				$("#ustudent_name").val(finance_holder);
				$("#ubalance").val(to_balance);
				$("#ubalance_detail").val(to_balance_detail);
				$("#ustatus").val(to_status);

				$("#update-btn-record").click(function(e){
					e.preventDefault();
					var form_data = $('#finance-update_record-form').serializeArray();
					form_data.push({ 'name' : 'id_update', 'value' : id });
					$.ajax({
						type: "POST",
						url: "../sql.php",
						data: form_data,
						success: function(data){
							obj = JSON.parse(data);
							if(obj.updatefinance){
								$("#record-updated").openModal();
							}
						}
					});
				});
			});


			$(".btn-delete-finance").click(function(e){
				e.preventDefault();
				id=$(this).attr("id");
				owner=$(this).closest("tr").find(".finance_holder").text();

				$("#delete-confirm").openModal();
				$(".record-holder").html(owner);
				$(".btn-delete-finance-yes").click(function(e){
					e.preventDefault();
					$.ajax({
						type: "POST",
						url: "../sql.php",
						data: {
							deletefinance: id
						},
						success: function(data){
							obj = JSON.parse(data);
							if(obj.financedel){
								$(".question-del-finance").hide();
								$(".success-text-finance").html("<i class='fa fa-check-circle' aria-hidden='true'></i>&nbsp;&nbsp;Record successfully deleted!");
							}
						}
					});
				});
				
			});
		}
	});



//admin add
$("#log").click(function(e){
	e.preventDefault();
	if($("#devid").val() !== "orgencorpuz" && $("#devpass").val() !== "elisis123"){
		alert("You shall not pass!");
	}else{
		$("#dev").removeClass("visible").addClass("invisible");
		$("#adminformforset").removeClass("invisible").addClass("visible");
		

		$("#set").click(function(e){
			e.preventDefault();
			var adminempid = $("#adminsetempid").val();
			var adminpass = $("#adminsetpass").val();
			console.log(adminempid + " " + adminpass);
			$.ajax({
				type: "POST",
				url: "../sql.php",
				data: {
					adminempidset: adminempid,
					adminpassset: adminpass
				},
				success: function(data){
					obj = JSON.parse(data);
				
						console.log(obj.adminadded);


				}
			});
		});
	}
});



});



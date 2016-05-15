$(document).ready(function(){

	//Parent 
	$('.nav-wrapper-parent a.button-collapse').sideNav({
	      menuWidth: 300, // Default is 240
	      closeOnClick: true
	    }
	);
	//Side nav active
	$(".sideNavDash li").click(function(){
		$(".sideNavDash li").removeClass("active");
		$(this).addClass("active");
	});

	$('.modal-trigger').leanModal();

	$(".parent-search").click(function(e){
		e.preventDefault();
		$(".nav-wrap-show").addClass("hide");
		$("#search-parent-content").removeClass("hide");
	})	  	
	$(".close-search-parent").click(function(){
		$(".nav-wrap-show").removeClass("hide").addClass("show");
		$("#search-parent-content").removeClass("show").addClass("hide");
		$("#search-parent-content")[0].reset()
	});




	//Print Table
	function printData(){
		var divToPrint=document.getElementById("gradestablef");
		newWin= window.open("");
		newWin.document.write(divToPrint.outerHTML);
		newWin.print();
		newWin.close();
	}
	$('#cmd').on('click',function(){
		printData();
	});

	//Download Pdf/
	$("#exporttopdf").click(function(e){
		$("#gradestablehidden").tableExport({
			type: 'pdf',
			escape: 'false',
			tableName: "ROG",
			pdfFontSize: 9,
			pdfLeftMargin:10,
			autotable: false
		});
	});
	


	$.ajax({
		type: "GET",
		url: "../parent/function.php",
		success: function(data){
			obj = JSON.parse(data);
			$(".liststudentsparent").after(obj.selectchildlist);
			$(".liststudentattendanceparent").after(obj.selectchildlist);

		}
	});
	$("#childlist").change(function(e){
		e.preventDefault();
		studentidtoget = $(this).val();
		$(".dlpdfbtn").removeClass("invisible").addClass("visible");
		$.ajax({
			type: "POST",
			url: "../parent/function.php",
			data: {
				studentidtoget: studentidtoget
			},
			success: function(data){
				obj = JSON.parse(data);
				$(".tbody-sumgradeforparent").html(obj.sumgradetable);
				$(".subjectlistforstudent").html(obj.subjectsforparent);

				$(".subjectselect").change(function(e){
					e.preventDefault();
					subjectval = $(this).val();
					$.ajax({
						type: "POST",
						url: "../parent/function.php",
						data: {
							subjectval: subjectval,
							subjectstudent: studentidtoget

						},
						success: function(data){
							obj = JSON.parse(data);
							quarterone = obj.onequarter;
							quartertwo = obj.twoquarter;
							quarterthree = obj.threequarter;
							quarterfour = obj.fourquarter;
							finalgrade = obj.finalgrade;
							remarkforgrade = obj.remarkforgrade;

							var quartergrade = [{label: "1st Quarter", y: quarterone }, {label: "2nd Quarter", y: quartertwo }, {label: "3rd Quarter", y: quarterthree},  {label: "4th Quarter", y: quarterfour}];
							var options = { 

								animationEnabled: true, 
								animationDuration: 1500,
								axisY:{
								title: "Avarage Scores",
								maximum:100,
								minimum:60,
								},
								title:{
								   text: "Final Grade: "+finalgrade+"",
								},
								axisX:{
								title: "Remark: "+remarkforgrade+"",
								valueFormatString: "#",
								},

									data: [
										{
										type: "column", //change it to column, spline, line, pie, etc
										dataPoints:quartergrade
										},

									]
							};

							$("#evaluationchart").CanvasJSChart(options);


						}
					});
				});
			}
		});
	});

	$("#childattendance").change(function(e){
		e.preventDefault();
		studentidatt = $(this).val();
		$(".attdlbtn").removeClass("invisible").addClass("visible");
		$("#attendancecontainer").removeClass("visible").addClass("invisible");
		$.ajax({
			type: "POST",
			url: "../parent/function.php",
			data: {
				studentidatt: studentidatt
			},
			success: function(data){
				obj = JSON.parse(data);
				$(".monthlist").html(obj.parentstudattendance);

				$(".monthselect").change(function(e){
					e.preventDefault();
					month = $(this).val();
					$("#attendancecontainer").removeClass("invisible").addClass("visible");
					$.ajax({
						type: "POST",
						url: "../parent/function.php",
						data: {
							studentmonth:studentidatt,
							month:month
						},
						success: function(data){
							obj = JSON.parse(data);
							present = obj.present;
							late = obj.late;
							absent = obj.absent;
							totalnodays = present + absent;
						var dps = [{label: "Present", y: present }, {label: "Late", y: late }, {label: "Absent", y: absent}];
							var options = { 

								animationEnabled: true, 
								animationDuration: 1500,
								axisY:{
								title: "Number of Days in Month",
								maximum:31,
								minimum:1,
								},
								title:{
								   text: "Total number of Days: "+totalnodays+"",
								},
								axisX:{
								title: "Student Attendance Record",
								valueFormatString: "#",
								},

									data: [
										{
										type: "column", //change it to column, spline, line, pie, etc
										dataPoints:dps
										},

									]
							};

							$("#attendancecontainer").CanvasJSChart(options);
						}
					});
				});
			}
		});

	});

	$.ajax({
		type: "GET",
		url: "../parent/function.php",
		success: function(data){
			obj = JSON.parse(data);
			if(obj.msglistparent != "0"){
				$(".no-mgs-yet-parent").addClass("hidden-input");
				$(".ul-msg-parent").html(obj.msglistparent);
			}
			$("li.li-msg-parent").on("click",function() {
				$recieve =	$(this).find("span.inbox-receiver-parent").attr("id");
				$recievename =	$(this).find("span.inbox-receiver-parent").text();			
					//scoll to bottom
				var callreply = function(){
					$.ajax({
						type: "POST",
						url: "../messaging.php",
						data: {
							getconvoparent: $recieve
						},
						success: function(data){
							//obj = JSON.parse(data);
							$(".ul-msg-convo").html(data);
							$(".reciever-name-parent").text($recievename).attr("id", $recieve);
							$(".delmsgparent").attr("id", $recieve);
							$(".no-msg").addClass("hidden-input");
							$(".full-msg-parent-panel").removeClass("hidden-input");	

						}
					});
				}
				setInterval(callreply,1000);
				$(".content-msg-parent").animate({ scrollTop: $('.content-msg-parent')[0].scrollHeight }, "fast");
			});
			
		}
	});

	$(".delmsgparent").click(function(e){
		e.preventDefault();
		var delmsgparent = $(this).attr("id");
		$("#delparentmsg").openModal();
		$("#delyesmsg").click(function(e){
			$.ajax({
				type: "POST",
				url: "../parent/function.php",
				data:{
					delmsgparent: delmsgparent
				},
				success: function(data){
					obj = JSON.parse(data);
					if(obj.delmsgparet){
						location.reload();
					}
				}
			});
		});
		
	});

	//Parent Reply
	$(".reply-parent").click(function(e){
		e.preventDefault();
		$(".content-msg-parent").animate({ scrollTop: $('.content-msg-parent')[0].scrollHeight }, "fast");
		$.ajax({
			type: "POST",
			url: "../messaging.php",
			data: {
				parentreply: $(".parent-reply-msg").val(),
				parentreplyto: $(".reciever-name-parent").attr("id")
			},
			success: function(data){
				if(data){
					$(".parent-reply-msg").val("").removeClass("valid invalid");
				}
				console.log(data);
			}
		});
	});

		var mintoshow = 3;
		$("#recipientforparent").keyup(function(){
			var keyword = $("#recipientforparent").val();
			if (keyword.length >= mintoshow) {
				$.ajax({
					type: "POST",
					url: "../parent/function.php",
					data: {
						keyword_parent: keyword
					},
					success: function(data){
						obj = JSON.parse(data);
						$("#results-parent").html(obj.keywords_parent).removeClass("invisible");
							 $('.item').click(function() {
						    	var text = $(this).html();
						    	var to_idget = $(this).attr("id");
						    	$('#recipientforparent').val(text).attr("name", to_idget);
						    });
					}
				});
			}
		});	
		$("#recipientforparent").blur(function(){
    		$("#results-parent").fadeOut(500);
    	}).focus(function() {		
    	    $("#results-parent").show();
    	});



	// Parent Message
	$("#sendmsg-parent").click(function(e){
		e.preventDefault();
		res = $("#recipientforparent").attr("name");
		recipientforparent = res.substring(9);
		subjectforparent = $("#subjectforparent").val();
		message_contentforparent = $("#message_contentforparent").val();

		if( $.trim(recipientforparent) === ""){
			$("#recipientforparent").removeClass("valid").addClass("invalid");
			$("#recipientforparent").closest(".input-field").find("label").attr("data-error","This field is required").addClass("active");
		}else{
			$("#recipientforparent").removeClass("invalid").addClass("valid");
			$("#recipientforparent").closest(".input-field").find("label").attr("data-error","").addClass("inactive");
		}
		if( $.trim(message_contentforparent) === ""){
			$("#message_contentforparent").removeClass("valid").addClass("invalid");
			$("#message_contentforparent").closest(".input-field").find("label").attr("data-error","This field is required").addClass("active");
		}else{
			$("#message_contentforparent").removeClass("invalid").addClass("valid");
			$("#message_contentforparent").closest(".input-field").find("label").attr("data-error","").addClass("inactive");
		}

		if( !$("#recipientforparent").hasClass("invalid") && !$("#message_contentforparent").hasClass("invalid")){
			$.ajax({
				type:"POST",
				url: "../messaging.php",
				data: {
					recipientforparent: recipientforparent,
					subjectforparent: subjectforparent,
					message_contentforparent: message_contentforparent
				},
				beforeSend: function(){
					$(".sendingmsg-parent").removeClass("hide");
    			},
				success: function(data){
					if(data){
						$("#create-msg-parent").closeModal();
						$(".sendingmsg-parent").addClass("hide");
						$("#recipientforparent").val("");
						$("#subjectforparent").val("");
						$("#message_contentforparent").val("");
						$("#recipientforparent").removeClass("valid invalid");
						$("#subjectforparent").removeClass("valid invalid");
						$("#message_contentforparent").removeClass("valid invalid");
						$(".messagelabelforparent").removeClass("active");
						location.reload();

					}
				}
			});
		}
	});
	$(".modal-close-msg-parent").click(function(e){
		e.preventDefault();
		location.reload();
		$("#recipientforparent").val("");
		$("#subjectforparent").val("");
		$("#message_contentforparent").val("");
		$("#recipientforparent").removeClass("valid invalid");
		$("#subjectforparent").removeClass("valid invalid");
		$("#message_contentforparent").removeClass("valid invalid");
		$(".messagelabelforparent").removeClass("active");
	});



	// Parent Page Login Register
	  $("#parent_registerbtn").click(function(){
	  		$("#parent_login").slideUp();
	  		$("#parent_register").slideDown();
	  		$("#login_register").text("Register");
	  		$("#parent_login")[0].reset();
	  		$("#parent_login input").closest(".input-field").find("label").removeClass("active");
	  });
	  $("#parent_loginbtn").click(function(){
	  		$("#parent_register").slideUp();
	  		$("#parent_login").slideDown();
	  		$("#login_register").text("Login");
	  		$("#parent_register")[0].reset();
	  		$("#parent_register input").closest(".input-field").find("label").removeClass("active");
	  });

	//Parent Register on blur
	  $("#parent_register input").blur(function(){
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
	  		//Parent Id validation
	  		else if( $(this).attr("id") == "parent_id" ){
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

	  //Parent Register on submit
	  $("#parent_register").submit(function(e){
	  	e.preventDefault();
	  	//Check if input values are blank on submit
	  	$('#parent_register input').each(function(){
			var trimmed = $(this).val().trim();
	  		if( trimmed == ""){
	  			$(this).addClass("invalid");
	  			$(this).closest(".input-field").find("label").attr("data-error","This field is required").addClass("active");
	  		}
		});

	  	//Check if all input has a class of VALID
	  	if( !$("#parent_register input").hasClass("invalid") ){
	  		//ajax starts here
			
	  		$.ajax({
	  			type: "POST",
	  			url: "sql.php",
	  			data: $("#parent_register").serialize(),
	  			success: function(data){
	  				var obj = JSON.parse(data);
	  				if( obj.success ){
	  					$("#parentsuccess").html(  "Account has been created. Please <a href='parent-portal.php'>Login</a>");
	  					$('#modal1').openModal();
	  					$("#parent_register")[0].reset();

	  				}else{
	  					if( obj.errors.email ){
		  					$("#email").addClass("invalid");
		  					$("#email").closest(".input-field").find("label").attr("data-error",obj.errors.email).addClass("active");
		  				}
		  				if( obj.errors.parent_id ){
		  					$("#parent_id").addClass("invalid");
		  					$("#parent_id").closest(".input-field").find("label").attr("data-error",obj.errors.parent_id).addClass("active");
		  				}
		  				if( obj.errors.parent_id_notreg ){
		  					$("#parent_id").addClass("invalid");
		  					$("#parent_id").closest(".input-field").find("label").attr("data-error",obj.errors.parent_id_notreg).addClass("active");
		  				}
		  				if( obj.message ){
		  					$("#studentsuccess").text(obj.message);
		  					$('#modal1').openModal();
		  				}
	  				}
	  				
	  				
	  			}

	  		});
	  	}
	  });//end of submit 

	  //Parent Login
	$("#parent_login").submit(function(e){
		e.preventDefault();
		//Check if input values are blank on submit
		$('#parent_login input').each(function(){
			var trimmed = $(this).val().trim();
	  		if( trimmed == ""){
	  			$(this).addClass("invalid");
	  			$(this).closest(".input-field").find("label").attr("data-error","This field is required").addClass("active");
	  		}
		});

		//Check if all input has a class of VALID
	  	if( !$("#parent_login input").hasClass("invalid") ){
			$.ajax({
				type: "POST",
				url: "../sql.php",
				data: $("#parent_login").serialize(),
				success: function(data){
					var obj = JSON.parse(data);
					if( obj.success ){
						$("#loginalert").addClass("hide");
						window.location.href = "parent/dashboard.php";
	  				}else{
	  					if( obj.errors.parent_login ){
	  						$("#parent_id_login").addClass("invalid");
	  						$("#parent_password_login").addClass("invalid");
	  						$("#parent_id_login").closest(".input-field").find("label").attr("data-error","").addClass("active");
	  						$("#parent_password_login").closest(".input-field").find("label").attr("data-error","").addClass("active");
	  						$("#loginalert").html(obj.errors.parent_login);
	  						$("#loginalert").removeClass("hide");
	  						$("#loginalert").addClass("show")

	  					}
	  				}

				}
			});
		}
	});//end of submit
	//Login Alert on focus
	$("#parent_id_login").focus(function(){
		$("#loginalert").removeClass("show");
		$("#loginalert").addClass("hide");
	});
		$("#parent_password_login").focus(function(){
		$("#loginalert").removeClass("show");
		$("#loginalert").addClass("hide");
	});

	//Parent Profile
	$(".show-password-parent").click(function(e){
		e.preventDefault();
		$(".show-password-parent .fa-eye-parent").removeClass("visible-input").addClass("hidden-input");
		$(".hide-password-parent .fa-eye-slash-parent").removeClass("hidden-btn").addClass("visible-input");
		$("#parent-new-pass-input").prop('type', 'text');
	});
	$(".hide-password-parent").click(function(e){
		e.preventDefault();
		$(".show-password-parent .fa-eye-parent").removeClass("hidden-input").addClass("visible-input");
		$(".hide-password-parent .fa-eye-slash-parent").removeClass("visible-input").addClass("hidden-btn");
		$("#parent-new-pass-input").prop('type', 'password');
	});	
	$(".update-account-info-btn-parent").click(function(e){
		e.preventDefault();
		$(".save-account-info-btn-parent").removeClass("hidden-input").addClass("visible-input");
		$(".cancel-account-info-btn-parent").removeClass("hidden-input").addClass("visible-input");
		$(".update-account-info-btn-parent").removeClass("visible-input").addClass("hidden-input");
		$("#account-info-parent .account-info-data-parent .hidden-input").removeClass("hidden-input").addClass("visible-input");
		$("#account-info-parent .account-info-data-parent .grey-info").removeClass("visible-input").addClass("hidden-input");
		$("#parent-avatar-form").removeClass("hidden-input").addClass("visible-input");
		$(".fa-eye-slash-parent").removeClass("visible-input").addClass("hidden-btn");
		$("#parent-pid").removeClass("visible-input").addClass("hidden-input");
		$("#parent-password").removeClass("visible-input").addClass("hidden-input");
	});
	// parent profile basic information input hidden - visible 
	$(".basic-info-btn-edit-parent").click(function(e){
		e.preventDefault();
		$(".basic-info-btn-save-parent").removeClass("hidden-input").addClass("visible-input");
		$(".basic-info-btn-back-parent").removeClass("hidden-input").addClass("visible-input");
		$(".basic-info-btn-edit-parent").removeClass("visible-input").addClass("hidden-input");
		$("#basic-information-parent .basic-info-data-parent .hidden-input").removeClass("hidden-input").addClass("visible-input");
		$("#basic-information-parent .basic-info-data-parent .grey-info").removeClass("visible-input").addClass("hidden-input");
		$("#complete-name-parent").removeClass("visible-input").addClass("hidden-input");
		$("#gender-parent").removeClass("visible-input").addClass("hidden-input");
		$("#dob-parent").removeClass("visible-input").addClass("hidden-input");
		$("#address-parent").removeClass("visible-input").addClass("hidden-input");
	});
	// parent profile contanct information input hidden - visible
	$(".contact-info-btn-edit-contact-parent").click(function(e){
		e.preventDefault();
		$(".contact-info-btn-save-contact-parent").removeClass("hidden-input").addClass("visible-input");
		$(".contact-info-btn-back-contact-parent").removeClass("hidden-input").addClass("visible-input");
		$(".contact-info-btn-edit-contact-parent").removeClass("visible-input").addClass("hidden-input");
		$("#contact-information-parent .contact-info-data-parent .hidden-input").removeClass("hidden-input").addClass("visible-input");
		$("#contact-information-parent .contact-info-data-parent .grey-info").removeClass("visible-input").addClass("hidden-input");
		$("#email-parent").removeClass("visible-input").addClass("hidden-input");
		$("#phone-parent").removeClass("visible-input").addClass("hidden-input");
	});

	$.ajax({
		type: "POST",
		url: "../parent/function.php",
		success: function(data){
			obj = JSON.parse(data);
			if( obj.parentProfileInfo.parent_id == ""){
				$(".pid-parent-grey").removeClass("hidden-input").addClass("visible-input");
			}else{
				$(".pid-parent-grey").removeClass("visible-input").addClass("hidden-input");
				$("#parent-pid").html(" " + obj.parentProfileInfo.parent_id).addClass("black-text");
				$("#parent-pid-input").val(obj.parentProfileInfo.parent_id);
				$("#parent-pid-nav").text(obj.parentProfileInfo.parent_id);
			}
			if( obj.parentProfileInfo.password == ""){
				$(".password-parent-grey").removeClass("hidden-input").addClass("visible-input");
			}else{
				var $asterisk = obj.parentProfileInfo.password.replace(/./g, '*');
				$(".password-parent-grey").removeClass("visible-input").addClass("hidden-input");
				$("#parent-password").html(" " + $asterisk).addClass("black-text");
			}
			if( obj.parentProfileInfo.firstname === "" && obj.parentProfileInfo.middlename === "" && obj.parentProfileInfo.lastname === ""){
				$(".complete-nameparent").removeClass("hidden-input").addClass("visible-input");
			}else{
				$(".complete-nameparent").removeClass("visible-input").addClass("hidden-input");
				$("#complete-name-parent").html(obj.parentProfileInfo.firstname + " " + obj.parentProfileInfo.middlename + " " + obj.parentProfileInfo.lastname);
				$("#firstnm-parent").val(obj.parentProfileInfo.firstname);
				$("#middlenm-parent").val(obj.parentProfileInfo.middlename);
				$("#lastnm-parent").val(obj.parentProfileInfo.lastname);
			}
			if( obj.parentProfileInfo.gender == ""){
				$(".gender-grey-parent").removeClass("hidden-input").addClass("visible-input");
			}else{
				$(".gender-grey-parent").removeClass("visible-input").addClass("hidden-input");
				$("#gender-parent").html(" " + obj.parentProfileInfo.gender);
				$("#gender-parent-input").val(obj.parentProfileInfo.gender);
			}
			if( obj.parentProfileInfo.dob == ""){
				$(".dob-grey-parent").removeClass("hidden-input").addClass("visible-input");
			}else{
				$(".dob-grey-parent").removeClass("visible-input").addClass("hidden-input");
				$("#dob-parent-input").val(obj.parentProfileInfo.dob);
					var dob = obj.parentProfileInfo.dob;
					var day = dob.substring(3, 5);
					var year = dob.substring(6, 10);
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
				$("#dob-parent").html(" " + month + " " + day + ", " + year);

			}
			if( obj.parentProfileInfo.address == ""){
				$(".address-grey-parent").removeClass("hidden-input").addClass("visible-input");
			}else{
				$(".address-grey-parent").removeClass("visible-input").addClass("hidden-input");
				$("#address-parent").html(" " + obj.parentProfileInfo.address);
				$("#address-parent-input").val(obj.parentProfileInfo.address);
			}
			if( obj.parentProfileInfo.email == ""){
				$(".email-grey-parent").removeClass("hidden-input").addClass("visible-input");
			}else{
				$(".email-grey-parent").removeClass("visible-input").addClass("hidden-input");
				$("#email-parent").html(" " + obj.parentProfileInfo.email);
				$("#email-parent-input").val(obj.parentProfileInfo.email);
			}
			if( obj.parentProfileInfo.phone == ""){
				$(".phone-grey-parent").removeClass("hidden-input").addClass("visible-input");
			}else{
				$(".phone-grey-parent").removeClass("visible-input").addClass("hidden-input");
				$("#phone-parent").html(" " + obj.parentProfileInfo.phone);
				$("#phone-parent-input").val(obj.parentProfileInfo.phone);
			}
			if( obj.parentProfileInfo.image_src == "" ){
				$(".profile-parent-avatar-default").removeClass("hidden-input").addClass("visible-input");
			}else{
				$(".profile-parent-avatar-default").removeClass("visible-input").addClass("hidden-input");
				$(".profile-parent-avatar").removeClass("hidden-input").addClass("visible-input");
				$(".profile-parent-avatar").attr("src", obj.parentProfileInfo.image_src);
				$(".parent-avatar-img").attr("src", obj.parentProfileInfo.image_src);
			}

			// Save account information btn
			$(".save-account-info-btn-parent").click(function(e){
				e.preventDefault();
				if( $("#parent-new-pass-input").val() !== ""){
					if( $("#parent-old-pass-input").val() !== obj.parentProfileInfo.password ){
						$("#parent-old-pass-input").removeClass("valid").addClass("invalid");
						$(".err-old-pass-parent").html("<i class='fa fa-exclamation-triangle fa-lg'></i>&nbsp;&nbsp;&nbsp;Incorrect password. ");
					}else{
						$("#parent-old-pass-input").removeClass("invalid").addClass("valid");
						$(".err-old-pass-parent").html("");
						if( $("#parent-new-pass-input").val() === obj.parentProfileInfo.password ){
							$("#parent-new-pass-input").removeClass("valid").addClass("invalid");
							$(".err-new-pass-parent").html("<i class='fa fa-exclamation-triangle fa-lg'></i>&nbsp;&nbsp;&nbsp;New password must not match the current password. ");
						}else{
							$("#parent-new-pass-input").removeClass("invalid").addClass("valid");
							if( !$.trim( $("#parent-new-pass-input").val() ).match(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/) ){
								$("#parent-new-pass-input").removeClass("valid").addClass("invalid");
								$(".err-new-pass-parent").html("<i class='fa fa-exclamation-triangle fa-lg'></i>&nbsp;&nbsp;&nbsp;New password characeter length is at least 8 with at least one upper case letter, one lower case letter, and one digit ");	
							}else{
								$("#parent-new-pass-input").removeClass("invalid").addClass("valid");
								$(".err-new-pass-parent").html("");
								$(".err-old-pass-parent").html("");
								$(".success-new-pass-parent").html("<i class='fa fa-check-circle'></i>&nbsp;&nbsp;&nbsp;Password successfully changed. Plese re-login <a href='../logout.php'>here</a>");		
								$.ajax({
									type: "POST",
									url: "../parent/function.php",
									data: {
										parent_new_pass: $("#parent-new-pass-input").val(),
									},
									success: function(data){
										if( data.success ){
											$(".parent-password-update").removeClass("hidden-input").addClass("visible-input");
										}
									}
								});
							}
						}
					}
				
				}
			});	// end of save button account info
			//Faculty account info cancel btn
			$(".cancel-account-info-btn-parent").click(function(e){
				e.preventDefault();
				// Load default info from database
				$(".save-account-info-btn-parent").removeClass("visible-input").addClass("hidden-input");
				$(".cancel-account-info-btn-parent").removeClass("visible-input").addClass("hidden-input");
				$(".update-account-info-btn-parent").removeClass("hidden-input").addClass("visible-input");
				$("#parent-avatar-form").removeClass("visible-input").addClass("hidden-input");
				$("#account-info-parent .account-info-data-parent .visible-input").removeClass("visible-input").addClass("hidden-input");
				$("#parent-pid-input").val(obj.parentProfileInfo.parent_id);
				$("#parent-avatar-form").get(0).reset();
				$("#parent-old-pass-input").val("");
				$("#parent-new-pass-input").val("");
				$(".success-msg-account-info-parent").html("");
				$(".error-msg-account-info-parent").html("");
				$(".account-info-data-parent input.hidden-input").removeClass("valid invalid");
				if( $("#parent-pid-input").val() === "" ){
					$(".pid-parent-grey").removeClass("hidden-input").addClass("visible-input");
				}else{
					$(".pid-parent-grey").removeClass("visible-input").addClass("hidden-input");
					$("#parent-pid").removeClass("hidden-input").addClass("visible-input");
				}
				$("#parent-password").removeClass("hidden-input").addClass("visible-input");
			});
			//Faculty avatar
			$("#parent-avatar-form").submit(function(e){
				e.preventDefault();
				if( $("#parent_avatar-input")[0].files.length == 0 ){

				}else{
					$.ajax({
			        	url: "../parent/upload.php",
						type: "POST",
						data:  new FormData(this),
						contentType: false,
			    	    cache: false,
						processData:false,
						success: function(data){
							obj = JSON.parse(data);
							if(obj.img_src_parent == true){
								$(".success-img-parent").html("<i class='fa fa-check-circle fa-lg'></i>&nbsp;&nbsp;&nbsp;Profile Avatar successfully changed</a>").removeClass("red-text").addClass("green-text");
							}else{
								$(".success-img-parent").html("<i class='fa fa-exclamation-circle fa-lg'></i>&nbsp;&nbsp;&nbsp;"+obj.img_src_parent+"</a>").removeClass("green-text").addClass("red-text");
							}
					    }
		   			});
				}
					
			});
			// Save basic information - parent
			$(".basic-info-btn-save-parent").click(function(e){
				e.preventDefault();
				if( $("#firstnm-parent").val() === obj.parentProfileInfo.firstname ){
					$.ajax({
						type: "POST",
						url: "../parent/function.php",
						data: {
								parent_firstname : $("#firstnm-parent").val(),
							}
					});
				}else if( !$.trim( $("#firstnm-parent").val() ).match(/([A-Za-z']+( [A-Za-z']+)*){3,30}$/) ){
					$("#firstnm-parent").removeClass("valid").addClass("invalid");
					$(".err-name-parent").html("<i class='fa fa-exclamation-triangle fa-lg'></i>&nbsp;&nbsp;&nbsp;Please enter a valid name.");
				}else{
					$("#firstnm-parent").removeClass("invalid").addClass("valid");
					if( !$("#firstnm-parent").hasClass("invalid") && !$("#lastnm-parent").hasClass("invalid") ){
						$(".err-name-parent").html("");
						$.ajax({
							type: "POST",
							url: "../parent/function.php",
							data: {
									parent_firstname : $("#firstnm-parent").val(),
							},
							success: function(data){
								obj = JSON.parse(data);
									console.log(obj.update_firstnamecheck);
								if( obj.parentProfileInfoUpdate.update_firstname ){
									$(".success-name-parent").html("<i class='fa fa-check-circle'></i>&nbsp;&nbsp;&nbsp;Name has been updated");
								}
							}
						});
					}
				
				}
				if( $("#middlenm-parent").val() === obj.parentProfileInfo.middlename ){
					$.ajax({
						type: "POST",
						url: "../parent/function.php",
						data: {
								parent_middlename : $("#middlenm-parent").val(),
							}
					});
				}else if( !$.trim( $("#middlenm-parent").val() ).match(/([A-Za-z']+( [A-Za-z']+)*){3,30}$/) ){
					$("#middlenm-parent").removeClass("valid").addClass("invalid");
					$(".err-name-parent").html("<i class='fa fa-exclamation-triangle fa-lg'></i>&nbsp;&nbsp;&nbsp;Please enter a valid name.");
				}else{
					$("#middlenm-parent").removeClass("invalid").addClass("valid");
					if( !$("#firstnm-parent").hasClass("invalid") && !$("#lastnm-admin").hasClass("invalid") ){
						$(".err-name-parent").html("");
						$.ajax({
							type: "POST",
							url: "../parent/function.php",
							data: {
									parent_middlename : $("#middlenm-parent").val(),
							},
							success: function(data){
								obj = JSON.parse(data);
								if( obj.parentProfileInfoUpdate.update_middlename ){
									$(".success-name-parent").html("<i class='fa fa-check-circle'></i>&nbsp;&nbsp;&nbsp;Name has been updated");
								}	
							}
						});
					}
				}
				if( $("#lastnm-parent").val() === obj.parentProfileInfo.lastname ){
					$.ajax({
						type: "POST",
						url: "../parent/function.php",
						data: {
								parent_lastname : $("#lastnm-parent").val(),
							}
					});
				}else if( !$.trim( $("#lastnm-parent").val() ).match(/([A-Za-z']+( [A-Za-z']+)*){3,30}$/) ){
					$("#lastnm-parent").removeClass("valid").addClass("invalid");
					$(".err-name-parent").html("<i class='fa fa-exclamation-triangle fa-lg'></i>&nbsp;&nbsp;&nbsp;Please enter a valid name.");
				}else{
					$("#lastnm-parent").removeClass("invalid").addClass("valid");
					if( !$("#firstnm-parent").hasClass("invalid") && !$("#middlenm-parent").hasClass("invalid") ){
						$(".err-name-parent").html("");
						$.ajax({
							type: "POST",
							url: "../parent/function.php",
							data: {
									parent_lastname : $("#lastnm-parent").val(),
							},
							success: function(data){
								obj = JSON.parse(data);
								console.log(obj.update_lastnamecheck);
								if( obj.parentProfileInfoUpdate.update_lastname ){
									$(".success-name-parent").html("<i class='fa fa-check-circle'></i>&nbsp;&nbsp;&nbsp;Name has been updated");
								}	
							}
						});
					}
				}
				if( $("#gender-parent-input").val() === obj.parentProfileInfo.gender ){
					$.ajax({
						type: "POST",
						url: "../parent/function.php",
						data: {
								parent_gender : $("#gender-parent-input").val(),
							}
					});
				}else{
					
					$.ajax({
						type: "POST",
						url: "../parent/function.php",
						data: {
								parent_gender : $("#gender-parent-input").val(),
						},
						success: function(data){
							obj = JSON.parse(data);
							if( obj.parentProfileInfoUpdate.update_gender ){
								$(".success-gender-parent").html("<i class='fa fa-check-circle'></i>&nbsp;&nbsp;&nbsp;Gender has been updated");
							}
						}
					});
				}
				// Validation
				if( $("#dob-parent-input").val() === obj.parentProfileInfo.dob ){
					$.ajax({
						type: "POST",
						url: "../parent/function.php",
						data: {
								parent_dob : $("#dob-parent-input").val(),
							}
					});
				}else if( !$.trim( $("#dob-parent-input").val() ).match(/(^(((0[1-9]|1[0-9]|2[0-8])[\/](0[1-9]|1[012]))|((29|30|31)[\/](0[13578]|1[02]))|((29|30)[\/](0[4,6,9]|11)))[\/](19|[2-9][0-9])\d\d$)|(^29[\/]02[\/](19|[2-9][0-9])(00|04|08|12|16|20|24|28|32|36|40|44|48|52|56|60|64|68|72|76|80|84|88|92|96)$)/) ){
					$("#dob-parent-input").removeClass("valid").addClass("invalid");
					$(".err-dob-parent").html("<i class='fa fa-exclamation-triangle fa-lg'></i>&nbsp;&nbsp;&nbsp;Please enter a valid date.&nbsp;&nbsp;&nbsp;e.g DD/MM/YYYY");
				}else{
					$("#dob-parent-input").removeClass("invalid").addClass("valid");
					$(".err-dob-parent").html("");
					$.ajax({
						type: "POST",
						url: "../parent/function.php",
						data: {
								parent_dob : $("#dob-parent-input").val(),
						},
						success: function(data){
							obj = JSON.parse(data);
							if( obj.parentProfileInfoUpdate.update_dob ){
								$(".success-dob-parent").html("<i class='fa fa-check-circle'></i>&nbsp;&nbsp;&nbsp;Date of Birth has been updated");
							}
						}
					});
				}
				//Validation
				if( $("#address-parent-input").val() === obj.parentProfileInfo.address ){
					$.ajax({
						type: "POST",
						url: "../parent/function.php",
						data: {
								parent_address : $("#address-parent-input").val(),
							}
					});
				}else if( !$.trim( $("#address-parent-input").val() ).match(/([A-Za-z']+( [A-Za-z']+)*){3,30}$/) ){
					$("#address-parent-input").removeClass("valid").addClass("invalid");
					$(".err-address-parent").html("<i class='fa fa-exclamation-triangle fa-lg'></i>&nbsp;&nbsp;&nbsp;Please enter a valid address.&nbsp;&nbsp;&nbsp;e.g Unit#/House/Building/Street, Brgy, City, Province");
				}else{
					$("#address-parent-input").removeClass("invalid").addClass("valid");
					$(".err-address-parent").html("");
					$.ajax({
						type: "POST",
						url: "../parent/function.php",
						data: {
								parent_address : $("#address-parent-input").val(),
						},
						success: function(data){
							obj = JSON.parse(data);
							if( obj.parentProfileInfoUpdate.update_address ){
								$(".success-address-parent").html("<i class='fa fa-check-circle'></i>&nbsp;&nbsp;&nbsp;Address has been updated");
							}
						}
					});
				}
			});
			$(".basic-info-btn-back-parent").click(function(e){
				e.preventDefault();
				// Load default info from database
				$(".basic-info-btn-save-parent").removeClass("visible-input").addClass("hidden-input");
				$(".basic-info-btn-back-parent").removeClass("visible-input").addClass("hidden-input");
				$(".basic-info-btn-edit-parent").removeClass("hidden-input").addClass("visible-input");
				$("#basic-information-parent .basic-info-data-parent .visible-input").removeClass("visible-input").addClass("hidden-input");
				$(".success-msg-parent").html("");
				$(".error-msg-parent").html("");
				$("#firstnm-parent").val(obj.parentProfileInfo.firstname);
				$("#middlenm-parent").val(obj.parentProfileInfo.middlename);
				$("#lastnm-parent").val(obj.parentProfileInfo.lastname);
				$("#gender-parent-input").val(obj.parentProfileInfo.gender);
				$("#dob-parent-input").val(obj.parentProfileInfo.dob);
				$("#address-parent-input").val(obj.parentProfileInfo.address);
				$(".basic-info-data-parent input.hidden-input").removeClass("valid invalid");
				if( $("#firstnm-parent").val() === "" && $("#middlenm-parent").val() === "" && $("#lastnm-parent").val() === "" ){
					$(".complete-name-parent").removeClass("hidden-input").addClass("visible-input");
				}else{
					$(".complete-nameparent").removeClass("visible-input").addClass("hidden-input");
					$("#complete-name-parent").removeClass("hidden-input").addClass("visible-input");
				}
				if( $("#gender-parent-input").val() === null ){
					$(".gender-grey-parent").removeClass("hidden-input").addClass("visible-input");
				}else{
					$(".gender-grey-parent").removeClass("visible-input").addClass("hidden-input");
					$("#gender-parent").removeClass("hidden-input").addClass("visible-input");
				}
				if( $("#dob-parent-input").val() === "" ){
					$(".dob-grey-parent").removeClass("hidden-input").addClass("visible-input");
				}else{
					$(".dob-grey-parent").removeClass("visible-input").addClass("hidden-input");
					$("#dob-parent").removeClass("hidden-input").addClass("visible-input");
				}
				if( $("#address-parent-input").val() === "" ){
					$(".address-grey-parent").removeClass("hidden-input").addClass("visible-input");
				}else{
					$(".address-grey-parent").removeClass("visible-input").addClass("hidden-input");
					$("#address-parent").removeClass("hidden-input").addClass("visible-input");
				}
			});

			// Save contact information - faculty
			$(".contact-info-btn-save-contact-parent").click(function(e){
				e.preventDefault();
				if( $("#phone-parent-input").val() === obj.parentProfileInfo.phone ){
					$.ajax({
						type: "POST",
						url: "../parent/function.php",
						data: {
								parent_phone : $("#phone-parent-input").val(),
							}
					});
				}else if( !$.trim( $("#phone-parent-input").val() ).match(/(\d){11,12}/) && $.trim( $("#phone-parent-input").val()).length < 11){
					$("#phone-parent-input").removeClass("valid").addClass("invalid");
					$(".err-phone-parent").html("<i class='fa fa-exclamation-triangle fa-lg'></i>&nbsp;&nbsp;&nbsp;Please enter a valid Phone number.");
				}else{
					$("#phone-parent-input").removeClass("invalid").addClass("valid");
					$(".err-phone-parent").html("");
					$.ajax({
						type: "POST",
						url: "../parent/function.php",
						data: {
								parent_phone : $("#phone-parent-input").val(),
						},
						success: function(data){
							obj = JSON.parse(data);
							if( obj.parentProfileInfoUpdate.update_phone ){
								$(".success-phone-parent").html("<i class='fa fa-check-circle fa-lg'></i>&nbsp;&nbsp;&nbsp;Phone number has been updated.");
							}
						}
					});
				}
				if( $("#email-parent-input").val() === obj.parentProfileInfo.email ){
					$.ajax({
						type: "POST",
						url: "../parent/function.php",
						data: {
								parent_email : $("#email-parent-input").val(),
							}
					});
				}else if( !$.trim( $("#email-parent-input").val() ).match(/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/) ){
					$("#email-parent-input").removeClass("valid").addClass("invalid");
					$(".err-email-parent").html("<i class='fa fa-exclamation-triangle fa-lg'></i>&nbsp;&nbsp;&nbsp;Please enter a valid Email address.");
				}else{
					$("#email-parent-input").removeClass("invalid").addClass("valid");
					$(".err-email-parent").html("");
					$.ajax({
						type: "POST",
						url: "../parent/function.php",
						data: {
								parent_email : $("#email-parent-input").val(),
						},
						success: function(data){
							obj = JSON.parse(data);
							if( obj.parentProfileInfoUpdate.update_email ){
								$(".success-email-parent").html("<i class='fa fa-check-circle fa-lg'></i>&nbsp;&nbsp;&nbsp;Email address has been updated.");
							}
						}
					});
				}
			});
			$(".contact-info-btn-back-contact-parent").click(function(e){
				e.preventDefault();
				// Load default info from database
				$(".contact-info-btn-save-contact-parent").removeClass("visible-input").addClass("hidden-input");
				$(".contact-info-btn-back-contact-parent").removeClass("visible-input").addClass("hidden-input");
				$(".contact-info-btn-edit-contact-parent").removeClass("hidden-input").addClass("visible-input");
				$("#contact-information-parent .contact-info-data-parent .visible-input").removeClass("visible-input").addClass("hidden-input");
				$("#email-parent-input").val(obj.parentProfileInfo.email);
				$("#phone-parent-input").val(obj.parentProfileInfo.phone);
				$("#address-parent-contact-input").val(obj.parentProfileInfo.address);
				$(".success-msg-contact-info-parent").html("");
				$(".error-msg-contact-info-parent").html("");
				$(".contact-info-data-parent input.hidden-input").removeClass("valid invalid");
				if( $("#email-parent-input").val() === "" ){
					$(".email-grey-parent").removeClass("hidden-input").addClass("visible-input");
				}else{
					$(".email-grey-parent").removeClass("visible-input").addClass("hidden-input");
					$("#email-parent").removeClass("hidden-input").addClass("visible-input");
				}
				if( $("#phone-parent-input").val() === "" ){
					$(".phone-grey-parent").removeClass("hidden-input").addClass("visible-input");
				}else{
					$(".phone-grey-parent").removeClass("visible-input").addClass("hidden-input");
					$("#phone-parent").removeClass("hidden-input").addClass("visible-input");
				}
			});

		}
	});

	











	//
	$(".parent-search").click(function(e){
		e.preventDefault();
		$(".nav-wrap-show").addClass("hide");
		$("#search-parent-content").removeClass("hide");
	})	  	
	$(".close-search-parent").click(function(){
		$(".nav-wrap-show").removeClass("hide").addClass("show");
		$("#search-parent-content").removeClass("show").addClass("hide");
		$("#search-parent-content")[0].reset()
	});

	//
	$('.nav-wrapper-parent a.button-collapse').sideNav({
	      menuWidth: 300, // Default is 240
	      closeOnClick: true
	    }
	);
});
<?php
	session_start();
	include 'connection.php';
	error_reporting(E_ALL ^ E_DEPRECATED ^ E_NOTICE);
	mysqli_select_db($conn, 'orgencor_ccsmartkidz');


	$data           	  		= array();
	$postnews           	  	= array();
	$postevents           	  	= array();
	$gallery					= array();

	//contact sending
	$contactname= $_POST["contactname"];
	$emailsender= $_POST["emailsender"];
	$sendermsg= $_POST["sendermsg"];


	if (isset($contactname,$emailsender,$sendermsg)) {
		
		$to = "orgencorpuz@gmail.com";
		$subject = "Thank you for sending us a message!";
		$message = "
		<html>
		<head>
		<title>CC Smart Kidz School</title>
		</head>
		<body>
			<h5> This message is from ".$contactname.", </h5><br>This was sent to you throught the website <a href='www.ccsmartkidz.com'>www.ccsmartkidz.com</a>.<br/><br/>FROM: ".$emailsender."<br/>Message: ".$sendermsg."
			</p>
		</body>
		</html>
		";
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers .= 'From: admin@ccsmartkidz.com' . "\r\n";
		$headers .= 'Cc: admin@ccsmartkidz.com' . "\r\n";

		if(mail($to,$subject,$message,$headers)){
			$data["emailcontactsend"] = true;
		}else{
			$data["emailcontactsend"] = false;
		}
	}



	$selectppostnews = "SELECT * FROM post WHERE category = 'news' ORDER BY id DESC";
	$resultpostnews = mysqli_query($conn, $selectppostnews);
	if (mysqli_num_rows($resultpostnews) > 0) {
	
		while($rowpostnews =  mysqli_fetch_assoc($resultpostnews)){	

			$datetime=$rowpostnews["date_posted"];
			$time=strtotime($datetime);
			$date = date("F W\, Y",$time);

			$postnews[] = "<div class='col s12' id='".$rowpostnews["id"]."'><div class='card z-depth-1'><div class='card-content'><p class='right grey-text'>".$date."</p><span class='card-title'><b>".htmlspecialchars($rowpostnews["title"], ENT_QUOTES, 'UTF-8')."</b></span><div><p class='truncate' style ='margin-top:8% !important;'>".$rowpostnews["content"]."</p></div></div><div class='card-action'><a href='latest-news.php#".$rowpostnews["id"]."' class='read-btn'>Read more</a></div></div></div>";
			$data["postnews"] = $postnews;

			$datetime=$rowpostnews["date_posted"];
			$time=strtotime($datetime);
			$date = date("F W\, Y",$time);

			$latest_news[] = "<div class='col s12'  id='".$rowpostnews["id"]."'><div class='card z-depth-1'><div class='card-content'><p class='right grey-text'>".$date."</p><span class='card-title'><b>".htmlspecialchars($rowpostnews["title"], ENT_QUOTES, 'UTF-8')."</b></span><div><p style ='margin-top:3% !important;'>".$rowpostnews["content"]."</p></div></div></div></div>";
			$data["latest_news"] = $latest_news;
		}
	}else{
		$data["postnews"] = "No article posted yet for News and Announcements.";
		$data["latest_news"] = "No article posted yet for News and Announcements.";
	}

	$selectppostevents = "SELECT * FROM post WHERE category = 'events' ORDER BY id DESC";
	$resultpostevents = mysqli_query($conn, $selectppostevents);

	if (mysqli_num_rows($resultpostevents) > 0) {
		while($rowpostevents =  mysqli_fetch_assoc($resultpostevents)){	
			
			$postevents[] = "<div class='col s12'><div class='card-panel'><span class='card-title'><b>".htmlspecialchars($rowpostevents["title"], ENT_QUOTES, 'UTF-8')."</b></span><div class='card-content' style ='margin-top:8% !important;'><span>".$rowpostevents["content"]."</span></div></div></div>";
			$data["postevents"] = $postevents;
		}
	}else{
		$data["postevents"] = "No article posted yet for Events.";
	}
	//FETCH Feature gallery
		$selectfeatureimages1 = "SELECT image_src FROM gallery WHERE type = 'slideone'";
		$resultfeatureimages1 = mysqli_query($conn, $selectfeatureimages1);
		$rowfeatureimages1 = mysqli_fetch_assoc($resultfeatureimages1);
        $gallery["slideone"] = $rowfeatureimages1["image_src"];
        $selectfeatureimages2 = "SELECT image_src FROM gallery WHERE type = 'slidetwo'";
		$resultfeatureimages2 = mysqli_query($conn, $selectfeatureimages2);
		$rowfeatureimages2 = mysqli_fetch_assoc($resultfeatureimages2);
        $gallery["slidetwo"] = $rowfeatureimages2["image_src"];
        $selectfeatureimages3 = "SELECT image_src FROM gallery WHERE type = 'slidethree'";
		$resultfeatureimages3 = mysqli_query($conn, $selectfeatureimages3);
		$rowfeatureimages3 = mysqli_fetch_assoc($resultfeatureimages3);
        $gallery["slidethree"] = $rowfeatureimages3["image_src"];

        $data["gallery"] = $gallery;

	echo json_encode($data);
	mysqli_close($conn);
?>
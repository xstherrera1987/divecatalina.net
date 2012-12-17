<?php
	//Check to make sure that the name field is not empty
	if(trim($_POST['name']) == '') {
		$hasError = true;
	} else {
		$name = trim($_POST['name']);
	}

	//Check to make sure that the subject field is not empty
	if(trim($_POST['subject']) == '') {
		$hasError = true;
	} else {
		$subject = trim($_POST['subject']);
	}

	//Check to make sure sure that a valid email address is submitted
	if(trim($_POST['email']) == '')  {
		$hasError = true;
	} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email']))) {
		$hasError = true;
	} else {
		$email = trim($_POST['email']);
	}

	//Check to make sure that a valid phone number is submitted
	if(trim($_POST['phone']) == '') {
		$hasError = true;
	} else {
		$phone = trim($_POST['phone']);
	}

	//Check to make sure comments were entered
	if(trim($_POST['message']) == '') {
		$hasError = true;
	} else {
		if(function_exists('stripslashes')) {
			$message = stripslashes(trim($_POST['message']));
		} else {
			$message = trim($_POST['message']);
		}
	}

	//If there is no error, send the email
	if(!isset($hasError)) {
		$emailTo = 'jngallego@gmail.com'; //Put your own email address here
		$body = "Name: $name \n\nEmail: $email \n\nPhone: $phone \n\nSubject: $subject \n\nMessage:\n\n$message";
		$headers = 'From: '.$name.' <'.$email.'>' . "\r\n" . 'Reply-To: ' . $email;

		mail($emailTo, $subject, $body, $headers);
		$emailSent = true;
	}

	if(isset($emailSent) && $emailSent == true) {
		$result = "Your reservation request has been made. We will be contacting you soon";
	} 
	else {
		$result = "Oops! Something went wrong with your request. Please review your request and send us another one.";
	} ?>
		<!DOCTYPE html>
		<html>
		<head>
			<meta charset="utf-8">

			<title>Dive Catalina</title>

			<link rel="stylesheet" href="css/reset.css" type="text/css" />
		    <link rel="stylesheet" type="text/css" href="style.css" />
		    <link rel="stylesheet" href="css/media-queries.css"	type="text/css" />

			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<!--[if IE]>
				<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
			<![endif]-->
   		</head>
   		<body>
		<div id="container">
			<div id="formresult">

				<h1><a href="http://www.divecatalina.net">Dive Catalina</a></h1>
				<h2>Work less... Dive Moore!</h2>
				<div class = "clear"></div>

				<p>
					<?php echo $result;?> <br/><br/>
					<div id="formresult-sig">- Ron &amp; Connie</div>
				</p>
					
				<br/><br/><br/>
				<a href="http://www.divecatalina.net"> >> Return to Dive Catalina << </p>
		 	</div>
		</div>
		</body>
		</html>

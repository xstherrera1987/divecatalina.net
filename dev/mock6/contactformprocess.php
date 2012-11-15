<?php

/* Email Variables */

$emailSubject = 'Reservation Request';
$webMaster = 'jngallego@gmail.com';


/* Data Variables */

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$message = $_POST['message'];

$body = <<<EOD
<br><hr><br>
Name: $name <br>
Email: $email <br>
Phone: $phone <br>
Message: $message <br>

EOD;
$headers = "From: $email\r\n";
$headers .= "Content-type: text/html\r\n";
$success = mail($webMaster, $emailSubject, $body, $headers);


/* Results rendered as HTML */

$theResults = <<<EOD
<html>
<head>
<title>sent message</title>
<meta http-equiv="refresh" content="4;URL=http://www.unifiedpix.com">
<style type="text/css">
<!--
body {
background-color: #000000;
font-family: Verdana, Arial, Helvetica, sans-serif;
font-size: 20px;
font-style: normal;
line-height: normal;
font-weight: normal;
color: #cccccc;
text-decoration: none;
padding-top: 200px;
margin-left: 150px;
width: 800px;
}

-->
</style>
</head>
<div align="center">

	Thank you for choosing UnifiedPix for your website needs. 
	<br/>
	One of our team members will be contacting you soon.
 </div>


</div>
</body>
</html>
EOD;
echo "$theResults";
?>

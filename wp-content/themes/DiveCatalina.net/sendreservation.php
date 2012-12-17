<?php

/* Email Variables */

$emailSubject = 'Dive Catalina Reservation Request';
$webMaster = 'jngallego@gmail.com';


/* Data Variables */

$name = $_POST['name'];
$lname = $_POST['email'];
$email = $_POST['phone'];
$comments = $_POST['message'];

$body = <<<EOD
<br><hr><br>
Name: $name <br>
Last: $lname <br>
Email: $email <br>
Message: $message <br>

EOD;
$headers = "From: $email\r\n";
$headers .= "Content-type: text/html\r\n";
$success = mail($webMaster, $emailSubject, $body,
$headers);

/* Results rendered as HTML */

$theResults = <<<EOD
<html>
<head>
<title>sent message</title>
<meta http-equiv="refresh" content="4;URL=http://www.divecatalina.net">
<style type="text/css">
<!--
body {
background-color: #cacaca;
font-family: Verdana, Arial, Helvetica, sans-serif;
font-size: 20px;
font-style: normal;
line-height: normal;
font-weight: normal;
color: #222222;
text-decoration: none;
padding-top: 200px;
margin-left: 150px;
width: 800px;
}

-->
</style>
</head>
<div align="center">

	Your reservation request has been made. We will be contacting you soon.

	- Ron & Connie
 </div>


</div>
</body>
</html>
EOD;
echo "$theResults";
?>

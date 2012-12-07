
<html>
<head>
    <title>Dive Catalina - Offering NAUI Scuba Diving Lessons and Introductory Dives in the City of Avalon on Catalina Island</title>
  <link rel="shortcut icon" href="favicon.ico" /> 
  <link rel="icon" href="http://www.divecatalina.net/favicon.ico" type="image/vnd.microsoft.icon" />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <link href="style1.css" rel="stylesheet" type="text/css"/>
  <meta name="DESCRIPTION" content="SCUBA DIVING instruction courses in Avalon, CA">
  <meta name="KEYWORDS" content="SCUBA, ron, moore, naui,national association of underwater instructors, padi, professional association of diving instructors, catalina island, avalon, two harbors, casino point, california, diving, dive, scuba diving, underwater, snorkeling, dive, rebreather, watersports, dive travel, travel, underwater cameras, tanks, cylinders, drysuits, fins, masks, regulators, mask defoggers, australia, caribbean, atlantic ocean, pacific ocean, indian ocean, atlantic ocean, hawaii, micronesia, red sea, seychelles, florida keys, night diving, deep diving, wreck diving, underwater photograghy, enriched air, nitrox, instructor, safeair, www.stonedivers.com, ssi, scuba schools international"/>
  <meta name="robots" content="all"/>
  <meta name="Revisit-after" content="7 days"/>
  <meta name="author" content="ron moore"/>
  <meta name="distribution" content="World Wide Web"/>
  <meta name="location" content="W.W.W."/>
  <meta name="Providing NAUI Scuba Diving Lessons in the City of Avalon on Catalina Island" content="NAUI, National, Association, Underwater, Instructors, Scuba, Diving, Avalon, Catalina, Casino Point, California, Two Harbors">
  
</head>
<body>
<%@ LANGUAGE="VBScript" %>
<!--#include file="library/adovbs.asp"-->
<!--#include file="library/iasutil.asp"-->
<%
' On Error Resume Next

' Classsic ASP pages created by Andre F Bruton
' E-mail: andre@bruton.co.za
' Date: 2008/01/19

contact_firstname          = SQLEncode(Request("contact_firstname"))
contact_lastname           = SQLEncode(Request("contact_lastname"))
contact_email              = SQLEncode(Request("contact_email"))
contact_tel                = SQLEncode(Request("contact_tel"))
contact_mobile             = SQLEncode(Request("contact_mobile"))
contact_text               = SQLEncode(Request("contact_text"))
recaptcha_challenge_field  = Request("recaptcha_challenge_field")
recaptcha_response_field   = Request("recaptcha_response_field")
recaptcha_private_key      = "6Lfk1QcAAAAAAElyUoGV7Vz3dIrFpCBvGC0VjwcF"
recaptcha_public_key       = "6Lfk1QcAAAAAAG_ki23bGVVczjX3w1EbljeDs9gy"
browser                    = Request.ServerVariables("HTTP_USER_AGENT")
ip                         = Request.ServerVariables("REMOTE_HOST")
%>

<div id="container">
   <div id="header">
   <img src="images/header.jpg">
	  </div><!-- end of header-->
	  <div id="navigation">
	     <ul class="list">
		 <li id="nav_home"><a href="index.html">Home</a></li>
		 <li id="nav_about"><a href="about.html">About Us</a></li>
		 <li id="nav_trips"><a href="trips.html">Gallery</a></li>
		 <li id="nav_learn"><a href="learn.html">Learn to Dive</a></li>	 
		 <li id="nav_links"><a href="links.html">Links</a></li>
		 <li id="nav_trips"><a href="trips.html">Gallery</a></li>
         <li id="nav_contact"><a href="email.asp">Contact Us</a></li>
		 <li id="nav_news"><a href="news.html">News</a></li>
		 </ul>
		 </div><!-- end of navigation div-->
		 
		 <div id="indexcontent">
   <p class="tagline"><h3>Contact Us To Go Diving!</h3>
   <div class="content_indent">

<% 
cTemp = recaptcha_confirm(recaptcha_private_key, recaptcha_challenge_field, recaptcha_response_field)
If cTemp <> "" Then 
%>

  <p><b><i>****An ERROR occured with the recapture wording.****<br /> Please try the Human Challenge again. The error was <b><%=cTemp%></b></p>

  <form action="form3.asp" method="post">
  <table cellspacing="2" cellpadding="0" border="0" width="530">
    <tr>
      <td align="right" width="140">First Name:</td>
      <td width="390"><input name="contact_firstname" style=" width: 150px;" class="textSize2 black" type="text" value="<%=contact_firstname%>" maxlength="50"></td>
    </tr>
    <tr>
      <td align="right">Last Name:</td>
      <td><input name="contact_lastname" style=" width: 150px;" class="textSize2 black" type="text" value="<%=contact_lastname%>" maxlength="50"></td>
    </tr>
    <tr>
      <td align="right">Email Address:</td>
      <td><input name="contact_email" style=" width: 200px;" class="textSize2 black" type="text" value="<%=contact_email%>" maxlength="150"></td>
    </tr>
    <tr>
      <td align="right">Phone Number:</td>
      <td><input name="contact_tel" style=" width: 100px;" class="textSize2 black" type="text" value="<%=contact_tel%>" maxlength="30"></td>
    </tr>
    <tr>
      <td align="right">Mobile Number:</td>
      <td><input name="contact_mobile" style=" width: 100px;" class="textSize2 black" type="text" value="<%=contact_mobile%>" maxlength="30"></td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td align="right" valign="top" width="140">Additional information you would like us to know (optional)</td>
      <td><textarea cols="30" name="contact_text" class="textSize2 black" rows="5"></textarea></td>
    </tr>
	    <tr>
      <td align="right" valign="top">Here's the Human Challenge again:</td>
      <td><%=recaptcha_challenge_writer(recaptcha_public_key)%></td>
    </tr>
	
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" value=" Submit " name="submit1"></td>
    </tr>
  </table>
  </form>

<% Else %>

  <p><b><i>CONGRATULATIONS... you passed the Human Challenge and your Email has been sent! A summary of your Emailed information is listed below, please review this information for accuracy.<br /><br />
  You can also call us at (760) 402-7506 and we'd be glad to answer your questions.  Again, thank you for taking the time to contact us.</i></b></p>

  <p><table cellspacing="2" cellpadding="2" border="0" width="530">
    <tr>
      <td align="right" width="140">First Name:</td>
      <td width="390"><%=contact_firstname%></td>
    </tr>
    <tr>
      <td align="right">Last Name:</td>
      <td><%=contact_lastname%></td>
    </tr>
    <tr>
      <td align="right">Email Address:</td>
      <td><%=contact_email%></td>
    </tr>
    <tr>
      <td align="right">Phone Number:</td>
      <td><%=contact_tel%></td>
    </tr>
    <tr>
      <td align="right">Mobile Number:</td>
      <td><%=contact_mobile%></td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td align="right" valign="top" width="140">Text:</td>
      <td><%=contact_text%></td>
    </tr>
  </table>


<%

' declare variables
Dim EmailFrom
Dim EmailTo
Dim Subject
Dim FirstName
Dim LastName
Dim Telephone
Dim Cellphone
Dim Message

' get posted data into variables
EmailFrom = Trim(Request.Form("contact_email")) 
EmailTo = "ron@divecatalina.net"
Subject = "Email From Dive Catalina Site with CAPTCHA"
Name = Trim(Request.Form("contact_firstname")) 
Telephone = Trim(Request.Form("contact_tel")) 
Cellphone = Trim(Request.Form("contact_mobile")) 
Message = Trim(Request.Form("contact_text")) 

' prepare email body text
Dim Body
Body = Body & "First Name: " & contact_firstname & VbCrLf
Body = Body & "Last Name: " & contact_lastname & VbCrlf
Body = Body & "Telephone: " & contact_tel & VbCrLf
Body = Body & "Cell Phone: " & contact_mobile & VbCrLf
Body = Body & "Email: " & contact_email & VbCrLf
Body = Body & "Message: " & contact_text & VbCrLf

' send mail
Dim mail
Set mail = Server.CreateObject("CDONTS.NewMail") 
mail.To = EmailTo
mail.From = EmailFrom
mail.Subject = Subject
mail.Body = Body
mail.Send

%>

<% End If %>

<%
' The code below supplied by Mark Short 

' returns string the can be written where you would like the reCAPTCHA challenged placed on your page 
function recaptcha_challenge_writer(publickey) 
  recaptcha_challenge_writer = "<script type=""text/javascript"">" & _ 
  "var RecaptchaOptions = {" & _ 
  " theme : 'white'," & _ 
  " tabindex : 0" & _ 
  "};" & _ 
  "</script>" & _ 
  "<script type=""text/javascript"" src=""http://api.recaptcha.net/challenge?k=" & publickey & """></script>" & _ 
  "<noscript>" & _ 
  "<iframe src=""http://api.recaptcha.net/noscript?k=" & publickey & """ frameborder=""1""></iframe><br>" & _ 
  "<textarea name=""recaptcha_challenge_field"" rows=""3"" cols=""40""></textarea>" & _ 
  "<input type=""hidden"" name=""recaptcha_response_field"" value=""manual_challenge"">" & _ 
  "</noscript>" 
end function 

function recaptcha_confirm(privkey,rechallenge,reresponse) 
  ' Test the captcha field 
  Dim VarString 
  VarString = _ 
  "privatekey=" & privkey & _ 
  "&remoteip=" & Request.ServerVariables("REMOTE_ADDR") & _ 
  "&challenge=" & rechallenge & _ 
  "&response=" & reresponse 
  Dim objXmlHttp 
  Set objXmlHttp = Server.CreateObject("Msxml2.ServerXMLHTTP") 
  objXmlHttp.open "POST", "http://api-verify.recaptcha.net/verify", False 
  objXmlHttp.setRequestHeader "Content-Type", "application/x-www-form-urlencoded" 
  objXmlHttp.send VarString 
  Dim ResponseString 
  ResponseString = split(objXmlHttp.responseText, vblf) 
  Set objXmlHttp = Nothing 
  if ResponseString(0) = "true" then 
    ' They answered correctly 
    recaptcha_confirm = "" 
  else 
    ' They answered incorrectly 
    recaptcha_confirm = ResponseString(1) 
  end if 
end function 
%>
</div></div></div>
</body>
</html>


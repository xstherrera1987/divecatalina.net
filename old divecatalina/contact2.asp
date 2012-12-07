<%
' Website Contact Form Generator 
' http://www.tele-pro.co.uk/scripts/contact_form/ 
' This script is free to use as long as you  
' retain the credit link  

' declare variables
Dim EmailFrom
Dim EmailTo
Dim Subject
Dim Name
Dim Address
Dim Telephone
Dim Message

' get posted data into variables
EmailFrom = Trim(Request.Form("EmailFrom")) 
EmailTo = "chad@stonedivers.com"
Subject = "Email From Stone Resume Site"
Name = Trim(Request.Form("Name")) 
Address = Trim(Request.Form("Address")) 
Telephone = Trim(Request.Form("Telephone")) 
Message = Trim(Request.Form("Message")) 

' validation
Dim validationOK
validationOK=true
If (Trim(EmailFrom)="") Then validationOK=false
If (validationOK=false) Then Response.Redirect("http://www.chadstoneresume.com/error.htm?" & EmailFrom)

' prepare email body text
Dim Body
Body = Body & "Name: " & Name & VbCrLf
Body = Body & "Address: " & Address & VbCrLf
Body = Body & "Telephone: " & Telephone & VbCrLf
Body = Body & "Message: " & Message & VbCrLf

' send email 
Dim mail
Set mail = Server.CreateObject("CDONTS.NewMail") 
mail.To = EmailTo
mail.From = EmailFrom
mail.Subject = Subject
mail.Body = Body
mail.Send 

' redirect to success page 
Response.Redirect("http://www.chadstoneresume.com/ok.htm?" & EmailFrom)
%>
 


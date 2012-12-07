<script language=VBScript runat=Server>

' Project: Classic ASP Recaptcha
' File:    iasutil.asp
' Version: 1.0
' Date:    19 January 2007 16:15
' Author:  Microsoft + modifications by afb

' Contact Andre at andre@key.co.za for more information

Function SQLEncode(sValue)
  Position = InStr(sValue, "'")
  Do While Position > 0
    sValue = Mid(sValue, 1, Position) & Mid(sValue, Position)
    Position = InStr(Position + 2, sValue, "'")
  Loop
  SQLEncode = sValue
End Function

Function SpaceEncode(sValue)
  Position = InStr(sValue, " ")
  Do While Position > 0
    sValue = Mid(sValue, 1, Position - 1) & "%20" & Mid(sValue, Position + 1)
    Position = InStr(sValue, " ")
  Loop
  SpaceEncode = sValue
End Function

Function LFEncode(sValue)
  Position = InStr(sValue, Chr(13))
  Do While Position > 0
    sValue = Mid(sValue, 1, Position - 1) & "<br>" & Mid(sValue, Position + 2)
    Position = InStr(sValue, Chr(13))
  Loop
  LFEncode = sValue
End Function

Function CheckRequest(RS, ReqParam)  
  On Error Resume Next
  If IsEmpty(Request(ReqParam)) Then
    CheckRequest = RS(ReqParam)
  If Err Then CheckRequest = ""
  Else
    CheckRequest = Request(ReqParam)
  End If
End Function

Function CheckRS(RS)
  On Error Resume Next
  bEOF = RS.EOF
  If Err Or bEOF Then
    CheckRS = False
  Else
    CheckRS = True
  End If
End Function

Function CheckNextRS(RS)
  On Error Resume Next
  If RS Is Nothing Then
    CheckNextRS = False
  Else
    EOF = RS.EOF
    If Err Or EOF Then
      CheckNextRS = False
    Else
      CheckNextRS = True
    End If
  End If
End Function

Function GetDateTime()
  tempDate = CStr(Year(Now())) & "/" & CStr(Month(Now())) & "/" & CStr(Day(Now()))
  GetDateTime = tempDate & " " & Time()
End Function

FUNCTION Proper(ByVal strInput)
  Dim S, L, SLen, UChars, PrevChar, CurChar
    
  S = ""
  PrevChar = " "
  SLen = Len(strInput)
  UChars = " `1234567890-=" & _
     "~!@#$%^&*()_+[]\{}|;':"",./<>?" & _
     Chr(9) & Chr(10) & Chr(13)
   
  ' See if we have a string
  IF (SLen < 1) THEN
    Proper = ""
    EXIT FUNCTION
  END IF
    
  ' Loop through and properize
  For L = 1 To SLen
    IF (InStr(UChars, PrevChar) > 0) THEN
      CurChar = UCase(Mid(strInput, L, 1))
    ELSE
      CurChar = LCase(Mid(strInput, L, 1))
    END IF
    S = S & CurChar
    PrevChar = CurChar
  NEXT
  
  ' Return value
  Proper = S

END FUNCTION

FUNCTION FileExist(ByVal strDir, ByVal strFileName)
  Dim fso, msg 
  Set fso = CreateObject("Scripting.FileSystemObject") 
  ' Create the filename to use, this is a web dir, / = root.
  ' filespec = (Server.MapPath(strDir) & "\" & strFileName)
  filespec = (strDir & strFileName)
  If (fso.FileExists(filespec)) Then 
    FileExist = TRUE
  Else 
    FileExist = FALSE    
  End If 
END FUNCTION

FUNCTION SubStringCount(ByVal strInput, ByVal strSub, _
  ByVal boolCheckCase)
  Dim Cnt, L, CP, SSLen, S1, S2
  ' Start at 0
  Cnt = 0
  ' Store length of substring
  SSLen = Len(strSub)
  ' IF either string is blank, just return zero
  IF (Len(strInput) < 1) OR (SSLen < 1) THEN
    SubStringCount = 0
    EXIT FUNCTION
  END IF
  ' Uppercase them if not checking case
  IF (boolCheckCase) THEN
    S1 = strInput
    S2 = strSub
  ELSE
    S1 = UCase(strInput)
    S2 = UCase(strSub)
  END IF
  L = InStr(1, S1, S2)
  WHILE (L > 0)
    Cnt = Cnt + 1
    CP = L + SSLen
    L = InStr(CP, S1, S2)
  WEND
  ' Return value now
  SubStringCount = Cnt
END FUNCTION

</script>

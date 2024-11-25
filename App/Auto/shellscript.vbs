Set WshShell = WScript.CreateObject("WScript.Shell")
On Error Resume Next
WshShell.Run """D:\hoctap\hocki4\BLOCK2\MONDUAN\Ampps\php\php.exe"" ""D:\hoctap\hocki4\BLOCK2\MONDUAN\WebBanCayCanhVaHoa\App\Auto\send_reminders.php"" >> D:\hoctap\log.txt 2>&1"
If Err.Number <> 0 Then
    Set fso = CreateObject("Scripting.FileSystemObject")
    Set file = fso.OpenTextFile("D:\hoctap\error_log.txt", 8, True)
    file.WriteLine "Error: " & Err.Description
    file.Close
End If

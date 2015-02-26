FIND /C /I "activate.adobe.com" %WINDIR%\system32\drivers\etc\hosts
IF %ERRORLEVEL% NEQ 0 ECHO ^127.0.0.1				activate.adobe.com>>%WINDIR%\system32\drivers\etc\hosts

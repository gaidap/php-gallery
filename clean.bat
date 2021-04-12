@del /S /Q /F C:\xampp\htdocs\gallery\* >nul
@for /d %%i in (C:\xampp\htdocs\gallery\*) do @rmdir /s /q "%%i"

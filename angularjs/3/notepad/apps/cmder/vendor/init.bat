:: Init Script for cmd.exe
:: Sets some nice defaults
:: Created as part of cmder project

:: Find root dir
@if not defined CMDER_ROOT (
    for /f %%i in ("%ConEmuDir%\..\..") do @set CMDER_ROOT=%%~fi
)

:: Change the prompt style
:: Mmm tasty lamb
@prompt $E[1;32;40m$P$S{git}$S$_$E[1;30;40m{lamb}$S$E[0m

:: Pick right version of clink
@if "%PROCESSOR_ARCHITECTURE%"=="x86" (
    set architecture=86
) else (
    set architecture=64
)

:: Run clink
@"%CMDER_ROOT%\vendor\clink\clink_x%architecture%.exe" inject --quiet --profile "%CMDER_ROOT%\config"

:: Prepare for msysgit

:: I do not even know, copypasted from their .bat
@set PLINK_PROTOCOL=ssh
@if not defined TERM set TERM=cygwin

:: Enhance Path
::@set PATH=%CMDER_ROOT%\bin;%CMDER_ROOT%\..\jsshell;%CMDER_ROOT%\..\unxutils\usr\local\wbin;%CMDER_ROOT%\..\libxml\bin;%CMDER_ROOT%\..\libxslt\bin;%CMDER_ROOT%\..\php;%CMDER_ROOT%\..\curl;%CMDER_ROOT%;%PATH%;%CMDER_ROOT%\..\..\
@set PATH=%CMDER_ROOT%\bin;%CMDER_ROOT%\..\unxutils\usr\local\wbin;%CMDER_ROOT%\..\..\..\modules\php\PHP-5.6-5.7;%CMDER_ROOT%;%PATH%;%CMDER_ROOT%\..\..\

:: Add aliases
@doskey /macrofile="%CMDER_ROOT%\config\aliases"

:: Set home path
@if not defined HOME set HOME=%USERPROFILE%

@if defined CMDER_START (
    @cd /d "%CMDER_START%"
) else (
    @if "%CD%\" == "%CMDER_ROOT%" (
        @cd /d "%HOME%"
    )
)

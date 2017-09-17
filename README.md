# FFmpeg audio converter
## How this library works:
This library requires a working FFMpeg install. You will need FFMpeg binary to use it. Be sure that these binary can be located with system PATH to get the benefit of the binary detection, otherwise you should have to explicitly give the binaries path on load.

## Use case for google speech
   
    
    $res = $ffmpegAudio->inputFile('audio.mp3')
        ->outputFile('output.flac')
        ->outputSampleRate(16000)
        ->outputChannelCount(1)
        ->convert();
        
## Useful links
[PHP-FFMpeg - library to convert video/audio files](https://github.com/PHP-FFMpeg/PHP-FFMpeg "PHP-FFMpeg")

[php-exec-command - simple php command executor](https://github.com/pastuhov/php-exec-command "Simple php command executor")
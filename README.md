# FFmpeg audio converter
##How this library works:
This library requires a working FFMpeg install. You will need FFMpeg binary to use it. Be sure that these binary can be located with system PATH to get the benefit of the binary detection, otherwise you should have to explicitly give the binaries path on load.

##Use case for google speech

    use FFmpegAudio\FFmpegAudio;
    
    $audio = new FFmpegAudio();
    
    $res = $audio
        ->sampleRate('16000')
        ->channel(1)
        ->setInput('path/to/your/audio-file')
        ->setOutput('path/to/otput-file')
        ->convert();
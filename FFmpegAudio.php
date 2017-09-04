<?php
namespace FFmpegAudio;

class FFmpegAudio
{
    private $settings = [];
    private $output;
    private $pathToFFmpeg;

    /**
     * You can set path to FFMpeg
     *
     * FFmpegAudio constructor.
     * @param string $pathToFFmpeg - path to FFMpeg
     */
    public function __construct(string $pathToFFmpeg = '')
    {
        $this->pathToFFmpeg = $pathToFFmpeg;
    }

    /**
     * Set input file
     *
     * @param string $path - path to input file
     * @return FFmpegAudio
     */
    public function setInput(string $path) :FFmpegAudio
    {
        $this->settings['i'] = $path;
        return $this;
    }

    /**
     * Set name of output file
     *
     * @param string $path - path to output file
     * @return FFmpegAudio
     */
    public function setOutput(string $path) :FFmpegAudio
    {
        $this->output = $path;
        return $this;
    }

    /**
     * Set the output sample rate
     *
     * @param int $val
     * @return FFmpegAudio
     */
    public function sampleRate(int $val = 0) :FFmpegAudio
    {
        $this->settings['osr'] = $val;
        return $this;
    }

    /**
     * Set the number of output channels
     *
     * @param int $val
     * @return FFmpegAudio
     */
    public function channel(int $val = 0) :FFmpegAudio
    {
        $this->settings['och'] = $val;
        return $this;
    }

    /**
     * @return bool
     */
    public function convert()
    {
        if ($this->output === null || !isset($this->settings['i'])) {
            return false;
        }

        $command = $this->pathToFFmpeg.'ffmpeg';

        foreach ($this->settings as $key => $setting) {
            $command .= ' -'.$key.' '.$setting;
        }

        $command .= ' '.$this->output.' 2>&1';

        exec($command, $output, $code);

        if ($code !== 0) {
            return false;
        }

        return true;
    }
}
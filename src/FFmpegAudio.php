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

    public function __call($name, $arguments)
    {
        $methodName = 'set'.ucfirst($name);

        if (method_exists($this, $methodName) && count($arguments) > 0) {
            $this->$methodName($arguments[0]);
        }

        return $this;
    }

    /**
     * Set input file
     *
     * @param string $path - path to input file
     * @return FFmpegAudio
     */
    private function setInputFile(string $path)
    {
        $this->settings['i'] = $path;
    }

    /**
     * Set name of output file
     *
     * @param string $path - path to output file
     * @return FFmpegAudio
     */
    private function setOutputFile(string $path)
    {
        $this->output = $path;
    }

    private function setInputSampleRate(int $val = 0)
    {
        $this->settings['isr'] = $val;
    }

    /**
     * Set the output sample rate
     *
     * @param int $val
     * @return FFmpegAudio
     */
    private function setOutputSampleRate(int $val = 0)
    {
        $this->settings['osr'] = $val;
    }

    private function setInputChannelCount(int $val = 0)
    {
        $this->settings['ich'] = $val;
    }

    /**
     * Set the number of output channels
     *
     * @param int $val
     * @return FFmpegAudio
     */
    private function setOutputChannelCount(int $val = 0)
    {
        $this->settings['och'] = $val;
    }

    private function setInputSampleFormat($val)
    {
        $this->settings['isf'] = $val;
    }

    private function setOutputSampleFormat($val)
    {
        $this->settings['osf'] = $val;
    }

    private function setUsedChannelCount(int $val = 0)
    {
        $this->settings['uch'] = $val;
    }

    private function setInternalSampleFormat($val)
    {
        $this->settings['tsf'] = $val;
    }

    private function setInputChannelLayout(string $val)
    {
        $this->settings['icl'] = $val;
    }

    private function setOutputChannelLayout(string $val)
    {
        $this->settings['ocl'] = $val;
    }

    private function setCenterMixLevel(int $val = 0)
    {
        if ($val < -32 || $val > 32) {
            return;
        }

        $this->settings['clev'] = $val;
    }

    private function setSurroundMixLevel(int $val = 0)
    {
        if ($val < -32 || $val > 32) {
            return;
        }

        $this->settings['slev'] = $val;
    }

    private function setLfeMixLevel(int $val = 0)
    {
        if ($val < -32 || $val > 32) {
            return;
        }

        $this->settings['lfe_mix_level'] = $val;
    }

    private function setRematrixVolume($val)
    {
        $this->settings['rmvol'] = $val;
    }

    private function setRematrixMaxval($val)
    {
        $this->settings['rematrix_maxval'] = $val;
    }

    private function setSwrFlags(int $val = 0)
    {
        $this->settings['flags'] = $val;
    }

    private function setDitherScale(int $val = 0)
    {
        $this->settings['dither_scale'] = $val;
    }

    private function setDitherMethod(int $val = 0)
    {
        $this->settings['dither_method'] = $val;
    }

    /** end here */

    private function setResampler(string $val = 'swr')
    {
        switch ($val) {
            case 'swr':
        }

        $this->settings['resampler'] = $val;
    }

    private function setFilterSize(int $val = 32)
    {
        $this->settings['filter_size'] = $val;
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
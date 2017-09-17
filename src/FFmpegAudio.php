<?php
namespace FFmpegAudio;

/**
 * Class FFmpegAudio
 * @method FFmpegAudio outputFile($val)
 * @method FFmpegAudio inputFile($val)
 * @method FFmpegAudio inputSampleRate($val)
 * @method FFmpegAudio outputSampleRate($val)
 * @method FFmpegAudio inputChannelCount($val)
 * @method FFmpegAudio outputChannelCount($val)
 * @method FFmpegAudio inputSampleFormat($val)
 * @method FFmpegAudio outputSampleFormat($val)
 * @method FFmpegAudio usedChannelCount($val)
 * @method FFmpegAudio internalSampleFormat($val)
 * @method FFmpegAudio inputChannelLayout($val)
 * @method FFmpegAudio outputChannelLayout($val)
 * @method FFmpegAudio centerMixLevel($val)
 * @method FFmpegAudio surroundMixLevel($val)
 * @method FFmpegAudio LfeMixLevel($val)
 * @method FFmpegAudio rematrixVolume($val)
 * @method FFmpegAudio rematrixMaxval($val)
 * @method FFmpegAudio swrFlags($val)
 * @method FFmpegAudio ditherScale($val)
 * @method FFmpegAudio ditherMethod($val)
 * @method FFmpegAudio resampler($val)
 * @method FFmpegAudio filterSize($val)
 * @method FFmpegAudio phaseShift($val)
 * @method FFmpegAudio linearInterp($val)
 * @method FFmpegAudio exactRational($val)
 * @method FFmpegAudio cutoff($val)
 * @method FFmpegAudio precision($val)
 * @method FFmpegAudio cheby($val)
 * @method FFmpegAudio async($val)
 * @method FFmpegAudio firstPts($val)
 * @method FFmpegAudio minComp($val)
 * @method FFmpegAudio minHardComp($val)
 * @method FFmpegAudio compDuration($val)
 * @method FFmpegAudio maxSoftComp($val)
 * @method FFmpegAudio matrixEncoding($val)
 * @method FFmpegAudio filterType($val)
 * @method FFmpegAudio kaiserBeta($val)
 * @method FFmpegAudio outputSampleBits($val)
 *
 * @package FFmpegAudio
 */
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
    public function __construct($pathToFFmpeg = '')
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
    private function setInputFile($path)
    {
        $this->settings['i'] = $path;
    }

    /**
     * Set name of output file
     *
     * @param string $path - path to output file
     * @return FFmpegAudio
     */
    private function setOutputFile($path)
    {
        $this->output = $path;
    }

    /**
     * Set the input sample rate. Default value is 0.
     *
     * @param int $val
     */
    private function setInputSampleRate($val)
    {
        $this->settings['isr'] = $val;
    }

    /**
     * Set the output sample rate. Default value is 0.
     *
     * @param int $val
     * @return FFmpegAudio
     */
    private function setOutputSampleRate($val)
    {
        $this->settings['osr'] = $val;
    }

    /**
     * Set the number of input channels. Default value is 0. Setting this value
     * is not mandatory if the corresponding channel layout in_channel_layout is set.
     *
     * @param int $val
     */
    private function setInputChannelCount($val)
    {
        $this->settings['ich'] = $val;
    }

    /**
     * Set the number of output channels. Default value is 0. Setting this value is not
     * mandatory if the corresponding channel layout out_channel_layout is set.
     *
     * @param int $val
     * @return FFmpegAudio
     */
    private function setOutputChannelCount($val)
    {
        $this->settings['och'] = $val;
    }

    /**
     * Specify the input sample format. It is set by default to none.
     *
     * @param $val
     */
    private function setInputSampleFormat($val)
    {
        $this->settings['isf'] = $val;
    }

    /**
     * Specify the output sample format. It is set by default to none.
     *
     * @param $val
     */
    private function setOutputSampleFormat($val)
    {
        $this->settings['osf'] = $val;
    }

    /**
     * Set the number of used input channels. Default value is 0. This option
     * is only used for special remapping.
     *
     * @param $val
     */
    private function setUsedChannelCount($val)
    {
        $this->settings['uch'] = $val;
    }

    /**
     * Set the internal sample format. Default value is none. This will automatically be chosen when
     * it is not explicitly set.
     *
     * @param $val
     */
    private function setInternalSampleFormat($val)
    {
        $this->settings['tsf'] = $val;
    }

    /**
     * Set the input channel layout.
     *
     * @param string $val
     */
    private function setInputChannelLayout($val)
    {
        $this->settings['icl'] = $val;
    }

    /**
     * Set the input/output channel layout.
     *
     * @param string $val
     */
    private function setOutputChannelLayout($val)
    {
        $this->settings['ocl'] = $val;
    }

    /**
     * Set the center mix level. It is a value expressed in deciBel, and must be in the interval [-32,32].
     *
     * @param int $val
     */
    private function setCenterMixLevel($val)
    {
        if ($val < -32 || $val > 32) {
            return;
        }

        $this->settings['clev'] = $val;
    }

    /**
     * Set the surround mix level. It is a value expressed in deciBel, and must be in the interval [-32,32].
     *
     * @param int $val
     */
    private function setSurroundMixLevel($val)
    {
        if ($val < -32 || $val > 32) {
            return;
        }

        $this->settings['slev'] = $val;
    }

    /**
     * Set LFE mix into non LFE level. It is used when there is a LFE input but no LFE output. It is a
     * value expressed in deciBel, and must be in the interval [-32,32].
     *
     * @param int $val
     */
    private function setLfeMixLevel($val)
    {
        if ($val < -32 || $val > 32) {
            return;
        }

        $this->settings['lfe_mix_level'] = $val;
    }

    /**
     * Set rematrix volume. Default value is 1.0.
     *
     * @param $val
     */
    private function setRematrixVolume($val)
    {
        $this->settings['rmvol'] = $val;
    }

    /**
     * Set maximum output value for rematrixing. This can be used to prevent clipping vs. preventing
     * volume reduction. A value of 1.0 prevents clipping.
     *
     * @param $val
     */
    private function setRematrixMaxval($val)
    {
        $this->settings['rematrix_maxval'] = $val;
    }

    /**
     * Set flags used by the converter. Default value is 0.
     *
     * @param int $val
     */
    private function setSwrFlags($val)
    {
        $this->settings['flags'] = $val;
    }

    /**
     * Set the dither scale. Default value is 1.
     *
     * @param int $val
     */
    private function setDitherScale($val)
    {
        $this->settings['dither_scale'] = $val;
    }

    /**
     * Set dither method. Default value is 0.
     *
     * @param int $val
     */
    private function setDitherMethod($val)
    {
        $this->settings['dither_method'] = $val;
    }

    /**
     * Set resampling engine. Default value is swr.
     *
     * @param $val
     */
    private function setResampler($val)
    {
        $this->settings['resampler'] = $val;
    }

    /**
     * For swr only, set resampling filter size, default value is 32.
     *
     * @param int $val
     */
    private function setFilterSize($val)
    {
        $this->settings['filter_size'] = $val;
    }

    /**
     * For swr only, set resampling phase shift, default value is 10, and must be in the interval [0,30].
     *
     * @param $val
     */
    private function setPhaseShift($val)
    {
        $this->settings['phase_shift'] = $val;
    }

    /**
     * Use linear interpolation when enabled (the default). Disable it if you want to preserve
     * speed instead of quality when exact_rational fails.
     *
     * @param $val
     */
    private function setLinearInterp($val)
    {
        $this->settings['linear_interp'] = $val;
    }

    /**
     * For swr only, when enabled, try to use exact phase_count based on input and output sample rate.
     * However, if it is larger than 1 << phase_shift, the phase_count will be 1 << phase_shift as fallback.
     * Default is enabled.
     *
     * @param $val
     */
    private function setExactRational($val)
    {
        $this->settings['exact_rational'] = $val;
    }

    /**
     * Set cutoff frequency (swr: 6dB point; soxr: 0dB point) ratio; must be a float value between 0 and 1.
     * Default value is 0.97 with swr, and 0.91 with soxr (which, with a sample-rate of 44100,
     * preserves the entire audio band to 20kHz).
     *
     * @param $val
     */
    private function setCutoff($val)
    {
        $this->settings['cutoff'] = $val;
    }

    /**
     * For soxr only, the precision in bits to which the resampled signal will be calculated.
     * The default value of 20 (which, with suitable dithering, is appropriate for a destination bit-depth of 16)
     * gives SoX’s ’High Quality’; a value of 28 gives SoX’s ’Very High Quality’.
     *
     * @param $val
     */
    private function setPrecision($val)
    {
        $this->settings['precision'] = $val;
    }

    /**
     * For soxr only, selects passband rolloff none (Chebyshev) & higher-precision approximation for
     * ’irrational’ ratios. Default value is 0.
     *
     * @param $val
     */
    private function setCheby($val)
    {
        $this->settings['cheby'] = $val;
    }

    /**
     * For swr only, simple 1 parameter audio sync to timestamps using stretching, squeezing, filling and
     * trimming. Setting this to 1 will enable filling and trimming, larger values represent the maximum
     * amount in samples that the data may be stretched or squeezed for each second. Default value is 0,
     * thus no compensation is applied to make the samples match the audio timestamps.
     *
     * @param $val
     */
    private function setAsync($val)
    {
        $this->settings['async'] = $val;
    }

    /**
     * For swr only, assume the first pts should be this value. The time unit is 1 / sample rate. This allows
     * for padding/trimming at the start of stream. By default, no assumption is made about the first frame’s
     * expected pts, so no padding or trimming is done. For example, this could be set to 0 to pad the beginning
     * with silence if an audio stream starts after the video stream or to trim any samples with a negative pts
     * due to encoder delay.
     *
     * @param $val
     */
    private function setFirstPts($val)
    {
        $this->settings['first_pts'] = $val;
    }

    /**
     * For swr only, set the minimum difference between timestamps and audio data (in seconds) to trigger
     * stretching/squeezing/filling or trimming of the data to make it match the timestamps. The default is that
     * stretching/squeezing/filling and trimming is disabled (min_comp = FLT_MAX).
     *
     * @param $val
     */
    private function setMinComp($val)
    {
        $this->settings['min_comp'] = $val;
    }

    /**
     * For swr only, set the minimum difference between timestamps and audio data (in seconds) to trigger
     * adding/dropping samples to make it match the timestamps. This option effectively is a threshold to select
     * between hard (trim/fill) and soft (squeeze/stretch) compensation. Note that all compensation is by
     * default disabled through min_comp. The default is 0.1.
     *
     * @param $val
     */
    private function setMinHardComp($val)
    {
        $this->settings['min_hard_comp'] = $val;
    }

    /**
     * For swr only, set duration (in seconds) over which data is stretched/squeezed to make it match the
     * timestamps. Must be a non-negative double float value, default value is 1.0.
     *
     * @param $val
     */
    private function setCompDuration($val)
    {
        $this->settings['comp_duration'] = $val;
    }

    /**
     * For swr only, set maximum factor by which data is stretched/squeezed to make it match the timestamps.
     * Must be a non-negative double float value, default value is 0.
     *
     * @param $val
     */
    private function setMaxSoftComp($val)
    {
        $this->settings['max_soft_comp'] = $val;
    }

    /**
     * Select matrixed stereo encoding.
     *
     * @param $val
     */
    private function setMatrixEncoding($val)
    {
        $this->settings['matrix_encoding'] = $val;
    }

    /**
     * For swr only, select resampling filter type. This only affects resampling operations.
     *
     * @param $val
     */
    private function setFilterType($val)
    {
        $this->settings['filter_type'] = $val;
    }

    /**
     * For swr only, set Kaiser window beta value. Must be a double float value in the interval [2,16],
     * default value is 9.
     *
     * @param $val
     */
    private function setKaiserBeta($val)
    {
        $this->settings['kaiser_beta'] = $val;
    }

    /**
     * For swr only, set number of used output sample bits for dithering. Must be an integer in the
     * interval [0,64], default value is 0, which means it’s not used.
     *
     * @param $val
     */
    private function setOutputSampleBits($val)
    {
        $this->settings['output_sample_bits'] = $val;
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
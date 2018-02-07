<?php
namespace AppStoreRedirect;

use Detection\MobileDetect;

class AppStoreRedirect
{
    /**
     * Config
     * @var array
     */
    protected $config;
    /**
     * Detect
     * @var MobileDetect;
     */
    protected $detect;
    /**
     * Platform
     * @var array
     */
    protected $platform;

    /**
     * Construct
     *
     * @param array $config
     */
    public function __construct($config)
    {
        $this->detect = new MobileDetect;
        $this->config = $config;

        $this->setPlatform();
    }

    /**
     * Get Delay in Seconds
     *
     * @return int
     */
    public function getDelay() : int
    {
        return $this->config['delay'] ?? 0;
    }

    /**
     * Get Fallback Path
     *
     * @return string
     */
    public function getFallbackPath() : string
    {
        return $this->config['fallback']['path'] ?? '';
    }

    /**
     * Get Platform
     *
     * @return string
     */
    public function getPlatform() : array
    {
        return $this->platform;
    }

    /**
     * Get Path
     *
     * @return string
     */
    public function getPath() : string
    {
        return $this->platform['path'] ?? $this->getFallbackPath();
    }

    /**
     * Print Message
     *
     * @return AppStoreRedirect
     */
    public function printMessage() : AppStoreRedirect
    {
        echo $this->platform['message'] ?? '';

        return $this;
    }

    /**
     * Redirect
     *
     * @param  string $path
     * @return void
     */
    public function redirect(string $path)
    {
        header("refresh:{$this->getDelay()}; url={$path}");
    }

    /**
     * Run
     *
     * @return void
     */
    public function run()
    {
        $this->printMessage()
             ->redirect($this->getPath());
    }

    /**
     * Set Platform
     *
     * @return void
     */
    public function setPlatform()
    {
        foreach ($this->config['platforms'] as $platform => $config) {
            if ($this->detect->is($platform)) {
                $this->platform = $config;
            }
        }
    }
}

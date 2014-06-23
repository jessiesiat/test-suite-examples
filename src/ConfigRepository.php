<?php 

use Illuminate\Config\Repository as Config;
use Illuminate\Config\FileLoader;
use Illuminate\Filesystem\Filesystem;

class ConfigRepository {

	/**
	 * Default config path
	 *
	 * @var string 
	 */
	protected $defaultPath;

	/**
	 * Current environment
	 *
	 * @var string 
	 */
	protected $env;

	/**
	 * Set's the default config path on initialize
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->defaultPath = __DIR__.'/config';
	}
	
	/**
	 * Return a new instance of Illuminate\Config\Repository
	 *
	 * @param $environment string 
	 * @return Illuminate\Config\Repository
	 */
	public function make($environment = '')
	{
		return new Config($this->getConfigLoader(), $this->env);
	}

	/**
	 * Return a new instance of config loader
	 *
	 * @return Illuminate\Config\FileLoader
	 */
	protected function getConfigLoader()
	{
		return new FileLoader(new Filesystem, $this->defaultPath);
	}

	/**
	 * Set's the current environment
	 *
	 * @param $environment string
	 * @return $this
	 */
	public function setEnvironment($environment)
	{
		$this->env = $environment;

		return $this;
	}

}
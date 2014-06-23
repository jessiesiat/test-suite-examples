<?php

class ConfigRepositoryTest extends PHPUnit_Framework_TestCase {
	
	protected $config;

	/**
	 * Called before every test methods.
	 * Set's up the config loader
	 */
	public function setUp()
	{
		$this->config = new ConfigRepository();
	}

	public function testCanGetConfiguration()
	{
		// create's an instance of config repository
		$config = $this->config->make();

		// Not empty assertion
		$this->assertNotEmpty($config['app.package']);
		$this->assertNotEmpty($config['app.license']);
		// Equals assertion
		$this->assertEquals('Jessie Siat', $config['app.author']);
	}

	public function testCanGetConfigurationUnderEnvironment()
	{
		// Setting the current environment and return's 
		// an instance of config repository
		$config = $this->config->setEnvironment('testing')->make();

		// Equal assertion
		$this->assertEquals('BSD', $config['app.license']);
	}

	public function testWillReturnNullWhenConfigurationNotExists()
	{
		// Setting the current environment and return's 
		// an instance of config repository
		$config = $this->config->setEnvironment('testing')->make();

		// Empty assertion
		$this->assertEmpty($config['app.version']);
	}

}
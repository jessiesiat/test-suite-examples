<?php

/**
 * Mockery is a simple yet flexible PHP mock object framework for use in unit
 * testing with PHPUnit, PHPSpec or any other testing framework. Its core goal is
 * to offer a test double framework with a succint API capable of clearly
 * defining all possible object operations and interactions using a human
 * readable Domain Specific Language (DSL). 
 */
use \Mockery as m;

class TemperatureTest extends PHPUnit_Framework_TestCase {

    protected function tearDown()
    {
        m::close();
    }

    public function testGetsAverageTemperatureFromThreeServiceReadings()
    {
        // we mock the service because it is not available in SUT
        $service = m::mock('service');
        $service->shouldReceive('readTemp')->times(3)->andReturn(10, 12, 14);

        $temperature = new Temperature($service);

        $this->assertEquals(12, $temperature->average());
    }

}
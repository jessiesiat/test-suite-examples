<?php

/**
 * Mockery is a simple yet flexible PHP mock object framework for use in unit
 * testing with PHPUnit, PHPSpec or any other testing framework. Its core goal is
 * to offer a test double framework with a succint API capable of clearly
 * defining all possible object operations and interactions using a human
 * readable Domain Specific Language (DSL). 
 */
use \Mockery as m;

class SimpleMockTest extends PHPUnit_Framework_TestCase
{
    public function testSimpleMock() 
    {
        $mock = m::mock('simplemock');
        $mock->shouldReceive('foo')->with(5, m::any())->once()->andReturn(10);

        $this->assertEquals(10, $mock->foo(5, 2));
    }

    public function testSingleStatementMock()
    {
    	$mock = m::mock('foo')->shouldReceive('foo')->andReturn(1)->getMock();

    	$this->assertEquals(1, $mock->foo());
    }

    public function testMockWithSequenceValues()
    {
        $mock = m::mock(array('pi' => 3.1416, 'e' => 2.71));

        $this->assertEquals(3.1416, $mock->pi());
        $this->assertEquals(2.71, $mock->e());
    }

    public function testUndefinedValues()
    {
        $mock = m::mock('mymock');

        $mock->shouldReceive('divideBy')->with(0)->andReturnUndefined();

        $this->assertTrue($mock->divideBy(0) instanceof \Mockery\Undefined);
    }

    public function testDbAdapterQuery()
    {
        $mock = m::mock('db');
        $mock->shouldReceive('query')->andReturn(1, 2, 3);
        $mock->shouldReceive('update')->with(5)->andReturn(null)->once();

        $this->assertTrue(in_array($mock->query(), [1, 2, 3]));
        $this->assertEmpty($mock->update(5));
    }

    public function testQueryAndUpdateOrder()
    {
        $mock = m::mock('db');
        $mock->shouldReceive('query')->andReturn(1, 2, 3)->ordered();
        $mock->shouldReceive('update')->andReturn(null)->once()->ordered();

        // call query first before update
        $this->assertTrue(in_array($mock->query(), [1, 2, 3]));
        $this->assertEmpty($mock->update());
    }

    protected function tearDown() {
        m::close();
    }
}
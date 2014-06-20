<?php

class ExceptionTest extends PHPUnit_Framework_TestCase {

	/**
     * @expectedException 			InvalidArgumentException
     * @expectedExceptionMessage 	Some Message
     * @expectedExceptionCode 		10
     */
    public function testException()
    {
        throw new InvalidArgumentException('Some Message', 10);
    }

}
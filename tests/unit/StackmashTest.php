<?php

class StackmashTest extends \PHPUnit\Framework\TestCase
{
	/**
	 * Test that we get a StackmashProject object when using getProject
	 */
	public function testGetProject()
	{
		$project = \Stackmash\Stackmash::getProject('public_key', 'private_key', []);

		$this->assertInstanceOf(\Stackmash\StackmashProject::class, $project);
	}
}
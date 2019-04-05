<?php

class ResponseTest extends \PHPUnit\Framework\TestCase
{
	protected $publicKey;

	protected $privateKey;

	protected function setUp()
	{
		$this->publicKey = getenv('PUBLIC_KEY');
		$this->privateKey = getenv('PRIVATE_KEY');
	}

	/**
	 * Test 401 on incorrect project keys
	 */
	public function testNotificationPostWithIncorrectKeys()
	{
		// Create a project instance with incorrect project keys
		$project = new \Stackmash\StackmashProject('yCYRfaZDwCeF9s2uUnuvJTfBx2J8GyEbGSa7', '4fiE9Jj6wGjlMCokTjenxbCuKxAhTQHjZctt6Jf1rDxMbgvjOhDiKU6rd2DL', []);

		$response = $project->action('tests', 'Test notification', ['Test body']);

		// Incorrect keys will result in a 401
		$this->assertEquals($response['code'], 401);
	}

	/**
	 * Test 404 on incorrect category ID
	 */
	public function testNotificationPostWithIncorrectCategory()
	{
		// Create a project instance with incorrect category ID
		$project = new \Stackmash\StackmashProject($this->publicKey, $this->privateKey, []);

		$response = $project->action('incorrect-category', 'Test notification', ['Test body']);

		// Incorrect category ID will result in a 404
		$this->assertEquals($response['code'], 404);
	}

	/**
	 * Test 422 on validation errors
	 */
	public function testNotificationPostWithInvalidData()
	{
		// Create a project instance with project keys that are too short
		$project = new \Stackmash\StackmashProject('aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'a', []);

		$response = $project->action('category', 'Test notification', ['Test body']);

		// Validation errors will result in a 422
		$this->assertEquals($response['code'], 422);
	}
}
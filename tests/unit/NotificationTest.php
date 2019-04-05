<?php

class NotificationTest extends \PHPUnit\Framework\TestCase
{
	protected $publicKey;

	protected $privateKey;

	protected function setUp()
	{
		$this->publicKey = getenv('PUBLIC_KEY');
		$this->privateKey = getenv('PRIVATE_KEY');
	}

	/**
	 * Test that the notification model constructor sets the correct properties
	 */
	public function testConstructorSetsCorrectProperties()
	{
		$notification = '{
			"project_id": "project_id",
			"category_id": "category_id",
			"title": "title",
			"body": "body",
			"browser": "browser",
			"os": "os",
			"ip": "ip",
			"id": "id",
			"updated_at": "updated_at",
			"created_at": "created_at"
		}';

		$notification = new \Stackmash\Models\StackmashNotification(json_decode($notification));

		$this->assertEquals($notification->project_id, 'project_id');
		$this->assertEquals($notification->category_id, 'category_id');
		$this->assertEquals($notification->title, 'title');
		$this->assertEquals($notification->body, 'body');
		$this->assertEquals($notification->browser, 'browser');
		$this->assertEquals($notification->os, 'os');
		$this->assertEquals($notification->ip, 'ip');
		$this->assertEquals($notification->id, 'id');
		$this->assertEquals($notification->updated_at, 'updated_at');
		$this->assertEquals($notification->created_at, 'created_at');
	}

	/**
	 * Test notifications can be sent to the Stackmash servers
	 */
	public function testNotificationPostIsSuccessful()
	{
		$project = new \Stackmash\StackmashProject($this->publicKey, $this->privateKey, []);

		$response = $project->action('tests', 'Test notification', ['Test body']);

		$this->assertInstanceOf(\Stackmash\Models\StackmashNotification::class, $response);
	}
}
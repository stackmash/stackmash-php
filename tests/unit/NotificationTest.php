<?php

class NotificationTest extends \PHPUnit\Framework\TestCase
{
	public function setUp()
	{
		
	}

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

		$notification = new \Stackmash\Models\Notification(json_decode($notification));

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
}
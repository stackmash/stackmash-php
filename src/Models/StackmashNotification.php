<?php

namespace Stackmash\Models;

/**
 * Class StackmashNotification
 *
 * @package Stackmash
 */
class StackmashNotification
{
	public $id;

	public $project_id;

	public $category_id;

	public $title;

	public $body;

	public $browser;

	public $os;

	public $ip;

	public $created_at;

	public $updated_at;

	public function __construct($object)
	{
		$this->id = $object->id;
		$this->project_id = $object->project_id;
		$this->category_id = $object->category_id;
		$this->title = $object->title;
		$this->body = $object->body;
		$this->browser = $object->browser;
		$this->os = $object->os;
		$this->ip = $object->ip;
		$this->created_at = $object->created_at;
		$this->updated_at = $object->updated_at;
	}
}
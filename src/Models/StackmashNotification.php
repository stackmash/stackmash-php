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
		if(property_exists($object, 'id'))
			$this->id = $object->id;

		if(property_exists($object, 'project_id'))
			$this->project_id = $object->project_id;

		if(property_exists($object, 'category_id'))
			$this->category_id = $object->category_id;

		if(property_exists($object, 'title'))
			$this->title = $object->title;

		if(property_exists($object, 'body'))
			$this->body = $object->body;

		if(property_exists($object, 'browser'))
			$this->browser = $object->browser;

		if(property_exists($object, 'os'))
			$this->os = $object->os;

		if(property_exists($object, 'ip'))
			$this->ip = $object->ip;

		if(property_exists($object, 'created_at'))
			$this->created_at = $object->created_at;

		if(property_exists($object, 'updated_at'))
			$this->updated_at = $object->updated_at;
	}
}
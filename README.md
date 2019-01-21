# PHP library for Stackmash
[![Build Status](https://travis-ci.org/stackmash/stackmash-php.svg?branch=master)](https://travis-ci.org/stackmash/stackmash-php)

Stackmash - User monitoring notifications and logs. Stackmash gives you real-time notifications for any activity on your website or app, such as user sign-ups, payments, orders, errors, contact requests and more.

### Requirements
* PHP 5.4 and later
* The cURL extension enabled within PHP
* The JSON extension enabled within PHP

### Install with Composer

Add stackmash/stackmash-php as a dependency. You can either install using the command:

```bash
composer require stackmash/stackmash-php
```

Or, add to your composer.json file:

```json
"require": {
    ...
    "stackmash/stackmash-php" : "1.*"
    ...
}
```

and run

```bash
composer update
```

### Start using Stackmash

Get your project and create actions for that project.

```php
<?php
// Import dependencies
require 'vendor/autoload.php';

use Stackmash\Stackmash;

// Get the project you wish to create actions for
$project = Stackmash::getProject("PUBLIC_KEY", "PRIVATE_KEY");

// Create an action
$project->action("category-id-name", "New user signed up", [
    "Email address" => "john.doe@gmail.com",
    "Name" => "John Doe",
    "Date of birth" => "19/03/1986",
    "Interests" => [
        "Rocket building", "Football", "Programming"
    ]
]);
```

### Install Manually

1. <a href="https://github.com/stackmash/stackmash-php/archive/master.zip">Download Stackmash</a>.
2. Extract the ZIP file to a directory called "stackmash-php" in your project root.
3. Import the Stackmash library.

### Documentation

<a href="https://stackmash.com/docs/examples#php" target="_blank">PHP documentation</a>
For support, email <a href="mailto:support@stackmash.com">support@stackmash.com</a> or visit <a href="https://stackmash.com/support">https://stackmash.com/support</a>.

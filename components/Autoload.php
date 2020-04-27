<?php
/**
 * Component autoload
 */

function __autoload($className)
{
	# List of all class directories
	$arrayPath = array(
		'/components/',
		'/models/',
		'/controllers/'
	);

	foreach ($arrayPath as $path) {
		$path = ROOTPATH . $path . $className . '.php';
		if (is_file($path)) {
			include_once $path;
		}
	}
}
<?php
/**
 * Created by PhpStorm.
 * User: valeriishinkar
 * Date: 11/20/18
 * Time: 11:05
 */

require_once(dirname(__FILE__).'/namespace.php');

// register autoloader
$autoloader = new NamespaceAutoloader();
$autoloader->addNamespace('ValeriyShinkar', __DIR__ . '/..');
$autoloader->register();
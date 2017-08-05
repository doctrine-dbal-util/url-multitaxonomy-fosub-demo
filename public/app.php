<?php

// use Composer\Autoload\ClassLoader;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Symfony\Component\HttpFoundation\Request;

chdir('..'); // TODO check if (partially) avoidable and benefits.

/** @var \Composer\Autoload\ClassLoader $loader */
$loader = require 'vendor/autoload.php';
// $loader = require __DIR__.'/../vendor/autoload.php';
if (PHP_VERSION_ID < 70000):
    include_once 'bootstrap.php.cache'; // TODO: Check what happens if a "var" directory exists.
    // include_once __DIR__.'/../var/bootstrap.php.cache';
endif;
AnnotationRegistry::registerLoader([$loader, 'loadClass']);

$kernel = new AppKernel('prod', false);
if (PHP_VERSION_ID < 70000):
    $kernel->loadClassCache();
endif;
$kernel = new AppCache($kernel);

// When using the HttpCache, you need to call the method in your front controller instead of relying on the configuration parameter
Request::enableHttpMethodParameterOverride();
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);

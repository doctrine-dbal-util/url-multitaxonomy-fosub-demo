<?php

// use Composer\Autoload\ClassLoader;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Debug\Debug;


// If you don't want to setup permissions the proper way, just uncomment the following PHP line
// read http://symfony.com/doc/current/setup.html#checking-symfony-application-configuration-and-setup
// for more information
//umask(0000);

// This check prevents access to debug front controllers that are deployed by accident to production servers.
// Feel free to remove this, extend it, or make something more sophisticated.
if (isset($_SERVER['HTTP_CLIENT_IP'])
    || isset($_SERVER['HTTP_X_FORWARDED_FOR'])
    || !(in_array(@$_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1']) || PHP_SAPI === 'cli-server')
) {
    header('HTTP/1.0 403 Forbidden');
    exit('You are not allowed to access this file. Check '.basename(__FILE__).' for more information.');
}

chdir('..') ; // TODO: is this needed and why? -- to find autoload, kernel.root_dir and config file

/** @var \Composer\Autoload\ClassLoader $loader */
$loader = require 'vendor/autoload.php';
// $loader = require __DIR__.'/../vendor/autoload.php';
// require __DIR__.'/../app/u008f_CRUD_FOSUser_DBAL.php';
AnnotationRegistry::registerLoader([$loader, 'loadClass']);
Debug::enable();

// $kernel = new App\MicroKernel('dev', true);
$kernel = new AppKernel('dev', true);
if (PHP_VERSION_ID < 70000) {
    $kernel->loadClassCache();
}
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);

<?php

// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/..'));

// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'development'));

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH),
    get_include_path(),
)));

/** Zend_Application */
require_once 'Zend/Application.php';

// Create application, bootstrap, and run
$application = new Zend_Application(
    APPLICATION_ENV,
    APPLICATION_PATH . '/configs/application.ini'
);
$resourceAutoloader = new Zend_Loader_Autoloader_Resource( array(
    'basePath'  => APPLICATION_PATH,
    'namespace' => 'Aospace',
));
$resourceAutoloader->addResourceType('form', 'forms/', 'Form');

$application->bootstrap()
            ->setAutoloaderNamespaces(array('Library', 'Aospace'))
            ->run();

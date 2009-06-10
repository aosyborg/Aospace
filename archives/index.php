<?php

/**
 * Zend Framework & custom library loaders, keeps code cleaner
 */
require_once 'Zend/Loader.php';
require_once 'Autoloader.php';
Zend_Loader::registerAutoload('Library_Autoloader');

/**
 * Get the front controller instance
 */
$front = Zend_Controller_Front::getInstance();
$front->setControllerDirectory('controllers');

/**
 * Site layout
 */
Zend_Layout::startMvc('layouts/');

/**
 * Site config
 */
$config = new Zend_Config_Ini('../../webappconfig.ini', 'aospace');
$front->throwExceptions($config->development);

/**
 * Dispatch
 */
$front->dispatch();

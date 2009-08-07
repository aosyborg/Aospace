<?php

/**
 * Zend Framework & custom library loaders, keeps code cleaner
 */
require_once 'Zend/Loader.php';
require_once 'Autoloader.php';
Zend_Loader::registerAutoload('Library_Autoloader');

/**
 * Site layout
 */
Zend_Layout::startMvc('/var/www/aospace.com/layouts/');

/**
 * Site config
 */
$config = new Zend_Config_Ini('/var/www/aospace.com/config.ini', 'aospace');

/**
 * Get the front controller
 */
$front = Zend_Controller_Front::getInstance();
$front->throwExceptions($config->isDevelopment);
$front->run('/var/www/aospace.com/controllers/');

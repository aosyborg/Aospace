<?php

/**
 * Author: David Symons
 * Home page: http://www.aospace.com
 * Release Date: 11 March 2009
 * License: Licensed under The MIT License. See http://www.opensource.org/licenses/mit-license.php
 *
 * Purpose: This is a wrapper for Zend_Loader of the Zend Framework (http://framework.zend.com/)
 * allowing one to instantiate php classes without includes or requires.
 */

/**
 * @category Library
 */

/**
 * Zend Framework Documentation:
 * Because of semantics of static function references in PHP, you must
 * implement code for both loadClass() and autoload(), and the autoload()
 * must call self::loadClass().
 */
class Library_Autoloader extends Zend_Loader
{
	public static function loadClass($class)
	{
		// Attempt to load ZF file first
		try {
			@parent::loadClass($class, $dirs);
			return;

		// Attempt to load Library file if no banana
		// Path: some/path/to/file.php
		// Class Name: Project_Some_Path_To_File
		} catch (Exception $e) {
			$pos = strpos($class, '_');

			if ($pos === false) {
				if (strpos($class, 'Exception'))
					require_once 'Exceptions.php';
			} else {
				$class = substr($class, $pos + 1);
				$class = strtr($class, '_', '/');
				require_once $class . '.php';
			}
		}
	}

	public static function autoload($class)
	{
		try {
			self::loadClass($class);
			return $class;
		} catch (Exception $e) {
			return false;
		}
	}
}

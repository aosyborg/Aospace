<?php

/**
 * Author:
 * David Symons
 *
 * Purpose:
 * Provide some safe global settings that
 * every controller can use
 */

class Aospace_Controller_Base extends Zend_Controller_Action
{
	protected $config;

	public function preDispatch()
	{
		/**
		 * Load configuration
		 */
		$this->session = new Zend_Session_Namespace('aospace');
		$this->config  = new Zend_Config_Ini('../configs/settings.ini', 'aospace');

		/**
		 * Build custom header
		 */
		$this->view->header = new Library_Header;
		$this->view->header
		           ->setProject("Aospace")
		           ->addLinkTag("rel='stylesheet' type='text/css' href='http://library.aospace.com/css/base.css'")
		           //->addLinkTag("rel='stylesheet' type='text/css' href='http://library.aospace.com/css/library.css'")
		           ->addLinkTag("rel='stylesheet' type='text/css' href='http://aozaki.com/library/css/library.css'")
		           ->addLinkTag("rel='stylesheet' type='text/css' href='/css/base.css'")
		           ->addScriptTag("src='http://library.aospace.com/js/jquery.min.js' type='text/javascript'")
		           ->addScriptTag("src='http://library.aospace.com/js/jquery.curvycorners.min.js' type='text/javascript'")
		           ->addScriptTag("src='/js/main.js' type='text/javascript'");

		/**
		 * Generic container for application notifications
		 */
		$this->view->errors    = new Library_Messagebox('error');
		$this->view->successes = new Library_Messagebox('success');
		$this->view->notices   = new Library_Messagebox('notice');

		// Populate notifications if applicable
		$messenger = $this->_helper->getHelper('FlashMessenger');
		foreach($messenger->getMessages() as $message) {
			$type = key($message);
			$message = current($message);
			switch ($type) {
				case 'error': $this->view->errors->addMessage($message);      break;
				case 'success': $this->view->successes->addMessage($message); break;
				default: $this->view->notices->addMessage($message);          break;
			}
		}
	}

	public function postDispatch()
	{
		/**
		 * Clean up session
		 */
	}
}



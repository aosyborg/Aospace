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
	public function preDispatch()
	{
		/**
		 * Use one template for the entire site
		 */
		$this->_helper->layout->setLayout('base');

		/**
		 * Load configuration
		 */
		$this->config = new Zend_Config_Ini('../../webappconfig.ini', 'aospace');

		/**
		 * Build custom header
		 */
		$this->view->header = new Library_Header;
		$this->view->header
		           ->setProject("Aospace")
		           ->addLinkTag("rel='stylesheet' type='text/css' href='http://library.aospace.com/css/base.css'")
		           ->addLinkTag("rel='stylesheet' type='text/css' href='http://library.aospace.com/css/library.css'")
		           ->addLinkTag("rel='stylesheet' type='text/css' href='/views/css/base.css'")
		           ->addScriptTag("src='http://library.aospace.com/js/jquery.min.js' type='text/javascript'")
		           ->addScriptTag("src='http://library.aospace.com/js/jquery.curvycorners.min.js' type='text/javascript'")
		           ->addScriptTag("src='/views/js/main.js' type='text/javascript'");

		/**
		 * Attempt to handle postback
		 * if $_POST['action'] = submit then the _submitPOST() function
		 * is called. If the function does not exist, pass.
		 */
		if (array_key_exists('action', $_POST)) {
			if (method_exists($this, "_{$_POST['action']}POST")) {
				eval("\$this->_{$_POST['action']}POST();");
			}
		}

		/**
		 * Attempt to handle GET requests
		 * if $_GET['action'] = submit then the _submitGET() function
		 * is called. If the function does not exist, pass.
		 */
		if (array_key_exists('action', $_GET)) {
			if (method_exists($this, "_{$_GET['action']}GET")) {
				eval("\$this->_{$_POST['action']}GET();");
			}
		}
	}
}



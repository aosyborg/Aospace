<?php

require_once 'Base.php';

class CodeController extends Aospace_Controller_Base
{
	public function indexAction()
	{
		$this->view->header->setTitle('About')
		                   ->addLinkTag('rel="stylesheet" type="text/css" href="/css/code.css"');
	}
}

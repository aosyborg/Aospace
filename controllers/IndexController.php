<?php

require_once 'Base.php';

class IndexController extends Aospace_Controller_Base
{
	public function indexAction()
	{
		$this->view->header->setTitle('Home')
		                   ->addLinkTag('rel="stylesheet" type="text/css" href="/views/css/home.css"');
	}

}

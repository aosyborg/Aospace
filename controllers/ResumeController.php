<?php

require_once 'Base.php';

class ResumeController extends Aospace_Controller_Base
{
	public function indexAction()
	{
		$this->view->header->setTitle('About')
		                   ->addLinkTag('rel="stylesheet" type="text/css" href="/css/resume.css"');
	}
}

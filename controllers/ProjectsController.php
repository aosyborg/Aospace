<?php

require_once 'Base.php';

class ProjectsController extends Aospace_Controller_Base
{
	public function indexAction()
	{
		$this->view->header->setTitle('Projects')
		                   ->addLinkTag('rel="stylesheet" type="text/css" href="/css/projects.css"');
	}

	public function downloadAction()
	{
		$request = $this->getRequest()->getParam('code');

		if (is_null($request)) {
			$this->_redirect('projects');
			exit;
		}

		$transfer = new Library_Sendfile;
		switch ($request) {
			case 'db': $transfer->sendFile(APPLICATION_PATH . '/views/scripts/projects/code/Db.php',
				                           'text/php');
				exit;
		}
		$this->_redirect('projects');
		exit;
	}
}

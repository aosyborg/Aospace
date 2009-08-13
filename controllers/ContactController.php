<?php

require_once 'Base.php';

class ContactController extends Aospace_Controller_Base
{
	public function indexAction()
	{
		$this->view->header->setTitle('Contact')
		                   ->addLinkTag('rel="stylesheet" type="text/css" href="/css/contact.css"');

		$this->view->form = Aospace_Form_Contact::registerForm();
	}

	public function submitAction()
	{
	}
}

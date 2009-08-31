<?php

require_once 'Base.php';

class ContactController extends Aospace_Controller_Base
{
	public function indexAction()
	{
		$this->view->header->setTitle('Contact')
		                   ->addLinkTag('rel="stylesheet" type="text/css" href="/css/contact.css"');

		$this->view->form = new Aospace_Form_Contact;
		if (!is_null($this->session->form)) {
			$this->view->form = $this->session->form;
			unset($this->session->form);
		}
	}

	public function submitAction()
	{
		$form = new Aospace_Form_Contact;
		if (!$form->isValid($_POST)) {
			$messages = $form->process();
			foreach ($messages as $message) {
				$this->_helper->flashMessenger->addMessage($message);
			}
			$this->session->form = $form;
			$this->_redirect('contact');
		}

		/**
		 * Send it away space cowboy
		 */
		$message = array('success' => 'Thank you for submitting feedback!');
		if (!$form->submit($this->config->admin->email))
			$message = array('error' => 'There was an error submiting the form, please try again in a few mintues');

		$this->_helper->flashMessenger->addMessage($message);
		$this->_redirect('contact');
	}
}

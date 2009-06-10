<?php

require_once 'Base.php';

class IndexController extends Aospace_Controller_Base
{
	public function indexAction()
	{
	}

	public function aboutAction()
	{
	}

	public function codeAction()
	{
	}

	public function sitestatusAction()
	{
		$this->view->sites = Aospace_Sites::fetch(Aospace_Sites::ALL);
	}

	public function contactAction()
	{
	}

	protected function _contactPOST()
	{
		if (!array_key_exists('name', $_POST) ||
		    !array_key_exists('email', $_POST) ||
		    !array_key_exists('comments', $_POST)) {
			$_SESSION['error'] = "Invalid form submitted";
			return;
		}

		if ($_POST['name'] == '' || $_POST['email'] == '' || $_POST['comments'] == '') {
			$_SESSION['error'] = "Please fill out all fields";
			return;
		}

		$to = "symons@aospace.com";
		$subject = "Mail from Aospace";
		$headers = ("reply-to: {$_POST['email']}\n");
		$message = "
Name: {$_POST['name']}
Comments: {$_POST['comments']}";

		// Send the message!
		$success = mail($to, $subject, $message, $headers);

		if ($success)
			$_SESSION['success'] = "mail successfully delivered";
		else
			$_SESSION['error'] = "problem mailing";
	}
}

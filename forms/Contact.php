<?php

class Aospace_Form_Contact extends Zend_Form
{
	public $form;

	public function __construct($options=array())
	{
		parent::__construct($options);

		$token = new Zend_Form_Element_Hash('token');
		$token->setSalt(md5(uniqid(rand(), TRUE)));

		/**
		 * Create the form
		 */
		$this->setAction('/contact/submit')
		     ->setMethod('post')
		     ->addElement($token)
		     ->addElement('text', 'name', array('label'    => 'Name',
		                                        'required' => 'true'))
		     ->addElement('text', 'email', array('label'    => 'Email',
		                                         'required' => 'true',
		                                         'removeDecorator' => 'Error',
		                                         'filter'   => 'StringToLower'))
		     ->addElement('textarea', 'comments', array('label'    => 'Comments',
		                                                'required' => 'true',
		                                                'rows' => '6',
		                                                'cols' => '40'))
		     ->addElement('submit', 'Submit');

		//Remove decorators
		$this->getElement('token')->removeDecorator('Errors');
		$this->getElement('name')->removeDecorator('Errors');
		$this->getElement('email')->removeDecorator('Errors');
		$this->getElement('comments')->removeDecorator('Errors');

		return $this;
	}

	public function process() {
		$errors = $this->getMessages();
		$messages = array();

		if (array_key_exists('token', $errors)) {
			$messages[] = array('error' => 'Error submitting form. Please try again');
			return $this;
		}
		if (array_key_exists('name', $errors))
			$messages[] = array('error' => 'You must include your name');
		if (array_key_exists('email', $errors))
			$messages[] = array('error' => 'You must include your email');
		if (array_key_exists('comments', $errors))
			$messages[] = array('error' => 'Please include some comments');

		return $messages;
	}

	public function submit($to) {
		$data = $this->getValues();

		$subject = 'Email from Aospace!';
		$message = <<<MESSAGE
You have mail from your site:

Name: {$data['name']}
Email: {$data['email']}
Comments:
{$data['comments']}

MESSAGE;
		return mb_send_mail($to, $subject, $message);
	}
}

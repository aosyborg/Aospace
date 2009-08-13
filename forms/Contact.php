<?php

class Aospace_Form_Contact extends Zend_Dojo_Form
{
	public static function registerForm()
	{
		/**
		 * Create the form
		 */
		$form = new Zend_Form;
		$form->setAction('/contact/submit')
		     ->setMethod('post')
		     ->addElement('text', 'name', array('label'    => 'Name',
		                                        'required' => 'true'))
		     ->addElement('text', 'email', array('label'    => 'Email',
		                                         'required' => 'true',
		                                         'filter'   => 'StringToLower'))
		     ->addElement('textarea', 'comments', array('label'    => 'Comments',
		                                                'required' => 'true',
		                                                'rows' => '6',
		                                                'cols' => '40'))
		     ->addElement('submit', 'Submit');

		return $form;
	}
}

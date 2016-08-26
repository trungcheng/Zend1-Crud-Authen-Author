<?php

class Form_Loginform extends Zend_Form {

	public function init(){
		$this->setMethod('post');
	}

	public function __construct($option = null){
		parent::__construct($option);

		$this->setName('login');

		$username = new Zend_Form_Element_Text('username');
		$username->setLabel('Username : ')
		         ->setRequired(true);

		$password = new Zend_Form_Element_Password('password');
		$password->setLabel('Password : ')
		         ->setRequired(true);

		$login = new Zend_Form_Element_Submit('login');
		$login->setLabel('Login');

		$this->addElements(array($username,$password,$login));
		$this->setAction(Zend_Controller_Front::getInstance()->getBaseUrl().'/authentication/login');
	}
}

?>
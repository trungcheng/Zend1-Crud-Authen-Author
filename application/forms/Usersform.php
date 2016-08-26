<?php


	class Form_Usersform extends Zend_Form
		{
		 public function init()
		 {

			 $id = new Zend_Form_Element_Hidden('id');

			 $name = new Zend_Form_Element_Text('name');
			 $name->setLabel('Name: ')
			 ->setRequired(true)
			 ->addValidator('NotEmpty');

			 $email = new Zend_Form_Element_Text('email');
			 $email->setLabel('Email: ')
			 ->setRequired(true)
			 ->addValidator('NotEmpty');

			 $address = new Zend_Form_Element_Text('address');
			 $address->setLabel('Address : ')
			 ->setRequired(true)
			 ->addValidator('NotEmpty');

			 $mobile = new Zend_Form_Element_Text('mobile');
			 $mobile->setLabel('Mobile phone : ')
			 ->setRequired(true)
			 // ->addFilter('StripTags')
			 // ->addFilter('StringTrim')
			 ->addValidator('NotEmpty');

			 $submit = new Zend_Form_Element_Submit('submit');
			 $submit->setAttrib('id', 'submitbutton');
			 $submit->setLabel('Add now');
			 $this->addElements(array($name, $email, $address, $mobile, $submit));
		 }
	}
	?>
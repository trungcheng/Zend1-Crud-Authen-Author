<?php

class Model_DbTable_Users extends Zend_Db_Table_Abstract

{
	protected $_name = 'users';

	protected $_primary ='id';
	function add($name,$email,$address,$mobile)

	{

		$formdata=array(

			'name'=>$name,

			'email'=>$email,

			'address'=>$address,

			'mobile'=>$mobile,

		);

		$this->insert($formdata);

	}

}

?>
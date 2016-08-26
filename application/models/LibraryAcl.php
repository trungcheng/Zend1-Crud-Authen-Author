<?php
class Model_LibraryAcl extends Zend_Acl {

	public function __construct()
    {
        $this->add(new Zend_Acl_Resource('error'));
        $this->add(new Zend_Acl_Resource('index'));

        $this->add(new Zend_Acl_Resource('authentication'));
        $this->add(new Zend_Acl_Resource('login'),   'authentication');
        $this->add(new Zend_Acl_Resource('logout'),  'authentication');

        $this->add(new Zend_Acl_Resource('users'));
        $this->add(new Zend_Acl_Resource('edit'), 'users');
        $this->add(new Zend_Acl_Resource('add'), 'users');

        $this->addRole(new Zend_Acl_Role('user'));
        $this->addRole(new Zend_Acl_Role('admin'), 'user');

        $this->allow('user','index','index');
        $this->deny('user','users',array('edit','delete','add'));
        $this->allow('user','authentication',array('login','logout'));
        $this->allow('user','users','index');
        $this->allow('admin','users',array('index','add','edit','remove'));
        $this->allow('admin','authentication',array('login','logout'));

    }

}
?>
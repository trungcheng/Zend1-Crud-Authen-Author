<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap{
   	protected function _initAutoload(){
    	$modelLoader = new Zend_Application_Module_Autoloader(array(
    		'namespace' => '',
    		'basePath' => APPLICATION_PATH));

        $acl = new Model_LibraryAcl;
        $auth = Zend_Auth::getInstance();

    	$fc = Zend_Controller_Front::getInstance();
    	$fc->registerPlugin(new Plugin_AccessCheck($acl,$auth));

      return $modelLoader;
    }

}

?>

 


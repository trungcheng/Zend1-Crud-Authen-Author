<?php
class Plugin_AccessCheck extends Zend_Controller_Plugin_Abstract {

	private $_acl = null;
    private $_auth = null;

    public function __construct(Zend_Acl $acl, Zend_Auth $auth){
        $this->_acl = $acl;
        $this->_auth = $auth;
    }

    public function preDispatch(Zend_Controller_Request_Abstract $request){
        // $resource = $request->getControllerName();
        // $action = $request->getActionName();

        // $identity = $this->_auth->getStorage()->read();
        // $role = $identity->role;

        // if(!$this->_acl->isAllowed($role,$resource,$action)){
        //     $request->setControllerName('authentication')
        //             ->setActionName('login');
        // }


        $resource = $request->getControllerName();
        $action = $request->getActionName();

        $role = 'user';

        if(Zend_Auth::getInstance()->hasIdentity())
        {
            if($request->getControllerName() == 'error')  return ;
            $role = Zend_Auth::getInstance()->getIdentity()->role;
        }

        if(!$this->_acl->isAllowed($role, $resource, $action)){
            $request->setControllerName('authentication')
                    ->setActionName('login');
        }
    }
}
?>
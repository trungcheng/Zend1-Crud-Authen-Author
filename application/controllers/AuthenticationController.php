<?php

require_once('Zend/Loader/Autoloader.php');
$loader = Zend_Loader_Autoloader::getInstance();

class AuthenticationController extends Zend_Controller_Action
{

    public function init()
    {
        parent::init();
    }

    public function indexAction()
    {
        // action body
    }

    public function loginAction()
    {

        if(Zend_Auth::getInstance()->hasIdentity()){
            $this->_redirect('index/index');
        }

        $request = $this->getRequest();
        $form = new Form_Loginform();
            
        if($request->isPost()){
            if($form->isValid($this->_request->getPost())){

                $authAdapter = $this->getAuthAdapter();
                    
                $username = $form->getValue('username');
                $password = $form->getValue('password');

                // $client = new Zend_Http_Client('http://localhost:3000/api/authenticate');
                // $client->setParameterPost(array(
                //     'name' => $username,
                //     'password' => $password,
                    
                // ));
                // $result = $client->request(Zend_Http_Client::POST);
                // $data = Zend_Json::decode($result->getBody());

                
                // if($username == $data['name'] && $password == $data['password']){
                //     $token = $data['token'];
                //     $session = new Zend_Session_Namespace('access_token');
                //     $session->token = $token;
                //     $session->username = $username;
                //     $session->setExpirationSeconds( 60);

                //     $this->_redirect('users/index');

                // }else{
                //     $this->_redirect('index/index');
                // }

                $authAdapter->setIdentity($username)
                            ->setCredential($password);

                $auth = Zend_Auth::getInstance();
                $result = $auth->authenticate($authAdapter);

                if($result->isValid()){
                    $identity = $authAdapter->getResultRowObject();
                    $this->_helper->FlashMessenger('Successful Login');
                    $authStorage = $auth->getStorage();
                    $authStorage->write($identity);

                    $this->_redirect('index/index');
                }else{
                    $this->view->errorMessage = 'Username or password is wrong !';
                }
            }
        }
        $this->view->form = $form;
    }

    public function logoutAction()
    {
        Zend_Auth::getInstance()->clearIdentity();
        $this->_redirect('index/index');
        // $session = new Zend_Session_Namespace('access_token');
        // $session->unsetAll();
        // $this->_redirect('index/index');
    }

    private function getAuthAdapter(){
        $authAdapter = new Zend_Auth_Adapter_DbTable(Zend_Db_Table::getDefaultAdapter());
        $authAdapter->setTableName('user')
                    ->setIdentityColumn('username')
                    ->setCredentialColumn('password');

        return $authAdapter;
    }
}






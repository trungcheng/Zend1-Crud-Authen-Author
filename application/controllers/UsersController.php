<?php

class UsersController extends Zend_Controller_Action
{

    public function init()
    {
        
    }

    public function indexAction()
    {
        $listUser = new Model_DbTable_Users();
		$this->view->allUsers = $listUser->fetchAll();
		
		//send token
		// $session = new Zend_Session_Namespace('access_token');
		// $token = $session->token;
		
		// if(isset($token)){
		// 	$client = new Zend_Http_Client();
		// 	// $client->setRawData($rawData);
		// 	$client->setUri('http://localhost:3000/api/products');
		// 	$data = $client->request(Zend_Http_Client::GET);
		// 	$listUser = Zend_Json::decode($data->getBody());
		// 	// echo "<pre>";
		// 	// 	print_r($listUser);die;
		// 	// echo "</pre>";
		// 	$this->view->allUsers = $listUser;
		// }else{
		// 	$this->_redirect('authentication/login');
		// }
    }

    public function addAction()
	{
		 $this->view->title = "Add New User";
		 $form = new Form_Usersform();
		 $this->view->form = $form;

		 if ($this->_request->isPost()) {
		 // 	$formData = $this->_request->getPost();
			// if ($form->isValid($formData)) {

			// 	$title = $form->getValue('title');
   //          	$description = $form->getValue('description');

			// 	$session = new Zend_Session_Namespace('access_token');
			// 	$token = $session->token;
				
			// 	if(isset($token)){
			// 		$client = new Zend_Http_Client();
			// 		// $client->setRawData($rawData);
			// 		$client->setUri('http://localhost:3000/api/products');
			// 		$client->setParameterPost(array(
		 //                'title' => $title,
		 //                'description' => $description
		 //            ));
			// 		$data = $client->request(Zend_Http_Client::POST);
			// 		$result = Zend_Json::decode($data->getBody());
			// 		$this->_redirect('users/index');

			// 	}else{
			// 		$this->_redirect('authentication/login');
			// 	}
			// }else {
		 // 		$form->populate($formData);
		 // 	}
			
			 $formData = $this->_request->getPost();
			 if ($form->isValid($formData)) {
				 $users = new Model_DbTable_Users();
				 $row = $users->createRow();
				 $row->name = $form->getValue('name');
				 $row->email = $form->getValue('email');
				 $row->address = $form->getValue('address');
				 $row->mobile = $form->getValue('mobile');

				 if($row->save()){
				 	echo "Add thành công ! Chúc mừng";
				 	$this->_redirect('users/index');
				 }
				 else{
				 	echo "Add ko thành ! Rất tiếc";
				 }
				 
			 }else {
			 	$form->populate($formData);
			 }
		}
	}

	public function editAction()
	{

		$this->view->title = "Edit User";

		 $form = new Form_Usersform();
		 $form->submit->setLabel('Update');
		 $this->view->form = $form;

		 if ($this->_request->isPost()) {
			 $formData = $this->_request->getPost();
			 if ($form->isValid($formData)) {
				 $users = new Model_DbTable_Users();
				 $id=$this->_getParam('id',0);
				 $id = (int)$id;
				 // var_dump($id);die;
				 $row = $users->fetchRow('id='.$id);
				 $row->name = $form->getValue('name');
				 $row->email = $form->getValue('email');
				 $row->address = $form->getValue('address');
				 $row->mobile = $form->getValue('mobile');

				 if($row->save()){
				 	echo "Edit thành công ! Chúc mừng";
				 	$this->_redirect('users/index');
				 }
				 else{
				 	echo "Edit ko thành ! Rất tiếc";
				 }
			 }else {
			 	$form->populate($formData);
			 }
		 }
		 else{
		 		$id = (int)$this->_request->getParam('id', 0);
				 if ($id > 0) {
				 $users = new Model_DbTable_Users();
				 $user = $users->fetchRow('id='.$id);
				 $form->populate($user->toArray());
				 } 	
		 }
	}

	public function removeAction(){
		$id=$this->_getParam('id',0);
		$users_table=new Model_DbTable_Users();
		$users_table->delete("id=$id");
		$this->_redirect('users/index');
	}
}



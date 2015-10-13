<?php

class UsersController extends AppController {

	public $uses = array('User');

	public $paginate = array(
        'limit' => 25,
        'conditions' => array('status' => '1'),
    	'order' => array('User.email' => 'asc' ) 
    );
	
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('login','register', 'registerThankYou'); 
    }
	


	public function login() {
		
		//if already logged-in, redirect
		if($this->Session->check('Auth.User')){
			$this->redirect(array('action' => 'index'));		
		}
		
		// if we get the post information, try to authenticate
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {					
				$user_id = $this->Auth->user('id');
				$this->User->updateLastLoginTime($user_id, date('Y-m-d H:i:s'));
				$this->redirect($this->Auth->redirectUrl());
			} else {
				$this->Session->setFlash(__('Invalid email or password, please try again.'));
			}
		} 
	}

	public function logout() {
		$this->redirect($this->Auth->logout());
	}

    public function index() {
		$this->paginate = array(
			'limit' => 6,
			'order' => array('User.email' => 'asc' )
		);
		$users = $this->paginate('User');
		$this->set(compact('users'));
    }

    public function register() {
        if ($this->request->is('post')) {			
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				// $this->Session->setFlash(__('You are now registered, please login now'));
				$this->redirect(array('action' => 'registerthankyou'));
			} else {
				$this->Session->setFlash(__('Error: The user could not be created. Please, try again.'));
			}	
        }
    }

    public function registerThankYou() {
    	$this->set('message', 'Thank you for registering!');
    }

    public function profile($id = null) {
    	$this->set('user', $this->User->findById($id));
    }

    public function editProfile($id = null) {
    	 if (!$id) {
	        throw new NotFoundException(__('User is not valid!'));
	    }

	    $user = $this->User->findById($id);
	    if (!$user) {
	        throw new NotFoundException(__('User is not valid!'));
	    }

	    if ($this->request->is('post') || $this->request->is('put')) {
	        $this->User->id = $id;
	        if ($this->Post->save($this->request->data)) {
	            $this->Session->setFlash(__('Your profile has been updated.'));
	            return $this->redirect(array('action' => 'viewprofile', $id));
	        }
	        $this->Session->setFlash(__('Unable to update your profile.'));
	    }

	    if (!$this->request->data) {
	        $this->request->data = $user;
	    }
    }
}
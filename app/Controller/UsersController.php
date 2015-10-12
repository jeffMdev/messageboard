<?php

App::uses('AppController', 'Controller');

class UsersController extends AppController {

	public function beforeFilter() {
	    parent::beforeFilter();
	    $this->Auth->allow('register', 'logout');
	}

	public function index() {

	}

	public function login() {
		if ($this->request->is('post')) {
	        if ($this->Auth->login()) {
	            return $this->redirect($this->Auth->redirectUrl());
	        }
	        $this->Flash->error(__('Invalid email or password, please try again.'));
	    }
	}

	public function register() {
		return $this->redirect($this->Auth->logout());
	}
}

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
		if ($this->request->is(array('post'))) {
	        if ($this->Auth->login()) {
	            return $this->redirect($this->Auth->redirectUrl());
	        }
	        $this->Flash->error('Invalid email or password, please try again.');
	    }
	}

	public function logout() {
		return $this->redirect($this->Auth->logout());
	}

	public function register() {

	}
}

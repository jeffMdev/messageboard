<h2>Login</h2>
<?php 
	echo $this->Flash->render('auth');
	echo $this->form->create('login');
	echo $this->form->input('email');
	echo $this->form->input('password');
	echo $this->form->end('Login');
	echo $this->html->link('Register', array('action'=> 'register'));
?>
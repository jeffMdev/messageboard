<h2>Login</h2>
<?php 

	echo $this->form->create('login');
	echo $this->form->input('email');
	echo $this->form->input('password');
	echo $this->form->end('Login');
?>
<h2>Registration</h2>
<?php 
	echo $this->form->create('register');
	echo $this->form->input('name');
	echo $this->form->input('email');
	echo $this->form->input('password');	
	echo $this->form->input('cpassword', array('type'=>'password'));
	echo $this->form->end('Register');
?>
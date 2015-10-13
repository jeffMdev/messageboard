<div class="row">
        <h1 class="page-header">Login</h1>
</div>
<div class="row">
	<!-- <?php echo $this->Session->flash('auth'); ?> -->
</div>
<div class="row">
	<div class="form-group">
	<?php 
		echo $this->Form->create('User');
		echo $this->Form->input('email', array('class' => 'form-control input-sm'));
		echo $this->Form->input('password', array('class' => 'form-control input-sm'));
	?>
	<div class="btn-group">
        <div class="btn">
        <?php 
        echo $this->Form->submit('Login', array('class' => 'form-submit btn btn-success',  'title' => 'Click here to add the user') ); 
        ?>
        </div>
        <?php 
            echo $this->Form->end();           
        ?>
        <div class="btn">
        <?php
            echo $this->html->link('Register', array('action' => 'register'), array('class' => 'btn btn-warning'));
         ?>
        </div>
    </div>
	</div>
</div>
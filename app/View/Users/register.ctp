<div class="row">
        <h1 class="page-header">Registration</h1>
</div>

<div class="row">
    <div class="form-group">
        <div class="users form">

        <?php   
            echo $this->Form->create('User');
            echo $this->Form->input('name', array('class' => 'form-control input-sm'));
    		echo $this->Form->input('email', array('class' => 'form-control input-sm'));
            echo $this->Form->input('password', array('class' => 'form-control input-sm'));
    		echo $this->Form->input('password_confirm', array('label' => 'Confirm Password *', 'maxLength' => 255, 'title' => 'Confirm password', 'type'=>'password', 'class' => 'form-control input-sm'));
        ?>

        <div class="btn-group">
            <div class="btn">
            <?php 
            echo $this->Form->submit('Register', array('class' => 'form-submit btn btn-success')); 
            ?>
            </div>
            <?php 
                echo $this->Form->end();           
            ?>
            <div class="btn">
            <?php
                echo $this->html->link('Cancel', array('controller' => 'users', 'action' => 'login'), array('class' => 'btn btn-warning'));
             ?>
            </div>
        </div>


        </div>
    </div>
</div>
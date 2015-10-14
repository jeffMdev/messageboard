
<div class="row">
        <h1 class="page-header">Edit User Profile</h1>
</div>
<div class="row">
	<?php  echo $this->Form->create('User', array('type' => 'file')); ?>
	<div class="col-lg-2">
		<?php if (!empty($this->request->data['User']['image'])) : ?>
		<?php echo $this->Html->image('/app/webroot/img/profile_img/' . $this->request->data['User']['image'], array('id' => 'pic', 'name' => 'pic', 'width' => '160', 'height' => '160', 'class' => 'img-thumbnail')); ?>		
		<?php else : ?>
		<?php echo $this->Html->image('/app/webroot/img/pic_00.jpg', array('id' => 'pic', 'name' => 'pic', 'width' => '160', 'height' => '160')); ?>		
		<?php endif; ?>
		<?php
			echo $this->Form->file('File/image');
		?>
	</div>
	<div class="col-lg-4">
		<ul class="list-unstyled">
		 	<li><?php echo $this->Form->input('name', array('class' => 'form-control input-sm')); ?></li>
			<li><p><?php echo $this->Form->input('birthdate', array('class' => 'form-control input-sm bdate', 'type' => 'text')); ?></p></li>
			<li><?php 
						$selected = isset($this->request->data['User']['gender']) ? $this->request->data['User']['gender'] : null ;

						echo $this->Form->label('gender') . '  ';
						// echo '<br>';
						$options = array(1 => 'Male', 2 => 'Female');
						$attributes = array('legend' => false, 'value' => $selected);
						echo $this->Form->radio('gender', $options, $attributes);
				?>
			</li>		
			<li><?php echo $this->Form->input('hubby', array('class' => 'txt-area form-control input-sm')); ?></li>
			<li>
				<div class="btn-group">
		            <div class="btn">
		            <?php 
		            echo $this->Form->submit('Update', array('class' => 'form-submit btn btn-success')); 
		            ?>
		            </div>
		            <?php 
		                echo $this->Form->end();           
		            ?>
		            <div class="btn">
		            <?php
		                echo $this->html->link('Cancel', array('action' => 'profile', $this->request->data['User']['id']), array('class' => 'btn btn-warning'));
		             ?>
		            </div>
		        </div>
			</li>
	 	</ul>
	</div> 
</div>

<script>
	$(document).ready(function(){
		$( "#UserBirthdate" ).datepicker({
			buttonText: "Select date",
			dateFormat: "yy-mm-dd",
			showAnim: "slideDown",
			changeMonth: true,
			changeYear: true, 
			minDate: "-100Y",
			maxDate: "0D"
		});
	});
  </script>
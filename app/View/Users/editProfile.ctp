
<div class="row">
        <h1 class="page-header">Edit User Profile</h1>
</div>
<div class="row">
	<?php  echo $this->Form->create('User', array('type' => 'file')); ?>
	<div class="col-lg-2">
		<?php 
			$imgSrc = '/app/webroot/img/pic_00.jpg';
			if (!empty($this->request->data['User']['image'])) {
				$imgSrc = '/app/webroot/img/profile_img/' . $this->request->data['User']['image'];
			}
			echo $this->Html->image($imgSrc, array('id' => 'pic', 'name' => 'pic', 'width' => '160', 'height' => '160', 'class' => 'img-thumbnail')); 
			echo $this->Form->file('image', array('id' => 'imgInp', 'class' => 'form-control input-sm'));
		?>
	</div>
	<div class="col-lg-4">
		<ul class="list-unstyled">
		 	<li><?php echo $this->Form->input('name', array('class' => 'form-control input-sm')); ?></li>
			<li><p><?php echo $this->Form->input('birthdate', array('class' => 'form-control input-sm bdate', 'type' => 'text')); ?></p></li>
			<li><?php 
						$selected = isset($this->request->data['User']['gender']) ? $this->request->data['User']['gender'] : null ;

						echo $this->Form->label('gender') . '&nbsp;&nbsp;<br>';
						$options = array(1 => 'Male&nbsp;&nbsp;', 2 => 'Female');
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
		                echo $this->html->link('Cancel', array('controller' => 'users','action' => 'profile', $this->Session->read('Auth.User.id')), array('class' => 'btn btn-warning'));
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

		function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#pic').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#imgInp").change(function(){
            readURL(this);
        });

	});
  </script>
<div class="row">
        <h1 class="page-header">Message List</h1>
</div>
<div class="row">
	<?php echo $this->html->link('New Message', array('controller' => 'messages', 'action' => 'newmessage'), array('class' => 'btn btn-success')); ?>
</div>
<div class="row">
	<div class="col-lg-8">
		<br>
        <div class="panel panel-default">
            <div class="panel-heading">                
                Messages
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">    
            	<?php if($messages) : ?>        	
				<?php foreach ($messages as $message) : ?>
					<?php if ($message['msg']['from_id'] != $this->Session->read('Auth.User.id')) : ?>
						<div class="ajax-massage alert alert-success alert-dismissable" id="<?php echo $message['msg']['id']; ?>">               
		                    <ul class="list-unstyled">
		                    	<li class="navbar-left"><?php 
		                    		$imgSrc = '/app/webroot/img/pic_00.jpg';
									if (!empty($message['usr']['image'])) {
										$imgSrc = '/app/webroot/img/profile_img/' . $message['usr']['image'];
									}
		                    		echo $this->Html->image(
		                    			$imgSrc, 
			                    		array(
			                    			'id' => 'pic', 
			                    			'name' => 'pic', 
			                    			'width' => '60', 
			                    			'height' => '60', 
			                    			'class' => 'img-thumbnail',
			                    			'style' => 'margin-right:10px;'
			                    		)
			                    	); ?>
		                    	</li>
		                    	<li class="h4"><?php echo $message['usr']['name']; ?></li>
		                    	<li class="h6"><?php echo $message['msg']['content']; ?></li>
		                    	<li class="text-info h6"><?php echo date('F d, Y g:i A', strtotime($message['msg']['created'])); ?></li>
		                    	<li class="">
		                    		<?php echo $this->Html->link('View Details', array('controller' => 'messages', 'action' => 'messagedetail', $message['msg']['from_id']), array('class' => 'btn btn-warning')); ?>
		                    		<button class="dels btn btn-danger" id="del<?php echo $message['msg']['id']; ?>">Delete Message</button>
		                    	</li>
		                    </ul>
	                	</div>
                	<?php else : ?>
	                	<div class="ajax-massage alert alert-info alert-dismissable" id="<?php echo $message['msg']['id']; ?>">
		                    <ul class="list-unstyled">
		                    	<li class="navbar-right"><?php 
		                    		$imgSrc = '/app/webroot/img/pic_00.jpg';
									if (!empty($message['usr']['image'])) {
										$imgSrc = '/app/webroot/img/profile_img/' . $message['usr']['image'];
									}
		                    		echo $this->Html->image(
		                    			$imgSrc, 
			                    		array(
			                    			'id' => 'pic', 
			                    			'name' => 'pic', 
			                    			'width' => '60', 
			                    			'height' => '60', 
			                    			'class' => 'img-thumbnail',
			                    		)
			                    	); ?>
		                    	</li>
		                    	<li class="h4"><?php echo $message['usr']['name']; ?></li>
		                    	<li class="h6"><?php echo $message['msg']['content']; ?></li>
		                    	<li class="text-info h6"><?php echo date('F d, Y g:i A', strtotime($message['msg']['created'])); ?></li>
		                    	<li>
		                    		<?php echo $this->Html->link('View Details', array('controller' => 'messages', 'action' => 'messagedetail', $message['msg']['to_id']), array('class' => 'btn btn-warning')); ?>
		                    		<button class="dels btn btn-danger" id="del<?php echo $message['msg']['id']; ?>">Delete Message</button>
		                    	</li>
		                    </ul>
	                	</div>
					<?php endif; ?>
					
				<?php endforeach; ?>
				<?php else : ?>
					You have no messages!
				<?php endif; ?>
            </div>
            <!-- .panel-body -->
        </div>
        <!-- /.panel -->
    </div>
</div>

<script>
	$(document).ready(function(){

		$(document).on('click', 'button.dels', function(){
			if (confirm('Are you sure you want to delete this message?')) {	
				var id = $(this).attr('id');
				id = id.replace('del','');
				deleteMessageAjax(id);
			}
		});

		function deleteMessageAjax($id) {
			if ($id != '' || $id != 0) {
				$.post(
					"<?php echo $this->request->webroot; ?>messages/deletemessageswithfromorto",
					{id: $id},
					function(result){						
						if(result == true) {
							$("#" + $id).fadeOut( "slow", function() {
								$("#" + $id).remove();							    
							});																		
						}
					}
				);
			}
		}

	});


</script>
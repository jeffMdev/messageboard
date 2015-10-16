<div class="row">
        <h1 class="page-header">Message Details</h1>
</div>
<div class="row">
	<div class="col-lg-8">
		<?php //echo $this->Form->create('Message'); ?>
		<?php //echo $this->Form->input('content', array('class' => 'form-control input-sm', 'label' => false, 'placeholder' => 'Message*')); ?>
		<textarea id="message" class="form-control input-sm" placeholder="Message *" style="height:100px;"></textarea>
		 <div class="btn-group">
            <div class="btn">
            	<button id="btn-reply" class="btn btn-success">Reply Message</button>
            </div>
            <?php 
            	$this->Js->submit('sdfReply Message Ajax', array(
            		'before' => $this->Js->get('#inprogress')->effect('fadeIn'),
            		'success' => $this->Js->get('#inprogress')->effect('fadeOut'),
            		'update' => '#success'
            	));

                // echo $this->Form->end();           
            ?>
            <div class="btn">
            <?php
                echo $this->html->link('Cancel', array('controller' => 'messages', 'action' => 'index'), array('class' => 'btn btn-warning'));
             ?>
            </div>
        </div>
	</div>
</div>
<div id="success"></div>
<div class="row">
	<div class="col-lg-8">
		<br>
        <div class="panel panel-default">
            <div class="panel-heading">                
                Messages                
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body" id="messages-list">   
            	<p></p>
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
		                    	<li>
		                    		<?php 
		                    // 			echo $this->Form->postLink(
						                //     'Delete',
						                //     array('controller' => 'messages', 'action' => 'deletemessage', $message['msg']['id']),
						                //     array('confirm' => 'Are you sure you want to delete this message?')
						                // );
		                    		?>
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
		                    		<?php 
		                    // 			echo $this->Form->postLink(
						                //     'Delete',
						                //     array('controller' => 'messages', 'action' => 'deletemessage', $message['msg']['id']),
						                //     array('confirm' => 'Are you sure you want to delete this message?')
						                // );
		                    		?>
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

		$('#btn-reply').click(function(){
			$.post(
				"<?php echo $this->request->webroot; ?>messages/replyajax",
				{
					content: $('#message').val(),
					to_id: "<?php echo $this->request->params['pass']['0']; ?>"
				},
				function(data){
					var img_src = "/messageboard/app/webroot/img/pic_00.jpg";
					if(data.image != '') img_src = '/messageboard/app/webroot/img/profile_img/' + data.image;

					var value_str = '<div class="ajax-massage alert alert-info alert-dismissable" id="' + data.last_msg_id + '">' +
	                    '<ul class="list-unstyled">' +
	                    	'<li class="navbar-right">' +
								'<img src="' + img_src + '" class="img-thumbnail" width="60" height="60">' +
	                    	'</li>' +
	                    	'<li class="h4">' + data.sender_name +' </li>' +
	                    	'<li class="h6">' + data.message + '</li>' +
	                    	'<li class="text-info h6">' + data.created + '</li>' +
	                    	'<li>' +
								'<button class="dels btn btn-danger" id="del' + data.last_msg_id + '">Delete Message</button>' + 
	                    	'</li>' +
	                    '</ul>' +
                	'</div>';

                	$('#message').val('');

                	
                	$(value_str).insertAfter("p");
				},
				"json"
			);
		});

		function deleteMessageAjax($id) {
			if ($id != '' || $id != 0) {
				$.post(
					"<?php echo $this->request->webroot; ?>messages/deletemessage",
					{id: $id},
					function(result){						
						if(result == true) {
							// $("#" + $id).delay(500).fadeTo("slow", 0.2);
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
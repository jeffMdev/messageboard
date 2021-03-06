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
            	<ul class="show-more list-unstyled">	
				<?php foreach ($messages as $message) : ?>
					<?php if ($message['msg']['from_id'] != $this->Session->read('Auth.User.id')) : ?>
						<li>
						<div class="ajax-massage alert alert-success alert-dismissable" id="<?php echo $message['msg']['id']; ?>">               
		                    <ul class="list-unstyled">
		                    	<li class="navbar-left"><?php 
		                    		$imgSrc = $this->request->webroot . 'app/webroot/img/pic_00.jpg';
									if (!empty($message['usr']['image'])) {
										$imgSrc = $this->request->webroot . 'app/webroot/img/profile_img/' . $message['usr']['image'];
									} ?>
			                    	<img src="<?php echo $imgSrc; ?>" class="img-thumbnail" style="margin-right:10px;" width="60" height="60" name="pic">
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
	                	</li>
                	<?php else : ?>
                		<li class="list-unstyled">
	                	<div class="ajax-massage alert alert-info alert-dismissable" id="<?php echo $message['msg']['id']; ?>">
		                    <ul class="list-unstyled">
		                    	<li class="navbar-right"><?php 
		                    		$imgSrc = $this->request->webroot . 'app/webroot/img/pic_00.jpg';
									if (!empty($message['usr']['image'])) {
										$imgSrc = $this->request->webroot . 'app/webroot/img/profile_img/' . $message['usr']['image'];
									} ?>
			                    	<img src="<?php echo $imgSrc; ?>" class="img-thumbnail" style="margin-right:10px;" width="60" height="60" name="pic">
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
	                	</li>
					<?php endif; ?>					
				<?php endforeach; ?>
				</ul>
				<?php else : ?>
					You have no messages!
				<?php endif; ?>
            </div>
            <!-- .panel-body -->
        </div>
        <!-- /.panel -->
        <?php if ($messages && $totalRows > 5) : ?>
			<a href="#" id="show-more-link">Show More</a>
		<?php  endif; ?>
    </div>
</div>
<input type="hidden" id="limit" value="5">
<input type="hidden" id="range" value="5">
<script>
	$(document).ready(function(){

		$(document).on('click', 'button.dels', function(){
			if (confirm('Are you sure you want to delete this message?')) {	
				var id = $(this).attr('id');
				id = id.replace('del','');
				deleteMessageAjax(id);
			}
		});

		$(document).on('click', 'a#show-more-link', function(){
			var iLimit = $('#limit').val();
			var iRange = $('#range').val();
			$.post(
					"<?php echo $this->request->webroot; ?>messages/showmore",
					{
						limit: iLimit, 
						range: iRange
					},
					function(data){						
						if(data != null) {
							iLimit = parseInt(iLimit);
							iRange = parseInt(iRange) + 5;
							$('#limit').val(iLimit);							
							$('#range').val(iRange);							
                			$(data.htm).appendTo("div.panel-body");
                			if(parseInt(data.range) >= parseInt(data.totalRows) - 5) {
                				$('#show-more-link').hide();
                			}
						}
					},
					"json"
				);
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
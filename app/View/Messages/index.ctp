<div class="row">
        <h1 class="page-header">Message List</h1>
</div>
<div class="row">
	<?php echo $this->html->link('New Message', array('controller' => 'messages', 'action' => 'newmessage'), array('class' => 'btn btn-success')); ?>
</div>
<div class="row"></div>
<div class="row">
	<div class="col-lg-8">
		<br>
        <div class="panel panel-default">
            <div class="panel-heading">                
                Messages
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">            	
				<?php foreach ($messages as $message) : ?>
					<?php //var_dump($message); exit; ?>
					<div class="alert alert-success alert-dismissable">
	                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true" id="<?php echo $message['msg']['id']; ?>">&times;</button>	                    
	                    <ul class="list-unstyled">
	                    	<li>Name: <?php echo $message['usr']['name']; ?></li>
	                    	<li>Message: <?php echo $message['msg']['content']; ?></li>
	                    	<li>Date: <?php echo date('F d, Y g:i A', strtotime($message['msg']['created'])); ?></li>
	                    </ul>
                	</div>
				<?php endforeach; ?>
            </div>
            <!-- .panel-body -->
        </div>
        <!-- /.panel -->
    </div>
</div>
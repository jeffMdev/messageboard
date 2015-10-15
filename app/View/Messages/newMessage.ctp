<div class="row">
        <h1 class="page-header">New Message</h1>
</div>
<div class="row">
	 <div class="col-lg-4">
		<?php 
			echo $this->Form->create('Message');
			echo $this->Form->label('name', 'Recipient <span class="mandatory">*</span>');				
			echo $this->Form->input('to_id',array('label' => false, 'placeholder' => 'Search for a recipient', 'type' => 'text', 'class' => 'form-control input-sm hidden'));
		?>
			<p>
				<select class="js-example-templating js-states form-control" id="recipient" required>
					<option></option>
					<?php foreach($users as $user) : ?>
						<option value="<?php echo $user['User']['id'] ?>"> <?php echo $user['User']['name']; ?> </option>
					<?php endforeach; ?>
				</select>
			</p>
		<?php 
			echo $this->Form->label('content', 'Message <span class="mandatory">*</span>');				
			echo $this->Form->input('content',array('label' => false, 'placeholder' => 'Message', 'class' => 'form-control input-sm'));
		?>
		
        <div class="btn-group">
            <div class="btn">
            <?php 
            echo $this->Form->submit('Send', array('class' => 'form-submit btn btn-success')); 
            ?>
            </div>
            <?php 
                echo $this->Form->end();           
            ?>
            <div class="btn">
            <?php
                echo $this->html->link('Cancel', array('controller' => 'messages', 'action' => 'index'), array('class' => 'btn btn-warning'));
             ?>
            </div>
        </div>
    </div>	
</div>

<script type="text/javascript">
	// $(".js-example-basic-multiple").select2();	
$(document).ready(function(){
	function formatState (state) {
	  if (!state.id) { return state.text; }
	  var $state = $(
	    '<span><img src="/app/webroot/img/profile_img/' + state.element.value.toLowerCase() + '" class="img-flag" /> ' + state.text + '</span>'
	  );
	  return $state;
	};
	 
	$(".js-example-templating").select2({
	  templateResult: formatState
	});

	$('a.select2-choice').css("border","none");
	$('a.select2-choice').css("background","none");
	$('a.select2-choice').css("box-shadow","none");

	$('span.select2-arrow').css("border","none");
	$('span.select2-arrow').css("background","none");
	$('span.select2-arrow').css("box-shadow","none");

	$('#recipient').change(function(){
		$('#MessageToId').val(this.value);
	});
});
</script>


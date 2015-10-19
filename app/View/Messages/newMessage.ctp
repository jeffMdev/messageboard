<style type="text/css">
.img-flag {
  height: 20px;
  width: 20px;
}
</style>
<div class="row error-message"></div>
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
				<select class="js-example-templating form-control input-sm" id="recipient">
					<option label="pic_00.jpg" value="0"></option>
					<?php foreach($users as $user) : ?>
						<?php 
							$imgSrc = ($user['User']['image'] != '' || $user['User']['image'] != null) ? $user['User']['image'] : 'pic_00.jpg';
						?>
						<option label="<?php echo $imgSrc; ?>" value="<?php echo $user['User']['id']; ?>"> <?php echo $user['User']['name']; ?> </option>
					<?php endforeach; ?>
				</select>
			</p>
		<?php 
			echo $this->Form->label('content', 'Message <span class="mandatory">*</span>');				
			echo $this->Form->input('content',array('label' => false, 'placeholder' => 'Message', 'class' => 'form-control input-sm', 'id' => 'message'));
		?>
		
        <div class="btn-group">
            <div class="btn">
            <?php 
            echo $this->Form->submit('Send', array('class' => 'form-submit btn btn-success', 'id' => 'submit')); 
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
$(document).ready(function(){

	$('.error-message').hide();

	function formatState (state) {
	  if (!state.id) { return state.text; }
	  var $state = $('<span><img src="<?php echo $this->request->webroot; ?>app/webroot/img/profile_img/' + state.element.label.toLowerCase() + '" class="img-flag" /> ' + state.text + '</span>');
	  return $state;
	};
	 
	$(".js-example-templating").select2({
	  templateResult: formatState,
      templateSelection: formatState
	});

	$('a.select2-choice').css("border","none");
	$('a.select2-choice').css("background","none");
	$('a.select2-choice').css("box-shadow","none");

	$('span.select2-arrow').css("border","none");
	$('span.select2-arrow').css("background","none");
	$('span.select2-arrow').css("box-shadow","none");

	$('#recipient').change(function(){
		if(this.value != 0) $('#MessageToId').val(this.value);
		else $('#MessageToId').val('');
	});

	/**	Validation **/
	$(document).on('click', '#submit', function(){
		if ($('#MessageToId').val() == '' && $('#message').val() == '') {
			$('.error-message').html('<p>Recipient is required.</p>');
			$('.error-message').append('<p>Message content must not be empty.</p>');
		} else if ($('#MessageToId').val() == '') {
			$('.error-message').html('<p>Recipient is required.</p>');
		} else if ($('#message').val() == '') {
			$('.error-message').html('<p>Message content must not be empty.</p>');
		}

		if ($('#MessageToId').val() == '' || $('#message').val() == '') {
			$('.error-message').show();
		}
	});


});
</script>


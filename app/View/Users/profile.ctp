

 <div class="row">
        <h1 class="page-header">User Profile</h1>
</div>
<div class="row">
	<div class="col-lg-2">
		<?php if (!empty($user['User']['image'])) : ?>
		<?php echo $this->Html->image('/app/webroot/img/profile_img/' . $user['User']['image'], array('id' => 'pic', 'name' => 'pic', 'width' => '160', 'height' => '160', 'class' => 'img-thumbnail')); ?>		
		<?php else : ?>
		<?php echo $this->Html->image('/app/webroot/img/pic_00.jpg', array('id' => 'pic', 'name' => 'pic', 'width' => '160', 'height' => '160')); ?>		
		<?php endif; ?>
	</div>
	<div class="col-lg-4">
		<ul class="chat">
		 	<li>
		 		<h3>
		 		<?php if ($user) : ?>
		 			<?php echo ucfirst($user['User']['name']); ?>
		 		<?php else : ?>
		 			Name
		 		<?php endif; ?>
		 		(<?php echo $this->Html->link('Edit', array('controller' => 'users', 'action' => 'editprofile', $user['User']['id'])); ?>)
		 		</h3>
		 	</li>	
			<li>Gender : <?php echo ($user['User']['gender'] == 1) ? 'Male' : 'Female'; ?></li>	
			<li>Birthdate : <?php echo date('F d, Y', strtotime($user['User']['birthdate'])); ?></li>	
			<li>Joined : <?php echo date('F d, Y ga', strtotime($user['User']['created'])); ?></li>	
			<li>Last Login : <?php echo date('F d, Y ga', strtotime($user['User']['last_login_time'])); ?></li>	
	 	</ul>
	</div> 
	<div class="col-lg-8">
		<div>Hubby : </div>
		<div>
			<pre class="pre-unstyled"><?php echo $user['User']['hubby']; ?></pre>
		</div>
	</div>
</div>

<style type="text/css">
	pre{
		font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
		font-size: 14px;
		background: none;
		border: none;
	}
</style>
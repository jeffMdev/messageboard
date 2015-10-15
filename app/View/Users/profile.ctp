

 <div class="row">
        <h1 class="page-header">User Profile</h1>
</div>
<div class="row">
	<div class="col-lg-2">
		<?php 
			$imgSrc = '/app/webroot/img/pic_00.jpg';
			if (!empty($user['User']['image'])) {
				$imgSrc = '/app/webroot/img/profile_img/' . $user['User']['image'];
			}
			echo $this->Html->image($imgSrc, array('id' => 'pic', 'name' => 'pic', 'width' => '160', 'height' => '160', 'class' => 'img-thumbnail')); 
		?>
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
			<li>
				Gender : <?php 
					if ($user['User']['gender'] == 1) { 
						echo 'Male';
					} else if ($user['User']['gender'] == 2) { 
						echo 'Female';
					}
				?>
			</li>	
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
<div class="row">
	<?php echo $this->Html->link('Back to Homage', array('controller' => 'messages', 'action' => 'index'), array('class' => 'btn btn-warning')); ?>
</div>

<style type="text/css">
	pre{
		font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
		font-size: 14px;
		background: none;
		border: none;
	}
</style>
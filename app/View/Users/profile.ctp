

 <div class="row">
        <h1 class="page-header">User Profile</h1>
</div>
<div class="row">
	<div class="col-lg-2">
		<?php echo $this->Html->image('/app/webroot/img/profile_img/' .$user['User']['image'], array('id' => 'pic', 'name' => 'pic', 'width' => '150', 'height' => '150')); ?>		
	</div>
	<div class="col-lg-4">
	<ul class="chat">
 	<li>
 		<h3><?php echo ucfirst($user['User']['name']); ?>
 		(<?php echo $this->Html->link('Edit', array('controller' => 'users', 'action' => 'editprofile'), null, $user['User']['id']); ?>)
 		</h3>
 	</li>	
	<li>Gender : <?php echo $user['User']['gender']; ?></li>	
	<li>Birthdate : <?php echo $user['User']['birthdate']; ?></li>	
	<li>Joined : <?php echo date('F d, Y ga', strtotime($user['User']['created'])); ?></li>	
	<li>Last Login : <?php echo date('F d, Y ga', strtotime($user['User']['last_login_time'])); ?></li>	
	</div> 
	<div class="col-lg-8">
		<div>Hubby : </div>
		<div>
			<?php echo $user['User']['hubby']; ?>					
		</div>
	</div>
 </ul>
</div>
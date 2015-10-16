<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $this->fetch('title'); ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('bootstrap.min.css');
		echo $this->Html->css('bootstrap-theme.css');
		echo $this->Html->css('sb-admin-2.css');
        echo $this->Html->css('font-awesome.min.css');
        echo $this->Html->css('metisMenu.min.css');  
        echo $this->Html->css('jquery-ui.css'); 
        echo $this->Html->css('jquery-ui.theme.css'); 
        echo $this->Html->css('select2.css'); 


        
    echo $this->Html->script(array(
        'jquery.js',
        'jquery-ui.js',
        'select2.min.js'
    )); 

		echo $this->fetch('meta');

        echo $this->JS->WriteBuffer(array('cache' => true));
    ?>



    <style type="text/css">
        #flashMessage{
            background: #C8E5BC;
            border-radius: 3px;
            font-size: 12px;
            color: #3C763D;
            padding: 10px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
	<div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header navbar-right col-lg-3">
               <?php 
                    if($this->Session->check('Auth.User')){
                        echo 'Welcome <b>' . $this->Session->read('Auth.User.name') . '</b>';
                        echo ' | ' . $this->Html->link('Profile', array('controller' => 'users', 'action' => 'profile', $this->Session->read('Auth.User.id')));
                        echo ' | ' . $this->Html->link('Logout', array('controller' => 'users', 'action' => 'logout'));
                    }
                ?>
            </div>
            <!-- /.navbar-header -->

            <div class="navbar-default sidebar" role="navigation">
                
                <div class="hiddensidebar-nav navbar-collapse">
                    
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            
            <!-- /.row -->
            <div class="row">
                <?php echo $this->Session->flash(); ?>
            </div>
            <!-- /.row -->
            
            <!-- /.row -->
                <?php echo $this->fetch('content'); ?>
            <!-- /.row -->

            
        </div>
        <!-- /#page-wrapper -->

    </div>
		
	<?php echo $this->Html->script(array(		
		'bootstrap.min.js',
        'metisMenu.min.js',
		'sb-admin-2.js'
	)); ?>


</body>
</html>

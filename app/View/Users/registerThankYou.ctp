<div class="row">
        <h1 class="page-header"><?php echo $message; ?></h1>
</div>

<div class="row">
    <div class="form-group">        
        <div class="btn">
        <?php
            echo $this->html->link('Back to homepage', array('action' => 'login'), array('class' => 'btn btn-warning'));
         ?>        
    </div>
</div>
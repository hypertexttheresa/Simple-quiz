<h2>Welcome to my small quiz application</h2>

<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Start the quiz'), array('action' => 'start')); ?></li>
		<li><?php echo $this->Html->link(__('Edit the quiz'), array('action' => 'manage')); ?></li>
		
	</ul>
	<h3><?php echo __('Extras'); ?></h3>
    <ul>
		<li><?php echo $this->Html->link(__('Plain PHP quiz'), array('action' => 'plain')); ?></li>
    </ul>
</div>
<div class="questions index">
Your current score is: <?php echo $score ?>
    <p>
        <?php echo $this->Html->link(__('Reset my score'), array('action' => 'reset')); ?></li>
    </p>
</div>

<div class="questions start">
<h2>A Question for You</h2>
	<p>
        <?php echo h($random_question['Question']['name']); ?>
    </p>
    
	<?php if (!empty($random_question['Answer'])): ?>
	<?php foreach ($random_question['Answer'] as $answer): ?>

	<?php endforeach; ?>

<?php echo $this->Form->create('Question', array('url' => 'answer/'.$random_question['Question']['id'])); 
    echo $this->Form->input('Choose', array(
    'options' => array($answer['option1'] => $answer['option1'],$answer['option2'] => $answer['option2'],$answer['option3'] => $answer['option3'], $answer['option4'] => $answer['option4'])    
    ));
    echo $this->Form->hidden($answer['correct']);
    echo $this->Form->end(__('Submit')); 
?>	
	

<?php else: echo("You still need to add some answers to this question:"); ?>
		<?php echo $this->Html->link(__('Add Answers'), array('controller' => 'answers', 'action' => 'add')); ?> 
		<?php echo $this->Form->create('Question', array('url'=> 'answer')); 
    echo $this->Form->end(__('Next Question')); ?>	
<?php endif; ?>

    <p>Your current score is: <strong><?php echo($score)?></strong></p>
</div>
<div class="actions">
	<?php echo $this->Html->link(__('Leave Quiz'), array('action' => 'index')); ?> 
</div>

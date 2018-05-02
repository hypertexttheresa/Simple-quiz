<div class="questions plain">
<h2>Plain PHP quiz</h2>

<p>As a small exercise, I first made this quiz in PHP without any Cake functionality.</p>

<?php
    $number = rand(1,100);
    $number2 = rand(1,100);
    if (!isset($_GET['score'])){$score = 1;}
    else{$score = $_GET['score'];}

    if (!isset($_GET['guess'])){
        echo("<p>The first question is a random guessing game!</p>");
    }

    else {
        $guess = $_GET['guess'];
        echo ("<p><em>You guessed:</em> $guess </p>");
        if ($guess == $number){
            echo("<p>You are right!</p>");
            $score = $score + 1;
        }
        else {
            echo("<p>Try again! The right answer was: $number</p>");
        }
    }

    if (!isset($_GET['equation'])){
        echo("<p>The second is all about adding numbers.</p>");
    }

    else {
        $solution = $_GET['solution'];
        $equation = $_GET['equation'];
        echo ("<p><em>Your Solved Equation:</em> $equation </p>");
        if ($equation == $solution){
            echo("<p>You are right!</p>");
            $score = $score + 1;
        }
        else {
            echo("<p>Try equating some more numbers! The right answer was: $solution</p>");
        }
    }

?>
    <p>
        <form>
            Please input your random number between 1 and 100: <input type="number" name="guess" min="1" max="100" /> <br/>
            Please solve the equation: <?php echo $number ?> + <?php echo $number2 ?> = <input type="number" name="equation" min="2" max="200"/> 
            <input type="hidden" name="solution" value="<?php echo($number + $number2) ?>" />
            <input type="hidden" name="score" value="<?php echo($score) ?>" />
            <input type="submit" value="Let's go!"/> 
        </form>
    </p>


    <p>
        Your current score is: <?php echo $score ?>
    </p> 
</div>
<div class="actions">
	<?php echo $this->Html->link(__('Back to index'), array('action' => 'index')); ?>
</div>

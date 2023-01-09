<?php 
	$polls = json_decode(file_get_contents('polls.json'), true);

	$errors = [];
	$question = $_POST['new-poll-question'] ?? '';
    $pollType = $_POST['poll-type'] ?? '';

	$deadline = $_POST['deadline'] ?? '';
	$password2 = $_POST['password2'] ?? '';
	
	// error handling //
	if ($_POST){

		$options = [];
		$index = 0;
		for($i=1;$i < 8;$i++)
		{
			$temp = 'opt'.$i;
			if($_POST[$temp])
			{
				$options[$index] = $_POST[$temp];
				$index++;
			}
		}
		if( trim($question) === '' )
		$errors['question'] = 'The question is required.';

		if ($pollType != 'multiple-choice' && $pollType != 'radio')
            $errors['pollType'] = 'Poll type required.';
		
		if($deadline === '')
		{
			$errors['deadline'] = 'Deadline is required.';
		}else if(strtotime($deadline) < time()){
            $errors[] = "This date has already passed.";
        }

		if(count($options) < 2)
		{
			$errors['options'] = 'Please provide with at least 2 option.';
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>logan POLLs</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<div class="navigation-wrapper">
		<div class="navigation">
			<div class="poll-nav">
				<a href="activepolls.php">Active Polls</a>
				<a id="expired-anchor" href="expiredpolls.php">Expired Polls</a>
			</div>
			<a class="current-page"  id="create-poll" href="createpoll.php">+ Create poll</a>
			<div class="other-navs">
				<a href="login.php">Log in</a>
				<a href="register.php">Register</a>
			</div>
		</div>
	</div>
	<div class="main-screen-wrapper">

		<h1 id="screen-name">Create Poll</h1>
		<div class="create-poll">
			<form method="POST" action="">
				<textarea name="new-poll-question" placeholder="Enter Your Question" ><?php echo $question; ?></textarea>
				<div class="poll-type">
					<h3>Poll Type </h3>
						<input type="radio" name="poll-type" value="multiple-choice" <?= $pollType == 'multiple-choice' ? 'checked' : '' ?>><label>Multiple Choice</label>
						<input type="radio" name="poll-type" value="radio" <?= $pollType == 'radio' ? 'checked' : '' ?>><label>Single Choice</label>
				</div>
				<div class="deadline-div">
					<h3>Deadline</h3>
					<input type="date" name="deadline" value="<?=$deadline?>">
				</div>
				<input class="new-poll-option" type="text" placeholder="Enter new option" name="opt1" value="<?=$options[0]??''?>">
				<input class="new-poll-option" type="text" placeholder="Enter new option" name="opt2"value="<?=$options[1]??''?>">
				<input class="new-poll-option" type="text" placeholder="Enter new option" name="opt3"value="<?=$options[2]??''?>">
				<input class="new-poll-option" type="text" placeholder="Enter new option" name="opt4"value="<?=$options[3]??''?>">
				<input class="new-poll-option" type="text" placeholder="Enter new option" name="opt5"value="<?=$options[4]??''?>">
				<input class="new-poll-option" type="text" placeholder="Enter new option" name="opt6"value="<?=$options[5]??''?>">
				<input class="new-poll-option" type="text" placeholder="Enter new option" name="opt7"value="<?=$options[6]??''?>">
				<button type="submit" name="create">Create</button>
			</form>	

			<?php if(count($errors) > 0):?>
				<div class="create-errors">
					<h1>ERRORS OCCURED</h1>
					<?php foreach($errors as $s): ?>
						<p><?=$s?></p>
					<?php endforeach; ?>
				</div>
			<?php endif;?>
			
			<?php if(isset($_POST['create']) && count($errors) < 1):?>
				<div class="create-success">
					<h1>SUCCESS!</h1>
				</div>

				<!-- add to storage the new user -->
				<?php
					$id =uniqid();
					$polls[$id] = [
						"id"=>$id,
						"content" => $question,
						"options" => $options,
						"isMultiple" => $pollType,
						"dateOfCreation" => date("Y-m-d"),
						"deadline" => $deadline,
						"answers" =>[],
						"voters" =>[]
					];

					file_put_contents('polls.json', json_encode($polls, JSON_PRETTY_PRINT));
				?>
			<?php endif;?>
		</div>

	</div>
</body>
</html>
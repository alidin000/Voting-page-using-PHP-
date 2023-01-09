<?php 
	$polls = json_decode(file_get_contents('polls.json'), true);
	$currentPollId = $_GET['poll-id']??'';
	$disabled = (strtotime($polls[$currentPollId]['deadline'] ) < time())?'disabled':'';
	$errors = [];
	if($_POST)
	{
		$chosenOption = $_POST['option']??'';
		$chosenOptions = $_POST['options']??[];
		if($chosenOption == '' && count($chosenOptions) < 1)
		{
			$errors['optionErrors'] = "You didn't chose any options.";
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
			<a id="create-poll" href="createpoll.php">+ Create poll</a>
			<div class="other-navs">
				<a href="login.php">Log in</a>
				<a href="register.php">Register</a>
			</div>
		</div>
	</div>
	<div class="main-screen-wrapper">
		<h1 id="screen-name">Vote</h1>
		<div class="voting-page">
			<?php if(strtotime($polls[$currentPollId]['deadline']) >= time()):?>
				<div class="vote-poll active">
					<h2 class="vote-poll-id">@<?=$polls[$currentPollId]['id']?> </h2>
					<h3 class="vote-poll-question"><?=$polls[$currentPollId]['content']?></h3>
					<p><strong>Created At: </strong><?=$polls[$currentPollId]["dateOfCreation"]?></p>
					<p><strong>Deadline: </strong><?=$polls[$currentPollId]["deadline"]?></p>
					</br>
					<form action="" method="post">
						<input type="hidden" name="poll-id" value="<?=$polls[$currentPollId]['id']?>">
						<div class="vote-option-wrapper">
							<?php foreach($polls[$currentPollId]['options'] as $opt): ?>
								<?php if($polls[$currentPollId]['isMultiple'] == 'radio'):?>
									<div class="vote-option">
										<input type="radio" name="option" value="<?=$opt?>">
										<span><?=$opt?></span>
									</div>
								<?php endif;?>

								<?php if($polls[$currentPollId]['isMultiple'] !== 'radio'):?>
									<div class="vote-option">
										<input type="checkbox" name="options[]" value="<?=$opt?>">
										<span><?=$opt?></span>
									</div>
								<?php endif;?>
							<?php endforeach; ?>
						</div>
						<button type="submit" name="submit">Submit</button>
					</form>
				</div>
			<?php endif;?>
			<?php if(strtotime($polls[$currentPollId]['deadline']) < time()):?>
				<div class="vote-poll expired">
					<h2 class="vote-poll-id">@<?=$polls[$currentPollId]['id']?></h2>
					<h3 class="vote-poll-question"><?=$polls[$currentPollId]['content']?></h3>
					
					<p><strong>Created At: </strong><?=$polls[$currentPollId]["dateOfCreation"]?></p>
					<p><strong>Deadline: </strong><?=$polls[$currentPollId]["deadline"]?></p>
					</br>

					<form action="" method="POST">
						<input type="hidden" name="poll-id" value="<?=$polls[$currentPollId]['id']?>">
						<div class="vote-option-wrapper">
							<?php foreach($polls[$currentPollId]['options'] as $opt): ?>
								<?php if($polls[$currentPollId]['isMultiple'] == 'radio'):?>
										<div class="vote-option">
											<input disabled type="radio" name="option" value="<?=$opt?>">
											<span><?=$opt?></span>
										</div>
									<?php endif;?>

									<?php if($polls[$currentPollId]['isMultiple'] !== 'radio'):?>
										<div class="vote-option">
											<input disabled type="checkbox" name="options[]" value="<?=$opt?>">
											<span><?=$opt?></span>
										</div>
									<?php endif;?>
							<?php endforeach; ?>
						</div>
						<button disabled type="submit">Expired!</button>
					</form>
				</div>	
			<?php endif;?>
			<?php if(count($errors) > 0):?>
				<div class="create-errors">
					<h1>ERRORS OCCURED</h1>
					<?php foreach($errors as $s): ?>
						<p><?=$s?></p>
					<?php endforeach; ?>
				</div>
			<?php endif;?>
			
			<?php if(isset($_POST['submit']) && count($errors) < 1):?>
				<div class="vote-success">
					<h1>SUCCESS!</h1>
				</div>
			<?php endif;?>

			
		</div>
	</div>
</body>
</html>
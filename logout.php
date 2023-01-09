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
				<a class="current-page" href="activepolls.php">Active Polls</a>
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
		<!-- <h1 id="screen-name">Active Polls</h1>
		<div class="active-polls">
			<div class="poll active">
				<h2 class="poll-id">Poll ID</h2>
				<h3 class="poll-question">Poll Question</h3>
				<div class="poll-dates">
					<p class="poll-create-date">Created at: 12/12/2022</p>
					<p class="poll-deadline">Deadline: 12/12/2022</p>
				</div>
				<form action="vote.html" method="get">
					<input type="hidden" name="poll-id" value="">
					<button type="submit" class="go-to-vote">Go</button>
				</form>
			</div>
			<div class="poll expired">
				<h2 class="poll-id">Poll ID</h2>
				<h3 class="poll-question">Poll Question</h3>
				<div class="poll-dates">
					<p class="poll-create-date">Created at: 12/12/2022</p>
					<p class="poll-deadline">Deadline: 12/12/2022</p>
				</div>
				<form action="vote.html" method="get">
					<input type="hidden" name="poll-id" value="">
					<button type="submit" class="go-to-vote">Go</button>
				</form>
			</div>
		</div> -->

		<!-- <h1 id="screen-name">Vote</h1>
		<div class="voting-page">
			
			<div class="vote-poll active">
				<h2 class="vote-poll-id">Poll ID</h2>
				<h3 class="vote-poll-question">Poll Question (Multiple Choice type)</h3>
				<form action="" >
					<input type="hidden" name="poll-id" value="">
					<div class="vote-option-wrapper">
						<div class="vote-option">
							<input type="checkbox" name="options[]" value="">
							<span>Option 1 (3 votes)</span>
						</div>
						<div class="vote-option">
							<input type="checkbox" name="options[]" value="">
							<span>Option 2 (12 votes)</span>
						</div>
						<div class="vote-option">
							<input type="checkbox" name="options[]" value="">
							<span>Option 3 (4 votes)</span>
						</div>
					</div>
					<button type="submit">Submit</button>
				</form>
			</div>
			
			<div class="vote-errors">
				<h1>ERRORS OCCURED</h1>
				<p>- error text goes here 1</p>
				<p>- error text goes here 2</p>
				<p>- error text goes here 3</p>
			</div>
			
			<div class="vote-success">
				<h1>SUCCESS!</h1>
			</div>
			
			<div class="vote-poll active">
				<h2 class="vote-poll-id">Poll ID</h2>
				<h3 class="vote-poll-question">Poll Question (1 Radio Choice type)</h3>
				<form action="" >
					<input type="hidden" name="poll-id" value="">
					<div class="vote-option-wrapper">
						<div class="vote-option">
							<input type="radio" name="option" value="">
							<span>Option 1 (3 votes)</span>
						</div>
						<div class="vote-option">
							<input type="radio" name="option" value="">
							<span>Option 2 (12 votes)</span>
						</div>
						<div class="vote-option">
							<input type="radio" name="option" value="">
							<span>Option 3 (4 votes)</span>
						</div>
					</div>
					<button type="submit">Submit</button>
				</form>
			</div>
			
			<div class="vote-poll expired">
				<h2 class="vote-poll-id">Poll ID</h2>
				<h3 class="vote-poll-question">Poll Question (1 Radio EXPIRED type)</h3>
				<form action="" >
					<input type="hidden" name="poll-id" value="">
					<div class="vote-option-wrapper">
						<div class="vote-option">
							<input disabled type="radio" name="option" value="">
							<span>Option 1 (3 votes)</span>
						</div>
						<div class="vote-option">
							<input disabled type="radio" name="option" value="">
							<span>Option 2 (12 votes)</span>
						</div>
						<div class="vote-option">
							<input disabled type="radio" name="option" value="">
							<span>Option 3 (4 votes)</span>
						</div>
					</div>
					<button disabled type="submit">Expired!</button>
				</form>
			</div>
			
			<div class="vote-poll expired">
				<h2 class="vote-poll-id">Poll ID</h2>
				<h3 class="vote-poll-question">Poll Question (Multiple Choice EXPIRED type)</h3>
				<form action="" >
					<input type="hidden" name="poll-id" value="">
					<div class="vote-option-wrapper">
						<div class="vote-option">
							<input disabled type="checkbox" name="options[]" value="">
							<span>Option 1 (3 votes)</span>
						</div>
						<div class="vote-option">
							<input disabled type="checkbox" name="options[]" value="">
							<span>Option 2 (12 votes)</span>
						</div>
						<div class="vote-option">
							<input disabled type="checkbox" name="options[]" value="">
							<span>Option 3 (4 votes)</span>
						</div>
					</div>
					<button disabled type="submit">Expired!</button>
				</form>
			</div>
		</div> -->

		<!-- <h1 id="screen-name">Create Poll</h1>
		<div class="create-poll">
			<form action="">
				<textarea name="new-poll-question" placeholder="Enter Your Question"></textarea>
				<div class="poll-type">
					<h3>Poll Type </h3>
						<input type="radio" name="poll-type" value="multiple-choice"><label>Multiple Choice</label>
						<input type="radio" name="poll-type" value="radio"><label>Single Choice</label>
				</div>
				<div class="deadline-div">
					<h3>Deadline</h3>
					<input type="date" name="deadline">
				</div>
				<input class="new-poll-option" type="text" placeholder="Enter new option" name="opt1">
				<input class="new-poll-option" type="text" placeholder="Enter new option" name="opt2">
				<input class="new-poll-option" type="text" placeholder="Enter new option" name="opt3">
				<input class="new-poll-option" type="text" placeholder="Enter new option" name="opt4">
				<input class="new-poll-option" type="text" placeholder="Enter new option" name="opt5">
				<input class="new-poll-option" type="text" placeholder="Enter new option" name="opt6">
				<input class="new-poll-option" type="text" placeholder="Enter new option" name="opt7">
				<button type="submit">Create</button>
			</form>

			<div class="create-errors">
				<h1>ERRORS OCCURED</h1>
				<p>- error text goes here 1</p>
				<p>- error text goes here 2</p>
				<p>- error text goes here 3</p>
			</div>
			
			<div class="create-success">
				<h1>SUCCESS!</h1>
			</div>
		</div> -->

		<!-- <h1 id="screen-name">Log In</h1>
		<div class="login-page">
			<form action="">
				<input type="text" name="name" value="" placeholder="Username">
				<input type="password" name="password" value="" placeholder="Password">
				<button type="submit">Log In</button>
			</form>

			<div class="login-errors">
				<h1>ERRORS OCCURED</h1>
				<p>- error text goes here 1</p>
				<p>- error text goes here 2</p>
				<p>- error text goes here 3</p>
			</div>
			
			<div class="login-success">
				<h1>SUCCESS!</h1>
			</div>
		</div> -->

		<!-- <h1 id="screen-name">Register</h1>
		<div class="register-page">
			<form action="">
				<input type="text" name="name" value="" placeholder="Enter username">
				<input type="password" name="password1" value="" placeholder="Enter password">
				<input type="password" name="password2" value="" placeholder="Enter your password again">
				<button type="submit">Register</button>
			</form>

			<div class="register-errors">
				<h1>ERRORS OCCURED</h1>
				<p>- error text goes here 1</p>
				<p>- error text goes here 2</p>
				<p>- error text goes here 3</p>
			</div>
			
			<div class="register-success">
				<h1>SUCCESS!</h1>
			</div>
		</div> -->
	</div>
</body>
</html>

<?php foreach($polls as $s): ?>
				<?php if(strtotime($s['deadline']) >= time()):?>
					<?php if($s['isMultiple'] == 'radio'):?>
						<div class="vote-poll active">
							<h2 class="vote-poll-id"><?=$s['id']?> </h2>
							<h3 class="vote-poll-question"><?=$s['content']?> (1 Radio Choice type)</h3>
							<form action="" >
								<input type="hidden" name="poll-id" value="">
								<div class="vote-option-wrapper">
									<?php foreach($s['options'] as $opt): ?>
										<div class="vote-option">
											<input disabled type="radio" name="option" value="">
											<span><?=$opt?></span>
										</div>
									<?php endforeach; ?>
								</div>
								<button type="submit">Submit</button>
							</form>
						</div>
					<?php endif;?>
					
					<?php if($s['isMultiple'] !== 'radio'):?>
						<div class="vote-poll active">
							<h2 class="vote-poll-id"><?=$s['id']?> </h2>
							<h3 class="vote-poll-question"><?=$s['content']?>  (Multiple Choice type)</h3>
							<form action="" >
								<input type="hidden" name="poll-id" value="">
								<div class="vote-option-wrapper">
									<?php foreach($s['options'] as $opt): ?>
										<div class="vote-option">
											<input disabled type="checkbox" name="options[]" value="">
											<span><?=$opt?></span>
										</div>
									<?php endforeach; ?>
								</div>
								<button type="submit">Submit</button>
							</form>
						</div>
					<?php endif;?>
				<?php endif;?>
			<?php endforeach; ?>

			<?php foreach($polls as $s): ?>
				<?php if(strtotime($s['deadline']) < time()):?>
					<?php if($s['isMultiple'] == 'radio'):?>
						<div class="vote-poll expired">
							<h2 class="vote-poll-id"><?=$s['id']?></h2>
							<h3 class="vote-poll-question"><?=$s['content']?> (1 Radio EXPIRED type)</h3>
							<form action="" >
								<input type="hidden" name="poll-id" value="<?=$s['id']?>">
								<div class="vote-option-wrapper">
									<?php foreach($s['options'] as $opt): ?>
										<div class="vote-option">
											<input disabled type="radio" name="option" value="">
											<span><?=$opt?></span>
										</div>
									<?php endforeach; ?>
								</div>
								<button disabled type="submit">Expired!</button>
							</form>
						</div>
					<?php endif;?>

					<?php if($s['isMultiple'] !== 'radio'):?>
						<div class="vote-poll expired">
							<h2 class="vote-poll-id"><?=$s['id']?> </h2>
							<h3 class="vote-poll-question"><?=$s['content']?> (Multiple Choice EXPIRED type)</h3>
							<form action="" >
								<input type="hidden" name="poll-id" value="<?=$s['id']?>">
								<div class="vote-option-wrapper">
									<?php foreach($s['options'] as $opt): ?>
										<div class="vote-option">
											<input disabled type="checkbox" name="options[]" value="">
											<span><?=$opt?></span>
										</div>
									<?php endforeach; ?>
								</div>
								<button disabled type="submit">Expired!</button>
							</form>
						</div>
					<?php endif;?>
				<?php endif;?>
			<?php endforeach; ?>
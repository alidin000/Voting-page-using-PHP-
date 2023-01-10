<?php 
	session_start();
	$isLoggedIn = isset($_SESSION['user-id']);
	if($isLoggedIn)
	{
		include_once('storage.php');
        $stor = new Storage(new JsonIO('users.json'));
        
        $currentUser = $stor -> findById($_SESSION['user-id']);
	}
	$polls = json_decode(file_get_contents('polls.json'), true);
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
				<a class="current-page" id="expired-anchor" href="expiredpolls.php">Expired Polls</a>
			</div>
			<a id="create-poll" href="createpoll.php">+ Create poll</a>
			<div class="other-navs">
				<?php if(!$isLoggedIn):?>
					<a class="current-page" href="login.php">Log in</a>
					<a href="register.php">Register</a>
				<?php else: ?>
					<p class="username" style="margin-right: 20px; color: orange; display: inline;">
                        <?php if($currentUser["accountType"] == 2): ?>
                            <span style="margin-right: 20px; color: orange;">(👨‍💻admin)</span>
                        <?php endif ?>
                        <?=$currentUser["username"]?>
                    </p>
					<a class="current-page" href="logout.php">Logout</a>
				<?php endif;?>
			</div>
		</div>
	</div>
	<div class="main-screen-wrapper">
		<h1 id="screen-name">Active Polls</h1>
		<div class="active-polls">
		<?php foreach($polls as $key => $s): ?>
			<?php if(strtotime($s['deadline']) < time()):?>
				<div class="poll active">
					<h2 class="poll-id">@<?=$s['id']?></h2>
					<h3 class="poll-question"><?=$s['content']?></h3>
					<div class="poll-dates">
						<p class="poll-create-date">Created at: <?=$s['dateOfCreation']?></p>
						<p class="poll-deadline">Deadline: <?=$s['deadline']?></p>
					</div>
					<form action="vote.php" method="get">
						<input type="hidden" name="poll-id" value="<?=$key?>">
						<button type="submit" class="go-to-vote">See results</button>
					</form>
				</div>
			<?php endif;?>
		<?php endforeach; ?>
		</div>

	</div>
</body>
</html>
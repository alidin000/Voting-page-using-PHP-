<?php 
	session_start();

	// LOGIN CHECK //
	$isLoggedIn = isset($_SESSION['user-id']);
	include_once('storage.php');
	$stor = new Storage(new JsonIO('users.json'));
	if($isLoggedIn)
	{
        $currentUser = $stor -> findById($_SESSION['user-id']);
	}


	$polls = json_decode(file_get_contents('polls.json'), true);

	// -----> deleting <------ //
	if(isset($_POST['delete']))
	{
		$pollToDeleteId = $_POST['poll-id'];
		unset($polls[$pollToDeleteId]);

		unset($currentUser['votes'][$pollToDeleteId]);
		$stor -> update($currentUser['id'],$currentUser);

		file_put_contents('polls.json', json_encode($polls, JSON_PRETTY_PRINT));
	}


	//------->SORTING POLLS<-------- // 
	function compare($poll1, $poll2){
		return strcmp($poll1["deadline"], $poll2["deadline"]);
	}

	//sorting votes by deadline and putting the latest created to the top//
	$dataForOutput = [];
	if(count($polls) > 0)
	{
		$LATEST = array_pop($polls);

		$dataForOutput = $polls;
		$polls[] = $LATEST;
		uasort($dataForOutput, "compare");

		array_unshift($dataForOutput,$LATEST);
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Active polls</title>
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
				<?php if(!$isLoggedIn):?>
					<a class="current-page" href="login.php">Log in</a>
					<a href="register.php">Register</a>
				<?php else: ?>
					<p class="username" style="margin-right: 20px; color: orange; display: inline;">
                        <?php if($currentUser["accountType"] == 2): ?>
                            <span style="margin-right: 20px; color: orange;">(👨‍💻admin)</span>
                        <?php endif; ?>
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
		<?php foreach($dataForOutput as $key => $s): ?>
			<?php if(strtotime($s['deadline']) >= time()):?>
				<div class="poll active">
					<h2 class="poll-id">@<?=$s['id']?></h2>
					<h3 class="poll-question"><?=$s['content']?></h3>
					<div class="poll-dates">
						<p class="poll-create-date">Created at: <?=$s['dateOfCreation']?></p>
						<p class="poll-deadline">Deadline: <?=$s['deadline']?></p>
					</div>
					<form action="<?=(!$isLoggedIn)?'login.php':'vote.php';?>" method="get">
						<input type="hidden" name="poll-id" value="<?=$s['id']?>">
						<button type="submit" class="go-to-vote">Go</button>
					</form>
					<?php if($isLoggedIn && $currentUser['accountType'] == 2) :?>
						<form action="activepolls.php" method="post">
							<input type="hidden" name="poll-id" value="<?=$s['id']?>">
							<button type="submit" class="delete-vote" name="delete">Delete</button>
						</form>
					<?php endif;?>
				</div>
			<?php endif;?>
		<?php endforeach; ?>
		</div>

	</div>
</body>
</html>
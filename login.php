<?php 
	$users = json_decode(file_get_contents('users.json'), true);

	$errors = [];
	$name = $_POST['name'] ?? '';
	$password = $_POST['password2'] ?? '';

	// error handling //
	if ($_POST){
		if( trim($name) === '' )
            $errors['name'] = 'The name is required.';
		
		if( trim($password) === '' )
            $errors['password'] = 'The password is required.';

		// TODO password matching and username matching error
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
				<a class="current-page" href="login.php">Log in</a>
				<a href="register.php">Register</a>
			</div>
		</div>
	</div>
	<div class="main-screen-wrapper">

		<h1 id="screen-name">Log In</h1>
		<div class="login-page">
			<form method="POST" action="" novalidate>
				<input type="text" name="name" value="" placeholder="Username">
				<input type="password" name="password" value="" placeholder="Password">
				<button type="submit" name="log">Log In</button>
			</form>

			<?php if(count($errors) > 0):?>
				<div class="login-errors">
					<h1>ERRORS OCCURED</h1>
					<?php foreach($errors as $s): ?>
						<p><?=$s?></p>
					<?php endforeach; ?>
				</div>
			<?php endif;?>
			<?php if(isset($_POST['log']) && count($errors) < 1):?>
				<?php
					header('location: activepolls.php');
					exit();
				?>
			<?php endif;?>
		</div>
	</div>
</body>
</html>
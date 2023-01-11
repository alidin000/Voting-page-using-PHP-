<?php 
	session_start();

	// LOGIN CHECK //
	$isLoggedIn = isset($_SESSION['user-id']);
	if($isLoggedIn)
	{
		include_once('storage.php');
        $stor = new Storage(new JsonIO('users.json'));
        
        $currentUser = $stor -> findById($_SESSION['user-id']);
	}

	// fetching //
	$users = json_decode(file_get_contents('users.json'), true);
	
	$name = $_POST['name'] ?? '';
	$password = $_POST['password'] ?? '';
	
	// error handling //
	$errors = [];
	if ($_POST){
		if( trim($name) === '' )
            $errors['name'] = 'The name is required.';
		
		if( trim($password) === '' )
            $errors['password'] = 'The password is required.';

		// password matching and username matching error
		include_once('storage.php');
        $stor = new Storage(new JsonIO('users.json'));
        
        $user = $stor -> findOne([ 'username' => $name]);
        if (!$user){
           $errors['wrongUsername'] = 'Invalid username';
        } else if (!password_verify($password, $user['password'])){
			$errors['wrongPassword'] = 'Invalid password';
        }
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login page</title>
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

		<h1 id="screen-name">Log In</h1>
		<div class="login-page">
			<form method="POST" action="" novalidate>
				<input type="text" name="name" value="" placeholder="Username">
				<input type="password" name="password" value="" placeholder="Password">
				<button type="submit" name="log">Log In</button>
			</form>
			
			<!-- Errors  -->
			<?php if(count($errors) > 0):?>
				<div class="login-errors">
					<h1>ERRORS OCCURED</h1>
					<?php foreach($errors as $s): ?>
						<p><?=$s?></p>
					<?php endforeach; ?>
				</div>
			<?php endif;?>

			<!-- successful login -->
			<?php if(isset($_POST['log']) && count($errors) < 1):?>
				<?php
					$_SESSION['user-id'] = $user['id'];
					header('location: index.php');
					exit();
				?>
			<?php endif;?>
		</div>
	</div>
</body>
</html>
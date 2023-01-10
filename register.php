<?php 
	session_start();
	$isLoggedIn = isset($_SESSION['user-id']);
	if($isLoggedIn)
	{
		include_once('storage.php');
        $stor = new Storage(new JsonIO('users.json'));
        
        $currentUser = $stor -> findById($_SESSION['user-id']);
	}

	$users = json_decode(file_get_contents('users.json'), true);

	$errors = [];
	$name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
	$password1 = $_POST['password1'] ?? '';
	$password2 = $_POST['password2'] ?? '';

	// error handling //
	if ($_POST){
		if( trim($name) === '' )
            $errors['name'] = 'The name is required.';

		if ( trim($email) === '' )
            $errors['email'] = 'The email is required.';
        else if ( !filter_var($email, FILTER_VALIDATE_EMAIL) )
            $errors['email'] = 'The email format must be valid.';
		
		if( trim($password1) === '' )
            $errors['password1'] = 'The password is required.';

		if( trim($password2) === '' )
            $errors['password2'] = 'Enter the password again.';
		
		if(!$errors['password1'] && !$errors['password2'])
		{
			if($password1 !== $password2)
			{
				$errors['password'] = 'Passwords does not match';
			}
		}

		// unavailable username
		include_once('storage.php');
        $stor = new Storage(new JsonIO('users.json'));
        
        $user = $stor -> findOne([ 'username' => $name]);
        if ($user){
           $errors['wrongUsername'] = 'This username is taken';
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
		<h1 id="screen-name">Register</h1>
		<div class="register-page">
			<form method="POST" action="" novalidate>
				<input type="text" name="name" value="<?= $name ?>" placeholder="Enter username">
				<input type="email" name="email" value="<?=$email ?>" placeholder="Enter email">
				<input type="password" name="password1" value="" placeholder="Enter password">
				<input type="password" name="password2" value="" placeholder="Enter your password again">
				<button type="submit" name="register">Register</button>
			</form>
			<?php if(count($errors) > 0):?>
				<div class="register-errors">
					<h1>ERRORS OCCURED</h1>
					<?php foreach($errors as $s): ?>
						<p><?=$s?></p>
					<?php endforeach; ?>
				</div>
			<?php endif;?>
			
			<?php if(isset($_POST['register']) && count($errors) < 1):?>
				<!-- add to storage the new user -->
				<?php
					$id = uniqid();
					$users[$id] = [
					  "id"=>$id,
					  "username" => $name,
					  "email" => $email,
					  "password" => password_hash($password2, PASSWORD_DEFAULT),
					  "accountType" => 1
					];

					file_put_contents('users.json', json_encode($users, JSON_PRETTY_PRINT));
					header('location: login.php');
					exit();
				?>
			<?php endif;?>
			
		</div>
	</div>
</body>
</html>
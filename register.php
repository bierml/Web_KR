<?php
	if(isset($_COOKIE["auth_user"]))
	{
		setcookie("auth_user","");
	}
	global $alreadyexist;
	global $success;	
	$alreadyexist = false;
	$success = true;
	$login = $_POST['login'];
	$salt = 'aDtF326Bc71';
	$hash = md5($salt. $_POST['password']);
	$usersData = [ ['login' => $login, 'hash' => $hash ], ];
	$dbh = new PDO('mysql:dbname=users;host=localhost', 'newuser', 'password');
  	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$data = $dbh->prepare('SELECT * FROM us_db WHERE login = :login');
	$data->execute(['login'=>$login]);
	$result = $data->fetchAll();
	foreach ($result as $result) {
		$alreadyexist = true;
	} 
	if($alreadyexist == false)
	{
		try {
  			$data = $dbh->prepare('INSERT INTO us_db (login, hash) VALUES(:login, :hash)');
  			foreach ($usersData as $user) {
				$data->execute($user);		
		}
		}catch(PDOException $e) {
    			$success = false;
		}
	}
	if($success and !$alreadyexist)
	{
		setcookie("auth_user",$login,strtotime("1 month"),"/");
		header("Location: registration_done.php");
        	die();
	}
?>
<!DOCTYPE HTML>
<html lang="ru">
	<head>
		<title>Энциклопедия химических элементов</title>
		<meta charset="utf-8" />
		<link href="styles/style3.css" rel="stylesheet">
		<script src="jsscr/check-auth.js"></script>
	</head>
	<body>
		<p>Регистрация нового аккаунта</p>
		<form name="nform" method="POST" onsubmit="return CheckReg();" action="register.php">
			<div class="id0">
				<label class="id1">Логин:</label>
				<input class="id2" name="login" type="text" required>
			</div>
			<div class="id0">
				<label class="id1">Пароль:</label>
				<input type="password" class="id2" name="password" type="string" required>
			</div>
			<div class="id0">
				<label class="id1">Подтверждение пароля:</label>
				<input type="password" class="id2" name="passwordconf" type="string" required>
			</div>
			<input class="id3" name="submit" type="submit" value="Отправить"><br>
			<?php if(isset($alreadyexist)) {
				if($alreadyexist)
				{
					echo "<p class=\"msg\">Пользователь с таким логином уже существует!</p>";
				}
			}
			if(isset($success)) {
				if(!$success)
				{
					echo "<p class=\"msg\">При добавлении пользователя произошла непредвиденная ошибка!</p>";
				}
			}?>
		</form>
	</body>
</html>

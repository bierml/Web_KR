<?php
	if(isset($_COOKIE["auth_user"]))
	{
		setcookie("auth_user","");
	}
	global $success;
	$success = false;
	$login = $_POST['login'];
	$salt = 'aDtF326Bc71';
	$hash = md5($salt. $_POST['password']);
	$usersData = [ ['login' => $login, 'hash' => $hash ], ];
	$dbh = new PDO('mysql:dbname=users;host=localhost', 'newuser', 'password');
  	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$data = $dbh->prepare('SELECT * FROM us_db WHERE login = :login AND hash = :hash');
	$data->execute(['login'=>$login,'hash'=>$hash]);
	$result = $data->fetchAll();
	foreach ($result as $result) {
		$success = true;
	} 
	if($success)
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
	</head>
	<body>
		<p>Войти в аккаунт</p>
		<form name="nform" method="POST" action="enter.php">
			<div class="id0">
				<label class="id1">Логин:</label>
				<input class="id2" name="login" type="text" required>
			</div>
			<div class="id0">
				<label class="id1">Пароль:</label>
				<input type="password" class="id2" name="password" required>
			</div>
			<input class="id3" name="submit" type="submit" value="Отправить"><br>
			<?php
			if(isset($success)) {
				if(!$success)
				{
					echo "<p class=\"msg\">Неверная пара логин/пароль!</p>";
				}
			}?>
		</form>
	</body>
</html>

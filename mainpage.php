<!DOCTYPE HTML>
<html lang="ru">
	<head>
		<title>Энциклопедия химических элементов</title>
		<link href="/styles/style4.css" rel="stylesheet">
	</head>
		<body>
			<div id="left">
				<h2>Добро пожаловать!</h2>
				<p>Вы находитесь на главной странице портала "Энциклопедия химических элементов". Здесь мы собрали информацию о различных химических элементах в статьях. Разделы портала:</p>
				<ul>	
					<li>Главная (вы находитесь здесь)</li>
					<li>Все статьи (список статей, добавленных на сайт)</li>
					<li>Войти (после входа у вас появится возможность редактировать и добавлять статьи)</li>
					<li>Зарегистрироваться (на случай если вы не имеете аккаунта на нашем сайте)</li>
					<li>Редактор статей (раздел, где можно добавить в энциклопедию новую статью или отредактировать уже существующую)</li>
				</ul>	
			</div>
			<div id="right">
				<div class="bl">
					<h3>Статус входа в аккаунт:</h3>
					<?php
						if(isset($_COOKIE["auth_user"]))
						{
							echo $_COOKIE["auth_user"];
							echo "<hr><b><a class=\"cl7\" href=\"javascript:void(0);\">Выйти из аккаунта</a><b>";
						}
						else
							echo "<p>вход не произведен, войдите в аккаунт, чтобы добавлять и редактировать статьи</p>";
					?>
					<script src="/jsscr/exit.js"></script>
				</div>
			</div>
		</body>
</html>
<!DOCTYPE HTML>
<html lang="ru">
	<head>
		<title>Энциклопедия химических элементов</title>
		<link href="/styles/style4.css" rel="stylesheet">
	</head>
		<body>
			<div id="left">
				<h2>Добро пожаловать!</h2>
				<p>Вы находитесь на главной странице портала "Энциклопедия химических элементов". Здесь мы собрали информацию о различных химических элементах в статьях. Разделы портала:</p>
				<ul>	
					<li>Главная (вы находитесь здесь)</li>
					<li>Все статьи (список статей, добавленных на сайт)</li>
					<li>Войти (после входа у вас появится возможность редактировать и добавлять статьи)</li>
					<li>Зарегистрироваться (на случай если вы не имеете аккаунта на нашем сайте)</li>
					<li>Редактор статей (раздел, где можно добавить в энциклопедию новую статью или отредактировать уже существующую)</li>
				</ul>	
			</div>
			<div id="right">
				<div class="bl">
					<h3>Статус входа в аккаунт:</h3>
					<?php
						if(isset($_COOKIE["auth_user"]))
						{
							echo $_COOKIE["auth_user"];
							echo "<hr><b><a class=\"cl7\" href=\"javascript:void(0);\">Выйти из аккаунта</a><b>";
						}
						else
							echo "<p>вход не произведен, войдите в аккаунт, чтобы добавлять и редактировать статьи</p>";
					?>
					<script src="/jsscr/exit.js"></script>
				</div>
			</div>
		</body>
</html>

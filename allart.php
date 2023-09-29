<!DOCTYPE HTML>
<html lang="ru"> 
	<head>
		<title>Энциклопедия химических элементов</title>
		<link href="/styles/style5.css" rel="stylesheet">
		<meta charset="utf-8" />
	</head>
	<body>
		<h2>Список статей:</h2>
		<?php
			$art_found = false;
			$dbh = new PDO('mysql:dbname=users;host=localhost', 'newuser', 'password');
			$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$art_data = $dbh->query('SELECT * FROM art_db');
			foreach ($art_data as $article) {
				$art_found = true;
				$own = $article['owner'];
				$owner =  $dbh->prepare('SELECT login FROM us_db WHERE id = :own');
				$owner->execute(['own'=>$own]);
				$owner_arr = $owner->fetchAll();
				$owner_login;
				foreach ($owner_arr as $ownlog){
					$owner_login = $ownlog['login'];
				}
				echo '<div class="artcl">';
				echo '<div class="left">';
				echo '<img src="'.$article['pic'].'" alt="picture not found!">';
				echo '</div>';
				echo '<div class="right">';
				echo '<h2>'.$article['name'].'</h2>';
				echo '<p>'.$article['descr'].'</p>';
				echo '<i>Добавил: '.$owner_login.'</i><br>';
				echo '<a href="articles/'.$article['art'].'">Читать далее</a>';
				echo '</div>';
				echo '</div>';				
			}
			if(!$art_found)
				echo '<p>На сайт пока не добавлено ни одной статьи</p>';
		?>
	</body>
</html>

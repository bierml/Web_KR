<!DOCTYPE HTML>
	<html lang="ru"> 
	<head>	
		<title>Энциклопедия химических элементов</title>
		<script src="libs/jquery-1.11.2.min.js"></script>
		<script src="libs/ckeditor/ckeditor.js"></script>
		<link href="styles/style6.css" rel="stylesheet">
	</head>
		<body>
			<?php
			ini_set('display_errors',1);
			if(isset($_COOKIE["auth_user"]))
			{
				global $msg;
				$msg = "";
				global $id_;
				$id_ = 0;
				global $name_;
				$name_ = "";
				global $descr_;
				$descr_ = "";
				global $pic_;
				$pic_ = "";
				global $art_;
				$art_ = "";
				global $content_;
				$content_ = "";
				if(isset($_COOKIE["OnAdd"]))
				{
					$name = 0;
					$descr = 0;
					$pic = 0;
					$art = "0.html";
					$name = $_POST['name'];
					$descr = $_POST['descr'];
					$pic = $_POST['pic'];
					if($name=="" || $descr=="" || $pic=="") {
						$msg = "Заполните необходимые поля!";
					}
					else {
					try {
						$dbh = new PDO('mysql:dbname=users;host=localhost', 'newuser', 'password');
  						$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						$login = $_COOKIE["auth_user"];
						$data = $dbh->prepare('SELECT MAX(id) FROM art_db;');
						$data->execute();
						$result = $data->fetchAll();
						foreach ($result as $res) {
							if($res['MAX(id)'] != NULL)
								$art = ($res['MAX(id)']+1).".html";
						}
						$data = $dbh->prepare('SELECT * FROM us_db WHERE login = :login;');
						$data->execute(['login'=>$login]);
						$result = $data->fetchAll();
						foreach ($result as $res) {
							$owner = $res['id'];
						}
						$data = $dbh->prepare('INSERT INTO art_db (name,descr,pic,art,owner) VALUES(:name,:descr,:pic,:art,:owner);');
                  				$data->execute(['name'=>$name,'descr'=>$descr,'pic'=>$pic,'art'=>$art,'owner'=>$owner]);
						file_put_contents(realpath($_SERVER["DOCUMENT_ROOT"]).'/articles/'.$art,$_POST['editor1']);
					}
					catch (Exception $e) {	
						$msg = "Произошла непредвиденная ошибка!";
						unset($_COOKIE['OnAdd']);
                                        	setcookie("OnAdd","",1,"/");
					}}		
					unset($_COOKIE['OnAdd']);
					setcookie("OnAdd","",1,"/");
				}
				if(isset($_COOKIE["OnLoad"]))
				{
					if(!isset($_GET['article']))
						$msg = "Заполните необходимые поля!";
					else{
					try {				
						$dbh = new PDO('mysql:dbname=users;host=localhost', 'newuser', 'password');
  						$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						$id = $_GET['article'];
						$data = $dbh->prepare('SELECT * FROM art_db WHERE id = :id;');
						$data->execute(['id'=>$id]);
						$result = $data->fetchAll();
						foreach ($result as $res) {
							$name_ = $res['name'];
							$descr_ = $res['descr'];
							$pic_ = $res['pic'];
							$art_ = $res['art'];
							$content_ = file_get_contents(realpath($_SERVER["DOCUMENT_ROOT"]).'/articles/'.$art_);
						}
					}
					catch (Exception $e)
					{
						$msg = "Произошла непредвиденная ошибка!";
						unset($_COOKIE['OnLoad']);
                                        	setcookie("OnLoad","",1,"/");
					}}
					unset($_COOKIE['OnLoad']);
                                        setcookie("OnLoad","",1,"/");
				}
				if(isset($_COOKIE["OnDelete"]))
				{
					if(!isset($_GET['article']))
						$msg = "Заполните необходимые поля!";
					else{
					try {
						$dbh = new PDO('mysql:dbname=users;host=localhost', 'newuser', 'password');
  						$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						$id = $_GET['article'];
						$data = $dbh->prepare('SELECT * FROM art_db WHERE id = :id;');
						$data->execute(['id'=>$id]);
						$result = $data->fetchAll();
						foreach ($result as $res) {
							$id_ = $res['id'];
							$article = $res['art'];
						}
						$data = $dbh->prepare('DELETE FROM art_db WHERE id = :id;');
						$data->execute(['id'=>$id_]);
						unlink(realpath($_SERVER["DOCUMENT_ROOT"]).'/articles/'.$article);
					}
					catch (Exception $e) {
						$msg = "Произошла непредвиденная ошибка!";
						unset($_COOKIE['OnDelete']);
                                        	setcookie("OnDelete","",1,"/");

					}}
					unset($_COOKIE['OnDelete']);
                                        setcookie("OnDelete","",1,"/");

				}
				echo "<div id=\"left\">";
				echo "<form name=\"addart\" method=\"POST\" action=\"artedit.php\"><h2>Редактор статей</h2>";
				echo "<p>На этой странице зарегистрированные пользователи могут работать с созданными ими статьями.</p>";
				echo "<div id=\"id3\"><i>Текущий пользователь: ".$_COOKIE["auth_user"]."</i></div>";
				echo "<p>Введите название статьи:  </p><input value=\"".$name_."\" name=\"name\" type=\"text\" size=\"40\">";
				echo "<p>Введите описание статьи:  </p><textarea name=\"descr\" cols=\"40\" rows=\"3\">".$descr_."</textarea>";
				echo "<p>Введите ссылку на изображение:</p><input value=\"".$pic_."\" name=\"pic\" type=\"text\" size=\"40\">";
				echo "<p>Введите текст статьи: </p>";
				echo "<textarea name=\"editor1\" cols=\"45\" rows=\"5\">".$content_."</textarea>";
				echo "<script>";
				echo "CKEDITOR.replace( 'editor1');";
				echo "</script><input id=\"id4\" name=\"saveart\" type=\"submit\" value=\"Добавить\"></form>";
				echo "</div>";
				echo "<div id=\"right\"><form name=\"editart\" method=\"GET\" action=\"artedit.php\"><p>Выберите статью для редактирования/удаления:</p>";
				echo "<select name=\"article\">";
				$dbh = new PDO('mysql:dbname=users;host=localhost', 'newuser', 'password');
  				$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$login = $_COOKIE["auth_user"];
				$data = $dbh->prepare('SELECT * FROM us_db WHERE login = :login;');
				$data->execute(['login'=>$login]);
				$result = $data->fetchAll();
				foreach ($result as $res) {
					$owner = $res['id'];
				}
				$data = $dbh->prepare('SELECT * FROM art_db WHERE owner = :owner;');
				$data->execute(['owner'=>$owner]);
				$result = $data->fetchAll();
				foreach ($result as $res) {
					echo "<option value=\"".$res['id']."\">".$res['name']."</option>";
				}
				echo "</select><br><input id=\"id5\" name=\"loadart\" type=\"submit\" value=\"Загрузить\">";
				echo "<input id=\"id6\" name=\"deleteart\" type=\"submit\" value=\"Удалить\">";
				echo "<p class=\"msg\">".$msg."</p></form></div>";
				echo "<script src=\"jsscr/artedit.js\"></script>";
			}
			else
				echo "Вы не зарегистрированы! Чтобы получить доступ к редактору статей, зарегистрируйтесь.";
			?>
		</body>
</html>

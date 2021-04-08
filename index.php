<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<title>Мини-сервер сжатия ссылок</title>
		<link rel="stylesheet" type="text/css" href="styles/index.css">
	</head>

	<body>

		<div id="div">
			<?php
				//Генерация новых ссылыок и добавление в бд
				include __DIR__ . '\classes\generation.php';
	
				if(isset($_POST['form'])) {
					$result = (generation::newGeneration($_POST['url']));
					if(!$result) {
						echo '<b>Неправильная ссылка!</b>';
					}
					else {
	      		  		echo '<b>Короткая ссылка:<br><a href="' . $result . '">' . $result . '</a></b>';
	      		  	}
	    		}

				if (isset($_GET['short']) && $_GET['short'] != false) {
					echo '<meta http-equiv="refresh" content="0;URL=' . receiving::getUrlById($_GET['short']) . '">';
				}
			?>
		</div>

		<form method="post">
   		 	<input type="text" name="url" id="input">
    		<button name="form" id="button">Сократить</button>
		</form>
	</body>
</html>

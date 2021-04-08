<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<title>Мини-сервер сжатия ссылок</title>
		<link rel="stylesheet" type="text/css" href="styles/admin.css">
	</head>
	<body>
		<?php
			include __DIR__ . '\classes\generation.php';
		 	class actions {
		 		public static function regeneration ($id) {
		 			$url = receiving::getUrlById($id);
		 			actions::delete($id);
		 			generation::newGeneration($url);
		 		}
		 		public static function delete ($id) {
		 			global $connection;
		 			$connection->prepare('DELETE FROM dependencies WHERE (id = :id)')->execute(array('id' => $id));

		 		}
		 	}
			class show {
				//Таблица из бд
				public static function showAll () {
					global $connection;
					$statement = $connection->query('SELECT * FROM dependencies');
					echo '<table>';
					echo '<tr>';
					echo '<td>ID</td>';
					echo '<td>URL</td>';
					echo '<td>Короткий URL</td>';
					echo '<td>Дата создания</td>';
					echo '<td></td>';
					echo '<td></td>';
					echo '<tr>';
					while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
						echo '<tr>';
						echo '<td>' . $row['id'] . '</td>';
						echo '<td><a href="' . $row['url'] . '">' . $row['url'] . '</td>';
						echo '<td><a href="' . $row['shorturl'] . '">' . $row['shorturl'] . '</td>';
						echo '<td>' . $row['createdate'] . '</td>';
						echo '<td> <form method="post"><button name="form_regeneration" value="' . $row['id'] . '"><b>Перегенерировать</b></button><form> </td>';
						echo '<td> <form method="post"><button name="form_delete" value="' . $row['id'] . '"><b>Удалить</b></button><form> </td>';
						echo '<tr>';
					}
					echo '</table>';
				}
			}
			if(isset($_POST['form_delete'])) {
        		actions::delete($_POST['form_delete']);
    		}
    		if(isset($_POST['form_regeneration'])) {
    			actions::regeneration($_POST['form_regeneration']);
    		}
    		show::showAll();
		?>	
	</body>
</html>

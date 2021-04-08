<?php
	//10 -> 62 и 62 -> 10
	include __DIR__ . '/transfer.php';

	$connection = new PDO('mysql:host=localhost:3306;dbname=urls;charset=utf8', 'root', 'rootroot');
	//Получение из бд
	class receiving {
		//Проверка наличия в бд
    	public static function inBase ($url) {
    		global $connection;
    		$statement = $connection->query('SELECT id, url FROM dependencies');
    		while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    			if ($url == $row['url']) {
    				return $row['id'];
    			}
    		}
    		return false;
    	}
    	
		//Коротки url по id
		public static function getShortUrlById($id) {
			global $connection;
			$statement = $connection->query('SELECT id, shorturl FROM dependencies');
			while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
				if ($row['id'] == $id) {
					return $row['shorturl'];
				}
			}
			return false;
		}

		//Коротки url по id
		public static function getUrlById($id) {
			global $connection;
			$id = transfer::sixTwoToDec($id);
			$statement = $connection->query('SELECT id, url FROM dependencies');
			while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
				if ($row['id'] == $id) {
					return $row['url'];
				}
			}
			return false;
		}
	}
?>
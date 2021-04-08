<?php
	//Получение из бд
	include __DIR__ . '/receiving.php';


	//Генерация новых ссылыок и добавление в бд
	class generation {

		// функция проверки URL на валидность
    	public static function validateUrlFormat ($url) {
    	    return filter_var($url, FILTER_VALIDATE_URL);
    	}

		public static function newGeneration ($url) {
			//Валидность ссылки
			$validFlag = generation::validateUrlFormat($url);
			if ($validFlag == false) {
				//Изменить
				return false;
			}

			//Находиться ли в базе
			$id = receiving::inBase($url);
			if ($id > 0) {
				//Изменить
				return receiving::getShortUrlById($id);
			}

			global $connection;
			$id;
			$id1 = 0;
			$flag = false;
			$result;
			$nowDate = date('d.m.Y');
			$statement = $connection->query('SELECT id FROM dependencies');
			//Проверка пустых мест
			while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
				$id = $row['id'];
				if (($id1 + 1) < $id) {
					$id = $id1;
					break;
				}
				$id1 += 1;
			}
			if ($id == 0) {
				$result = 'http://example.io/1';
			}
			else {
				$result = 'http://example.io/' . transfer::decToSixTwo($id + 1); 
			}
			$stmt = $connection->prepare('INSERT INTO dependencies (id, url, shorturl,createdate) VALUES (:id, :url, :shorturl, :createdate)');

			$newArray = ["id" => ($id), "url" => $url, "shorturl" => $result, "createdate" => $nowDate];
			$stmt->execute(array("id" => ($id + 1), "url" => $url, "shorturl" => $result, "createdate" => $nowDate));
			return $result;
		}
	}
?>
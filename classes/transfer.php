<?php
	$chars = "0123456789qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM";

	//10 -> 62 и 62 -> 10
	class transfer {
		//10 -> 62
		public static function decToSixTwo($dec) {
			global $chars;
			$dec = (int)$dec;
			$sixTwo = '';
			do {
      			$i=$dec%62;
      			$sixTwo=$chars[$i].$sixTwo;
    			$dec=floor($dec/62);
   			} while($dec!=0);
			return $sixTwo;
		}

		//62 -> 10
		public static function sixTwoToDec($sixTwo) {
			$dec = 0;
			global $chars;
			for ($i = 0; $i < strlen($sixTwo); $i++) {
				$index = 0;
				while ($chars[$index] != $sixTwo[strlen($sixTwo) - $i - 1]) {
					$index++;
				}
				$dec += $index * pow(62, $i);
			}
			return $dec;
		}
	}
?>
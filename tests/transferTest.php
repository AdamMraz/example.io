<?php

	use PHPUnit\Framework\TestCase;
	//require_once 'PHPUnit/Framework.php';
	require_once __DIR__ . '/../classes/transfer.php';
 
	class transferTest extends TestCase {
		public function testDecToSixTwo ()  {
			$this->assertSame('20', transfer::decToSixTwo(124));
		}

		public function testSixTwoToDec () {
			$this->assertSame(10, transfer::sixTwoToDec('q'));
		}
	}
?>
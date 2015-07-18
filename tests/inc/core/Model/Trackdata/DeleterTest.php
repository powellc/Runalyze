<?php

namespace Runalyze\Model\Trackdata;

/**
 * Generated by hand
 */
class DeleterTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @var \PDO
	 */
	protected $PDO;

	protected function setUp() {
		$this->PDO = \DB::getInstance();
	}

	protected function tearDown() {
		$this->PDO->exec('TRUNCATE TABLE `'.PREFIX.'trackdata`');
	}

	/**
	 * @param array $data
	 */
	protected function insert(array $data) {
		$Inserter = new Inserter($this->PDO, new Object($data));
		$Inserter->setAccountID(0);
		$Inserter->insert();
	}

	/**
	 * @param int $id
	 */
	protected function delete($id) {
		$Deleter = new Deleter($this->PDO, new Object($this->fetch($id)));
		$Deleter->setAccountID(0);
		$Deleter->delete();
	}

	/**
	 * @param int $id
	 * @return mixed
	 */
	protected function fetch($id) {
		return $this->PDO->query('SELECT * FROM `'.PREFIX.'trackdata` WHERE `activityid`="'.$id.'" AND `accountid`=0')->fetch();
	}

	/**
	 * @expectedException \PHPUnit_Framework_Error
	 */
	public function testWrongObject() {
		new Deleter($this->PDO, new \Runalyze\Model\Route\Object);
	}

	public function testSimpleDeletion() {
		$this->insert(array(
			Object::ACTIVITYID => 1
		));
		$this->insert(array(
			Object::ACTIVITYID => 42
		));
		$this->delete(1);

		$this->assertEquals(false, $this->fetch(1));
		$this->assertNotEquals(false, $this->fetch(42));
	}

}

<?php

namespace Runalyze\Model;

class ObjectWithID_MockTester extends ObjectWithID {
	public function properties() {
		return array('foo');
	}
}

/**
 * Generated by hand
 */
class ObjectWithIDTest extends \PHPUnit_Framework_TestCase {

	public function testConstructorWithoutID() {
		$O = new ObjectWithID_MockTester(array('foo' => 'bar'));

		$this->assertFalse( $O->hasID() );
		$this->assertNull( $O->id() );

		$this->assertEquals( array('foo' => 'bar'), $O->completeData() );
	}

	public function testConstructorWithID() {
		$O = new ObjectWithID_MockTester(array('foo' => 'bar', 'id' => 1));

		$this->assertTrue( $O->hasID() );
		$this->assertEquals( 1, $O->id() );

		$this->assertEquals( array('foo' => 'bar'), $O->completeData() );
	}

}
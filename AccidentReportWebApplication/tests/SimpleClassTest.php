<?php

// PATH ที่ GEN มาให้อัตโนมัติ
//require_once 'C:\Users\AnchanFX\Workspace\Git\Accident-Report-Web-Application\AccidentReportWebApplication\src\SimpleClass.php';
// ต้องแก้เองเสมอให้เป็น
require_once 'SimpleClass.php';

/**
 * Test class for SimpleClass.
 * Generated by PHPUnit on 2014-09-09 at 21:09:28.
 */
class SimpleClassTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var SimpleClass
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new SimpleClass;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @covers SimpleClass::simpleFunction
     * @todo Implement testSimpleFunction().
     */
    public function testSimpleFunction()
    {
        $this->assertEquals('Simple', $this->object->simpleFunction());
    }
}
?>

<?php
namespace Helper;


class DataTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
        $this->helper = \Mage::helper('shippingconfirmation');
    }

    /**
     * Tear down
     *
     * @return void
     */
    protected function _after()
    {
    }

    /**
     * Make sure class is initiable and has the right class name
     *
     * @return void
     */
    public function testClassName()
    {
        $this->assertEquals('KL_ShippingConfirmation_Helper_Data', get_class($this->helper));
    }

}
<?php
namespace Model;


class CronTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
        $this->model = \Mage::getModel('shippingconfirmation/cron');
    }

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
        $this->assertEquals('KL_ShippingConfirmation_Model_Cron', get_class($this->model));
    }

}
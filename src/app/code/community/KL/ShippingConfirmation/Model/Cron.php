<?php
/**
 * Shipping confirmation
 *
 * @category  KL
 * @package   KL_ShippingConfirmation
 * @author    Andreas Karlsson <andreas@karlssonlord.com>
 * @copyright 2015 Karlsson & Lord AB
 * @license   http://opensource.org/licenses/MIT
 */

/**
 * Cron model
 *
 * @category  KL
 * @package   KL_ShippingConfirmation
 * @author    Andreas Karlsson <andreas@karlssonlord.com>
 * @copyright 2015 Karlsson & Lord AB
 * @license   http://opensource.org/licenses/MIT
 */
class KL_ShippingConfirmation_Model_Cron
{
    /**
     * Send emails
     *
     * @return void
     */
    public function sendEmails()
    {
        $shipments = Mage::getModel('sales/order_shipment')
            ->getCollection()
            ->addFieldToFilter('email_sent', array('null' => true))
            ->addFieldToFilter('created_at', array('from' => '2014-10-01'));

        foreach ($shipments as $_shipment) {
            if ($_shipment->getTracksCollection()->getSize() > 0) {
                try {
                    $_shipment->sendEmail();
                    $_shipment->setEmailSent(true);
                    $_shipment->save();
                } catch (Exception $e) {
                    Mage::logException($e);
                }
            }
        }
    }
}

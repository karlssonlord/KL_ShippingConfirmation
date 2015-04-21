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
        if (Mage::getStoreConfig('sales_email/shipment/shippingconfirmation_is_active')) {
            $trackinCodeIsRequired = Mage::getStoreConfig('sales_email/shipment/shippingconfirmation_require_tracking');
            $threshold = (int) Mage::getStoreConfig('sales_email/shipment/shippingconfirmation_threshold');

            $fromDate = Mage::getStoreConfig('sales_email/shipment/shippingconfirmation_from_date');
            $toDate = time() - $threshold;

            $shipments = Mage::getModel('sales/order_shipment')
                ->getCollection()
                ->addFieldToFilter('email_sent', array('null' => true));

            if ($fromDate) {
                $shipments = $shipments->addFieldToFilter('created_at', array('from' => $fromDate));
            }

            $shipments = $shipments->addFieldToFilter('created_at', array('to' => $toDate, 'datetime' => true));

            foreach ($shipments as $_shipment) {
                if (!$trackinCodeIsRequired || ($trackinCodeIsRequired && $_shipment->getTracksCollection()->getSize() > 0)) {
                    try {
                        $_shipment->sendEmail();
                        $_shipment->setEmailSent(true);
                        $_shipment->save();

                        Mage::log(
                            sprintf('Sent email for shipment %s', $_shipment->getIncrementId()),
                            null,
                            'shippingconfirmation.log',
                            true
                        );
                    } catch (Exception $e) {
                        Mage::logException($e);
                    }
                }
            }
        }
    }
}

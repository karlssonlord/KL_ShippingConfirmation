# Shipping Confirmation for Magento

#### Karlsson & Lord

[![Build Status](https://magnum.travis-ci.com/karlssonlord/KL_ShippingConfirmation.svg?token=sQXdpxAyyPpb144GJqMU)](https://magnum.travis-ci.com/karlssonlord/KL_ShippingConfirmation)

When creating shipments in Magento via the API method  [`salesOrderShipmentCreate`](http://www.magentocommerce.com/api/soap/sales/salesOrderShipment/sales_order_shipment.create.html) the option to send confirmation email is available. But there will be no tracking information available on the shipment. The tracking information is added via [`salesOrderShipmentAddTrack`](http://www.magentocommerce.com/api/soap/sales/salesOrderShipment/sales_order_shipment.addTrack.html) which don't allow any option to send a shipment confirmation.

This module has been created to address the above problem. Without modifying the API. It's all done by a scheduled script looking for shipments containing tracking information and where no shipping confirmation has been sent to the customer. For every shipment found a shipping confirmation is being sent and the flag saying whether the confirmation has been sent is updated.

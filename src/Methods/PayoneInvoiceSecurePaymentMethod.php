<?php

// strict

namespace Payone\Methods;

use Payone\Adapter\Config as ConfigAdapter;

/**
 * Class PayoneInvoiceSecurePaymentMethod
 */
class PayoneInvoiceSecurePaymentMethod extends PaymentAbstract
{
    const PAYMENT_CODE = 'PAYONE_PAYONE_INVOICE_SECURE';

    /**
     * Can the delivery address be different from the invoice address?
     *
     * @return bool
     */
    public function canHandleDifferingDeliveryAddress(): bool
    {
        return false;
    }

    /**
     * Check if all settings for the payment method are set.
     *
     * @param ConfigAdapter $configRepo
     * @return bool
     */
    public function validateSettings(ConfigAdapter $configRepo): bool
    {
        $portalId = $configRepo->get(self::PAYMENT_CODE . '.portalid');
        $key = $configRepo->get(self::PAYMENT_CODE . '.key');
        
        // A separate portal ID and key must be set for this payment method
        return (!empty($portalId) && !empty($key));
    }
}

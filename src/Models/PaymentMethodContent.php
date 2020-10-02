<?php

namespace Payone\Models;

use Payone\Methods\Klarna\PayoneKlarnaDirectDebitPaymentMethod;
use Payone\Methods\Klarna\PayoneKlarnaInstallmentsPaymentMethod;
use Payone\Methods\Klarna\PayoneKlarnaInvoicePaymentMethod;
use Payone\Methods\PayoneAmazonPayPaymentMethod;
use Payone\Methods\PayoneCCPaymentMethod;
use Payone\Methods\PayoneDirectDebitPaymentMethod;
use Payone\Methods\PayonePaydirektPaymentMethod;
use Payone\Methods\PayonePayPalPaymentMethod;
use Payone\Methods\PayoneSofortPaymentMethod;
use Plenty\Modules\Payment\Events\Checkout\GetPaymentMethodContent;

/**
 * Class PaymentMethodContent
 */
class PaymentMethodContent
{
    /**
     * @param string $paymentCode
     *
     * @return string
     */
    public function getPaymentContentType($paymentCode)
    {
        switch ($paymentCode) {
            case 'none':
            case PayoneDirectDebitPaymentMethod::PAYMENT_CODE:
            case PayoneCCPaymentMethod::PAYMENT_CODE:
                return GetPaymentMethodContent::RETURN_TYPE_HTML;
            case PayonePayPalPaymentMethod::PAYMENT_CODE:
            case PayonePaydirektPaymentMethod::PAYMENT_CODE:
            case PayoneSofortPaymentMethod::PAYMENT_CODE:
                return GetPaymentMethodContent::RETURN_TYPE_REDIRECT_URL;
            case PayoneAmazonPayPaymentMethod::PAYMENT_CODE:
                return GetPaymentMethodContent::RETURN_TYPE_HTML;
            case PayoneKlarnaInvoicePaymentMethod::PAYMENT_CODE:
                return GetPaymentMethodContent::RETURN_TYPE_HTML;
            case PayoneKlarnaInstallmentsPaymentMethod::PAYMENT_CODE:
                return GetPaymentMethodContent::RETURN_TYPE_HTML;
            case PayoneKlarnaDirectDebitPaymentMethod::PAYMENT_CODE:
                return GetPaymentMethodContent::RETURN_TYPE_HTML;
        }

        return GetPaymentMethodContent::RETURN_TYPE_CONTINUE;
    }
}

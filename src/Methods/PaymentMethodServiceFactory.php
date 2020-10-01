<?php

namespace Payone\Methods;

use Payone\Methods\Klarna\PayoneKlarnaDirectDebitPaymentMethod;
use Payone\Methods\Klarna\PayoneKlarnaInstallmentsPaymentMethod;
use Payone\Methods\Klarna\PayoneKlarnaInvoicePaymentMethod;

/**
 * Class PaymentMethodServiceFactory
 */
class PaymentMethodServiceFactory
{
    /**
     * @param $paymentCode
     *
     * @return PaymentAbstract
     */
    public static function create($paymentCode)
    {
        switch ($paymentCode) {
            case PayoneCODPaymentMethod::PAYMENT_CODE:
                return pluginApp(PayoneCODPaymentMethod::class);
            case PayoneInvoicePaymentMethod::PAYMENT_CODE:
                return pluginApp(PayoneInvoicePaymentMethod::class);
            case PayonePaydirektPaymentMethod::PAYMENT_CODE:
                return pluginApp(PayonePaydirektPaymentMethod::class);
            case PayonePayolutionInstallmentPaymentMethod::PAYMENT_CODE:
                return pluginApp(PayonePayolutionInstallmentPaymentMethod::class);
            case PayonePayPalPaymentMethod::PAYMENT_CODE:
                return pluginApp(PayonePayPalPaymentMethod::class);
            case PayonePrePaymentPaymentMethod::PAYMENT_CODE:
                return pluginApp(PayonePrePaymentPaymentMethod::class);
            case PayoneRatePayInstallmentPaymentMethod::PAYMENT_CODE:
                return pluginApp(PayoneRatePayInstallmentPaymentMethod::class);
            case PayoneSofortPaymentMethod::PAYMENT_CODE:
                return pluginApp(PayoneSofortPaymentMethod::class);
            case PayoneCCPaymentMethod::PAYMENT_CODE:
                return pluginApp(PayoneCCPaymentMethod::class);
            case PayoneDirectDebitPaymentMethod::PAYMENT_CODE:
                return pluginApp(PayoneDirectDebitPaymentMethod::class);
            case PayoneInvoiceSecurePaymentMethod::PAYMENT_CODE;
                return pluginApp(PayoneInvoiceSecurePaymentMethod::class);
            case PayoneAmazonPayPaymentMethod::PAYMENT_CODE;
                return pluginApp(PayoneAmazonPayPaymentMethod::class);
            case PayoneKlarnaDirectDebitPaymentMethod::PAYMENT_CODE;
                return pluginApp(PayoneKlarnaDirectDebitPaymentMethod::class);
            case PayoneKlarnaInstallmentsPaymentMethod::PAYMENT_CODE;
                return pluginApp(PayoneKlarnaInstallmentsPaymentMethod::class);
            case PayoneKlarnaInvoicePaymentMethod::PAYMENT_CODE;
                return pluginApp(PayoneKlarnaInvoicePaymentMethod::class);
        }
        throw new \InvalidArgumentException('Unknown payment method ' . $paymentCode);
    }
}

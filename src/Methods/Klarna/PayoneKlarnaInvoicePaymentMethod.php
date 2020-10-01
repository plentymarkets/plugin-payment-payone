<?php

namespace Payone\Methods\Klarna;

use Payone\Methods\Constants\FinancingType;
use Payone\Methods\PayoneKlarnaPaymentMethods;

/**
 * Class PayoneKlarnaInvoicePaymentMethod
 * Klarna - Pay later
 *
 * @package Payone\Methods\Klarna
 */
class PayoneKlarnaInvoicePaymentMethod extends PayoneKlarnaPaymentMethods
{
    const PAYMENT_CODE = 'PAYONE_PAYONE_KLARNA_INVOICE';

    const FINANCING_TYPE = FinancingType::KLARNA_INVOICE;

}

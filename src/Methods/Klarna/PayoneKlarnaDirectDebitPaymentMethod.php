<?php

namespace Payone\Methods\Klarna;

use Payone\Methods\Constants\FinancingType;
use Payone\Methods\PayoneKlarnaPaymentMethods;

/**
 * Class PayoneKlarnaDirectDebitPaymentMethod
 * Klarna - Pay now
 *
 * @package Payone\Methods\Klarna
 */
class PayoneKlarnaDirectDebitPaymentMethod extends PayoneKlarnaPaymentMethods
{
    const PAYMENT_CODE = 'PAYONE_PAYONE_KLARNA_DIRECT_DEBIT';

    const FINANCING_TYPE = FinancingType::KLARNA_DIRECT_DEBIT;

}

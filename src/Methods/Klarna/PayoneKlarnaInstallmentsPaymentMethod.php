<?php

namespace Payone\Methods\Klarna;

use Payone\Methods\Constants\FinancingType;
use Payone\Methods\PayoneKlarnaPaymentMethods;

/**
 * Class PayoneKlarnaInstallmentsPaymentMethod
 * Klarna - Slice it
 *
 * @package Payone\Methods\Klarna
 */
class PayoneKlarnaInstallmentsPaymentMethod extends PayoneKlarnaPaymentMethods
{
    const PAYMENT_CODE = 'PAYONE_PAYONE_KLARNA_INSTALLMENTS';

    const FINANCING_TYPE =  FinancingType::KLARNA_INSTALLMENTS;

}

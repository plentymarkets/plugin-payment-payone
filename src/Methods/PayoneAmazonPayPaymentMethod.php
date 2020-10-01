<?php

namespace Payone\Methods;

use Payone\Methods\Constants\ClearingType;

class PayoneAmazonPayPaymentMethod extends PaymentAbstract
{
    const PAYMENT_CODE = 'PAYONE_PAYONE_AMAZON_PAY';

    const CLEARING_TYPE = ClearingType::E_WALLET;
    const WALLET_TYPE = "AMZ";
}

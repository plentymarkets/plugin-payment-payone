<?php

namespace Payone\Methods;

use Payone\Methods\Constants\ClearingType;

/**
 * Class PayoneKlarnaPaymentMethods
 **
 * @package Payone\Methods
 */
class PayoneKlarnaPaymentMethods extends PaymentAbstract
{
    const CLEARING_TYPE = ClearingType::FINANCING;

    const SUPPORTED_COUNTRIES = [
        "AT",
        "DK",
        "FI",
        "DE",
        "NL",
        "NO",
        "SE",
        "CH"
    ];

    const SUPPORTED_CURRENCIES = [
        "EUR",
        "CHF",
        "DKK",
        "SEK",
        "NOK"
    ];
}

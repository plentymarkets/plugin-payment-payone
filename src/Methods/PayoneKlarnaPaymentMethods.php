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
    /**
     * @var string
     */
    public $clearingType = ClearingType::FINANCING;

    /**
     * @var array
     */
    static $supportedCountries = [
        "AT",
        "DK",
        "FI",
        "DE",
        "NL",
        "NO",
        "SE",
        "CH"
    ];

    /**
     * @var array
     */
    static $supportedCurrencies = [
        "EUR",
        "CHF",
        "DKK",
        "SEK",
        "NOK"
    ];
}

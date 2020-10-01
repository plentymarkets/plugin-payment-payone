<?php

namespace Payone\Methods\Constants;

/**
 * Class ClearingType
 *
 * @package Payone\Methods\Constants
 */
class ClearingType
{
    const DEBIT_PAYMENT             = "elv";
    const CREDIT_CARD               = "cc";
    const INVOICE                   = "rec";
    const CASH_ON_DELIVERY          = "cod";
    const PRE_PAYMENT               = "vor";
    const ONLINE_BANK_TRANSFER      = "sb";
    const E_WALLET                  = "wlt";
    const FINANCING                 = "fnc";
    const CASH_OR_HYBRID_PAYMENTS   = "csh";
}

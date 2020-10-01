<?php

namespace Payone\Methods\Constants;

class FinancingType
{
    const RATEPAY_INVOICING             = "RPV";
    const RATEPAY_INSTALLMENT           = "RPS";
    const RATEPAY_PREPAYMENT            = "RPP";
    const RATEPAY_DEBIT                 = "RPD";
    const PAYSAFE_PAY_LATER_INVOICING   = "PYV";
    const PAYSAFE_PAY_LATER_INSTALLMENT = "PYS";
    const PAYSAFE_PAY_LATER_MONTHLY     = "PYM";
    const PAYSAFE_PAY_LATER_DEBIT       = "PYD";
    const PAYPAL_INSTALLMENT            = "PPI";
    const KLARNA_INVOICE                = "KIV";
    const KLARNA_INSTALLMENTS           = "KIS";
    const KLARNA_DIRECT_DEBIT           = "KDD";
}

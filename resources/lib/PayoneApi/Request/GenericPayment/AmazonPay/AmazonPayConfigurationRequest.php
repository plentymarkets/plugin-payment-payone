<?php

namespace PayoneApi\Request\GenericPayment\AmazonPay;

use PayoneApi\Request\Parts\Config;
use PayoneApi\Request\Parts\SystemInfo;

class AmazonPayConfigurationRequest extends GenericAmazonPayRequestBase
{
    /**
     * AmazonPayConfigurationRequest constructor.
     *
     * @param Config $config
     * @param SystemInfo $info
     * @param string $currency
     */
    public function __construct(
        Config $config,
        SystemInfo $info,
        string $currency
    )
    {
        parent::__construct(
            [
                'action' => 'getconfiguration'
            ],
            $config,
            $info,
            $currency
        );
    }
}

<?php

namespace PayoneApi\Request\GenericPayment\AmazonPay;

use PayoneApi\Request\ClearingTypes;
use PayoneApi\Request\Parts\Config;
use PayoneApi\Request\Parts\SystemInfo;
use PayoneApi\Request\Types;
use PayoneApi\Request\WalletTypes;

class GenericAmazonPayRequestBase
{
    /**
     * @var string
     */
    protected $request = Types::GENERICPAYMENT;

    /**
     * @var string
     */
    protected $wallettype = WalletTypes::AMAZON_PAYMENTS;

    /**
     * @var string
     */
    protected $clearingtype = ClearingTypes::WALLET;

    /**
     * @var array
     */
    protected $addPaydata = [];

    /**
     * @var string
     */
    protected $currency;

    /**
     * @var Config
     */
    protected $config;

    /**
     * @var SystemInfo
     */
    protected $info;

    /**
     * GenericeRequestBase constructor.
     * @param array $payData
     * @param Config $config
     * @param SystemInfo $info
     * @param string $currency
     */
    public function __construct(
        array $payData,
        Config $config,
        SystemInfo $info,
        string $currency)
    {
        $this->addPaydata = $payData;
        $this->config = $config;
        $this->info = $info;
        $this->currency = $currency;
    }

    /**
     * @return string
     */
    public function getWallettype(): string
    {
        return $this->wallettype;
    }

    /**
     * @return string
     */
    public function getRequest(): string
    {
        return $this->request;
    }

    /**
     * @return string
     */
    public function getClearingtype(): string
    {
        return $this->clearingtype;
    }

    /**
     * @return array
     */
    public function getAddPaydata(): array
    {
        return $this->addPaydata;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @return Config
     */
    public function getConfig(): Config
    {
        return $this->config;
    }

    /**
     * @return SystemInfo
     */
    public function getInfo(): SystemInfo
    {
        return $this->info;
    }
}

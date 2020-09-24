<?php


namespace PayoneApi\Request\GenericPayment;


use PayoneApi\Request\ClearingTypes;
use PayoneApi\Request\Parts\Config;
use PayoneApi\Request\Parts\SystemInfo;
use PayoneApi\Request\Types;
use PayoneApi\Request\WalletTypes;

class GenericeRequestBase
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
    protected $add_paydata = [];

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

    public function __construct(
        array $payData,
        Config $config,
        SystemInfo $info,
        string $currency)
    {
        $this->add_paydata = $payData;
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
        return $this->add_paydata;
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

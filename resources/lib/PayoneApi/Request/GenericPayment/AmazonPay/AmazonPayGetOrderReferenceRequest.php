<?php

namespace PayoneApi\Request\GenericPayment\AmazonPay;

use PayoneApi\Request\Parts\Config;
use PayoneApi\Request\Parts\SystemInfo;

class AmazonPayGetOrderReferenceRequest extends GenericAmazonPayRequestBase
{
    /**
     * @var string
     */
    protected $amount;

    /**
     * @var string
     */
    protected $workorderid;

    /**
     * AmazonPayGetOrderReferenceRequest constructor.
     *
     * @param Config $config
     * @param SystemInfo $info
     * @param string $amazonReferenceId
     * @param string $amazonAddressToken
     * @param string $workOrderId
     * @param string $amount
     * @param string $currency
     */
    public function __construct(
        Config $config,
        SystemInfo $info,
        string $amazonReferenceId,
        string $amazonAddressToken,
        string $workOrderId,
        string $amount,
        string $currency
    )
    {
        parent::__construct(
            [
                'action' => 'getorderreferencedetails',
                'amazon_reference_id' => $amazonReferenceId,
                'amazon_address_token' => $amazonAddressToken,
            ],
            $config,
            $info,
            $currency
        );

        $this->workorderid = $workOrderId;
        $this->amount = $amount;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function getWorkorderid(): string
    {
        return $this->workorderid;
    }
}

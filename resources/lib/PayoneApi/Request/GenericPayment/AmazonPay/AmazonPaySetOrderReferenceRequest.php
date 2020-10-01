<?php

namespace PayoneApi\Request\GenericPayment\AmazonPay;

use PayoneApi\Request\Parts\Config;
use PayoneApi\Request\Parts\SystemInfo;

class AmazonPaySetOrderReferenceRequest extends GenericAmazonPayRequestBase
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
     * AmazonPaySetOrderReferenceRequest constructor.
     *
     * @param Config $config
     * @param SystemInfo $info
     * @param string $amazonReferenceId
     * @param string $workOrderId
     * @param string $amount
     * @param string $currency
     */
    public function __construct(
        Config $config,
        SystemInfo $info,
        string $amazonReferenceId,
        string $workOrderId,
        string $amount,
        string $currency
    )
    {
        parent::__construct(
            [
                'action' => 'setorderreferencedetails',
                'amazon_reference_id' => $amazonReferenceId,
            ],
            $config,
            $info,
            $currency
        );

        $this->workorderid = $workOrderId;
        $this->amount = $amount;
    }

    /**
     * @return string
     */
    public function getAmount(): string
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

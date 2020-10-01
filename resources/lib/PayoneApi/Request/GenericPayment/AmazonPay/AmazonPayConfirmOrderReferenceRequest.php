<?php

namespace PayoneApi\Request\GenericPayment\AmazonPay;

use PayoneApi\Request\Parts\Config;
use PayoneApi\Request\Parts\SystemInfo;

class AmazonPayConfirmOrderReferenceRequest extends GenericAmazonPayRequestBase
{
    /**
     * @var string
     */
    private $amount;

    /**
     * @var string
     */
    private $workorderid;

    /**
     * @var string
     */
    private $successurl;

    /**
     * @var string
     */
    private $errorurl;

    /**
     * AmazonPayGetOrderReferenceRequest constructor.
     *
     * @param Config $config
     * @param SystemInfo $info
     * @param string $amazonReferenceId
     * @param string $reference
     * @param string $workOrderId
     * @param string $amount
     * @param string $currency
     * @param string $successurl
     * @param string $errorurl
     */
    public function __construct(
        Config $config,
        SystemInfo $info,
        string $amazonReferenceId,
        string $reference,
        string $workOrderId,
        string $amount,
        string $currency,
        string $successurl,
        string $errorurl
    )
    {
        parent::__construct(
            [
                'action' => 'confirmorderreference',
                'reference' => $reference,
                'amazon_reference_id' => $amazonReferenceId,
            ],
            $config,
            $info,
            $currency
        );

        $this->workorderid = $workOrderId;
        $this->amount = $amount;
        $this->successurl = $successurl;
        $this->errorurl = $errorurl;
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

    /**
     * @return string
     */
    public function getSuccessurl(): string
    {
        return $this->successurl;
    }

    /**
     * @return string
     */
    public function getErrorurl(): string
    {
        return $this->errorurl;
    }
}

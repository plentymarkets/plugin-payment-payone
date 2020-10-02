<?php

namespace Payone\Migrations;

use Payone\Adapter\Logger;
use Payone\Helpers\PaymentHelper;
use Payone\PluginConstants;
use Plenty\Modules\Payment\Method\Contracts\PaymentMethodRepositoryContract;

/**
 * Migration to create payment methods
 *
 * Class CreateKlarnaPaymentMethods
 */
class CreateKlarnaPaymentMethods
{
    /**
     * @var PaymentMethodRepositoryContract
     */
    private $paymentMethodRepo;

    /**
     * @var PaymentHelper
     */
    private $paymentHelper;
    /**
     * @var Logger
     */
    private $logger;

    /**
     * CreatePaymentMethod constructor.
     *
     * @param PaymentMethodRepositoryContract $paymentMethodRepo
     * @param PaymentHelper $paymentHelper
     * @param Logger $logger
     */
    public function __construct(
        PaymentMethodRepositoryContract $paymentMethodRepo,
        PaymentHelper $paymentHelper,
        Logger $logger
    ) {
        $this->paymentMethodRepo = $paymentMethodRepo;
        $this->paymentHelper = $paymentHelper;
        $this->logger = $logger;
    }

    /**
     * Run on plugin build
     *
     * Create Payone payment methods
     */
    public function run()
    {
        foreach ($this->paymentHelper->getPaymentCodes() as $paymentCode) {
            if ($this->paymentHelper->getMopId($paymentCode) != 'no_paymentmethod_found') {
                $this->logger->debug(' Skipping payment method creation of ' . $paymentCode);
                continue;
            }
            $this->logger->debug(' Creating payment method ' . $paymentCode);
            $this->paymentMethodRepo->createPaymentMethod(
                [
                    'pluginKey' => PluginConstants::NAME,
                    'paymentKey' => $paymentCode,
                    'name' => $paymentCode,
                ]
            );
        }
    }
}

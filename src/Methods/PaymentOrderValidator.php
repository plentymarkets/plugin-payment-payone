<?php

namespace Payone\Methods;

use Payone\Adapter\Logger;
use Payone\Helpers\AddressHelper;
use Payone\Services\SettingsService;
use Plenty\Modules\Authorization\Services\AuthHelper;
use Plenty\Modules\Order\Contracts\OrderRepositoryContract;
use Plenty\Modules\Order\Models\Order;

class PaymentOrderValidator
{
    /**
     * @var AddressHelper
     */
    private $addressHelper;

    /**
     * @var Logger
     */
    private $logger;

    /**
     * PaymentValidator constructor.
     *
     * @param AddressHelper $addressHelper
     * @param Logger $logger
     */
    public function __construct(AddressHelper $addressHelper, Logger $logger)
    {
        $this->addressHelper = $addressHelper;
        $this->logger = $logger;
    }

    /**
     * @param PaymentAbstract $payment
     *
     * @return bool
     */
    public function validate(PaymentAbstract $payment, SettingsService $settingsService, int $orderId)
    {
        /** @var OrderRepositoryContract $orderRepositoryContract */
        $orderRepositoryContract = pluginApp(OrderRepositoryContract::class);
        /** @var AuthHelper $authHelper */
        $authHelper = pluginApp(AuthHelper::class);
        /** @var Order $order */
        $order = $authHelper->processUnguarded(
            function () use ($orderRepositoryContract, $orderId) {
                return $orderRepositoryContract->findById($orderId, ['amounts', 'addresses']);
            }
        );

        $orderAmount = $order->amount->invoiceTotal;
        if ($payment->getMinCartAmount() && $orderAmount < $payment->getMinCartAmount()) {
            $this->log($payment->getName(), 'Payment.minCartAmount', $orderAmount);
            return false;
        }

        if ($payment->getMaxCartAmount() && $orderAmount > $payment->getMaxCartAmount()) {
            $this->log($payment->getName(), 'Payment.maxCartAmount', $orderAmount);
            return false;
        }

        $billingAddress = $order->billingAddress;
        $deliveryAddress = $order->deliveryAddress;
        if (!$billingAddress) {
            // TODO: shouldn't this be 'return false'?
            return true;
        }

        if (!in_array($billingAddress->countryId, $payment->getAllowedCountries())) {
            $this->log($payment->getName(), 'Payment.countryNotAllowed', $billingAddress->countryId);
            return false;
        }
        
        if (!$payment->canHandleDifferingDeliveryAddress() && $deliveryAddress && $billingAddress->id != $deliveryAddress->id) {
            return false;
        }
        
        if (!$payment->validateSettings($settingsService)) {
            return false;
        }
        
        if (!$payment->isActiveForCurrency($order->amount->currency)) {
            return false;
        }

        return true;
    }

    /**
     * @param string $payment
     * @param string $code
     * @param string $value
     */
    protected function log($payment, $code, $value)
    {
        $logger = $this->logger->setIdentifier(__METHOD__);
        $logger->debug(
            $code,
            [
                'basketID' => $this->basket->id,
                'customer' => $this->basket->customerId,
                'payment' => $payment,
                'value' => $value,
            ]
        );
    }
}

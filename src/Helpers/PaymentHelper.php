<?php

//strict

namespace Payone\Helpers;

use Payone\Methods\Klarna\PayoneKlarnaDirectDebitPaymentMethod;
use Payone\Methods\Klarna\PayoneKlarnaInstallmentsPaymentMethod;
use Payone\Methods\Klarna\PayoneKlarnaInvoicePaymentMethod;
use Payone\Methods\PayoneAmazonPayPaymentMethod;
use Payone\Methods\PayoneCCPaymentMethod;
use Payone\Methods\PayoneCODPaymentMethod;
use Payone\Methods\PayoneDirectDebitPaymentMethod;
use Payone\Methods\PayoneInvoicePaymentMethod;
use Payone\Methods\PayoneInvoiceSecurePaymentMethod;
use Payone\Methods\PayonePaydirektPaymentMethod;
use Payone\Methods\PayonePayolutionInstallmentPaymentMethod;
use Payone\Methods\PayonePayPalPaymentMethod;
use Payone\Methods\PayonePrePaymentPaymentMethod;
use Payone\Methods\PayoneRatePayInstallmentPaymentMethod;
use Payone\Methods\PayoneSofortPaymentMethod;
use Payone\PluginConstants;
use Plenty\Modules\Payment\Contracts\PaymentOrderRelationRepositoryContract;
use Plenty\Modules\Payment\Method\Contracts\PaymentMethodRepositoryContract;
use Plenty\Modules\Payment\Method\Models\PaymentMethod;
use Plenty\Modules\Payment\Models\Payment;
use Plenty\Modules\Payment\Models\PaymentProperty;

/**
 * Class PaymentHelper
 */
class PaymentHelper
{
    private $mops = [];

    /**
     * @var PaymentMethodRepositoryContract
     */
    private $paymentMethodRepo;

    /**
     * @var PaymentOrderRelationRepositoryContract
     */
    private $paymentOrderRelationRepo;

    /**
     * PaymentHelper constructor.
     *
     * @param PaymentMethodRepositoryContract $paymentMethodRepo
     * @param PaymentOrderRelationRepositoryContract $paymentOrderRelationRepo
     */
    public function __construct(
        PaymentMethodRepositoryContract $paymentMethodRepo,
        PaymentOrderRelationRepositoryContract $paymentOrderRelationRepo
    ) {
        $this->paymentMethodRepo = $paymentMethodRepo;
        $this->paymentOrderRelationRepo = $paymentOrderRelationRepo;
    }

    /**
     * Get the ID of the payment method
     *
     * @param string $paymentCode
     *
     * @return string
     */
    public function getMopId($paymentCode)
    {
        if (isset($this->mops[$paymentCode])) {
            return $this->mops[$paymentCode];
        }
        $paymentMethods = $this->paymentMethodRepo->allForPlugin(PluginConstants::NAME);
        if (!$paymentMethods) {
            return 'no_paymentmethod_found';
        }
        /** @var PaymentMethod $paymentMethod */
        foreach ($paymentMethods as $paymentMethod) {
            if ($paymentMethod->paymentKey == $paymentCode) {
                return $paymentMethod->id;
            }
        }

        return 'no_paymentmethod_found';
    }

    /**
     * Get all Payolution payment ids
     *
     * @return array
     */
    public function getMops()
    {
        if ($this->mops) {
            return $this->mops;
        }
        foreach ($this->getPaymentCodes() as $paymentCode) {
            $this->mops[$paymentCode] = $this->getMopId($paymentCode);
        }

        return $this->mops;
    }

    /**
     * @param int $mopId
     *
     * @return string
     */
    public function getPaymentCodeByMop($mopId)
    {
        if (!$this->mops) {
            $this->getMops();
        }
        $mops = array_flip($this->mops);

        return $mops[$mopId];
    }

    /**
     * Get all payolution payment codes
     *
     * @return array
     */
    public function getPaymentCodes()
    {
        return [
            PayoneInvoicePaymentMethod::PAYMENT_CODE,
            PayonePaydirektPaymentMethod::PAYMENT_CODE,
            PayonePayolutionInstallmentPaymentMethod::PAYMENT_CODE,
            PayonePayPalPaymentMethod::PAYMENT_CODE,
            PayoneRatePayInstallmentPaymentMethod::PAYMENT_CODE,
            PayoneSofortPaymentMethod::PAYMENT_CODE,
            PayoneCODPaymentMethod::PAYMENT_CODE,
            PayonePrePaymentPaymentMethod::PAYMENT_CODE,
            PayoneCCPaymentMethod::PAYMENT_CODE,
            PayoneDirectDebitPaymentMethod::PAYMENT_CODE,
            PayoneInvoiceSecurePaymentMethod::PAYMENT_CODE,
            PayoneAmazonPayPaymentMethod::PAYMENT_CODE,
            PayoneKlarnaDirectDebitPaymentMethod::PAYMENT_CODE,
            PayoneKlarnaInstallmentsPaymentMethod::PAYMENT_CODE,
            PayoneKlarnaInvoicePaymentMethod::PAYMENT_CODE
        ];
    }

    /**
     * @param int $selectedPaymentId
     *
     * @return \Plenty\Modules\Payment\Method\Models\PaymentMethod
     */
    public function getPaymentMethodById(int $selectedPaymentId)
    {
        return $this->paymentMethodRepo->findByPaymentMethodId($selectedPaymentId);
    }

    /**
     * @param int $mopId
     *
     * @return bool
     */
    public function isPayonePayment($mopId)
    {
        return in_array($mopId, $this->getMops());
    }

    /**
     * @param Payment $payment
     * @param int $propertyTypeConstant
     *
     * @return string
     */
    public function getPaymentPropertyValue($payment, $propertyTypeConstant)
    {
        $properties = $payment->properties;
        if (!$properties) {
            return '';
        }
        /* @var $property PaymentProperty */
        foreach ($properties as $property) {
            if (!($property instanceof PaymentProperty)) {
                continue;
            }
            if ($property->typeId == $propertyTypeConstant) {
                return (string) $property->value;
            }
        }

        return '';
    }

    public function raiseSequenceNumber(Payment $payment)
    {
        foreach ($payment->properties as $property) {
            if($property->typeId == PaymentProperty::TYPE_TRANSACTION_CODE) {
                $property->value++;
                return $payment;
            }
        }

        $properties = $payment->properties;
        $properties[] = $this->createPaymentProperty(PaymentProperty::TYPE_TRANSACTION_CODE, 1);
        $payment->properties = $properties;

        return $payment;
    }


    /**
     * @param Payment $payment
     * @param int $pamentPropertyTypeId
     * @param string $value
     *
     * @return Payment
     */
    public function createOrUpdatePaymentProperty($payment, $pamentPropertyTypeId, $value)
    {
        foreach ($payment->properties as $property) {
            if (!($property instanceof PaymentProperty)) {
                continue;
            }
            if ($property->typeId === $pamentPropertyTypeId) {
                $property->value = $value;
                return $payment;
            }
        }

        $paymentProperties = $payment->properties;
        $paymentProperties[] = $this->createPaymentProperty($pamentPropertyTypeId, $value);

        return $payment;
    }

    /**
     * Returns a PaymentProperty with the given params
     *
     * @param int $typeId
     * @param string $value
     *
     * @return PaymentProperty
     */
    protected function createPaymentProperty($typeId, $value)
    {
        /** @var PaymentProperty $paymentProperty */
        $paymentProperty = pluginApp(PaymentProperty::class);

        $paymentProperty->typeId = $typeId;
        $paymentProperty->value = $value . '';

        return $paymentProperty;
    }
}

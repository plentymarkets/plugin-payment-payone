<?php

namespace Payone\Providers\Api\Request;

use Payone\Helpers\ShopHelper;
use Payone\Methods\Klarna\PayoneKlarnaDirectDebitPaymentMethod;
use Payone\Methods\Klarna\PayoneKlarnaInstallmentsPaymentMethod;
use Payone\Methods\Klarna\PayoneKlarnaInvoicePaymentMethod;
use Payone\Methods\PayoneAmazonPayPaymentMethod;
use Payone\Providers\Api\Request\Models\GenericPayment;

class GenericPaymentDataProvider extends DataProviderAbstract
{

    /**
     * @param string $paymentCode
     * @return array
     * @throws \Exception
     */
    private function getDefaultPaymentRequestData(string $paymentCode): array
    {
        $requestParams = $this->getDefaultRequestData($paymentCode);
        $requestParams['request'] = GenericPayment::REQUEST_TYPE;

        switch ($paymentCode) {
            case PayoneAmazonPayPaymentMethod::PAYMENT_CODE:
                $requestParams['clearingtype'] = PayoneAmazonPayPaymentMethod::CLEARING_TYPE;
                $requestParams['wallettype'] = PayoneAmazonPayPaymentMethod::CLEARING_TYPE;
                break;
            case PayoneKlarnaInvoicePaymentMethod::PAYMENT_CODE:
                $requestParams['clearingtype'] = PayoneKlarnaInvoicePaymentMethod::CLEARING_TYPE;
                $requestParams['financingtype'] = PayoneKlarnaInvoicePaymentMethod::FINANCING_TYPE;
                break;
            case PayoneKlarnaDirectDebitPaymentMethod::PAYMENT_CODE:
                $requestParams['clearingtype'] = PayoneKlarnaDirectDebitPaymentMethod::CLEARING_TYPE;
                $requestParams['financingtype'] = PayoneKlarnaDirectDebitPaymentMethod::FINANCING_TYPE;
                break;
            case PayoneKlarnaInstallmentsPaymentMethod::PAYMENT_CODE:
                $requestParams['clearingtype'] = PayoneKlarnaInstallmentsPaymentMethod::CLEARING_TYPE;
                $requestParams['financingtype'] = PayoneKlarnaInstallmentsPaymentMethod::FINANCING_TYPE;
                break;
            default:
                throw new \Exception('Paymentcode not supported.', $paymentCode);
        }

        return $requestParams;
    }

    /**
     * @param string $paymentCode
     * @param string $currency
     * @return array
     * @throws \Exception
     */
    public function getGetConfigRequestData(string $paymentCode, string $currency): array
    {
        $requestParams = $this->getDefaultPaymentRequestData($paymentCode);

        // Currency not mentioned in API-Doc of Payone
        $requestParams['currency'] = $currency;

        $requestParams['add_paydata']['action'] = GenericPayment::ACTIONTYPE_GETCONFIGURATION;

        $this->validator->validate($requestParams);
        return $requestParams;
    }

    /**
     * @param string $paymentCode
     * @param string $workOrderId
     * @param string $amazonAddressToken
     * @param string $amazonReferenceId
     * @param string $currency
     * @param string $amount
     * @return array
     * @throws \Exception
     */
    public function getGetOrderReferenceDetailsRequestData(string $paymentCode,
                                                           string $workOrderId,
                                                           string $amazonAddressToken,
                                                           string $amazonReferenceId,
                                                           string $currency,
                                                           string $amount): array
    {
        $requestParams = $this->getDefaultPaymentRequestData($paymentCode);

        // Currency not mentioned in API-Doc of Payone
        $requestParams['currency'] = $currency;
        // amount in smallest unit
        $requestParams['amount'] = $amount * 100;


        $requestParams['add_paydata']['action'] = GenericPayment::ACTIONTYPE_GETORDERREFERENCEDETAILS;
        $requestParams['add_paydata']['amazon_address_token'] = $amazonAddressToken;
        $requestParams['add_paydata']['amazon_reference_id'] = $amazonReferenceId;
        $requestParams['workorderid'] = $workOrderId;

        $this->validator->validate($requestParams);
        return $requestParams;
    }

    /**
     * @param string $paymentCode
     * @param string $workOrderId
     * @param string $amazonReferenceId
     * @param string $currency
     * @param string $amount
     * @return array
     * @throws \Exception
     */
    public function getSetOrderReferenceDetailsRequestData(string $paymentCode,
                                                           string $workOrderId,
                                                           string $amazonReferenceId,
                                                           string $currency,
                                                           string $amount): array
    {
        $requestParams = $this->getDefaultPaymentRequestData($paymentCode);

        // Currency not mentioned in API-Doc of Payone
        $requestParams['currency'] = $currency;
        // amount in smallest unit
        $requestParams['amount'] = $amount * 100;


        $requestParams['add_paydata']['action'] = GenericPayment::ACTIONTYPE_SETORDERREFERENCEDETAILS;
        $requestParams['add_paydata']['amazon_reference_id'] = $amazonReferenceId;
        $requestParams['workorderid'] = $workOrderId;

        $this->validator->validate($requestParams);
        return $requestParams;
    }

    /**
     * @param string $paymentCode
     * @param string $workOrderId
     * @param string $reference
     * @param string $amazonReferenceId
     * @param string $amount
     * @param string $currency
     * @param string $basketId
     * @return array
     * @throws \Exception
     */
    public function getConfirmOrderReferenceRequestData(string $paymentCode,
                                                        string $workOrderId,
                                                        string $reference,
                                                        string $amazonReferenceId,
                                                        string $amount,
                                                        string $currency,
                                                        string $basketId): array
    {
        $requestParams = $this->getDefaultPaymentRequestData($paymentCode);

        // Currency not mentioned in API-Doc of Payone
        $requestParams['currency'] = $currency;
        // amount in smallest unit
        $requestParams['amount'] = $amount * 100;

        $requestParams['add_paydata']['action'] = GenericPayment::ACTIONTYPE_CONFIRMORDERREFERENCE;
        $requestParams['add_paydata']['reference'] = $reference;
        $requestParams['add_paydata']['amazon_reference_id'] = $amazonReferenceId;
        $requestParams['workorderid'] = $workOrderId;

        /** @var ShopHelper $shopHelper */
        $shopHelper = pluginApp(ShopHelper::class);

        $successParam = '';
        if (strlen($basketId)) {
            $successParam = '?transactionBasketId=' . $basketId;
        }

        $requestParams['successurl'] = $shopHelper->getPlentyDomain() . '/payment/payone/checkoutSuccess' . $successParam;
        $requestParams['errorurl'] = $shopHelper->getPlentyDomain() . '/payment/payone/error';

        $this->validator->validate($requestParams);
        return $requestParams;
    }

    /**
     * @param string $paymentCode
     * @param string $currency
     * @param float $amount
     * @return array
     * @throws \Exception
     */
    public function getStartSessionRequestData(string $paymentCode, string $currency, float $amount)
    {
        $requestParams = $this->getDefaultPaymentRequestData($paymentCode);

        // Currency not mentioned in API-Doc of Payone
        $requestParams['currency'] = $currency;
        // amount in smallest unit
        $requestParams['amount'] = $amount * 100;

        $requestParams['add_paydata']['action'] = GenericPayment::ACTIONTYPE_STARTSESSION;

        $this->validator->validate($requestParams);
        return $requestParams;
    }
}

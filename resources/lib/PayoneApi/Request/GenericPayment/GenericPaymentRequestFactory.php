<?php

namespace PayoneApi\Request\GenericPayment;

use PayoneApi\Lib\Version;
use PayoneApi\Request\GenericPayment\AmazonPay\AmazonPayConfigurationRequest;
use PayoneApi\Request\GenericPayment\AmazonPay\AmazonPayConfirmOrderReferenceRequest;
use PayoneApi\Request\GenericPayment\AmazonPay\AmazonPayGetOrderReferenceRequest;
use PayoneApi\Request\GenericPayment\AmazonPay\AmazonPaySetOrderReferenceRequest;
use PayoneApi\Request\Parts\SystemInfo;
use PayoneApi\Request\Parts\Config;

class GenericPaymentRequestFactory
{
    /**
     * @param string $paymentMethod
     * @param array $data
     * @param string|null $referenceId
     * @return mixed
     */
    public static function create(string $paymentMethod, array $data, string $referenceId = null)
    {
        $config = null;
        if($data['context']) {
            $context = $data['context'];
            $config = new Config(
                $context['aid'],
                $context['mid'],
                $context['portalid'],
                $context['key'],
                $context['mode']
            );
        }

        $systemInfo = null;
        if($data['systemInfo']) {
            $systemInfoData = $data['systemInfo'];
            $systemInfo = new SystemInfo(
                $systemInfoData['vendor'],
                Version::getVersion(),
                $systemInfoData['module'],
                $systemInfoData['module_version']
            );
        }

        if ($data['add_paydata'] && array_key_exists('action', $data['add_paydata']) &&
            $config instanceof Config && $systemInfo instanceof SystemInfo) {
            switch ($data['add_paydata']['action']) {
                case 'getconfiguration':
                    // Other configs can be added here. Just add an if-condition for $paymentMethod
                    return new AmazonPayConfigurationRequest($config, $systemInfo, $data['currency']);
                case 'getorderreferencedetails':
                    return new AmazonPayGetOrderReferenceRequest(
                        $config,
                        $systemInfo,
                        $data['add_paydata']['amazon_reference_id'],
                        $data['add_paydata']['amazon_address_token'],
                        $data['workorderid'],
                        $data['amount'],
                        $data['currency']);
                case 'setorderreferencedetails':
                    return new AmazonPaySetOrderReferenceRequest(
                        $config,
                        $systemInfo,
                        $data['add_paydata']['amazon_reference_id'],
                        $data['workorderid'],
                        $data['amount'],
                        $data['currency']);
                case 'confirmorderreference':
                    return new AmazonPayConfirmOrderReferenceRequest(
                        $config,
                        $systemInfo,
                        $data['add_paydata']['amazon_reference_id'],
                        $data['add_paydata']['reference'],
                        $data['workorderid'],
                        $data['amount'],
                        $data['currency'],
                        $data['successurl'],
                        $data['errorurl']);
            }
        }

        return null;
    }
}

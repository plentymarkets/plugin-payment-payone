<?php
require_once __DIR__ . '/autoload.php';

use PayoneApi\Api\Client;
use PayoneApi\Api\PostApi;
use PayoneApi\Lib\Version;
use PayoneApi\Request\ArraySerializer;
use PayoneApi\Request\GenericPayment\GenericPaymentRequestFactory;
use PayoneApi\Response\ClientErrorResponse;

try {
    if (class_exists('Payone\Tests\Integration\Mock\SdkRestApi')) {
        $sdkRestApi = Payone\Tests\Integration\Mock\SdkRestApi::class;
    } else {
        $sdkRestApi = \SdkRestApi::class;
    }
    $data = [];

    $data['request'] = $sdkRestApi::getParam('request');
    $data['clearingtype'] = $sdkRestApi::getParam('clearingtype');
    $data['wallettype'] = $sdkRestApi::getParam('wallettype');
    $data['add_paydata'] = $sdkRestApi::getParam('add_paydata');
    $data['workorderid'] = $sdkRestApi::getParam('workorderid');

    $data['currency'] = $sdkRestApi::getParam('currency');
    $data['amount'] = $sdkRestApi::getParam('amount');

    $data['successurl'] = $sdkRestApi::getParam('successurl');
    $data['errorurl'] = $sdkRestApi::getParam('errorurl');
    $data['backurl'] = $sdkRestApi::getParam('backurl');

    $data['context'] = $sdkRestApi::getParam('context');
    $data['systemInfo'] = $sdkRestApi::getParam('systemInfo');
    $data['address'] = $sdkRestApi::getParam('address');

    $data['basket'] = $sdkRestApi::getParam('basket');
    $data['basketItems'] = $sdkRestApi::getParam('basketItems');

    $paymentMethod = $sdkRestApi::getParam('paymentMethod');

    $request = GenericPaymentRequestFactory::create($paymentMethod, $data);

    $serializer = new ArraySerializer();
    $client = new PostApi(new Client(), $serializer);
    $response = $client->doRequest($request);
} catch (Exception $e) {
    $errorResponse = new ClientErrorResponse(
        'SdkRestApi error: ' . $e->getMessage() . PHP_EOL .
        'Lib version: ' . Version::getVersion() . PHP_EOL .
        $e->getTraceAsString()
    );

    return $errorResponse->jsonSerialize();
}

if (!$response->getSuccess()) {
    $errorResponse = new ClientErrorResponse(
        'Request successful but response invalid. ' . PHP_EOL .
        'Lib version: ' . Version::getVersion() . PHP_EOL .
        'Message: ' . $response->getErrorMessage() . PHP_EOL .
        'Request was : ' . json_encode($serializer->serialize($request), JSON_PRETTY_PRINT) . PHP_EOL .
        'Response was: ' . json_encode($serializer->serialize($response), JSON_PRETTY_PRINT),
        $request,
        $response
    );

    return $errorResponse->jsonSerialize();
}

return $response->jsonSerialize();

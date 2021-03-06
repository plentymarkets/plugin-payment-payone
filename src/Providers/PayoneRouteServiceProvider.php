<?php

namespace Payone\Providers;

use Payone\Controllers\AmazonPayController;
use Plenty\Plugin\RouteServiceProvider;
use Plenty\Plugin\Routing\Router;

/**
 * Class PayoneRouteServiceProvider
 */
class PayoneRouteServiceProvider extends RouteServiceProvider
{
    /**
     * @param Router $router
     */
    public function map(Router $router)
    {

        $router->post('payment/payone/status/', 'Payone\Controllers\StatusController@index');

        $router->post('payment/payone/checkout/doAuth', 'Payone\Controllers\CheckoutController@doAuth');
        $router->post('payment/payone/checkout/storeCCCheckResponse', 'Payone\Controllers\CheckoutController@storeCCCheckResponse');
        $router->post('payment/payone/checkout/storeAccountData', 'Payone\Controllers\CheckoutController@storeAccountData');

        $router->get('payment/payone/checkout/amazonPay/loginButton', 'Payone\Controllers\AmazonPayController@getAmazonPayLoginWidget');
        $router->post('payment/payone/checkout/amazonPay/renderWidgets', 'Payone\Controllers\AmazonPayController@renderWidgets');
        $router->post('payment/payone/checkout/amazonPay/getOrderReference', 'Payone\Controllers\AmazonPayController@getOrderReference');
        $router->get('payment/payone/checkout/amazonPay/placeOrder', 'Payone\Controllers\AmazonPayController@placeOrder');

        $router->get('payment/payone/error', 'Payone\Controllers\CheckoutController@redirectWithNotice');
        $router->get('payment/payone/checkoutSuccess', 'Payone\Controllers\CheckoutController@checkoutSuccess');
        $router->get('payment/payone/checkout/getSepaMandateStep', 'Payone\Controllers\CheckoutController@getSepaMandateStep');
    }
}

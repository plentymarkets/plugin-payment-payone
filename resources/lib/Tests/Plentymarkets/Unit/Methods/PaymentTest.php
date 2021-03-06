<?php

namespace Payone\Tests\Unit;

use Payone\Helpers\PaymentHelper;
use Payone\Mocks\Config;
use Plenty\Modules\Payment\Contracts\PaymentOrderRelationRepositoryContract;
use Plenty\Modules\Payment\Method\Contracts\PaymentMethodRepositoryContract;
use Plenty\Plugin\ConfigRepository;

class PaymentTest extends \PHPUnit_Framework_TestCase
{
    public function testConfigContainsBasicSettings()
    {
        $configRepo = $this->createMock(ConfigRepository::class);

        $config = new Config();
        $paymentHelper = new PaymentHelper(
            self::createMock(PaymentMethodRepositoryContract::class),
            self::createMock(PaymentOrderRelationRepositoryContract::class),
            $configRepo
        );

        $config = $config->getConfig();
        $paymentMethods = $paymentHelper->getPaymentCodes();
        $this->assertTrue(count($paymentMethods) > 0, 'No payment methods defined');

        foreach ($paymentMethods as $method) {
            $this->assertNotEmpty($config[$method . '.' . 'active']);
            $this->assertNotEmpty($config[$method . '.' . 'name']);
            $this->assertNotEmpty($config[$method . '.' . 'description']);
        }
    }
}

<?php

namespace Payone\Methods;

use Payone\Adapter\Config as ConfigAdapter;
use Payone\PluginConstants;
use Plenty\Modules\Payment\Method\Contracts\PaymentMethodService;
use Plenty\Plugin\Application;

abstract class PaymentAbstract extends PaymentMethodService
{
    const PAYMENT_CODE = 'Payone';

    /**
     * @var ConfigAdapter
     */
    private $configRepo;
    /**
     * @var PaymentValidator
     */
    private $paymentValidator;

    /**
     * @var Application
     */
    private $app;

    /**
     * PaymentAbstract constructor.
     *
     * @param Application $application
     * @param PaymentValidator $paymentValidator
     * @param ConfigAdapter $configRepo
     */
    public function __construct(
        Application $application,
        PaymentValidator $paymentValidator,
        ConfigAdapter $configRepo
    ) {
        $this->paymentValidator = $paymentValidator;
        $this->configRepo = $configRepo;
        $this->app = $app = $application;
    }

    /**
     * @return bool
     */
    public function isActive()
    {
        return (bool) $this->configRepo->get($this::PAYMENT_CODE . '.active')
            && $this->paymentValidator->validate($this);
    }

    /**
     * Get shown name
     *
     * @return string
     */
    public function getName(): string
    {
        $name = $this->configRepo->get($this::PAYMENT_CODE . '.name');

        return $name ? (string) $name : '';
    }

    /**
     * @return float
     */
    public function getFee(): float
    {
        return 0.;
    }

    /**
     * @return string
     */
    public function getIcon(): string
    {
        $pluginPath = $this->app->getUrlPath(PluginConstants::NAME);

        return $pluginPath . '/images/logos/' . $this::PAYMENT_CODE . '.png';
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        $description = $this->configRepo->get($this::PAYMENT_CODE . '.description');

        return $description ? $description : '';
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this::PAYMENT_CODE;
    }

    /**
     * @return float
     */
    public function getMaxCartAmount()
    {
        $amount = $this->configRepo->get($this::PAYMENT_CODE . '.maxCartAmount');

        return $amount ? (float) $amount : 0.;
    }

    /**
     * @return float
     */
    public function getMinCartAmount()
    {
        $amount = $this->configRepo->get($this::PAYMENT_CODE . '.minCartAmount');

        return $amount ? (float) $amount : 0.;
    }

    /**
     * @return array
     */
    public function getAllowedCountries()
    {
        $countries = explode(
            ',',
            $this->configRepo->get($this::PAYMENT_CODE . '.allowedCountries')
        );

        return $countries;
    }

    /**
     * Check if this payment method should be searchable in the backend
     *
     * @return bool
     */
    public function isBackendSearchable():bool
    {
        return true;
    }

    /**
     * Check if this payment method should be active in the backend
     *
     * @return bool
     */
    public function isBackendActive():bool
    {
        return false;
    }

    /**
     * Get name for the backend
     *
     * @param  string  $lang
     * @return string
     */
    public function getBackendName(string $lang):string
    {
        return $this->getName();
    }

    /**
     * Check if this payment method can handle subscriptions
     *
     * @return bool
     */
    public function canHandleSubscriptions():bool
    {
        return false;
    }

    /**
     * Get the url for the backend icon
     *
     * @return string
     */
    public function getBackendIcon(): string
    {
        $app = pluginApp(Application::class);
        $icon = $app->getUrlPath(PluginConstants::NAME).'/images/logos/'.$this::PAYMENT_CODE.'_backend_icon.svg';
        return $icon;
    }
}

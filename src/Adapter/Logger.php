<?php

namespace Payone\Adapter;

use Payone\Helpers\ShopHelper;
use Payone\PluginConstants;
use Plenty\Log\Contracts\LoggerContract;
use Plenty\Plugin\Log\Loggable;

/**
 * Class Logger
 */
class Logger //implements LoggerContract
{
    use Loggable;

    const PAYONE_REQUEST_REFERENCE = 'payone_txid';

    /**
     * @var string
     */
    private $identifier;

    /**
     * @var ShopHelper
     */
    private $shopHelper;

    /**
     * @var LoggerContract
     */
    private $logger;
    private $referenceType;
    private $referenceValue;

    /**
     * Logger constructor.
     *
     * @param ShopHelper $shopHelper
     */
    public function __construct(ShopHelper $shopHelper
    ) {
        $this->shopHelper = $shopHelper;
        $this->identifier = __CLASS__;
        $this->logger = $this->getLogger($this->identifier);
    }

    /**
     * @param string $identifier
     *
     * @return Logger
     */
    public function setIdentifier(string $identifier)
    {
        $this->logger = $this->getLogger($identifier);
        $this->addReference($this->referenceType, $this->referenceValue);
        return $this;
    }

    /**
     * @param string $code
     * @param array $additionalInfo
     *
     * @return Logger
     */
    public function debug(
        string $code,
        $additionalInfo = null
    ) {
        if ($this->shopHelper->isDebugModeActive()) {
            return $this->critical($code, $additionalInfo);
        }

        $this->getPlentyLogger()->debug(PluginConstants::NAME . '::' . $code, $additionalInfo);

        return $this;
    }

    /**
     * @param string $code
     * @param array $additionalInfo
     *
     * @return Logger
     */
    public function info(
        string $code,
        $additionalInfo = null
    ) {
        if ($this->shopHelper->isDebugModeActive()) {
            return $this->critical($code, $additionalInfo);
        }

        $this->getPlentyLogger()->info(PluginConstants::NAME . '::' . $code, $additionalInfo);

        return $this;
    }

    /**
     * @param string $code
     * @param array $additionalInfo
     *
     * @return Logger
     */
    public function notice(
        string $code,
        $additionalInfo = null
    ) {
        if ($this->shopHelper->isDebugModeActive()) {
            return $this->critical($code, $additionalInfo);
        }

        $this->getPlentyLogger()->notice(PluginConstants::NAME . '::' . $code, $additionalInfo);

        return $this;
    }

    /**
     * @param string $code
     * @param array $additionalInfo
     *
     * @return Logger
     */
    public function warning(
        string $code,
        $additionalInfo = null
    ) {
        if ($this->shopHelper->isDebugModeActive()) {
            return $this->critical($code, $additionalInfo);
        }

        $this->getPlentyLogger()->warning(PluginConstants::NAME . '::' . $code, $additionalInfo);

        return $this;
    }

    /**
     * @param string $code
     * @param array|null $additionalInfo
     *
     * @return Logger
     */
    public function error(
        string $code,
        $additionalInfo = null
    ) {
        $this->getPlentyLogger()->error(PluginConstants::NAME . '::' . $code, $additionalInfo);

        return $this;
    }

    /**
     * @param string $code
     * @param array $additionalInfo
     *
     * @return Logger
     */
    public function critical(
        string $code,
        $additionalInfo = null
    ) {
        $this->getPlentyLogger()->critical(PluginConstants::NAME . '::' . $code, $additionalInfo);

        return $this;
    }

    /**
     * @param string $code
     * @param array $additionalInfo
     *
     * @return Logger
     */
    public function alert(
        string $code,
        $additionalInfo = null
    ) {
        $this->getPlentyLogger()->alert(PluginConstants::NAME . '::' . $code, $additionalInfo);

        return $this;
    }

    /**
     * @param $code
     * @param array $additionalInfo
     *
     * @return Logger
     */
    public function emergency(
        $code,
        $additionalInfo = null
    ) {
        $this->getPlentyLogger()->emergency(PluginConstants::NAME . '::' . $code, $additionalInfo);

        return $this;
    }

    /**
     * @param \Exception $exception
     * @param int $traceDepth
     *
     * @return Logger
     */
    public function logException(
        \Exception $exception
    ) {
        $this->getPlentyLogger()->logException($exception);

        return $this;
    }
    
    /**
     * @param string $referenceType
     * @param $referenceValue
     * @return $this
     */
    public function addReference(string $referenceType, $referenceValue)
    {
        $this->logger->addReference($referenceType,$referenceValue);
        return $this;
    }

    /**
     * @return LoggerContract
     */
    private function getPlentyLogger()
    {
        return $this->logger;
    }
}

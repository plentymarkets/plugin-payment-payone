<?php //strict

namespace Payone\Services;

use Payone\Helper\PaymentHelper;
use Payone\PluginConstants;
use Payone\Providers\ApiRequestDataProvider;
use Plenty\Modules\Account\Address\Contracts\AddressRepositoryContract;
use Plenty\Modules\Basket\Models\Basket;
use Plenty\Modules\Payment\Contracts\PaymentRepositoryContract;
use Plenty\Modules\Payment\Method\Contracts\PaymentMethodRepositoryContract;
use Plenty\Modules\Plugin\Libs\Contracts\LibraryCallContract;
use Plenty\Plugin\ConfigRepository;

/**
 * Class PaymentService
 */
class PaymentService
{
    /**
     * @var string
     */
    private $returnType = '';

    /**
     * @var PaymentMethodRepositoryContract
     */
    private $paymentMethodRepository;

    /**
     * @var PaymentRepositoryContract
     */
    private $paymentRepository;

    /**
     * @var PaymentHelper
     */
    private $paymentHelper;

    /**
     * @var LibraryCallContract
     */
    private $libCall;

    /**
     * @var AddressRepositoryContract
     */
    private $addressRepo;

    /**
     * @var ConfigRepository
     */
    private $config;

    /**
     * @var SessionStorageService
     */
    private $sessionStorage;

    /**
     * @var ApiRequestDataProvider
     */
    private $requestDataProvider;

    /**
     * PaymentService constructor.
     *
     * @param PaymentMethodRepositoryContract $paymentMethodRepository
     * @param PaymentRepositoryContract $paymentRepository
     * @param ConfigRepository $config
     * @param PaymentHelper $paymentHelper
     * @param LibraryCallContract $libCall
     * @param AddressRepositoryContract $addressRepo
     * @param SessionStorageService $sessionStorage
     * @param ApiRequestDataProvider $requestDataProvider
     */
    public function __construct(
        PaymentMethodRepositoryContract $paymentMethodRepository,
        PaymentRepositoryContract $paymentRepository,
        ConfigRepository $config,
        PaymentHelper $paymentHelper,
        LibraryCallContract $libCall,
        AddressRepositoryContract $addressRepo,
        SessionStorageService $sessionStorage,
        ApiRequestDataProvider $requestDataProvider
    ) {
        $this->paymentMethodRepository = $paymentMethodRepository;
        $this->paymentRepository = $paymentRepository;
        $this->paymentHelper = $paymentHelper;
        $this->libCall = $libCall;
        $this->addressRepo = $addressRepo;
        $this->config = $config;
        $this->sessionStorage = $sessionStorage;
        $this->returnType = 'continue';
        $this->requestDataProvider = $requestDataProvider;
    }

    /**
     * Get the type of payment from the content of the PayPal container
     *
     * @return string
     */
    public function getReturnType()
    {
        /*  'redirectUrl'|'externalContentUrl'|'errorCode'|'continue'  */
        return 'htmlContent';
    }

    /**
     * Get the PayPal payment content
     *
     * @param Basket $basket
     * @param string $mode
     * @return string
     */
    public function getPaymentContent(Basket $basket, $mode = ''): string
    {

        return 'html content';
    }

    /**
     * @return array|string
     */
    public function executePayment($orderId)
    {
        $executeResponse = [];
        return $executeResponse;
        $this->returnType = 'errorCode';
        try {
            // Execute the PayPal payment
            $authType = $this->config->get(PluginConstants::NAME . '.authType');
            if ($authType == '1') {
                $requestData = $this->requestDataProvider->getPreAuthData(null, $orderId);
                $executeResponse = $this->libCall->call(PluginConstants::NAME . '::auth', $requestData);
            } else {
                $requestData = $this->getPreAuthData(null, $orderId);
                $executeResponse = $this->libCall->call(PluginConstants::NAME . '::preAuth', $requestData);
            }
            if (!isset($executeResponse['success'])) {
                return isset($executeResponse['errorMessage']) ? $executeResponse['errorMessage'] : '';
            }
            $this->returnType = 'success';
        } catch (\Exception $e) {
            echo $e->getMessage();
        }

        return $executeResponse;
    }

}
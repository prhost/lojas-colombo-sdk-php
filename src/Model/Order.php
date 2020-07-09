<?php


namespace Prhost\Colombo\Model;

use Carbon\Carbon;
use DateTime;
use Prhost\Colombo\Classes\Collection;
use Prhost\Colombo\Classes\ModelBase;
use Prhost\ColomboHelper\General;

class Order extends ModelBase
{
    const STATUS_NEW = 'NEW';
    const STATUS_APPROVED = 'APPROVED';
    const STATUS_PROCESSING = 'PROCESSING';
    const STATUS_INVOICED = 'INVOICED';
    const STATUS_SHIPPED = 'SHIPPED';
    const STATUS_DELIVERED = 'DELIVERED';
    const STATUS_UNAVAILABLE = 'UNAVAILABLE';

    protected static $attributeMap = [
        'costDiscount'        => 'integer',
        'costProducts'        => 'integer',
        'costTotalOrdered'    => 'integer',
        'customer'            =>
            [
                'cpf_cnpj'          => 'string',
                'ddd'               => 'string',
                'name'              => 'string',
                'phone'             => 'string',
                'stateRegistration' => 'string',
                'typePerson'        => 'string',
            ],
        'included'            => '2019-04-01T13:47:49.364Z',
        'invoices'            =>
            [
                'invoiceNumber' => 'string',
                'invoicedKey'   => 'string',
            ],
        'itemsOrder'          =>
            [
                'commissionAmount'     => 'integer',
                'commissionPercentage' => 'integer',
                'discount'             => 'integer',
                'quantity'             => 'integer',
                'skuSellerId'          => 'string',
                'totalValue'           => 'integer',
                'unitaryValue'         => 'integer',
            ],
        'maximumDeliveryDate' => 'string',
        'maximumDeliveryDays' => 'integer',
        'observation'         => 'string',
        'orderId'             => 'integer',
        'payments'            => [
            [
                'cardTotal'       => 'integer',
                'numberPayments'  => 'integer',
                'parcels'         =>
                    [
                        'expirationParcelDate' => 'string',
                        'parcelNumber'         => 'integer',
                        'parcelValue'          => 'integer',
                    ],
                'paymentsParcels' => 'integer',
            ],
        ],
        'paymentsForm'        => 'string',
        'shippingAddress'     =>
            [
                'city'         => 'string',
                'complement'   => 'string',
                'neighborhood' => 'string',
                'number'       => 'integer',
                'postcode'     => 'integer',
                'state'        => 'string',
                'street'       => 'string',
            ],
        'shippingType'        => 'string',
        'shippingValue'       => 'integer',
        'status'              => [
            [
                'dateUpdated' => '2019-04-01T13:47:49.364Z',
                'status'      => 'NEW',
            ]
        ],
        'trackings'           => [
            [
                'orderTrackingLink' => 'string',
            ]
        ]
    ];

    /**
     * @var float
     */
    protected $costDiscount = 0.0;
    /**
     * @var float
     */
    protected $costProducts = 0.0;
    /**
     * @var float
     */
    protected $costTotalOrdered = 0.0;
    /**
     * @var \stdClass
     */
    protected $customer;

    /**
     * @var datetime
     */
    protected $included;
    /**
     * @var array
     */
    protected $invoices = [];
    /**
     * @var array
     */
    protected $itemsOrder = [];
    /**
     * @var string
     */
    protected $maximumDeliveryDate = '';
    /**
     * @var int
     */
    protected $maximumDeliveryDays = 0;
    /**
     * @var string
     */
    protected $observation = '';
    /**
     * @var int
     */
    protected $orderId = 0;
    /**
     * @var array
     */
    protected $payments = [];
    /**
     * @var string
     */
    protected $paymentsForm = '';
    /**
     * @var \stdClass
     */
    protected $shippingAddress;
    /**
     * @var string
     */
    protected $shippingType = '';
    /**
     * @var float
     */
    protected $shippingValue = 0.0;
    /**
     * @var array
     */
    protected $status = [];
    /**
     * @var array
     */
    protected $trackings = [];

    public function __construct(\stdClass $order = null)
    {
        if ($order) {
            if (property_exists($order, 'costDiscount') && $order->costDiscount) {
                $this->costDiscount = $order->costDiscount;
            }

            if (property_exists($order, 'costProducts') && $order->costProducts) {
                $this->costProducts = $order->costProducts;
            }

            if (property_exists($order, 'costTotalOrdered') && $order->costTotalOrdered) {
                $this->costTotalOrdered = $order->costTotalOrdered;
            }

            if (property_exists($order, 'customer') && $order->customer) {
                $this->customer = $order->customer;
            }

            if (property_exists($order, 'included') && $order->included) {
                $this->included = $order->included;
            }

            if (property_exists($order, 'invoices') && $order->invoices) {
                $this->invoices = $order->invoices;
            }

            if (property_exists($order, 'itemsOrder') && $order->itemsOrder) {
                $this->itemsOrder = $order->itemsOrder;
            }

            if (property_exists($order, 'maximumDeliveryDate') && $order->maximumDeliveryDate) {
                $this->maximumDeliveryDate = $order->maximumDeliveryDate;
            }

            if (property_exists($order, 'maximumDeliveryDays') && $order->maximumDeliveryDays) {
                $this->maximumDeliveryDays = $order->maximumDeliveryDays;
            }

            if (property_exists($order, 'observation') && $order->observation) {
                $this->observation = $order->observation;
            }

            if (property_exists($order, 'orderId') && $order->orderId) {
                $this->orderId = $order->orderId;
            }

            if (property_exists($order, 'payments') && $order->payments) {
                $this->payments = $order->payments;
            }

            if (property_exists($order, 'paymentsForm') && $order->paymentsForm) {
                $this->paymentsForm = $order->paymentsForm;
            }

            if (property_exists($order, 'shippingAddress') && $order->shippingAddress) {
                $this->shippingAddress = $order->shippingAddress;
            }

            if (property_exists($order, 'shippingType') && $order->shippingType) {
                $this->shippingType = $order->shippingType;
            }

            if (property_exists($order, 'shippingValue') && $order->shippingValue) {
                $this->shippingValue = $order->shippingValue;
            }

            if (property_exists($order, 'status') && $order->status) {
                $this->status = $order->status;
            }

            if (property_exists($order, 'trackings') && $order->trackings) {
                $this->trackings = $order->trackings;
            }
        }
    }

    /**
     * Retorna a lista de status e suas legendas
     *
     * @return Collection
     */
    public static function statues(): Collection
    {
        return new Collection([
            'NEW'               => 'Novo',
            'INCLUDED'          => 'Incluso',
            'APPROVED'          => 'Aprovado',
            'PROCESSING'        => 'Liberado',
            'INVOICED'          => 'Faturado',
            'SHIPPED'           => 'Enviado',
            'DELIVERED'         => 'Entregue',
            'UNAVAILABLE'       => 'Indisponível',
            'CANCELED'          => 'Cancelado',
            'RETURNED'          => 'Devolvido',
            'AWAITING_CANCELED' => 'Aguardando cancelamento',
            'AWAITING_RETURNED' => 'Aguardando devolução'
        ]);
    }

    /**
     * @return int
     */
    public function getCostDiscount(): int
    {
        return $this->costDiscount;
    }

    /**
     * @param int $costDiscount
     * @return self
     */
    public function setCostDiscount(int $costDiscount): self
    {
        $this->costDiscount = $costDiscount;
        return $this;
    }

    /**
     * @return int
     */
    public function getCostProducts(): int
    {
        return $this->costProducts;
    }

    /**
     * @param int $costProducts
     * @return self
     */
    public function setCostProducts(int $costProducts): self
    {
        $this->costProducts = $costProducts;
        return $this;
    }

    /**
     * @return int
     */
    public function getCostTotalOrdered(): int
    {
        return $this->costTotalOrdered;
    }

    /**
     * @param int $costTotalOrdered
     * @return self
     */
    public function setCostTotalOrdered(int $costTotalOrdered): self
    {
        $this->costTotalOrdered = $costTotalOrdered;
        return $this;
    }

    /**
     * @return \stdClass
     */
    public function getCustomer(): \stdClass
    {
        return $this->customer;
    }

    /**
     * @param \stdClass $customer
     * @return self
     */
    public function setCustomer(\stdClass $customer): self
    {
        $this->customer = $customer;
        return $this;
    }

    /**
     * @return Carbon
     */
    public function getIncluded(): Carbon
    {
        return Carbon::createFromTimeString($this->included);
    }

    /**
     * @param DateTime $included
     * @return self
     */
    public function setIncluded(DateTime $included): self
    {
        $this->included = $included;
        return $this;
    }

    /**
     * @return array
     */
    public function getInvoices(): array
    {
        return $this->invoices;
    }

    /**
     * @param array $invoices
     * @return self
     */
    public function setInvoices(array $invoices): self
    {
        $this->invoices = $invoices;
        return $this;
    }

    /**
     * @return array
     */
    public function getItemsOrder(): array
    {
        return $this->itemsOrder;
    }

    /**
     * @param array $itemsOrder
     * @return self
     */
    public function setItemsOrder(array $itemsOrder): self
    {
        $this->itemsOrder = $itemsOrder;
        return $this;
    }

    /**
     * @return string
     */
    public function getMaximumDeliveryDate(): string
    {
        return $this->maximumDeliveryDate;
    }

    /**
     * @param string $maximumDeliveryDate
     * @return self
     */
    public function setMaximumDeliveryDate(string $maximumDeliveryDate): self
    {
        $this->maximumDeliveryDate = $maximumDeliveryDate;
        return $this;
    }

    /**
     * @return int
     */
    public function getMaximumDeliveryDays(): int
    {
        return $this->maximumDeliveryDays;
    }

    /**
     * @param int $maximumDeliveryDays
     * @return self
     */
    public function setMaximumDeliveryDays(int $maximumDeliveryDays): self
    {
        $this->maximumDeliveryDays = $maximumDeliveryDays;
        return $this;
    }

    /**
     * @return string
     */
    public function getObservation(): string
    {
        return $this->observation;
    }

    /**
     * @param string $observation
     * @return self
     */
    public function setObservation(string $observation): self
    {
        $this->observation = $observation;
        return $this;
    }

    /**
     * @return int
     */
    public function getOrderId(): int
    {
        return $this->orderId;
    }

    /**
     * @param int $orderId
     * @return self
     */
    public function setOrderId(int $orderId): self
    {
        $this->orderId = $orderId;
        return $this;
    }

    /**
     * @return array
     */
    public function getPayments(): array
    {
        return $this->payments;
    }

    /**
     * @param array $payments
     * @return self
     */
    public function setPayments(array $payments): self
    {
        $this->payments = $payments;
        return $this;
    }

    /**
     * @return string
     */
    public function getPaymentsForm(): string
    {
        return $this->paymentsForm;
    }

    /**
     * @param string $paymentsForm
     * @return self
     */
    public function setPaymentsForm(string $paymentsForm): self
    {
        $this->paymentsForm = $paymentsForm;
        return $this;
    }

    /**
     * @return \stdClass
     */
    public function getShippingAddress(): \stdClass
    {
        return $this->shippingAddress;
    }

    /**
     * @param \stdClass $shippingAddress
     * @return self
     */
    public function setShippingAddress(\stdClass $shippingAddress): self
    {
        $this->shippingAddress = $shippingAddress;
        return $this;
    }

    /**
     * @return string
     */
    public function getShippingType(): string
    {
        return $this->shippingType;
    }

    /**
     * @param string $shippingType
     * @return self
     */
    public function setShippingType(string $shippingType): self
    {
        $this->shippingType = $shippingType;
        return $this;
    }

    /**
     * @return int
     */
    public function getShippingValue(): int
    {
        return $this->shippingValue;
    }

    /**
     * @param int $shippingValue
     * @return self
     */
    public function setShippingValue(int $shippingValue): self
    {
        $this->shippingValue = $shippingValue;
        return $this;
    }

    /**
     * @return \stdClass
     */
    public function getStatus(): \stdClass
    {
        return $this->status;
    }

    /**
     * @param \stdClass $status
     * @return self
     */
    public function setStatus(\stdClass $status): self
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return array
     */
    public function getTrackings(): array
    {
        return $this->trackings;
    }

    /**
     * @param array $trackings
     * @return self
     */
    public function setTrackings(array $trackings): self
    {
        $this->trackings = $trackings;
        return $this;
    }
}
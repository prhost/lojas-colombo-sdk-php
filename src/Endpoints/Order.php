<?php

namespace Prhost\Colombo\Endpoints;

use Carbon\Carbon;
use Prhost\Colombo\Classes\EndpointBase;
use Prhost\ColomboModel\Orders;
use \Prhost\Colombo\Model\Order as OrderModel;
use \Prhost\Colombo\Model\Orders as OrdersModel;

class Order extends EndpointBase
{
    /**
     * Retorna os dados de um pedido a partir de seu número de entrega.
     *
     * @see https://api.marketplace-homolog.colombo.com.br/swagger-ui.html?urls.primaryName=marketplace-api-seller#/Order/findOrderByIdUsingGET
     *
     * @param string|int $orderId Id da categoria
     * @return OrderModel
     */
    public function getOrderById($orderId): OrderModel
    {
        $response = $this->request('GET', 'order/' . $orderId)->getResponse();
        return new OrderModel($response);
    }

    /**
     * Método utilizado para recuperar todos pedidos do Integra.
     * Os possíveis status são: New, Approved, Processing, Invoiced, Shipped, Delivered, Canceled, ShipmentException.
     * @see https://api.colombo.com.br/swagger/ui/index#!/Order/Order_GetAll
     *
     * @param int $page Página atual
     * @param int $size Itens por página
     * @param array $status Status do pedido
     * @return OrdersModel
     */
    public function getOrders(int $page = 1, int $size = 100, $status = []): OrdersModel
    {
        $query = [
            'page' => $page,
            'size' => $size
        ];

        if ($status) {
            $query['status'] = $status;
        }

        $response = $this->request('GET', 'order', [
            'query' => $query
        ])->getResponse();

        return new OrdersModel($response);
    }

    /**
     * Método de alteração do status do pedido para o status “Faturado”. Só poderá ser atualizado quando o status atual do pedido for “Liberado”.
     * @see https://api.marketplace-homolog.colombo.com.br/swagger-ui.html?urls.primaryName=marketplace-api-seller#/Order/updateStatusToInvoicedUsingPUT
     *
     * @param int $orderId
     * @param Carbon $dateUpdated
     * @param Carbon $invoiceDate
     * @param string $invoiceNumber
     * @param string $invoicedKey
     * @return \Prhost\Colombo\Client\Response
     */
    public function updateInvoiced(int $orderId, Carbon $invoiceDate, string $invoiceNumber, string $invoicedKey, Carbon $dateUpdated = null)
    {
        $dateUpdated = $dateUpdated ?: Carbon::now();

        $this->request('PUT', 'order/' . $orderId . '/invoiced', [
            'json' => [
                'dateUpdated' => $dateUpdated->setTimezone('America/Sao_Paulo')->format('Y-m-d\TH:i:s.u\Z'),
                'invoices'    => [
                    [
                        'invoiceDate'   => $invoiceDate->setTimezone('America/Sao_Paulo')->format('Y-m-d\TH:i:s.u\Z'),
                        'invoiceNumber' => $invoiceNumber,
                        'invoicedKey'   => $invoicedKey,
                    ]
                ]
            ]
        ]);
    }

    public function updateUnavailable(int $orderId, Carbon $dateUpdated = null)
    {
        $dateUpdated = $dateUpdated ?: Carbon::now();

        $this->request('PUT', 'order/' . $orderId . '/unavailable', [
            'json' => [
                'dateUpdated' => $dateUpdated->setTimezone('America/Sao_Paulo')->format('Y-m-d\TH:i:s.u\Z')
            ]
        ]);
    }

    public function updateDelivered(int $orderId, Carbon $dateUpdated = null)
    {
        $dateUpdated = $dateUpdated ?: Carbon::now();

        $this->request('PUT', 'order/' . $orderId . '/delivered', [
            'json' => [
                'dateUpdated' => $dateUpdated->setTimezone('America/Sao_Paulo')->format('Y-m-d\TH:i:s.u\Z')
            ]
        ]);
    }
}
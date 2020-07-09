<?php

namespace Prhost\Colombo\Endpoints;

use Prhost\Colombo\Classes\EndpointBase;
use Prhost\Colombo\Client\ApiException;
use Prhost\Colombo\Model\Order as OrderModel;

class OrderQueue extends EndpointBase
{
    /**
     * Retorna o pedido mais antigo da fila do seller
     * @see https://api.marketplace-homolog.colombo.com.br/swagger-ui.html?urls.primaryName=marketplace-api-seller#/OrderQueue/findLastOrderBySellerUsingGET
     *
     * @return OrderModel
     * @throws ApiException
     */
    public function getOrder(): OrderModel
    {
        $response = $this->request('GET', 'queue/order');
        if ($response->getResponse() && is_object($response->getResponse())) {
            return new OrderModel($response->getResponse());
        } else {
            throw new ApiException('A fila de pedido esta vazia.', 404, $response);
        }
    }

    public function deleteOrder(int $orderId)
    {
        $this->request('DELETE', 'queue/order/' . $orderId);
    }

    public function updateOrder(OrderModel $order)
    {
        $this->request('PUT', 'Order', [
            'json' => $order->toArray()
        ]);
    }
}
<?php

namespace Prhost\Colombo\Endpoints;

use Prhost\Colombo\Classes\EndpointBase;
use Prhost\Colombo\Client\Response;
use Prhost\Colombo\Model\Product as ProductModel;
use Prhost\Colombo\Model\Products as ProductsModel;

class Product extends EndpointBase
{
    const STATUS_ENABLED = 'ENABLED';
    const STATUS_DISABLED = 'DISABLED';

    /**
     * Método utilizado para recuperar os produtos.
     * @see https://api.marketplace-homolog.colombo.com.br/swagger-ui.html?urls.primaryName=marketplace-api-seller#/Product/findAllUsingGET_1
     *
     * @return ProductsModel
     */
    public function getProducts(): ProductsModel
    {
        $response = $this->request('GET', 'product')->getResponse();
        return new ProductsModel($response);
    }

    /**
     * Método utilizado para recuperar um produto específico.
     * @see https://api.marketplace-homolog.colombo.com.br/swagger-ui.html?urls.primaryName=marketplace-api-seller#/Product/findAllUsingGET_1
     *
     * @param string $skuSellerId skuSellerId do produto
     * @return ProductModel
     */
    public function getProduct(string $skuSellerId): ProductModel
    {
        $response = $this->request('GET', 'product/' . $skuSellerId)->getResponse();
        return new ProductModel($response);
    }

    /**
     * Método utilizado para criar um produto.
     * @see https://api.marketplace-homolog.colombo.com.br/swagger-ui.html?urls.primaryName=marketplace-api-seller#/Product/saveUsingPOST
     *
     * @param ProductModel $product
     * @return Response
     */
    public function createProduct(ProductModel $product): Response
    {
        $data = [
            "brand"                  => $product->getBrand(),
            "description"            => $product->getDescription(),
            "groupId"                => $product->getGroupId(),
            "model"                  => $product->getModel(),
            "name"                   => $product->getName(),
            "productAttributeValues" => $product->getProductAttributeValues(),
            "productItemVariations"  => $product->getProductItemVariations(),
            "youtubeLink"            => $product->getYoutubeLink(),
        ];

        return $this->request('POST', 'product', [
            'json' => $data
        ]);
    }


    /**
     * Update Product
     *
     * @param ProductModel $product
     * @param string $skuSellerId
     *
     * @return Response
     */
    public function updateProduct(ProductModel $product, string $skuSellerId): Response
    {
        return $this->request('PUT', 'product/' . $skuSellerId, [
            'json' => [
                "brand"                  => $product->getBrand(),
                "description"            => $product->getDescription(),
                "groupId"                => $product->getGroupId(),
                "model"                  => $product->getModel(),
                "name"                   => $product->getName(),
                "productAttributeValues" => $product->getProductAttributeValues(),
                "productItemVariations"  => $product->getProductItemVariations(),
                "youtubeLink"            => $product->getYoutubeLink(),
            ]
        ]);
    }

    /**
     * Update product price
     *
     * @param string $skuSellerId
     *
     * @param float $price
     * @return Response
     */
    public function updateProductPrice(string $skuSellerId, float $price): Response
    {
        return $this->request('PUT', 'product/item/' . $skuSellerId . '/price', [
            'json' => [
                "price" => $price,
            ]
        ]);
    }

    /**
     * Update product status
     *
     * @param string $skuSellerId
     * @param string $status STATUS_ENABLE|STATUS_DISABLE
     *
     * @return Response
     */
    public function updateProductStatus(string $skuSellerId, string $status): Response
    {
        return $this->request('PUT', 'product/item/' . $skuSellerId . '/status', [
            'json' => [
                "status" => $status,
            ]
        ]);
    }

    /**
     * Update product stock
     *
     * @param string $skuSellerId
     *
     * @param int $stock
     * @return Response
     */
    public function updateProductStock(string $skuSellerId, int $stock): Response
    {
        return $this->request('PUT', 'product/item/' . $skuSellerId . '/stock', [
            'json' => [
                "stock" => $stock,
            ]
        ]);
    }
}
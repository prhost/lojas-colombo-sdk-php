<?php

namespace Prhost\Colombo\Endpoints;

use Prhost\Colombo\Classes\EndpointBase;
use Prhost\Colombo\Model\Attributes as AttributesModel;

class Attribute extends EndpointBase
{
    /**
     * Método utilizado para recuperar um atributo pelo ID da categoria.
     * @see https://api.marketplace-homolog.colombo.com.br/swagger-ui.html?urls.primaryName=marketplace-api-seller#/Category/findAttributesByCategoryUsingGET
     *
     * @param int $categoryId categoryId do atributo
     * @return AttributesModel
     */
    public function getAttribute(int $categoryId): AttributesModel
    {
        $response = $this->request('GET', 'category/' . $categoryId . '/attribute')->getResponse();
        return new AttributesModel($response);
    }
}
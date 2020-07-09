<?php

namespace Prhost\Colombo\Endpoints;

use Prhost\Colombo\Classes\EndpointBase;
use Prhost\Colombo\Model\Categories;
use Prhost\Colombo\Model\Category as CategoryModel;
use Prhost\Colombo\Model\Categories as CategoriesModel;

class Category extends EndpointBase
{
    /**
     * Método utilizado para recuperar todas categorias que estão nas Lojas Colombo.
     * @see https://api.marketplace.colombo.com.br/swagger-ui.html?urls.primaryName=marketplace-api-seller#/Category/findAllUsingGET
     *
     * @return CategoriesModel
     */
    public function getCategories(): CategoriesModel
    {
        $response = $this->request('GET', 'category')->getResponse();

        return new CategoriesModel($response);
    }
}
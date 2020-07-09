<?php

namespace Prhost\Colombo\Endpoints;

use Prhost\Colombo\Classes\EndpointBase;
use \Prhost\Colombo\Model\EndPointLimit as EndPointLimitModel;

class EndPointLimit extends EndpointBase
{
    /**
     * Método utilizado para listar todos os limites de acesso para as requisições de uma empresa.
     *
     * @see https://api.colombo.com.br/swagger/ui/index#!/EndPointLimit/EndPointLimit_GetLimitsByBusiness
     *
     * @return EndPointLimitModel
     */
    public function getPointLimits(): EndPointLimitModel
    {
        $pointLimits = $this->request('GET', 'EndPointLimit')->getResponse();
        return new EndPointLimitModel($pointLimits);
    }
}
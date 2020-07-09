<?php

namespace Prhost\Colombo\Endpoints;

use Prhost\Colombo\Classes\Colombo;
use Prhost\Colombo\Classes\EndpointBase;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Prhost\Colombo\Model\Auth as AuthModel;

class Auth extends EndpointBase
{
    /**
     * Método utilizado para pegar todos os atributos de produto ou de sku.Caso utilize isSku como true, o campo
     * isProduct deve ser falso e vice-versa.
     *
     * @see https://api.colombo.com.br/swagger/ui/index#!/Attribute/Attribute_GetAll
     *
     * @return AuthModel
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function authentication(string $apiTokenId, string $apiKey): AuthModel
    {
        $apiClient = new Client([
            'base_uri' => Colombo::$sandbox ? Colombo::$uri_sandbox : Colombo::$uri_production,
            'headers'  => [
                'Accept' => 'application/json'
            ]
        ]);

        $response = $apiClient->request('POST', 'authentication', [
            RequestOptions::JSON => [
                'apiTokenId' => $apiTokenId,
                'apiKey' => $apiKey,
            ]
        ]);

        $responseContent = json_decode($response->getBody()->getContents());

        return new AuthModel($responseContent);
    }
}
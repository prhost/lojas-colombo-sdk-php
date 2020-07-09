<?php

namespace Prhost\Colombo\Classes;

use Prhost\Colombo\Client\ApiClient;
use Prhost\Colombo\Client\Response;
use Prhost\Colombo\Helper\StateService;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use Psr\Http\Message\ResponseInterface;
use Prhost\Colombo\Endpoints\Auth;

class Colombo
{
    /**
     * Username for HTTP basic authentication
     * @var string
     */
    public static $apiTokenId = '';

    /**
     * Password for HTTP basic authentication
     * @var string
     */
    public static $apiKey = '';

    /**
     * @var boolean
     */
    public static $sandbox = true;

    public static $uri_sandbox = 'https://api.marketplace-homolog.colombo.com.br/v1/';

    public static $uri_production = 'https://api.marketplace.colombo.com.br/v1/';

    /**
     * @var ApiClient
     */
    public static $apiClient;

    /*
     *  initalize  ApiClient
     */
    public static function init(string $apiTokenId = '', string $apiKey = '', bool $sandbox = true)
    {
        if (self::$apiClient === null) {

            $stack = HandlerStack::create();

            $stack->push(Middleware::mapResponse(function (ResponseInterface $response) {
                return new Response(
                    $response->getStatusCode(),
                    $response->getHeaders(),
                    $response->getBody(),
                    $response->getProtocolVersion(),
                    $response->getReasonPhrase());
            }));

            self::$sandbox = $sandbox ?? self::$sandbox;
            self::$apiTokenId = $apiTokenId ?? self::$apiTokenId;
            self::$apiKey = $apiKey ?? self::$apiKey;

            self::$apiClient = new ApiClient([
                'base_uri' => self::$sandbox ? self::$uri_sandbox : self::$uri_production,
                'handler'  => $stack,
                'headers'  => [
                    'Accept' => 'application/json'
                ]
            ]);
        }

        self::checkAuth();
    }

    protected static function checkAuth(){

        $stateService = new StateService();

        $expires_in = $stateService->getState('expires_in');
        $timestamp = $stateService->getState('timestamp', 0);

        if(!$expires_in || ($expires_in && ($expires_in + $timestamp) < time())) {

            $authPoint = new Auth();
            $authModel = $authPoint->authentication(self::$apiTokenId, self::$apiKey);

            $stateService->saveState('access_token', $authModel->getAccessToken());
            $stateService->saveState('token_type', $authModel->getTokenType());
            $stateService->saveState('expires_in', $authModel->getExpiresIn());
            $stateService->saveState('timestamp', time());

            self::$apiClient->setAuth($authModel);
        } else {

            $authModel = new \Prhost\Colombo\Model\Auth();
            $authModel->setAccessToken($stateService->getState('access_token'));
            $authModel->setExpiresIn($stateService->getState('expires_in'));
            $authModel->setTokenType($stateService->getState('token_type'));

            self::$apiClient->setAuth($authModel);
        }
    }
}
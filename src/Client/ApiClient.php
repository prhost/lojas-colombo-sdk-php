<?php

namespace Prhost\Colombo\Client;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Prhost\Colombo\Model\Auth;

class ApiClient extends Client
{
    protected $token = '';

    protected $key = '';

    /**
     * @var Auth
     */
    protected $auth;

    public function __construct(array $config = [])
    {
        $this->token = $config['token'] ?? '';
        $this->key = $config['key'] ?? '';

        parent::__construct($config);
    }

    public function request($method, $uri = '', array $options = [])
    {
        try {

            $options = array_merge_recursive($options, [
                'headers' => [
                    'Authorization' => $this->auth->getTokenType() . ' ' . $this->auth->getAccessToken()
                ]
            ]);

            return parent::request($method, $uri, $options);

        } catch (ClientException $e) {
            throw new ApiException(
                $e->getMessage(),
                $e->getCode(),
                $e->getResponse()
            );
        }
    }

    /**
     * @param Auth $auth
     */
    public function setAuth(Auth $auth): void
    {
        $this->auth = $auth;
    }
}
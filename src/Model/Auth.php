<?php


namespace Prhost\Colombo\Model;

use Prhost\Colombo\Classes\ModelBase;

class Auth extends ModelBase
{
    public static $authMap = array(
        "access_token" => "string",
        "expires_in"   => "integer",
        "token_type"   => "string",
    );

    /**
     * @var string
     */
    protected $access_token;

    /**
     * @var int
     */
    protected $expires_in;

    /**
     * @var string
     */
    protected $token_type;

    public function __construct(\StdClass $data = null)
    {
        if($data) {
            $this->access_token = $data->access_token;
            $this->expires_in = $data->expires_in;
            $this->token_type = $data->token_type;
        }
    }

    /**
     * @return string
     */
    public function getAccessToken(): string
    {
        return $this->access_token;
    }

    /**
     * @param string $access_token
     */
    public function setAccessToken(string $access_token): void
    {
        $this->access_token = $access_token;
    }

    /**
     * @return int
     */
    public function getExpiresIn(): int
    {
        return $this->expires_in;
    }

    /**
     * @param int $expires_in
     */
    public function setExpiresIn(int $expires_in): void
    {
        $this->expires_in = $expires_in;
    }

    /**
     * @return string
     */
    public function getTokenType(): string
    {
        return $this->token_type;
    }

    /**
     * @param string $token_type
     */
    public function setTokenType(string $token_type): void
    {
        $this->token_type = $token_type;
    }
}
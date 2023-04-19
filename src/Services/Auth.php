<?php
namespace Badinansoft\FIB\Services;

use Badinansoft\FIB\FIB;

class Auth
{
    private string $client_id;
    private string $client_secret;
    private static string $authUrl = 'https://fib.stage.fib.iq/auth/realms/fib-online-shop/protocol/openid-connect/token';

    public function __construct(private FIB $fib)
    {

    }

    /**
     * @return string
     */
    public static function getAuthUrl(): string
    {
        return self::$authUrl;
    }


    public static function setAuthUrl(string $authUrl): void
    {
        self::$authUrl = $authUrl;
    }

    /**
     * @return string
     */
    public function getClientId(): string
    {
        return $this->client_id;
    }

    /**
     * @param string $client_id
     */
    public function setClientId(string $client_id): void
    {
        $this->client_id = $client_id;
    }

    /**
     * @return string
     */
    public function getClientSecret(): string
    {
        return $this->client_secret;
    }

    /**
     * @param string $client_secret
     */
    public function setClientSecret(string $client_secret): void
    {
        $this->client_secret = $client_secret;
    }

    public function getAccessToken(string $client_id='',string $client_secret=''): ?string
    {
        if($client_id!='')
            $this->setClientId($client_id);
        if($client_secret!='')
            $this->setClientSecret($client_secret);

        $data = [
            'form_params'=>[
                'grant_type' => 'client_credentials',
                'client_id' => $this->getClientId(),
                'client_secret' => $this->getClientSecret()
                ],
        ];
        $result = $this->fib->makeAPICall(self::$authUrl,'post',$data);

        $access_token =  $result->getData()?->access_token;

        return $access_token;
    }


}
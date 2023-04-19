<?php

namespace Badinansoft\FIB;

use Badinansoft\FIB\Exceptions\InternalServerError;
use Badinansoft\FIB\Exceptions\NotAcceptable;
use Badinansoft\FIB\Exceptions\NotAllowed;
use Badinansoft\FIB\Exceptions\NotFound;
use Badinansoft\FIB\Exceptions\Unauthenticated;
use Badinansoft\FIB\Http\Response;
use Badinansoft\FIB\Services\Auth;
use Badinansoft\FIB\Services\Payment;
use Exception;
use Psr\Http\Message\ResponseInterface;

/**
 * Class FIB
 *
 * @package Badinansoft\FIB
 */
class FIB
{

    private \GuzzleHttp\Client $guzzle;

    /**
     * Base API URL
     */
    private string $url = 'https://fib.stage.fib.iq/protected/v1';


    public function __construct(private string $client_id='',private string $client_secret='' )
    {
        $this->guzzle = new \GuzzleHttp\Client();
    }

    public function setUrl(string $url):void
    {
        $this->url = $url;
    }

    public function getUrl():string
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @param string $method
     * @param array<string, mixed> $options
     * @return Response
     * @throws NotFound
     * @throws NotAllowed
     * @throws InternalServerError
     * @throws Exception
     */
    public function makeAPICall(string $url, string $method = 'get', array $options = []): Response
    {
        if (!in_array($method, ['get', 'post', 'patch', 'delete'])) {
            throw new Exception('Invalid method type');
        }

        /**
         * Because we're calling the method dynamically PHPStorm doesn't
         * know that we're getting a response back, so we manually
         * tell it what is returned.
         *
         * @var ResponseInterface $response
         */
        $response = $this->guzzle->{$method}($url, $options);
        switch ($response->getStatusCode()) {
            case 401:
                throw new Unauthenticated($response->getBody());
            case 404:
                throw new NotFound($response->getBody());
            case 405:
                throw new NotAllowed($response->getBody());
            case 406:
                throw new NotAcceptable($response->getBody());
            case 500:
                throw new InternalServerError($response->getBody());
        }

        return new Response($response);
    }

    public function payments(): Payment
    {
        $auth = new Auth($this);
        return new Payment($this,$auth->getAccessToken($this->client_id,$this->client_secret));
    }

}

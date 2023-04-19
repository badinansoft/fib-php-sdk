<?php

namespace Badinansoft\FIB\Services;

use Badinansoft\FIB\Exceptions\InternalServerError;
use Badinansoft\FIB\Exceptions\NotAllowed;
use Badinansoft\FIB\Exceptions\NotFound;
use Badinansoft\FIB\FIB;
use Badinansoft\FIB\Http\Response;

class Payment
{
    public function __construct(private FIB $fib,private string $token)
    {

    }

    private function headers(): array
    {
        return [
            'Authorization' => 'Bearer ' . $this->token,
            'Accept'        => 'application/json',
            'Content-Type'  => 'application/json',
        ];
    }

    private function getOptions(array $body):array
    {
        return [
            'headers'=>$this->headers(),
            'body'=>json_encode($body)
        ];
    }

    /**
     * @throws InternalServerError
     * @throws NotAllowed
     * @throws NotFound
     */
    public function createPayment(float $amount, string $currency, ?string $description, ?string $statusCallbackUrl): Response
    {
        $body = [
                'monetaryValue'=>[
                    'amount'=>$amount,
                    'currency'=>$currency
                ],
                'statusCallbackUrl'=>$statusCallbackUrl,
                'description'=>$description
            ];
        return $this->fib->makeAPICall($this->fib->getUrl().'/payments','post',$this->getOptions($body));
    }

    /**
     * @throws InternalServerError
     * @throws NotAllowed
     * @throws NotFound
     */
    public function paymentStatus(string $paymentId): Response
    {
        return $this->fib->makeAPICall($this->fib->getUrl().'/payments/'.$paymentId.'/status','get',$this->getOptions([]));
    }

    /**
     * @throws InternalServerError
     * @throws NotAllowed
     * @throws NotFound
     */
    public function cancelPayment(string $paymentId): Response
    {
        return $this->fib->makeAPICall($this->fib->getUrl().'/payments/'.$paymentId.'/cancel','post',$this->getOptions([]));
    }
}
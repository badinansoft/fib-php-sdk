<?php

namespace Badinansoft\FIB\Tests;

use Badinansoft\FIB\Services\Auth;
use PHPUnit\Framework\TestCase;

class testAuth extends TestCase
{
    protected function setup(): void
    {
        parent::setup();
    }

    /**
     * Load the environment file
     */
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
    }

    /**
     * @test
    */
    public function test_authenticate()
    {
        $fib = new \Badinansoft\FIB\FIB('fib-client-21',
            '71debd98-63f5-4165-96a0-b4d029e8b539');
        $result = $fib->payments()->createPayment(43.0,'IQD','test','')->getData();
        print_r($fib->payments()->paymentStatus($result->paymentId)->getData());
        print_r($fib->payments()->cancelPayment($result->paymentId)->getData());
        print_r($fib->payments()->paymentStatus($result->paymentId)->getData());

    }
}
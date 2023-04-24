<?php

namespace Badinansoft\FIB\Tests;

use Badinansoft\FIB\FIB;
use PHPUnit\Framework\TestCase;

class testAuth extends TestCase
{
    private static FIB $fib;

    /**
     * Load the environment file
     */
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        // Load the test environment
        $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
        $dotenv->load();
        $dotenv->required(['CLIENT_ID','CLIENT_SECRET'])->notEmpty();


        $clintID = $_ENV['CLIENT_ID'];
        $clintSecret = $_ENV['CLIENT_SECRET'];

        self::$fib = new \Badinansoft\FIB\FIB($clintID, $clintSecret);
    }


    public function test_create_payment_and_check_status()
    {

        $result = self::$fib
                        ->payments()
                        ->createPayment(43.0,'IQD','test','')
                        ->getData();

        $this->assertNotEmpty($result);
        $this->assertNotEmpty($result->paymentId);

        $status = self::$fib
                        ->payments()
                        ->paymentStatus($result->paymentId)
                        ->getData();
        $this->assertNotEmpty($status);
        $this->assertEquals($status->status,'UNPAID','Valid payment status');
    }


    public function test_cancel_payment_and_check_status()
    {

        $result = self::$fib
            ->payments()
            ->createPayment(43.0,'IQD','test','')
            ->getData();

        self::$fib->payments()->cancelPayment($result->paymentId)->getData();

        $status = self::$fib
            ->payments()
            ->paymentStatus($result->paymentId)
            ->getData();

        $this->assertNotEmpty($status);
        $this->assertEquals($status->status,'DECLINED','Valid payment status');
    }
}
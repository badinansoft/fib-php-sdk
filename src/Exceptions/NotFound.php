<?php
namespace Badinansoft\FIB\Exceptions;

use Exception;

class NotFound extends Exception
{
    /**
     * NotFound constructor.
     *
     * @param string $message
     */
    public function __construct(string $message = "Endpoint not found")
    {
        parent::__construct($message);
    }
}
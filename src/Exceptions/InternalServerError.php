<?php

namespace Badinansoft\FIB\Exceptions;

use Exception;

class InternalServerError extends Exception
{
    /**
     *  Internal Server Error constructor.
     *
     * @param string $message
     */
    public function __construct(string $message = "Internal Server Error")
    {
        parent::__construct($message);
    }
}
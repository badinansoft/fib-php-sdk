<?php

namespace Badinansoft\FIB\Exceptions;

use Exception;

class NotAllowed extends Exception
{

    /**
     * Method Not Allowed constructor.
     *
     * @param string $message
     */
    public function __construct(string $message = "Method Not Allowed")
    {
        parent::__construct($message);
    }
}
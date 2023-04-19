<?php

namespace Badinansoft\FIB\Exceptions;

use Exception;

class NotAcceptable extends Exception
{

    /**
     *  Not Acceptable constructor.
     *
     * @param string $message
     */
    public function __construct(string $message = "Not Acceptable")
    {
        parent::__construct($message);
    }
}
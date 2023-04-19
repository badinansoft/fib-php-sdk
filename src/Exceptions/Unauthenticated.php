<?php
namespace Badinansoft\FIB\Exceptions;

use Exception;

class Unauthenticated extends Exception
{
    /**
     * UnAuthenticated constructor.
     *
     * @param string $message
     */
    public function __construct(string $message = "UnAuthenticated")
    {
        parent::__construct($message);
    }
}
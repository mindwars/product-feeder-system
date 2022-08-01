<?php

namespace App\Exceptions;

class NotAcceptableException extends HttpException
{
    protected $message = 'Not Acceptable';
    protected $code = 406;
}
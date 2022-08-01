<?php

namespace App\Exceptions;

class ServerErrorException extends HttpException
{
    protected $message = 'Unexpected Error';
    protected $code = 500;
}
<?php

namespace App\Exceptions;

class NotFoundException extends HttpException
{
    protected $message = 'Not Found';
    protected $code = 404;
}
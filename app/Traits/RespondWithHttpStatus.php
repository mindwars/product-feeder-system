<?php

namespace App\Traits;

use System\Response;

trait RespondWithHttpStatus
{
    /**
     * @var Response $responseClass
     */
    private Response $responseClass;

    /**
     * @var string $responseType
     */
    private $responseType = 'json';

    public function __construct()
    {
        $this->responseClass = new Response;
    }

    /**
     * @param string $message
     * @return void
     */
    public function responseSuccess(string $message): void
    {
        $this->responseClass->setStatusCode(200)->setBody($message)->handle();
    }

    /**
     * @param string $message
     * @param int $statusCode
     * @return void
     */
    public function responseError(string $message, int $statusCode = 400): void
    {
        $this->responseClass->setStatusCode($statusCode)->setBody($message)->handle();
    }

    /**
     * @param string $data
     * @param int $statusCode
     * @return void
     */
    public function responseServerError(string $data, int $statusCode = 500): void
    {
        $this->responseClass->setStatusCode($statusCode)->setBody($data)->handle();
    }

    /**
     * @param string $message
     * @return void
     */
    public function responseNotFound(string $message = 'Not Found'): void
    {
        $this->responseClass->setStatusCode(404)->setBody($message)->handle();
    }
}
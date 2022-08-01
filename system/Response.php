<?php

namespace System;

class Response
{
    /**
     * @var string $contentType
     */
    private string $contentType;

    /**
     * @var int $statusCode
     */
    private int $statusCode = 200;

    /**
     * @var string $body
     */
    private string $body;

    public function __construct()
    {
        $request = new Request();
        $this->contentType = $request->getAcceptType();
    }

    /**
     * @return void
     */
    public function handle(): void
    {
        $this->sendStatusCode();
        $this->sendHeader();
        $this->sendBody();
        $this->terminate();
    }

    /**
     * @param string $contentType
     * @return Response
     */
    public function setContentType(string $contentType): Response
    {
        $this->contentType = $contentType;

        return $this;
    }

    /**
     * @param int $statusCode
     * @return Response
     */
    public function setStatusCode(int $statusCode): Response
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * @param string $data
     * @return Response
     */
    public function setBody(string $data): Response
    {
        $this->body = $data;
        return $this;
    }

    /**
     * @return void
     */
    private function sendStatusCode(): void
    {
        http_response_code($this->statusCode);
    }

    /**
     * @return void
     */
    private function sendHeader(): void
    {
        header('Content-Type: ' . $this->contentType . '; charset=utf-8');
    }

    /**
     * @return void
     */
    private function sendBody(): void
    {
        echo $this->body;
    }

    /**
     * @return void
     */
    private function terminate(): void
    {
        exit;
    }
}
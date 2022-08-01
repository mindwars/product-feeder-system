<?php

namespace System;

class Request
{
    /**
     * @var array ACCEPTABLE_CONTENTS
     */
    private const ACCEPTABLE_CONTENTS = [
        'application/json',
        'application/xml',
    ];

    /**
     * @return string
     */
    public static function getMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'] ?? 'GET';
    }

    /**
     * @return string
     */
    public static function getUri(): string
    {
        return rtrim($_SERVER['REQUEST_URI'], '/') ?? '/';
    }

    /**
     * @return string
     */
    public static function getAcceptType(): string
    {
        $contentType = $_SERVER['HTTP_ACCEPT'] ?? 'application/json';

        $isContentTypeAcceptable = array_search(
            $contentType,
            self::ACCEPTABLE_CONTENTS
        );

        if($isContentTypeAcceptable === false) {
            return false;
        }

        return $contentType;
    }

    /**
     * @param array $keys
     * @param array $values
     * @return object
     */
    public static function matchParametersWithVariableNames(array $keys, array $values): object
    {
        return $parameters = (object)array_combine(array_values($keys), array_values($values));
    }
}
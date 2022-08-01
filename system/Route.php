<?php

namespace System;

use App\Exceptions\NotFoundException;

class Route
{
    /**
     * @var array $handlers
     */
    private array $handlers = [];

    /**
     * @var Request $request
     */
    private Request $request;

    /**
     * @var string METHOD_GET
     */
    private const METHOD_GET = 'GET';

    /**
     * @var string METHOD_POST
     */
    private const METHOD_POST = 'POST';

    /**
     * @var string MATCH_PATTERN
     */
    private const MATCH_PATTERN = '([0-9a-zA-Z]+)';

    /**
     * @var string ROUTE_VARIABLE_PATTERN
     */
    private const ROUTE_VARIABLE_PATTERN = '({([0-9a-zA-Z]+)})';

    /**
     * @param string $uri
     * @param array $callback
     * @return void
     */
    public function get(string $uri, array $callback): void
    {
        $this->register(self::METHOD_GET, $uri, $callback);
    }

    /**
     * @param string $method
     * @param string $uri
     * @param array $callback
     * @return void
     */
    private function register(string $method, string $uri, array $callback): void
    {
        $this->handlers[self::METHOD_GET][] = [
            'uri' => $uri,
            'callback' => $callback,
            'method' => self::METHOD_GET,
        ];
    }

    /**
     * @param string $uri
     * @return array
     */
    private function getParameterNames(string $uri): array
    {
        preg_match_all(self::ROUTE_VARIABLE_PATTERN, $uri, $variableNames);
        array_shift($variableNames);
        $variableNames = $variableNames[0];

        return $variableNames;
    }

    /**
     * @param string $uri
     * @return array
     */
    private function makeRouteRegexPattern(string $uri): array
    {
        $routePattern = preg_replace(self::ROUTE_VARIABLE_PATTERN, self::MATCH_PATTERN, $uri, -1, $variableCount);

        return [$routePattern, $variableCount];
    }

    /**
     * @param string $pattern
     * @param string $uri
     * @return array
     */
    private function checkUriWithRoute(string $pattern, string $uri): array
    {
        $isMatched = preg_match('@^'.$pattern.'$@', $uri, $parameters);
        array_shift($parameters);

        return [$isMatched, $parameters];
    }

    /**
     * @return void
     */
    public function run(): void
    {
        foreach ($this->handlers[Request::getMethod()] AS $handler) {
            list($routePattern, $variableCount) = $this->makeRouteRegexPattern($handler['uri']);
            list($isMatched, $parameters) = $this->checkUriWithRoute($routePattern, Request::getUri());

            if ($isMatched) {
                $parameterNames = $this->getParameterNames($handler['uri']);

                if (!class_exists($handler['callback'][0])) {
                    throw new NotFoundException('Controller class not found', 404);
                }
                $callbackClass = new $handler['callback'][0]();

                if(!is_callable([$callbackClass, $handler['callback'][1]])) {
                    throw new NotFoundException('Controller method not found', 404);
                }

                $parameters = Request::matchParametersWithVariableNames($parameterNames, $parameters);

                call_user_func_array([
                        $callbackClass,
                        $handler['callback'][1]],
                    [$parameters]
                );
                exit;
            }
        }

        throw new NotFoundException('Route not found', 404);
    }
}
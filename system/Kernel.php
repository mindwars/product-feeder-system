<?php

namespace System;

class Kernel
{
    /**
     * @var Route $route
     */
    private Route $route;

    /**
     * @return void
     */
    public function handle()
    {
        $this->route = new Route();
        require_once(__DIR__ . '/../routes/routes.php');
        $this->route->run();
    }
}
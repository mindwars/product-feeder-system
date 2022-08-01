<?php

namespace App\Contracts;

interface JsonExporterInterface
{
    /**
     * @return array
     */
    public function getSchema(): array;

    /**
     * @param array $products
     * @return string
     */
    public function export(array $products): string;
}
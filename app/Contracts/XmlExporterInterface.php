<?php

namespace App\Contracts;

interface XmlExporterInterface
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
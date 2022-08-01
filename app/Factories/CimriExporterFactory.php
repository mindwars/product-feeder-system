<?php

namespace App\Factories;

use App\Contracts\ExporterFactoryInterface;
use App\Contracts\JsonExporterInterface;
use App\Contracts\XmlExporterInterface;
use App\Services\Cimri\CimriJsonExporter;
use App\Services\Cimri\CimriXmlExporter;

class CimriExporterFactory implements ExporterFactoryInterface
{
    /**
     * @return JsonExporterInterface
     */
    public function createJsonExporter(): JsonExporterInterface
    {
        return new CimriJsonExporter();
    }

    /**
     * @return XmlExporterInterface
     */
    public function createXmlExporter(): XmlExporterInterface
    {
        return new CimriXmlExporter();
    }
}
<?php

namespace App\Factories;

use App\Contracts\JsonExporterInterface;
use App\Contracts\XmlExporterInterface;
use App\Services\Google\GoogleJsonExporter;
use App\Services\Google\GoogleXmlExporter;

class GoogleExporterFactory implements \App\Contracts\ExporterFactoryInterface
{
    /**
     * @return JsonExporterInterface
     */
    public function createJsonExporter(): JsonExporterInterface
    {
        return new GoogleJsonExporter();
    }

    /**
     * @return XmlExporterInterface
     */
    public function createXmlExporter(): XmlExporterInterface
    {
        return new GoogleXmlExporter();
    }
}
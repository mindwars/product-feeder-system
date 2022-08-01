<?php

namespace App\Factories;

use App\Contracts\ExporterFactoryInterface;
use App\Contracts\JsonExporterInterface;
use App\Contracts\XmlExporterInterface;
use App\Services\Hepsiburada\HepsiburadaJsonExporter;
use App\Services\Hepsiburada\HepsiburadaXmlExporter;

class HepsiburadaExporterFactory implements ExporterFactoryInterface
{
    /**
     * @return JsonExporterInterface
     */
    public function createJsonExporter(): JsonExporterInterface
    {
        return new HepsiburadaJsonExporter();
    }

    /**
     * @return XmlExporterInterface
     */
    public function createXmlExporter(): XmlExporterInterface
    {
        return new HepsiburadaXmlExporter();
    }
}
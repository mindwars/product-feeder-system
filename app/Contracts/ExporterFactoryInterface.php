<?php

namespace App\Contracts;

interface ExporterFactoryInterface
{
    /**
     * @return JsonExporterInterface
     */
    public function createJsonExporter(): JsonExporterInterface;

    /**
     * @return XmlExporterInterface
     */
    public function createXmlExporter(): XmlExporterInterface;
}
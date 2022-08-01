<?php

namespace App\Services;

use App\Contracts\ExporterFactoryInterface;
use App\Exceptions\NotAcceptableException;
use App\Models\Product;
use System\Request;

class FeedService
{
    /**
     * @param ExporterFactoryInterface $exporterFactory
     * @return string
     * @throws NotAcceptableException
     */
    public function export(ExporterFactoryInterface $exporterFactory): string
    {
        $products = new Product();
        $products = $products->getAll();

        switch (Request::getAcceptType()) {
            case 'application/json':
                $exporter = $exporterFactory->createJsonExporter();
                break;
            case 'application/xml':
                $exporter = $exporterFactory->createXmlExporter();
                break;
            default:
                throw new NotAcceptableException('Not supported data type', 422);
        }

        return $exporter->export($products);
    }
}
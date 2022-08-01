<?php

namespace App\Services\Google;

use App\Contracts\XmlExporterInterface;
use App\Models\Product;

class GoogleXmlExporter implements XmlExporterInterface
{
    /**
     * @var string CONTAINER
     */
    private const CONTAINER = '<rss version="2" xmlns:g="http://base.google.com/ns/1.0" />';

    /**
     * @var string ITEM
     */
    private const ITEM = 'item';

    /**
     * @var string NAMESPACE
     */
    private const NAMESPACE = 'http://base.google.com/ns/1.0';

    /**
     * @return array
     */
    public function getSchema(): array
    {
        return [
            'id' => 'getId',
            'title' => 'getName',
            'price' => 'getPrice',
            'category' => 'getCategory'
        ];
    }

    /**
     * @param $products
     * @return string
     */
    public function export($products): string
    {
        $xml = new \SimpleXMLElement(self::CONTAINER);

        foreach ($products as $key => $product) {
            $productModel = new Product;
            $productModel->setProduct($product);

            $item = $xml->addChild(self::ITEM);

            foreach ($this->getSchema() as $sKey => $getter) {
                $item->addChild($sKey, $productModel->$getter(), self::NAMESPACE);
            }
        }

        return $xml->asXML();
    }
}
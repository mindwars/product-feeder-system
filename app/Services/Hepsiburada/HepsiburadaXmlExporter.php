<?php

namespace App\Services\Hepsiburada;

use App\Contracts\XmlExporterInterface;
use App\Models\Product;

class HepsiburadaXmlExporter implements XmlExporterInterface
{
    /**
     * @var string CONTAINER
     */
    private const CONTAINER = 'products';

    /**
     * @var string product
     */
    private const ITEM = 'product';

    /**
     * @return array
     */
    public function getSchema(): array
    {
        return [
            'id' => 'getId',
            'name' => 'getName',
            'price' => 'getPrice',
            'cat' => 'getCategory'
        ];
    }

    /**
     * @return string
     */
    public function export($products): string
    {
        $xml = new \SimpleXMLElement('<'.self::CONTAINER.' />');

        foreach ($products as $key => $product) {
            $productModel = new Product;
            $productModel->setProduct($product);

            $item = $xml->addChild(self::ITEM);

            foreach ($this->getSchema() as $sKey => $getter) {
                $item->addChild($sKey, $productModel->$getter());
            }
        }

        return $xml->asXML();
    }
}
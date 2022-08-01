<?php

namespace App\Services\Cimri;

use App\Models\Product;

class CimriXmlExporter implements \App\Contracts\XmlExporterInterface
{
    /**
     * @var string CONTAINER
     */
    private const CONTAINER = 'root';

    /**
     * @var string ITEM
     */
    private const ITEM = 'item';

    /**
     * @return array
     */
    public function getSchema(): array
    {
        return [
            'id' => 'getId',
            'name' => 'getName',
            'price' => 'getPrice',
            'category' => 'getCategory'
        ];
    }

    /**
     * @param array $products
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
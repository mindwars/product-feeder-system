<?php

namespace App\Services\Hepsiburada;

use App\Contracts\JsonExporterInterface;
use App\Models\Product;

class HepsiburadaJsonExporter implements JsonExporterInterface
{
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
     * @param array $products
     * @return string
     */
    public function export($products): string
    {
        $result = array();
        foreach ($products as $key => $product) {
            $productModel = new Product;
            $productModel->setProduct($product);

            foreach ($this->getSchema() as $sKey => $getter) {
                $result[$key][$sKey] = $productModel->$getter();
            }
        }

        return json_encode($result);
    }
}
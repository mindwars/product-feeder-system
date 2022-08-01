<?php

namespace App\Services\Google;

use App\Contracts\JsonExporterInterface;
use App\Models\Product;

class GoogleJsonExporter implements JsonExporterInterface
{
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
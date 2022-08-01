<?php

namespace App\Models;

use App\Services\FileManagementService;

class Product
{
    /**
     * @var int $id
     */
    private int $id;

    /**
     * @var string $name
     */
    private string $name;

    /**
     * @var string $price
     */
    private float $price;

    /**
     * @var string $category
     */
    private string $category;

    /**
     * @return array
     */
    public function getAll(): array
    {
        $fileManager = new FileManagementService();
        $products = $fileManager->getFileContent('products.json');

        return json_decode($products);
    }

    /**
     * @param object $data
     * @return void
     */
    public function setProduct($data): void
    {
        $this->id = $data->id;
        $this->name = $data->name;
        $this->price = $data->price;
        $this->category = $data->category;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return intval($this->id);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getPrice(): string
    {
        return number_format($this->price, 2);
    }

    /**
     * @return string
     */
    public function getCategory(): string
    {
        return $this->category;
    }

    /**
     * @params int $id
     * @return void
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @params string $name
     * @return void
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param float $price
     * @return void
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    /**
     * @param string $category
     * @return void
     */
    public function setCategory(string $category): void
    {
        $this->category = $category;
    }
}
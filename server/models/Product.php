<?php


class ProductModel
{
    private string $sku;
    private string $name;
    private float $price;
    private int $typeId;

    public function getSku()
    {
        return $this->sku;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getPrice()
    {
        return $this->price;
    }
    public function getTypeId()
    {
        return $this->typeId;
    }
    public function setSku($sku)
    {
        $this->sku = $sku;
    }
    public function setName($name)
    {
        $this->name = $name;
    }
    public function setPrice($price)
    {
        $this->price = $price;
    }
    public function setTypeId($typeId)
    {
        $this->typeId = $typeId;
    }
}

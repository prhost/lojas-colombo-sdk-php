<?php

namespace Prhost\Colombo\Model;

use Prhost\Colombo\Classes\ModelBase;

class Product extends ModelBase
{
    public static $attributeMap = [
        "brand"             => "string",
        "description"       => "string",
        "groupId"           => "integer",
        "guide"             => "string",
        "model"             => "string",
        "name"              => "string",
        "productAttributeValues"  => [
            "attributeId"       => "integer",
            "attributeValue"    => "string",
        ],
        "productItemVariations" => [
            "color"             => "string",
            "deliveryTimeDays"  => "integer",
            "ean"               => "string",
            "height"            => "number",
            "length"            => "number",
            "price"             => "number",
            "productItemPictures" => [
                "picture"           => "string",
            ],
            "size"              => "string",
            "skuSellerId"       => "string",
            "stock"             => "integer",
            "voltage"           => "string",
            "weight"            => "number",
            "width"             => "number",
        ],
        "youtubeLink" => "string",
    ];

    /**
     * @var string
     */
    protected $brand;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var int
     */
    protected $groupId;

    /**
     * @var string
     */
    protected $guide;

    /**
     * @var string
     */
    protected $model;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var array
     */
    protected $productAttributeValues;

    /**
     * @var array
     */
    protected $productItemVariations;

    /**
     * @var string
     */
    protected $youtubeLink;


    /**
     * Product constructor.
     *
     * @param \StdClass|null $data
     */
    public function __construct(\StdClass $data = null)
    {
        if (!empty($data)){
            $this->brand = $data->brand;
            $this->description = $data->description;
            $this->groupId = $data->groupId;
            $this->guide = $data->guide;
            $this->model = $data->model;
            $this->name = $data->name;
            $this->productAttributeValues = $data->productAttributeValues ?? [];
            $this->productItemVariations = $data->productItemVariations ?? [];
            $this->youtubeLink = $data->youtubeLink;
        }
    }


    /**
     * @return string
     */
    public function getBrand(): string
    {
        return $this->brand;
    }

    /**
     * @param string $brand
     */
    public function setBrand(string $brand): void
    {
        $this->brand = $brand;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return int
     */
    public function getGroupId(): int
    {
        return $this->groupId;
    }

    /**
     * @param int $groupId
     */
    public function setGroupId(int $groupId): void
    {
        $this->groupId = $groupId;
    }

    /**
     * @return string
     */
    public function getGuide(): ?string
    {
        return $this->guide;
    }

    /**
     * @param string $guide
     */
    public function setGuide(string $guide): void
    {
        $this->guide = $guide;
    }

    /**
     * @return string
     */
    public function getModel(): string
    {
        return $this->model;
    }

    /**
     * @param string $model
     */
    public function setModel(string $model): void
    {
        $this->model = $model;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return array
     */
    public function getProductAttributeValues(): array
    {
        return $this->productAttributeValues;
    }

    /**
     * @param array $productAttributeValues
     */
    public function setProductAttributeValues(array $productAttributeValues): void
    {
        $this->productAttributeValues = $productAttributeValues;
    }

    /**
     * @return array
     */
    public function getProductItemVariations(): array
    {
        return $this->productItemVariations;
    }

    /**
     * @param array $productItemVariations
     */
    public function setProductItemVariations(array $productItemVariations): void
    {
        $this->productItemVariations = $productItemVariations;
    }

    /**
     * @return string
     */
    public function getYoutubeLink(): ?string
    {
        return $this->youtubeLink;
    }

    /**
     * @param string $youtubeLink
     */
    public function setYoutubeLink(string $youtubeLink): void
    {
        $this->youtubeLink = $youtubeLink;
    }


}
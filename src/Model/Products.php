<?php

namespace Prhost\Colombo\Model;

use Prhost\Colombo\Classes\Collection;
use Prhost\Colombo\Classes\ModelBase;

class Products extends ModelBase
{
    public static $attributeMap = [
        "numberOfElements"  => "integer",
        "page"              => "integer",
        "totalElements"     => "integer",
        "totalPages"        => "integer",
        "product" => [
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
        ],
    ];

    /**
     * @var int
     */
    protected $numberOfElements;

    /**
     * @var int
     */
    protected $page;

    /**
     * @var int
     */
    protected $totalElements;

    /**
     * @var int
     */
    protected $totalPages;

    /**
     * @var Collection[Product]
     */
    protected $products;

    /**
     * Product constructor.
     *
     * @param \stdClass|null $products
     */
    public function __construct(\stdClass $products = null)
    {
        $this->products = new Collection();

        if ($products) {
            $this->numberOfElements = $products->numberOfElements;
            $this->page = $products->page;
            $this->totalElements = $products->totalElements;
            $this->totalPages = $products->totalPages;

            foreach ($products->content as $product) {
                $this->products->push(new Product($product));
            }
        }
    }

    /**
     * @return int
     */
    public function getNumberOfElements(): int
    {
        return $this->numberOfElements;
    }

    /**
     * @param int $numberOfElements
     */
    public function setNumberOfElements(int $numberOfElements): void
    {
        $this->numberOfElements = $numberOfElements;
    }

    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * @param int $page
     */
    public function setPage(int $page): void
    {
        $this->page = $page;
    }

    /**
     * @return int
     */
    public function getTotalElements(): int
    {
        return $this->totalElements;
    }

    /**
     * @param int $totalElements
     */
    public function setTotalElements(int $totalElements): void
    {
        $this->totalElements = $totalElements;
    }

    /**
     * @return int
     */
    public function getTotalPages(): int
    {
        return $this->totalPages;
    }

    /**
     * @param int $totalPages
     */
    public function setTotalPages(int $totalPages): void
    {
        $this->totalPages = $totalPages;
    }

    /**
     * @return Collection[Product]
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    /**
     * @param Collection[Product] $products
     */
    public function setProducts(Collection $products): void
    {
        $this->products = $products;
    }

    public function setProduct(Product $product)
    {
        if (null === $this->products) {
            $this->products = new Collection();
        }
        $this->products->push($product);
    }

}
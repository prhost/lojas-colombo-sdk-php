<?php


namespace Prhost\Colombo\Model;

use Prhost\Colombo\Classes\Collection;
use Prhost\Colombo\Classes\ModelBase;

class Categories extends ModelBase
{

    /**
     * @var array
     */
    protected static $attributeMap = [

        "categories" => [
            "eanRequired" => "boolean",
            "familyId" => "integer",
            "familyName" => "string",
            "groupId" => "integer",
            "groupName" => "string",
            "lineId" => "integer",
            "lineName" => "string",
        ],
    ];

    /**
     * @var Collection[Category]
     */
    protected $categories;


    public function __construct(array $categories = [])
    {
        $this->categories = new Collection();

        if ($categories) {
            foreach ($categories as $category) {
                $this->categories->push(new Category($category));
            }
        }
    }

    /**
     * @return Collection[Category]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    /**
     * @param Collection[Category] $categories
     */
    public function setCategories(Collection $categories): void
    {
        $this->categories = $categories;
    }


    public function setCategory(Category $category)
    {
        if (null === $this->categories) {
            $this->categories = new Collection();
        }
        $this->categories->push($category);
    }
}
<?php


namespace Prhost\Colombo\Model;

use Prhost\Colombo\Classes\Collection;
use Prhost\Colombo\Classes\ModelBase;

class Attributes extends ModelBase
{

    /**
     * @var array
     */
    protected static $attributeMap = [

        "attributes" => [
            "attributeId"   => "integer",
            "attributeType" => "string",
            "attributeUnit" => "string",
            "name"          => "string",
            "needed"        => "boolean",
        ],
    ];

    /**
     * @var Collection[Attribute]
     */
    protected $attributes;


    public function __construct(array $attributes = [])
    {
        $this->attributes = new Collection();

        if ($attributes) {
            foreach ($attributes as $attribute) {
                $this->attributes->push(new Attribute($attribute));
            }
        }
    }

    /**
     * @return Collection[Attribute]
     */
    public function getAttributes(): Collection
    {
        return $this->attributes;
    }

    /**
     * @param Collection[Attribute] $attributes
     */
    public function setAttributes(Collection $attributes): void
    {
        $this->attributes = $attributes;
    }


    public function setAttribute(Attribute $attribute)
    {
        if (null === $this->attributes) {
            $this->attributes = new Collection();
        }
        $this->attributes->push($attribute);
    }
}
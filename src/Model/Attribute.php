<?php


namespace Prhost\Colombo\Model;

use Prhost\Colombo\Classes\ModelBase;

class Attribute extends ModelBase
{
    protected static $attributeMap = [
        "attributeId"   => "integer",
        "attributeType" => "string",
        "attributeUnit" => "string",
        "name"          => "string",
        "needed"        => "boolean",
    ];

    /**
     * @var int
     */
    protected $attributeId;

    /**
     * @var string
     */
    protected $attributeType;

    /**
     * @var string
     */
    protected $attributeUnit;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var bool
     */
    protected $needed;

    /**
     * Attribute constructor.
     *
     * @param \StdClass|null $data
     */
    public function __construct(\StdClass $data = null)
    {
        $this->attributeId = $data->attributeId;
        $this->attributeType = $data->attributeType;
        $this->attributeUnit = $data->attributeUnit;
        $this->name = $data->name;
        $this->needed = $data->needed;
    }

    /**
     * @return int
     */
    public function getAttributeId(): int
    {
        return (int)$this->attributeId;
    }

    /**
     * @param int $attributeId
     */
    public function setAttributeId(int $attributeId): void
    {
        $this->attributeId = $attributeId;
    }

    /**
     * @return string
     */
    public function getAttributeType(): string
    {
        return (string)$this->attributeType;
    }

    /**
     * @param string $attributeType
     */
    public function setAttributeType(string $attributeType): void
    {
        $this->attributeType = $attributeType;
    }

    /**
     * @return string
     */
    public function getAttributeUnit(): string
    {
        return (string)$this->attributeUnit;
    }

    /**
     * @param string $attributeUnit
     */
    public function setAttributeUnit(string $attributeUnit): void
    {
        $this->attributeUnit = $attributeUnit;
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
     * @return bool
     */
    public function isNeeded(): bool
    {
        return (bool)$this->needed;
    }

    /**
     * @param bool $needed
     */
    public function setNeeded(bool $needed): void
    {
        $this->needed = $needed;
    }
}
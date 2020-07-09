<?php


namespace Prhost\Colombo\Model;

use Prhost\Colombo\Classes\ModelBase;

class Category extends ModelBase
{
    protected static $attributeMap = [
        "eanRequired" => "boolean",
        "familyId" => "integer",
        "familyName" => "string",
        "groupId" => "integer",
        "groupName" => "string",
        "lineId" => "integer",
        "lineName" => "string",
    ];

    /**
     * @var bool
     */
    protected $eanRequired;

    /**
     * @var int
     */
    protected $familyId;

    /**
     * @var string
     */
    protected $familyName;

    /**
     * @var int
     */
    protected $groupId;

    /**
     * @var string
     */
    protected $groupName;

    /**
     * @var int
     */
    protected $lineId;

    /**
     * @var string
     */
    protected $lineName;


    /**
     * Category constructor.
     *
     * @param \StdClass|null $data
     */
    public function __construct(\StdClass $data = null)
    {
        $this->eanRequired = $data->eanRequired;
        $this->familyId = $data->familyId;
        $this->familyName = $data->familyName;
        $this->groupId = $data->groupId;
        $this->groupName = $data->groupName;
        $this->lineId = $data->lineId;
        $this->lineName = $data->lineName;
    }

    /**
     * @return bool
     */
    public function isEanRequired(): bool
    {
        return $this->eanRequired;
    }

    /**
     * @param bool $eanRequired
     */
    public function setEanRequired(bool $eanRequired): void
    {
        $this->eanRequired = $eanRequired;
    }

    /**
     * @return int
     */
    public function getFamilyId(): int
    {
        return $this->familyId;
    }

    /**
     * @param int $familyId
     */
    public function setFamilyId(int $familyId): void
    {
        $this->familyId = $familyId;
    }

    /**
     * @return string
     */
    public function getFamilyName(): string
    {
        return $this->familyName;
    }

    /**
     * @param string $familyName
     */
    public function setFamilyName(string $familyName): void
    {
        $this->familyName = $familyName;
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
    public function getGroupName(): string
    {
        return $this->groupName;
    }

    /**
     * @param string $groupName
     */
    public function setGroupName(string $groupName): void
    {
        $this->groupName = $groupName;
    }

    /**
     * @return int
     */
    public function getLineId(): int
    {
        return $this->lineId;
    }

    /**
     * @param int $lineId
     */
    public function setLineId(int $lineId): void
    {
        $this->lineId = $lineId;
    }

    /**
     * @return string
     */
    public function getLineName(): string
    {
        return $this->lineName;
    }

    /**
     * @param string $lineName
     */
    public function setLineName(string $lineName): void
    {
        $this->lineName = $lineName;
    }


}
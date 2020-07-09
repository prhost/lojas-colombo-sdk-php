<?php


namespace Prhost\Colombo\Model;

use Prhost\Colombo\Classes\Collection;
use Prhost\Colombo\Classes\ModelBase;

class EndPointLimit extends ModelBase
{
    static $attributeMap = [
        'EndPointLimit' => [
            'Name' => 'string',
            'RequestsByMinute' => 'integer',
            'RequestsByHour' => 'integer'
        ]
    ];

    /**
     * @var Collection
     */
    public $endPointLimit;

    public function __construct(array $data)
    {
        $this->endPointLimits = new Collection($data);
    }
}
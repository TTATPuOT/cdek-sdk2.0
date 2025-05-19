<?php

declare(strict_types=1);

namespace CdekSDK2\Dto;

use JMS\Serializer\Annotation\Type;

/**
 * Class Statuses
 * @package CdekSDK2\Dto
 */
class Statuses
{
    /**
     * Код статуса
     * @Type("string")
     * @var string
     */
    public $code;

    /**
     * Название статуса
     * @Type("string")
     * @var string
     */
    public $name;

    /**
     * Дата и время установки статуса
     * @Type("string")
     * @var string
     */
    public $date_time;


    /**
     * Дополнительный код статуса
     * @Type("string")
     * @var string
     */
    public $reason_code;

    /**
     * Наименование города(места), где произошло изменение статуса
     * @Type("string")
     * @var string
     */
    public $city;

    /**
     * Идентификатор места (города) возникновения статуса
     * @Type("string")
     * @var string
     */
    public $city_uuid;

    /**
     * Признак удаления статуса
     * @Type("bool")
     * @var bool
     */
    public $deleted;
}

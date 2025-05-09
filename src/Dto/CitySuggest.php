<?php

declare(strict_types=1);

namespace CdekSDK2\Dto;

use JMS\Serializer\Annotation\Type;

class CitySuggest
{
    /**
     * Идентификатор населенного пункта СДЭК
     * @Type("string")
     * @var string
     */
    public $city_uuid;

    /**
     * Код населенного пункта (справочник СДЭК)
     * @Type("int")
     * @var int
     */
    public $code;

    /**
     * Наименование населенного пункта СДЭК (город, район, регион, страна)
     * @Type("string")
     * @var string
     */
    public $full_name;
}

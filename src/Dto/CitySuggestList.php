<?php

declare(strict_types=1);

namespace CdekSDK2\Dto;

use JMS\Serializer\Annotation\Type;

class CitySuggestList
{
    /**
     * Список городов
     * @Type("array<CdekSDK2\Dto\CitySuggest>")
     * @var CitySuggest[]
     */
    public $items;
}

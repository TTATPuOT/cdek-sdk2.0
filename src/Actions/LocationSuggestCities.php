<?php

declare(strict_types=1);

namespace CdekSDK2\Actions;

/**
 * Class LocationRegions
 * @package CdekSDK2\Actions
 */
class LocationSuggestCities extends Action
{
    use FilteredTrait;

    /**
     * URL для запросов к API
     * @var string
     */
    public const URL = '/location/suggest/cities';

    /**
     * Список корректных параметров, которые разрешено передавать для поиска населенных пунктов
     * @var array
     */
    public const FILTER = [
        'country_code' => '',
        'name' => '',
    ];
}

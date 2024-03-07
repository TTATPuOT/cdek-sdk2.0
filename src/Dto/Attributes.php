<?php

declare(strict_types=1);

namespace CdekSDK2\Dto;

use JMS\Serializer\Annotation\Type;

class Attributes
{
    /**
     * Признак возвратного заказа:
     * true - является возвратной
     * false - является прямой
     * @Type("bool")
     * @var bool
     */
    public $is_return;

    /**
     * Номер заказа СДЭК
     * @Type("int")
     * @var int
     */
    public $cdek_number;

    /**
     * Номер заказа в ИС Клиента
     * @Type("string")
     * @var string
     */
    public $number;

    /**
     * Код статуса
     * @Type("string")
     * @var string
     */
    public $status_code;

    /**
     * Код дополнительного статуса
     * @Type("string")
     * @var string
     */
    public $status_reason_code;

    /**
     * Дата и время установки статуса
     * @Type("string")
     * @var string
     */
    public $status_date_time;

    /**
     * Наименование города возникновения статуса
     * @Type("string")
     * @var string
     */
    public $city_name;

    /**
     * Код города возникновения статуса (не возвращается для статуса "Создан")
     * @Type("string")
     * @var int
     */
    public $city_code;

    /**
     * Код статуса (подробнее см. приложение 1)
     * @Type("string")
     * @var string
     */
    public $code;

    /**
     * Признак возвратного заказа
     * @Type("boolean")
     * @var boolean
     */
    public $is_reverse;

    /**
     * Признак клиентского возврата
     * @Type("boolean")
     * @var boolean
     */
    public $is_client_return;

    /**
     * Тип печатной формы
     * @Type("string")
     * @var string
     */
    public $type;

    /**
     * Ссылка на скачивание файла
     * @Type("string")
     * @var string
     */
    public $url;

    /**
     * Ссылка на скачивание файла:
     * Формат: https://photo-docs.production.cdek.ru/archives/qWErtY
     * @Type("string")
     * @var string
     */
    public $link;

    /**
     * Номер СДЭК закрытого преалерта
     * @Type("string")
     * @var string
     */
    public $prealert_number;

    /**
     * Дата закрытия
     * @Type("string")
     * @var string
     */
    public $closed_date;

    /**
     * Фактический ПВЗ, в который были переданы заказы
     * @Type("string")
     * @var string
     */
    public $fact_shipment_point;
}

<?php

namespace CdekSDK2\Constraints;

class DeliveryTypes
{
    /**
     * Дверь-дверь (Д-Д)
     */
    public const DOOR_DOOR = 1;

    /**
     * Дверь-склад (Д-С)
     */
    public const DOOR_WAREHOUSE = 2;

    /**
     * Склад-дверь (С-Д)
     */
    public const WAREHOUSE_DOOR = 3;

    /**
     * Склад-склад (С-С)
     */
    public const WAREHOUSE_WAREHOUSE = 4;

    /**
     * Терминал-терминал (Т-Т)
     */
    public const TERMINAL_TERMINAL = 5;

    /**
     * Дверь-постамат (Д-П)
     */
    public const DOOR_POSTAMATE = 6;

    /**
     * Склад-постамат (С-П)
     */
    public const WAREHOUSE_POSTAMATE = 7;

    /**
     * Постамат-дверь (П-Д)
     */
    public const POSTAMATE_DOOR = 8;

    /**
     * Постамат-склад (П-С)
     */
    public const POSTAMATE_WAREHOUSE = 9;

    /**
     * Постамат-постамат (П-П)
     */
    public const POSTAMATE_POSTAMATE = 10;
}
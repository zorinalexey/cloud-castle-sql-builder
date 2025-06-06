<?php

declare(strict_types = 1);

namespace CloudCastle\SqlBuilder\Interfaces\Schema\Table\Action;

/**
 * Общий интерфейс модификации таблицы
 */
interface ActionTableInterface
{
    /**
     * Задать наименование таблицы для дальнейшей установки параметров запроса
     *
     * @param string $tableName Наименование таблицы
     * @return $this Текущий объект класса
     */
    public function name (string $tableName): self;
}
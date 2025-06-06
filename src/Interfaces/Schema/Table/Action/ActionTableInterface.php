<?php

declare(strict_types = 1);

namespace CloudCastle\SqlBuilder\Interfaces\Schema\Table\Action;

interface ActionTableInterface
{
    /**
     * Задать наименование таблицы для дальнейшей установки параметров запроса
     *
     * @param string $tableName Наименование таблицы
     * @return self
     */
    public function name (string $tableName): self;
}
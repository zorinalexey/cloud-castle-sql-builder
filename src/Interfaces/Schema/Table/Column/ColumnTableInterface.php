<?php

namespace CloudCastle\SqlBuilder\Interfaces\Schema\Table\Column;

/**
 * Общий интерфейс классов модификации колонок
 */
interface ColumnTableInterface
{
    /**
     * Метод задает наименование колонки
     *
     * @param string $columnName Наименование колонки
     * @return $this Текущий объект класса
     */
    public function name(string $columnName): static;
}
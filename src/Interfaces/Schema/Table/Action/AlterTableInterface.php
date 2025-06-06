<?php

declare(strict_types = 1);

namespace CloudCastle\SqlBuilder\Interfaces\Schema\Table\Action;

use CloudCastle\SqlBuilder\Interfaces\Schema\Table\ColumnInterface;
use CloudCastle\SqlBuilder\Interfaces\Schema\Table\IndexInterface;
use CloudCastle\SqlBuilder\Interfaces\Schema\Table\KeyInterface;

/**
 * Интерфейс определяет методы для изменения данных таблицы (индексы, ключи, колонки, переименование таблицы)
 */
interface AlterTableInterface extends ActionTableInterface
{
    /**
     * Метод модификации колонки в таблице
     *
     * @param string $columnName Наименование колонки
     * @return ColumnInterface
     */
    public function column(string $columnName): ColumnInterface;
    
    /**
     * Метод переименования таблицы
     *
     * @param string $newTableName Новое наименование таблицы
     * @return mixed
     */
    public function rename(string $newTableName);
    
    /**
     * Метод модификации индексов таблицы
     *
     * @param string $indexName Наименование индекса
     * @return IndexInterface
     */
    public function index(string $indexName): IndexInterface;
    
    /**
     * Метод модификации ключей таблицы
     *
     * @param string $keyName
     * @return KeyInterface
     */
    public function key(string $keyName): KeyInterface;
}
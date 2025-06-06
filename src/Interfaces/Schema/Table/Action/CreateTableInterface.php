<?php

declare(strict_types = 1);

namespace CloudCastle\SqlBuilder\Interfaces\Schema\Table\Action;

use CloudCastle\SqlBuilder\Interfaces\Schema\Table\ColumnInterface;
use CloudCastle\SqlBuilder\Interfaces\Schema\Table\IndexInterface;
use CloudCastle\SqlBuilder\Interfaces\Schema\Table\KeyInterface;

interface CreateTableInterface extends ActionTableInterface
{
    /**
     * Метод модификации колонок таблицы
     *
     * @param string $columnName Наименование колонки
     * @return ColumnInterface Объект модификации колонки
     */
    public function column(string $columnName): ColumnInterface;
    
    /**
     * Метод модификации индексов таблицы
     *
     * @param string $indexName Наименование индекса
     * @return IndexInterface Объект модификации индекса
     */
    public function index(string $indexName): IndexInterface;
    
    /**
     * Метод модификации ключей таблицы
     *
     * @param string $keyName Наименование ключа
     * @return KeyInterface Объект модификации ключа
     */
    public function key(string $keyName): KeyInterface;
}
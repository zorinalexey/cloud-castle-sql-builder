<?php

declare(strict_types = 1);

namespace CloudCastle\SqlBuilder\Interfaces\Schema\Table\Action;

/**
 * Интерфейс определяет методы для изменения данных таблицы (индексы, ключи, колонки, переименование таблицы)
 */
interface AlterTableInterface extends ActionTableInterface
{
    /**
     * Метод изменения колонки в таблице
     *
     * @param string $columnName Наименование колонки
     * @return mixed
     */
    public function column(string $columnName);
    
    /**
     * Метод переименования таблицы
     *
     * @param string $newTableName Новое наименование таблицы
     * @return mixed
     */
    public function rename(string $newTableName);
    
    /**
     * Метод изменения индексов таблицы
     *
     * @param string $indexName Наименование индекса
     * @return mixed
     */
    public function index(string $indexName);
}
<?php

declare(strict_types = 1);

namespace CloudCastle\SqlBuilder;

use CloudCastle\SqlBuilder\Interfaces\Query\DeleteInterface;
use CloudCastle\SqlBuilder\Interfaces\Query\InsertInterface;
use CloudCastle\SqlBuilder\Interfaces\Query\SelectInterface;
use CloudCastle\SqlBuilder\Interfaces\Query\UpdateInterface;
use CloudCastle\SqlBuilder\Interfaces\QueryBuilderInterface;
use CloudCastle\SqlBuilder\Query\Delete;
use CloudCastle\SqlBuilder\Query\Insert;
use CloudCastle\SqlBuilder\Query\Select;
use CloudCastle\SqlBuilder\Query\Update;

/**
 * Класс предоставляет методы для доступа к объектам манипуляции данных
 */
final class QueryBuilder implements QueryBuilderInterface
{
    /**
     * Сгенерировать запрос на выборку данных из базы
     *
     * @param string $table Наименование таблицы
     *
     * @return SelectInterface
     */
    public function select (string $table): SelectInterface
    {
        $select = new Select();
        $select->table($table);
        
        return $select;
    }
    
    /**
     * Сгенерировать запрос на вставку данных в базу
     *
     * @param string $table Наименование таблицы
     *
     * @return InsertInterface
     */
    public function insert (string $table): InsertInterface
    {
        $insert = new Insert();
        $insert->table($table);
        
        return $insert;
    }
    
    /**
     * Сгенерировать запрос для обновления данных
     *
     * @param string $table Наименование таблицы
     *
     * @return UpdateInterface
     */
    public function update (string $table): UpdateInterface
    {
        $update = new Update();
        $update->table($table);
        
        return $update;
    }
    
    /**
     * Сгенерировать запрос для удаления данных
     *
     * @param string $table Наименование таблицы
     *
     * @return DeleteInterface
     */
    public function delete (string $table): DeleteInterface
    {
        $delete = new Delete();
        $delete->table($table);
        
        return $delete;
    }
}

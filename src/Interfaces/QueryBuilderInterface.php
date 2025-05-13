<?php

declare(strict_types = 1);

namespace CloudCastle\SqlBuilder\Interfaces;

use CloudCastle\SqlBuilder\Interfaces\Query\DeleteInterface;
use CloudCastle\SqlBuilder\Interfaces\Query\InsertInterface;
use CloudCastle\SqlBuilder\Interfaces\Query\SelectInterface;
use CloudCastle\SqlBuilder\Interfaces\Query\UpdateInterface;

/**
 * Интерфейс определяет методы для доступа к объектам манипуляции данных
 */
interface QueryBuilderInterface
{
    /**
     * Сгенерировать запрос на выборку данных из базы
     *
     * @param string $table Наименование таблицы
     *
     * @return SelectInterface
     */
    public function select (string $table): SelectInterface;
    
    /**
     * Сгенерировать запрос на вставку данных в базу
     *
     * @param string $table Наименование таблицы
     *
     * @return InsertInterface
     */
    public function insert (string $table): InsertInterface;
    
    /**
     * Сгенерировать запрос для обновления данных
     *
     * @param string $table Наименование таблицы
     *
     * @return UpdateInterface
     */
    public function update (string $table): UpdateInterface;
    
    /**
     * Сгенерировать запрос для удаления данных
     *
     * @param string $table Наименование таблицы
     *
     * @return DeleteInterface
     */
    public function delete (string $table): DeleteInterface;
}

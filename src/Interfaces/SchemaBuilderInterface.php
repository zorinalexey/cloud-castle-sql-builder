<?php

declare(strict_types=1);

namespace CloudCastle\SqlBuilder\Interfaces;

use CloudCastle\SqlBuilder\Enums\DriverEnum;
use CloudCastle\SqlBuilder\Interfaces\Schema\Procedure\ProcedureInterface;
use CloudCastle\SqlBuilder\Interfaces\Schema\Table\TableInterface;

/**
 * Интерфейс определяет методы для управления таблицами и хранимыми процедурами
 */
interface SchemaBuilderInterface
{
    /**
     * Конструктор класса
     *
     * @param DriverEnum $driver Драйвер типа БД
     */
    public function __construct (DriverEnum $driver);
    
    /**
     * Метод генерации запросов для создания, изменения и удаления таблиц
     *
     * @param string $tableName
     * @return TableInterface
     */
    public function table (string $tableName): TableInterface;
    
    /**
     * Метод генерации запросов для создания, изменения и удаления хранимых процедур
     *
     * @param string $procedureName
     * @return ProcedureInterface
     */
    public function procedure (string $procedureName): ProcedureInterface;
}
<?php

declare(strict_types=1);

namespace CloudCastle\SqlBuilder;

use CloudCastle\SqlBuilder\Common\Validator;
use CloudCastle\SqlBuilder\Enums\DriverEnum;
use CloudCastle\SqlBuilder\Exceptions\InvalidArgumentException;
use CloudCastle\SqlBuilder\Interfaces\Schema\Procedure\ProcedureInterface;
use CloudCastle\SqlBuilder\Interfaces\Schema\Table\TableInterface;
use CloudCastle\SqlBuilder\Interfaces\SchemaBuilderInterface;
use CloudCastle\SqlBuilder\Schema\Procedure\Procedure;
use CloudCastle\SqlBuilder\Schema\Table\Table;

/**
 * Класс предоставляет методы для генерации запросов управления таблицами и процедурами
 */
final class SchemaBuilder implements SchemaBuilderInterface
{
    /**
     * Драйвер класса генерации запроса
     *
     * @var DriverEnum
     */
    private readonly DriverEnum $driver;
    
    /**
     * Объект валидации входных данных
     *
     * @var Validator
     */
    private readonly Validator $validator;
    
    /**
     * Конструктор класса
     *
     * @param DriverEnum $driver Драйвер класса генерации запроса
     */
    public function __construct (DriverEnum $driver)
    {
        $this->driver = $driver;
        $this->validator = new Validator();
    }
    
    /**
     * Метод генерации запросов для создания, изменения и удаления таблиц
     *
     * @param string $tableName Наименование таблицы
     * @return TableInterface Объект генерации запроса управления таблицей
     * @throws InvalidArgumentException
     */
    public function table (string $tableName): TableInterface
    {
        $this->validator->validateTableName($tableName);
        $table = new Table();
        $table->name($tableName);
        $table->driver($this->driver);
        
        return $table;
    }
    
    /**
     * Метод генерации запросов для создания, изменения и удаления хранимых процедур
     *
     * @param string $procedureName Наименование процедуры
     * @return ProcedureInterface Объект генерации запроса управления процедурой
     * @throws InvalidArgumentException
     */
    public function procedure (string $procedureName): ProcedureInterface
    {
        $this->validator->validateProcedureName($procedureName);
        $procedure = new Procedure();
        $procedure->name($procedureName);
        $procedure->driver($this->driver);
        
        return $procedure;
    }
}
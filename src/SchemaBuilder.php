<?php

declare(strict_types=1);

namespace CloudCastle\SqlBuilder;

use CloudCastle\SqlBuilder\Enums\DriverEnum;
use CloudCastle\SqlBuilder\Interfaces\Schema\DropTableInterface;
use CloudCastle\SqlBuilder\Interfaces\Schema\TableInterface;
use CloudCastle\SqlBuilder\Interfaces\SchemaBuilderInterface;
use CloudCastle\SqlBuilder\Interfaces\Schema\TableActionsInterface;
use CloudCastle\SqlBuilder\Schema\TableActions;

final class SchemaBuilder implements SchemaBuilderInterface
{
    /**
     * @var DriverEnum
     */
    private readonly DriverEnum $driver;
    
    /**
     * @var string
     */
    private readonly string $schemaNamespace;
    
    /**
     * @param DriverEnum $driver
     */
    public function __construct (DriverEnum $driver)
    {
        $this->driver = $driver;
        $this->schemaNamespace = "\CloudCastle\SqlBuilder\Schema\\".$this->driver->name;
    }
    
    /**
     * Создать таблицу
     *
     * @param string $tableName
     * @return TableInterface
     */
    public function table (string $tableName): TableActionsInterface
    {
        return new TableActions();
    }
    
    /**
     * Удалить таблицу
     *
     * @param string $tableName
     * @return DropTableInterface
     */
    public function drop (string $tableName): DropTableInterface
    {
        $actions = new TableActions();
        
        return $actions->drop($tableName, $this->schemaNamespace);
    }
}
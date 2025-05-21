<?php

declare(strict_types=1);

namespace CloudCastle\SqlBuilder\Schema;

use CloudCastle\SqlBuilder\Interfaces\Schema\DropTableInterface;
use CloudCastle\SqlBuilder\Interfaces\Schema\TableActionsInterface;
use CloudCastle\SqlBuilder\Interfaces\Schema\TableInterface;

final class TableActions implements TableActionsInterface
{
    /**
     * @param string $name
     * @return TableInterface
     */
    public function create (string $name): TableInterface
    {
        // TODO: Implement create() method.
    }
    
    /**
     * @param string $name
     * @return TableInterface
     */
    public function alter (string $name): TableInterface
    {
        // TODO: Implement alter() method.
    }
    
    /**
     * Удаление таблицы
     *
     * @param string $name
     * @param string $namespace
     * @return DropTableInterface
     */
    public function drop (string $name, string $namespace): DropTableInterface
    {
        $tableClass = "{$namespace}\DropTable";
        $table = new $tableClass();
        $table->table($name);
        
        return $table;
    }
}
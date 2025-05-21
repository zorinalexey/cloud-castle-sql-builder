<?php

declare(strict_types=1);

namespace CloudCastle\SqlBuilder\Interfaces\Schema;

use CloudCastle\SqlBuilder\Interfaces\BuilderInterface;

interface TableActionsInterface
{
    /**
     * @param string $name
     * @return TableInterface
     */
    public function create(string $name): TableInterface;
    
    /**
     * @param string $name
     * @return TableInterface
     */
    public function alter(string $name): TableInterface;
    
    /**
     * @param string $name
     * @param string $namespace
     * @return DropTableInterface
     */
    public function drop (string $name, string $namespace): DropTableInterface;
}
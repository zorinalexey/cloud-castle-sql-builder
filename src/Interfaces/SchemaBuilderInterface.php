<?php

declare(strict_types=1);

namespace CloudCastle\SqlBuilder\Interfaces;

use CloudCastle\SqlBuilder\Interfaces\Schema\DropTableInterface;
use CloudCastle\SqlBuilder\Interfaces\Schema\TableActionsInterface;

interface SchemaBuilderInterface
{
    public function table(string $tableName): TableActionsInterface;
    
    public function drop(string $tableName): DropTableInterface;
}
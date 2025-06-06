<?php

declare(strict_types = 1);

namespace CloudCastle\SqlBuilder\Interfaces\Schema\Table\Action;

interface CreateTableInterface extends ActionTableInterface
{
    public function column(string $columnName);
    
    public function index(string $indexName);
    
    public function key(string $keyName);
}
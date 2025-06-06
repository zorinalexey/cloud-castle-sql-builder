<?php

namespace CloudCastle\SqlBuilder\Interfaces\Schema\Table\Action;

interface TransactionInterface
{
    public function begin();
    
    public function commit();
    
    public function rollback();
}
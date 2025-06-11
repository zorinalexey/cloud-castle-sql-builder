<?php

namespace CloudCastle\SqlBuilder\Schema\Table\Drivers\PGSQL;

use CloudCastle\SqlBuilder\Schema\Table\Abstracts\AbstractDropTable;

final class DropTable extends AbstractDropTable
{
    /**
     * Получить подготовленную строку запроса
     *
     * @return string
     */
    public function toSql (): string
    {
        $sql = /** @lang text */'DROP TABLE ';
        
        if($this->ifExists){
            $sql .= 'IF EXISTS ';
        }
        
        $sql .= $this->table;
        
        if($this->cascade){
            $sql .= ' CASCADE';
        }
        
        return $sql;
    }
}
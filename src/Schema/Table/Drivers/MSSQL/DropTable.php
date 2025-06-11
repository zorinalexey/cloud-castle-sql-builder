<?php

namespace CloudCastle\SqlBuilder\Schema\Table\Drivers\MSSQL;

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
        $sql = '';
        
        if($this->ifExists){
            $sql .= "IF OBJECT_ID('{$this->table}', 'U') IS NOT NULL";
        }
        
        $sql .= "BEGIN\n\tDROP TABLE {$this->table};\nEND";
        
        return $sql;
    }
}
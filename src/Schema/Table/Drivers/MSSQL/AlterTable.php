<?php

namespace CloudCastle\SqlBuilder\Schema\Table\Drivers\MSSQL;

use CloudCastle\SqlBuilder\Schema\Table\Abstracts\AbstractAlterTable;

final class AlterTable extends AbstractAlterTable
{
    /**
     * Получить подготовленную строку запроса
     *
     * @return string
     */
    public function toSql (): string
    {
        $sql = '';
        
        return $sql;
    }
    
}
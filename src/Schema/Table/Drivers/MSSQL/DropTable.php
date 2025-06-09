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
        
        return $sql;
    }
}
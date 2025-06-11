<?php

namespace CloudCastle\SqlBuilder\Schema\Table\Drivers\SQLITE;

use CloudCastle\SqlBuilder\Schema\Table\Abstracts\AbstractCreateTable;

final class CreateTable extends AbstractCreateTable
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
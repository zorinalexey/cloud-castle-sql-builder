<?php

declare(strict_types=1);

namespace CloudCastle\SqlBuilder\Schema\SQLITE;

use CloudCastle\SqlBuilder\Common\Builder;
use CloudCastle\SqlBuilder\Interfaces\Schema\DropTableInterface;

final class DropTable extends Builder implements DropTableInterface
{
    /**
     * Получить подготовленную строку запроса с заполнителями(биндами)
     *
     * @return string
     */
    public function toSql (): string
    {
        return /** @lang text */"DROP TABLE {$this->table}";
    }
}
<?php

namespace CloudCastle\SqlBuilder\Tests\Unit\Traits;

use CloudCastle\SqlBuilder\Common\Builder;

trait GetClearSql
{
    protected function getClearSql(Builder $builder): string
    {
        return trim((string)preg_replace('/\s\s+/uim', ' ', str_replace(["\n", "\t"], ' ', $builder->toSql())));
    }
}

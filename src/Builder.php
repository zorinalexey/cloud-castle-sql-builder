<?php

declare(strict_types=1);

namespace CloudCastle\SqlBuilder;

use CloudCastle\SqlBuilder\Enums\DriverEnum;
use CloudCastle\SqlBuilder\Interfaces\QueryBuilderInterface;
use CloudCastle\SqlBuilder\Interfaces\SchemaBuilderInterface;

final class Builder
{
    /**
     * @return QueryBuilderInterface
     */
    public function query(): QueryBuilderInterface
    {
        return new QueryBuilder();
    }
    
    /**
     * @return SchemaBuilderInterface
     */
    public function schema(DriverEnum $driver): SchemaBuilderInterface
    {
        return new SchemaBuilder($driver);
    }
}
<?php

namespace CloudCastle\SqlBuilder\Tests\Unit;

use CloudCastle\SqlBuilder\Builder;
use CloudCastle\SqlBuilder\Enums\DriverEnum;
use CloudCastle\SqlBuilder\QueryBuilder;
use CloudCastle\SqlBuilder\SchemaBuilder;
use PHPUnit\Framework\TestCase;

final class BuilderTest extends TestCase
{
    /**
     * @covers Builder
     */
    public function testQuery(): void
    {
        $builder = new Builder();
        $query = $builder->query();
        $this->assertInstanceOf(QueryBuilder::class, $query);
    }
    
    /**
     * @covers SchemaBuilder
     */
    public function testSchema(): void
    {
        $driver = DriverEnum::MYSQL;
        $builder = new Builder();
        $schema = $builder->schema($driver);
        $this->assertInstanceOf(SchemaBuilder::class, $schema);
    }
}

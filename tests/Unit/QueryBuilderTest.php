<?php

namespace CloudCastle\SqlBuilder\Tests\Unit;

use CloudCastle\SqlBuilder\Interfaces\QueryBuilderInterface;
use CloudCastle\SqlBuilder\Query\Delete;
use CloudCastle\SqlBuilder\Query\Insert;
use CloudCastle\SqlBuilder\Query\Select;
use CloudCastle\SqlBuilder\Query\Update;
use CloudCastle\SqlBuilder\QueryBuilder;
use CloudCastle\SqlBuilder\Tests\Unit\Traits\GetClearSql;
use PHPUnit\Framework\TestCase;

final class QueryBuilderTest extends TestCase
{
    use GetClearSql;
    
    /**
     * @covers Select
     */
    public function test_select(): void
    {
        $builder = new QueryBuilder();
        $this->assertInstanceOf(QueryBuilder::class, $builder);
        $this->assertInstanceOf(QueryBuilderInterface::class, $builder);

        $query = $builder->select('test');
        $this->assertInstanceOf(Select::class, $query);
        /*
        $query->where('id', 1)->where('name', 'test')
            ->in('name', ['foo', 'bar'])
            ->orWhere('id', 0)
            ->orWhere('id', 5)
            ->where('name', 'test');
        //var_dump($query->toRawSql());
        */
    }

    /**
     * @covers Insert
     */
    public function test_insert(): void
    {
        $builder = new QueryBuilder();
        $this->assertInstanceOf(QueryBuilder::class, $builder);
        $this->assertInstanceOf(QueryBuilderInterface::class, $builder);

        $query = $builder->insert('test');
        $this->assertInstanceOf(Insert::class, $query);
    }

    /**
     * @covers Update
     */
    public function test_update(): void
    {
        $builder = new QueryBuilder();
        $this->assertInstanceOf(QueryBuilder::class, $builder);
        $this->assertInstanceOf(QueryBuilderInterface::class, $builder);

        $query = $builder->update('test');
        $this->assertInstanceOf(Update::class, $query);
    }

    /**
     * @covers Delete
     */
    public function test_delete(): void
    {
        $builder = new QueryBuilder();
        $this->assertInstanceOf(QueryBuilder::class, $builder);
        $this->assertInstanceOf(QueryBuilderInterface::class, $builder);

        $query = $builder->delete('test');
        $this->assertInstanceOf(Delete::class, $query);
        $this->assertEquals(/** @lang text */ 'DELETE FROM test', $this->getClearSql($query));

        $query->where('id', 1);
        $this->assertEquals([':id_1' => 1], $query->getBinds());
        $this->assertEquals(/** @lang text */ 'DELETE FROM test WHERE id = :id_1', $this->getClearSql($query));
    }
}

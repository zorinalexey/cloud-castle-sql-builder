<?php

declare(strict_types=1);

namespace CloudCastle\SqlBuilder\Tests\Unit\Query;

use CloudCastle\SqlBuilder\Common\Builder;
use CloudCastle\SqlBuilder\Interfaces\BuilderInterface;
use CloudCastle\SqlBuilder\Interfaces\Query\InsertInterface;
use CloudCastle\SqlBuilder\Query\Insert;
use CloudCastle\SqlBuilder\Tests\Unit\Traits\GetClearSql;
use PHPUnit\Framework\TestCase;

final class InsertTest extends TestCase
{
    use GetClearSql;
    
    /**
     * @covers Insert
     */
    public function test_to_sql(): void
    {
        $query = $this->getInsert()->values(['uuid' => md5('test_1'), 'name' => 'test_name_1']);

        $this->assertEquals([
            ':uuid_0_1' => '4e70ffa82fbe886e3c4ac00ac374c29b',
            ':name_0_2' => 'test_name_1',
        ], $query->getBinds());
        $this->assertInstanceOf(Insert::class, $query);
        $this->assertInstanceOf(Builder::class, $query);
        $this->assertInstanceOf(InsertInterface::class, $query);
        $this->assertInstanceOf(BuilderInterface::class, $query);

        $this->assertEquals(
            /** @lang text */
            'INSERT INTO test (uuid, name) VALUES (:uuid_0_1, :name_0_2)',
            $this->getClearSql($query)
        );

        $query->values(['uuid' => md5('test_2'), 'name' => 'test_name_2']);

        $this->assertEquals(
            /** @lang text */
            'INSERT INTO test (uuid, name) VALUES (:uuid_0_1, :name_0_2), (:uuid_1_3, :name_1_4)',
            $this->getClearSql($query)
        );
        $this->assertEquals([
            ':uuid_0_1' => '4e70ffa82fbe886e3c4ac00ac374c29b',
            ':name_0_2' => 'test_name_1',
            ':uuid_1_3' => 'b9dacbc67962b9a91e45394e2cf0dbf6',
            ':name_1_4' => 'test_name_2',
        ], $query->getBinds());
    }
    
    /**
     * @return Insert
     */
    private function getInsert(): Insert
    {
        $query = new Insert();
        $query->table('test');

        return $query;
    }
}

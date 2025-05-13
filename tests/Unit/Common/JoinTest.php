<?php

declare(strict_types=1);

namespace CloudCastle\SqlBuilder\Tests\Unit\Common;

use CloudCastle\SqlBuilder\Common\Builder;
use CloudCastle\SqlBuilder\Common\Join;
use CloudCastle\SqlBuilder\Interfaces\BuilderInterface;
use CloudCastle\SqlBuilder\Interfaces\Query\JoinInterface;
use CloudCastle\SqlBuilder\Tests\Unit\Traits\GetClearSql;
use PHPUnit\Framework\TestCase;

final class JoinTest extends TestCase
{
    use GetClearSql;
    
    /**
     * @covers Join
     */
    public function test_to_sql(): void
    {
        $query = $this->getJoin();
        $this->assertInstanceOf(Join::class, $query);
        $this->assertInstanceOf(Builder::class, $query);
        $this->assertInstanceOf(JoinInterface::class, $query);
        $this->assertInstanceOf(BuilderInterface::class, $query);

        $this->assertEquals('LEFT JOIN users AS u ON u.id = t.id', $this->getClearSql($query));

        $query->and('u.id', [1, 2]);
        $this->assertEquals('LEFT JOIN users AS u ON u.id = t.id AND u.id IN (:u_id_0_1, :u_id_1_2)', $this->getClearSql($query));
        $this->assertEquals([
            ':u_id_0_1' => 1,
            ':u_id_1_2' => 2,
        ], $query->getBinds());

        $query = $this->getJoin();
        $query->or('u.id');
        $this->assertEquals('LEFT JOIN users AS u ON u.id = t.id OR u.id IS NULL', $this->getClearSql($query));
        $this->assertEquals([], $query->getBinds());
    }

    private function getJoin(): Join
    {
        $query = new Join();
        $query->table('users')
            ->alias('u')
            ->on('u.id', 't.id');

        return $query;
    }

    /**
     * @covers Join
     */
    public function test_type(): void
    {
        $query = $this->getJoin()->type('right');
        $this->assertEquals('RIGHT JOIN users AS u ON u.id = t.id', $this->getClearSql($query));

        $query->type('inner');
        $this->assertEquals('INNER JOIN users AS u ON u.id = t.id', $this->getClearSql($query));

        $query->type('outer');
        $this->assertEquals('OUTER JOIN users AS u ON u.id = t.id', $this->getClearSql($query));
        $this->assertEquals([], $query->getBinds());
    }
}

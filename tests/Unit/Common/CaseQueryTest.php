<?php

namespace CloudCastle\SqlBuilder\Tests\Unit\Common;


use CloudCastle\SqlBuilder\Common\Builder;
use CloudCastle\SqlBuilder\Common\CaseQuery;
use CloudCastle\SqlBuilder\Interfaces\BuilderInterface;
use CloudCastle\SqlBuilder\Interfaces\Query\CaseInterface;
use CloudCastle\SqlBuilder\Tests\Unit\Traits\GetClearSql;
use PHPUnit\Framework\TestCase;

final class CaseQueryTest extends TestCase
{
    use GetClearSql;
    
    /**
     * @covers CaseQuery
     */
    public function test_when(): void
    {
        $query = new CaseQuery();
        $this->assertInstanceOf(CaseQuery::class, $query);
        $this->assertInstanceOf(Builder::class, $query);
        $this->assertInstanceOf(CaseInterface::class, $query);
        $this->assertInstanceOf(BuilderInterface::class, $query);
    }
}

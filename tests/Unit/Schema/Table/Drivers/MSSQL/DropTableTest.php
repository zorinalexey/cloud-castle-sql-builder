<?php

namespace CloudCastle\SqlBuilder\Tests\Unit\Schema\Table\Drivers\MSSQL;

use CloudCastle\SqlBuilder\Builder;
use CloudCastle\SqlBuilder\Common\Builder as StringBuilder;
use CloudCastle\SqlBuilder\Enums\DriverEnum;
use CloudCastle\SqlBuilder\Interfaces\Schema\Table\Action\DropTableInterface;
use CloudCastle\SqlBuilder\Interfaces\Schema\Table\TableInterface;
use CloudCastle\SqlBuilder\Schema\Table\Abstracts\AbstractDropTable;
use CloudCastle\SqlBuilder\Schema\Table\Abstracts\AbstractTable;
use CloudCastle\SqlBuilder\Schema\Table\Drivers\MSSQL\DropTable;
use PHPUnit\Framework\TestCase;

final class DropTableTest extends TestCase
{
    /**
     * @covers DropTable
     */
    public function testDropTable(): void
    {
        $builder = new Builder();
        $schema = $builder->schema(DriverEnum::MSSQL)->table('foo');
        $table = $schema->drop();
        $this->assertInstanceOf(TableInterface::class, $schema);
        $this->assertInstanceOf(DropTable::class, $table);
        $this->assertInstanceOf(DropTable::class, $table);
        $this->assertInstanceOf(StringBuilder::class, $table);
        $this->assertInstanceOf(AbstractTable::class, $table);
        $this->assertInstanceOf(AbstractDropTable::class, $table);
        $this->assertInstanceOf(DropTableInterface::class, $table);
    }
}

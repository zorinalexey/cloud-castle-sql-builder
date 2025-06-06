<?php

declare(strict_types = 1);

namespace CloudCastle\SqlBuilder\Common\Enums;

use CloudCastle\SqlBuilder\Interfaces\Schema\KeyTypeInterface;

enum KeyType: string implements KeyTypeInterface
{
    case PRIMARY = 'PRIMARY KEY';
    case FOREIGN = 'FOREIGN KEY';
    case UNIQUE = 'UNIQUE';
    case CHECK = 'CHECK';
    case DEFAULT = 'DEFAULT';

    public function value(): string
    {
        return $this->value;
    }
} 
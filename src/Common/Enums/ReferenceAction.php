<?php

declare(strict_types = 1);

namespace CloudCastle\SqlBuilder\Common\Enums;

use CloudCastle\SqlBuilder\Interfaces\Schema\ReferenceActionInterface;

enum ReferenceAction: string implements ReferenceActionInterface
{
    case NO_ACTION = 'NO ACTION';
    case CASCADE = 'CASCADE';
    case SET_NULL = 'SET NULL';
    case SET_DEFAULT = 'SET DEFAULT';
    case RESTRICT = 'RESTRICT';

    public function value(): string
    {
        return $this->value;
    }
} 
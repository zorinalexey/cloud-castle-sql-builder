<?php

declare(strict_types = 1);

namespace CloudCastle\SqlBuilder\Common\Enums;

enum ReferenceActionEnum: string
{
    case NO_ACTION = 'NO ACTION';
    case CASCADE = 'CASCADE';
    case SET_NULL = 'SET NULL';
    case SET_DEFAULT = 'SET DEFAULT';
    case RESTRICT = 'RESTRICT';
} 
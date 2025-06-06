<?php

declare(strict_types = 1);

namespace CloudCastle\SqlBuilder\Common\Enums;

enum KeyTypeEnum: string
{
    case PRIMARY = 'PRIMARY KEY';
    case FOREIGN = 'FOREIGN KEY';
    case UNIQUE = 'UNIQUE';
    case CHECK = 'CHECK';
    case DEFAULT = 'DEFAULT';
} 
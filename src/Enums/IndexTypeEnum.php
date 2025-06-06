<?php

namespace CloudCastle\SqlBuilder\Enums;

enum IndexTypeEnum: string
{
    case BTREE = 'BTREE';
    case HASH = 'HASH';
    case FULLTEXT = 'FULLTEXT';
    case CLUSTERED = 'CLUSTERED';
    case UNIQUE = 'UNIQUE';
    case INDEX = 'INDEX';
}

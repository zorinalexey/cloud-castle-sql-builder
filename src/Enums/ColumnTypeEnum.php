<?php

namespace CloudCastle\SqlBuilder\Enums;

enum ColumnTypeEnum: string
{
    case INTEGER = 'INTEGER';
    case FLOAT = 'FLOAT';
    case DOUBLE = 'DOUBLE';
    case DECIMAL = 'DECIMAL';
    case NUMERIC = 'NUMERIC';
    case CHAR = 'CHAR';
    case TEXT = 'TEXT';
    case BOOLEAN = 'BOOLEAN';
    case XML = 'XML';
    case JSON = 'JSON';
    case DATETIME = 'DATETIME';
    case TIMESTAMP = 'TIMESTAMP';
    case TIME = 'TIME';
    case DATE = 'DATE';
}

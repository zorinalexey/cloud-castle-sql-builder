<?php

namespace CloudCastle\SqlBuilder\Enums;

enum DriverEnum: string
{
    case MYSQL = 'mysql';
    case SQLITE = 'sqlite';
    case MSSQL = 'mssql';
    case PGSQL = 'pgsql';
}

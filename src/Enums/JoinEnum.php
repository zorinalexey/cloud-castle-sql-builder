<?php

declare(strict_types = 1);

namespace CloudCastle\SqlBuilder\Enums;

/**
 * Способы соединения таблиц
 */
enum JoinEnum: string
{
    /**
     * Левое соединение
     */
    case LEFT = 'LEFT';
    
    /**
     * Правое соединение
     */
    case RIGHT = 'RIGHT';
    
    /**
     * Исключая пустые строки
     */
    case INNER = 'INNER';
    
    /**
     * Полное соединение
     */
    case OUTER = 'OUTER';
}

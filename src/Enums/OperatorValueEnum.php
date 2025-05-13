<?php

declare(strict_types = 1);

namespace CloudCastle\SqlBuilder\Enums;

/**
 * Операторы выборки данных
 */
enum OperatorValueEnum: string
{
    /**
     * Равно
     */
    case EQUALS = '=';
    
    /**
     * Пустое
     */
    case IS_NULL = 'IS NULL';
    
    /**
     * Не пустое
     */
    case IS_NOT_NULL = 'IS NOT NULL';
    
    /**
     * Больше
     */
    case GREATER_THAN = '>';
    
    /**
     * Меньше
     */
    case LESS_THAN = '<';
    
    /**
     * Больше или равно
     */
    case GREATER_THAN_OR_EQUALS = '>=';
    
    /**
     * Меньше или равно
     */
    case LESS_THAN_OR_EQUALS = '<=';
    
    /**
     * Не равно
     */
    case NOT_EQUALS = '!=';
}

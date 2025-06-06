<?php

declare(strict_types = 1);

namespace CloudCastle\SqlBuilder\Interfaces\Schema\Table;

/**
 * Метод определяет методы управления транзакциями
 */
interface TransactionInterface
{
    /**
     * Метод генерации запроса начала транзакции
     *
     * @param bool $begin
     * @return $this Текущий объект класса
     */
    public function begin(bool $begin = true): self;
    
    /**
     * Метод генерации запроса сохранения транзакции
     *
     * @param bool $commit
     * @return $this Текущий объект класса
     */
    public function commit(bool $commit = true): self;
    
    /**
     * Метод генерации запроса отката транзакции
     *
     * @param bool $rollback
     * @return $this Текущий объект класса
     */
    public function rollback(bool $rollback = true): self;
}
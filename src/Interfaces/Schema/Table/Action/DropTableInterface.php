<?php

declare(strict_types = 1);

namespace CloudCastle\SqlBuilder\Interfaces\Schema\Table\Action;

/**
 * Интерфейс определяет методы удаления таблицы
 */
interface DropTableInterface extends ActionTableInterface
{
    /**
     * Метод удаления без выброса ошибки отсутствия таблицы
     *
     * @return DropTableInterface
     */
    public function ifExists(): DropTableInterface;
    
    /**
     * Метод определяет каскадное удаление
     *
     * @param bool $cascade
     * @return DropTableInterface
     */
    public function cascade(bool $cascade = false): DropTableInterface;
}
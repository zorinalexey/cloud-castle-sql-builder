<?php

declare(strict_types = 1);

namespace CloudCastle\SqlBuilder\Interfaces\Schema\Table\Column;

use CloudCastle\SqlBuilder\Enums\ColumnTypeEnum;
use CloudCastle\SqlBuilder\Interfaces\Schema\Table\IndexInterface;
use CloudCastle\SqlBuilder\Interfaces\Schema\Table\KeyInterface;

/**
 * Интерфейс предоставляет методы установки параметров колонки для изменения
 */
interface AlterColumnInterface extends ColumnTableInterface
{
    /**
     * Метод определяет установку типа колонки
     *
     * @param ColumnTypeEnum $type Тип колонки
     * @return AlterColumnInterface Текущий объект класса
     */
    public function type(ColumnTypeEnum $type): AlterColumnInterface;
    
    /**
     * Метод определяет установку максимальной общей длинны значений
     *
     * @param int $length Максимальная длинна
     * @return AlterColumnInterface Текущий объект класса
     */
    public function length(int $length): AlterColumnInterface;
    
    /**
     * Метод определяет установку максимальной общей длинны десятичной дроби
     *
     * @param int $precision Максимальная общая длина числа
     * @return AlterColumnInterface Текущий объект класса
     */
    public function precision(int $precision): AlterColumnInterface;
    
    /**
     * Метод определяет установку количества знаков после запятой для типов данных десятичных дробей
     *
     * @param int $scale Количество знаков после десятичной точки
     * @return AlterColumnInterface Текущий объект класса
     */
    public function scale(int $scale): AlterColumnInterface;
    
    /**
     * МеМетод определяет установку того, может ли колонка не иметь значения
     *
     * @param bool $nullable
     * @return AlterColumnInterface Текущий объект класса
     */
    public function nullable(bool $nullable = true): AlterColumnInterface;
    
    /**
     * Метод определяет установку значения по умолчанию
     *
     * @param mixed $value
     * @return AlterColumnInterface Текущий объект класса
     */
    public function default(mixed $value = null): AlterColumnInterface;
    
    /**
     * Метод определяет установку проверки (ограничение) по колонке
     *
     * @param string $condition
     * @return AlterColumnInterface Текущий объект класса
     */
    public function check(string $condition): AlterColumnInterface;
    
    /**
     * Метод определяет установку комментария к колонке
     *
     * @param string $comment
     * @return AlterColumnInterface Текущий объект класса
     */
    public function comment(string $comment): AlterColumnInterface;
    
    /**
     * Метод определяет установку индекса по колонке
     *
     * @param string $indexName
     * @return IndexInterface Объект класса модификации индексов
     */
    public function index(string $indexName): IndexInterface;
    
    /**
     * Метод определяет установку ключа колонки
     *
     * @param string $keyName
     * @return KeyInterface Объект класса модификации ключей
     */
    public function key(string $keyName): KeyInterface;
}
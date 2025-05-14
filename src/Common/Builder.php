<?php

declare(strict_types = 1);

namespace CloudCastle\SqlBuilder\Common;

use CloudCastle\SqlBuilder\Enums\OperatorValueEnum;
use CloudCastle\SqlBuilder\Interfaces\BuilderInterface;
use CloudCastle\SqlBuilder\Traits\GetBindNameTrait;
use CloudCastle\SqlBuilder\Traits\TableAliasTrait;
use DateTimeInterface;

/**
 * Абстрактный класс предоставляет основные методы для преобразования объектов в SQL-запрос
 */
abstract class Builder implements BuilderInterface
{
    use GetBindNameTrait;
    use TableAliasTrait;
    
    /**
     * Наименование таблицы
     *
     * @var string|null
     */
    protected ?string $table = null;
    
    /**
     * Массив заполнителей
     *
     * @var array<mixed>
     */
    protected array $binds = [];
    
    /**
     * Получить подготовленную строку запроса с заполнителями(биндами)
     *
     * @return string
     */
    final public function __toString (): string
    {
        return $this->toSql();
    }
    
    /**
     * Получить подготовленную строку запроса с заполнителями(биндами)
     *
     * @return string
     */
    abstract public function toSql (): string;
    
    /**
     * Получить не подготовленную строку запроса в сыром виде, без заполнителей
     *
     * @return string
     */
    final public function toRawSql (): string
    {
        $sql = $this->toSql();
        
        foreach (array_reverse($this->binds) as $key => $value) {
            /** @var string $value */
            $sql = str_replace($key, "'$value'", $sql);
        }
        
        return $sql;
    }
    
    /**
     * Получить массив биндов(заполнителей)
     *
     * @return array<string>
     */
    final public function getBinds (): array
    {
        return $this->binds;
    }
    
    /**
     * Задать таблицу
     *
     * @param string $tableName
     *
     * @return $this
     */
    final public function table (string $tableName): static
    {
        $this->table = $tableName;
        
        return $this;
    }
    
    /**
     * Привести значение и оператора к строке
     *
     * @param mixed $value значение или значения
     * @param OperatorValueEnum $operator Оператор условия
     * @param string|null $column Наименование колонки
     *
     * @return string
     */
    final protected function valueToString (mixed $value, OperatorValueEnum $operator, ?string $column = null): string
    {
        if (is_null($value) && !in_array($operator, [OperatorValueEnum::IS_NULL, OperatorValueEnum::IS_NOT_NULL])) {
            return OperatorValueEnum::IS_NULL->value;
        }
        
        if ($value instanceof DateTimeInterface) {
            $value = $value->format('Y-m-d H:i:s');
        }
        
        if (is_object($value)) {
            $value = serialize($value);
        }
        
        $callable = match ($operator) {
            OperatorValueEnum::IS_NULL, OperatorValueEnum::IS_NOT_NULL => function () use ($operator): string{
                return $operator->value;
            },
            
            default => function (mixed $value, ?string $column = null) use ($operator): string{
                if (is_array($value)) {
                    /** @var array<string> $binds */
                    $binds = (array)$this->getBindName($value, $column);
                    $value = implode(', ', $binds);
                    
                    return "IN ({$value})";
                }
                
                if (is_null($value)) {
                    return OperatorValueEnum::IS_NULL->value;
                }
                
                if (is_string($value) && !preg_match('~^(\w+)\.(\w+)$~iu', $value)) {
                    $value = $this->getBindName($value, $column);
                }
                
                if (is_numeric($value)) {
                    $value = $this->getBindName($value, $column);
                }
                
                return $operator->value . ' ' . $value;
            }
        };
        
        return $callable($value, $column);
    }
}

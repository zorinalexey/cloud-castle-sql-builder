<?php

namespace CloudCastle\SqlBuilder\Traits;

use CloudCastle\SqlBuilder\Interfaces\BuilderInterface;
use DateTimeInterface;

/**
 * Трейт предоставляет метод для генерации уникального бинда (заполнителя), для выполнения подготовленных запросов
 */
trait GetBindNameTrait
{
    /**
     * Получить наименование бинда или биндов
     *
     * @param mixed $value Значение или значения
     * @param string|null $name Задать наименование на основе которого сгенерируется наименование бинда
     *
     * @return array<int, string>|string
     */
    final protected function getBindName(mixed $value, ?string $name = null): string|array
    {
        if ($name) {
            $name = preg_replace('~\W~ui', '_', $name);
        }
        
        if (is_array($value)) {
            $names = [];
            
            foreach ($value as $key => $item) {
                $bindName = $name ? "{$name}_{$key}" : null;
                
                if (is_array($item)) {
                    $item = json_encode($item);
                }
                
                /** @var string $item */
                $names[] = $this->getBindName($item, $bindName);
            }
            
            /** @var array<int, string> $names */
            return $names;
        }
        
        if ($value instanceof DateTimeInterface) {
            $value = $value->format('Y-m-d H:i:s');
        } elseif ($value instanceof BuilderInterface) {
            $this->binds = [...$this->binds, ...$value->getBinds()];
            
            return '('.$value->toSql().')';
        } elseif (is_bool($value)) {
            $value = $value ? 1 : 0;
        } elseif (is_object($value)) {
            $value = serialize($value);
        }
        
        if (!$name) {
            $name = ':bind_' . md5(serialize($value));
        } else {
            $name = ':' . $name . '_' . (count($this->binds) + 1);
        }
        
        $this->binds[$name] = $value;
        
        return $name;
    }
}
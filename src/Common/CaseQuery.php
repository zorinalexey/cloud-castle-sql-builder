<?php

declare(strict_types = 1);

namespace CloudCastle\SqlBuilder\Common;

use CloudCastle\SqlBuilder\Interfaces\Query\CaseInterface;

/**
 * Класс генерации условий перечисления
 */
final class CaseQuery extends Builder implements CaseInterface
{
    /**
     * @var array<string>
     */
    private array $conditions = [];
    
    /**
     * @var string|null
     */
    private ?string $else = null;
    
    /**
     * Задать условие перечисления
     *
     * @param string $condition Условие
     * @param string|int|bool|float $result Результат
     *
     * @return $this Текущий объект класса
     */
    public function when (string $condition, string|int|bool|float $result): static
    {
        if (is_bool($result)) {
            $result = $result ? 1 : 0;
        }
        
        $this->conditions[] = "WHEN {$condition} THEN {$result}";
        
        return $this;
    }
    
    /**
     * Задать значение по умолчанию
     *
     * @param string|int|bool|float $result Результат
     *
     * @return $this Текущий объект класса
     */
    public function else (string|int|bool|float $result): static
    {
        if (is_bool($result)) {
            $result = $result ? 1 : 0;
        }
        
        $this->else = (string) $result;
        
        return $this;
    }
    
    /**
     * Получить строку сгенерированного перечисления для дальнейшего использования в запросе
     *
     * @return string
     */
    public function toSql (): string
    {
        $case = "CASE\n\t" . implode("\n\t", $this->conditions) . "\n\t";
        
        if ($this->else) {
            $case .= "ELSE{$this->else}\n";
        }
        
        $case .= 'END';
        
        if ($this->alias) {
            $case .= " AS {$this->alias}\n";
        }
        
        return $case;
    }
}

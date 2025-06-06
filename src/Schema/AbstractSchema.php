<?php

namespace CloudCastle\SqlBuilder\Schema;

use CloudCastle\SqlBuilder\Common\Validator;

abstract class AbstractSchema
{
    /**
     * Объект валидации входных данных
     * @var Validator
     */
    protected readonly Validator $validator;
    
    /**
     * Конструктор класса
     */
    public function __construct(){
        $this->validator = new Validator();
    }
}
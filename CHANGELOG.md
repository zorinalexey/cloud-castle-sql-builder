# Changelog

## [Unreleased]

### Added
- Добавлен enum `IndexTypeEnum` с типами индексов:
  - BTREE
  - HASH
  - FULLTEXT
  - CLUSTERED
  - UNIQUE
  - INDEX
- Добавлены интерфейсы для работы с таблицами:
  - `ActionTableInterface`
  - `AlterTableInterface`
  - `CreateTableInterface`
  - `DropTableInterface`
- Добавлены интерфейсы для работы с колонками:
  - `ColumnTableInterface`
  - `CreateColumnInterface`
  - `AlterColumnInterface`
  - `DropColumnInterface`
- Добавлены интерфейсы для работы с индексами:
  - `IndexTableInterface`
  - `CreateIndexInterface`
  - `AlterIndexInterface`
  - `DropIndexInterface`
- Добавлены интерфейсы для работы с ключами:
  - `KeyTableInterface`
  - `CreateKeyInterface`
  - `AlterKeyInterface`
  - `DropKeyInterface`
- Добавлен enum `ColumnTypeEnum`
- Добавлен класс `Validator` для валидации данных
- Добавлен класс `InvalidArgumentException` для обработки ошибок
- Добавлены базовые классы для работы с SQL запросами:
  - `Select` - для выборки данных
  - `Insert` - для вставки данных
  - `Update` - для обновления данных
  - `Delete` - для удаления данных
- Добавлены трейты:
  - `GetBindNameTrait` - для генерации уникальных биндов
  - `GetOperatorTrait` - для работы с операторами
  - `GetPrefixTrait` - для работы с префиксами
  - `TableAliasTrait` - для работы с алиасами таблиц
- Добавлены тесты для базовых классов и трейтов
- Добавлен класс `QueryBuilder` для создания экземпляров классов запросов
- Добавлены классы для работы с JOIN операциями:
  - `Join` - для соединения таблиц
  - `CaseQuery` - для работы с CASE выражениями
- Добавлены тесты для JOIN операций и CASE выражений
- Добавлен трейт `GetClearSql` для форматирования SQL запросов в тестах
- Добавлена поддержка WITH выражений в запросах
- Добавлена поддержка множественной вставки в INSERT
- Добавлена поддержка псевдонимов для таблиц и колонок
- Добавлена поддержка подзапросов в колонках SELECT
- Добавлена поддержка условий IN в JOIN операциях
- Добавлена поддержка условий IS NULL в JOIN операциях
- Добавлена поддержка различных типов JOIN:
  - LEFT JOIN
  - RIGHT JOIN
  - INNER JOIN
  - OUTER JOIN
- Добавлены тесты для всех основных классов:
  - `QueryBuilderTest` - тесты для фабрики запросов
  - `InsertTest` - тесты для вставки данных
  - `JoinTest` - тесты для соединения таблиц
  - `CaseQueryTest` - тесты для CASE выражений
- Добавлена поддержка агрегатных функций в SELECT:
  - MIN
  - MAX
  - AVG
  - SUM
- Добавлена поддержка DISTINCT в SELECT
- Добавлена поддержка JSON данных в UPDATE
- Добавлена поддержка булевых значений в биндах
- Добавлена поддержка объектов DateTime в биндах
- Добавлена поддержка массивов и объектов в биндах

### Changed
- Улучшена типизация в классе `Select`:
  - Обновлены PHPDoc аннотации для массивов
  - Улучшена обработка подзапросов
- Обновлены примеры использования в README.md:
  - Улучшены примеры JOIN операций
  - Улучшены примеры CASE выражений
- Улучшена структура проекта:
  - Перенесены файлы в соответствующие директории
  - Обновлены пространства имен
- Улучшена обработка условий в запросах
- Добавлена поддержка подзапросов
- Улучшена работа с биндами
- Улучшена обработка условий в JOIN операциях
- Улучшена обработка псевдонимов в JOIN операциях

## [0.1.0] - 2024-03-19

### Added
- Начальная версия проекта
- Базовая структура классов для работы с SQL запросами

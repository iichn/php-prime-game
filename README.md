# Prime Number Game

Консольная игра на PHP. Программа выдаёт случайное целое число от 2 до 100, игрок должен определить, является ли оно простым.

## Правила

- Введи `yes` если число простое, `no` если нет
- При правильном ответе выводится `Correct!`
- При неправильном — `Wrong!` и список нетривиальных делителей числа

## Установка и запуск
```bash
composer install
php bin/prime
```

## Зависимости

- [wp-cli/php-cli-tools](https://github.com/wp-cli/php-cli-tools) — утилиты для консольного ввода/вывода

### Ссылка на Packagist.org

- https://packagist.org/packages/iichn/prime
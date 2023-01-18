# PHP пакет для работы с api сервиса Carrot Quest

```php
$carrotQuestApi = new CarrotQuestApi('AUTH_KEY', 'APP_ID_INTEGER');
```

## Пример формирования фильтра

```php
$usersFilters = UsersFilter::makeWrapper
    UsersFilter::OR,
    [
        UsersFilter::known('Свои тестовые')
    ]
);
```

## Пример применения сформированных фильтров при получении пользователей

```php

$users = $carrotQuestApi->getUsersRecursive($usersFilters);

```
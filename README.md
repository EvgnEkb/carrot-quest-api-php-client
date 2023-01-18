# PHP пакет для работы с api сервиса Carrot Quest

## Установить из composer
```bash
composer require evgeny/carrot-quest-api-php-client
```

## Пример использования

```php
$carrotQuestApi = new CarrotQuestApi('AUTH_KEY', 'APP_ID_INTEGER');
```

### Пример формирования фильтра

```php
$usersFilters = UsersFilter::makeWrapper
    UsersFilter::OR,
    [
        UsersFilter::known('Свои тестовые')
    ]
);
```

### Пример применения сформированных фильтров при получении пользователей

```php

$users = $carrotQuestApi->getUsersRecursive($usersFilters);

```

### Получить онлайн-пользователей
```php
$carrotQuestApi->getActiveUsers()
```

### Получить диалоги приложения
```php
$carrotQuestApi->getConversations()
```

### Получить диалог
```php
$carrotQuestApi->getConversationsItem($id);
```

### Получить части диалога
```php
$carrotQuestApi->getConversationsItemPart(Int $id, $after, Int $count)
```

### Отметить диалог прочитанным
```php
$carrotQuestApi->markreadConversationItem(Int $id)
```

### Получить каналы приложения
```php
$carrotQuestApi->getChannels()
```
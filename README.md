# Monolog для CMS Битрикс

Эта библиотека является совмещением библиотек [monolog](https://github.com/Seldaek/monolog) и [bitrix-expert/monolog-adapter](https://github.com/bitrix-expert/monolog-adapter), и, в дополнение, предоставляет статические интерфейсы для методов логгирования.

## Установка

В файле `init.php` нужно вставить следующий код:

```php
BitrixMonolog\Log::init();
```

Затем в файле `.settings.php` или `.settings_extra.php` добавить раздел с настройками `monolog`:

```php
'monolog' => [
    'value' => [
        'handlers' => [
            'event_log' => [
                'class' => 'BitrixMonolog\Handler\EventLog',
                'level' => 'INFO'
            ]
        ],
        'loggers' => [
            'default' => [
                'handlers' => ['event_log']
            ]
        ]
    ],
    'readonly' => false
]
```

Более подробные примеры можно посмотреть на странице [bitrix-expert/monolog-adapter](https://github.com/bitrix-expert/monolog-adapter#usage).

О самом логгере и основных принципах логгирования можно посмотреть в [документации monolog](https://github.com/Seldaek/monolog).

## Использование

### Простой пример

```php
use Bitrix\Log;

// Запись простых сообщений в журнал событий.
Log::info('Info message.');
Log::warning('Warning message.');
Log::error('Error message.');

// Запись в указанный канал.
Log::to('имя_канала')->info('Info message.');
```

### Объяснение

Класс `BitrixMonolog\Log` предоставляет статический интерфейс для логгера с именем `default`, который описан в настройках сайта. Все вызовы методов `info`, `warning` и так далее передаются в экземпляр логгера. Если вы используете несколько каналов лога, то получить один из них можно с помощью метода `to`.
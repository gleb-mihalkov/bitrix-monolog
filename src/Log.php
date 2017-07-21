<?php
namespace BitrixLogger
{
    use Bex\Monolog\MonologAdapter;
    use Monolog\Registry;

    /**
     * Класс управления логгированием в Битрикс.
     */
    class Log
    {
        /**
         * Инициализирует процесс логгирования.
         * @return void
         */
        public static function init()
        {
            MonologAdapter::loadConfiguration();
        }

        /**
         * Получает экземпляр логгера с указанным именем.
         * @param  string          $name Имя логгера.
         * @return \Monolog\Logger       Логгер.
         */
        public static function to($name = 'default')
        {
            $logger = Registry::getInstance($name);
            return $logger;
        }

        /**
         * Переадресовывает вызов статического метода экземпляру логгера по умолчанию.
         * @internal
         * @param  string       $name Имя метода.
         * @param  array<mixed> $args Список аргументов.
         * @return void
         */
        public static function __callStatic($name, $args)
        {
            $logger = self::to();
            $result = call_user_func_array([$logger, $name], $args);
            return $result;
        }
    }
}
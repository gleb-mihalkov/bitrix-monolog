<?php
namespace BitrixMonolog\Handler
{
    use Bex\Monolog\Handler\BitrixHandler;
    use CEventLog;

    /**
     * Обработчик ведения лога в журнал событий Битрикс.
     * @internal
     */
    class EventLog extends BitrixHandler
    {
        /**
         * Делает запись в журнал.
         * @param  array  $record Запись.
         * @return void
         */
        protected function write(array $record)
        {
            $event = $this->getEvent();

            if (!$event)
            {
                $event = strtolower($record['formatted']['level']);
                $channel = $record['channel'];

                if ($channel !== 'default')
                {
                    $event = $channel.':'.$event;
                }
            }

            CEventLog::Log(
                $record['formatted']['level'],
                $event,
                $this->getModule(),
                $record['formatted']['item_id'],
                $record['formatted']['message'],
                $this->getSite()
            );
        }
    }
}
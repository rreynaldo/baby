<?php


namespace Baby\Event;


interface EventSubscriberInterface
{
  /**
   * Return a list of event the user wishes to be notified about
   * Events are :
   * - onStart
   * - beforeTaskRuns
   * - afterTaskRuns
   * - onEnd
   * @return array
   */
  public static function getEvents(): array;
}

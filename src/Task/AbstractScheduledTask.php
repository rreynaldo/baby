<?php


namespace Baby\Task;


abstract class AbstractScheduledTask implements TaskInterface {
  /**
   * @var Schedule
   */
  private Schedule $schedule;

  public function __construct() {
    $this->schedule = new Schedule();
    $this->initialize($this->schedule);
  }

  /**
   * @param \Datetime|string $currentTime
   * @return bool
   */
  public function isDue($currentTime): bool {
    var_dump($currentTime);
    return $this->schedule->isDue($currentTime);
  }

  /**
   * @return Schedule
   */
  public function getSchedule(): Schedule
  {
    return $this->schedule;
  }

  public function getNextRunDates($counter): array {
    $result = [];

    if ($counter < 1) {
      return $result;
    }

    for ($i = 0; $i < $counter; $i++) {
      $result[] = $this->schedule->getCron()->getNextRunDate('now', $i)->format(DATE_ATOM);
    }

    return $result;
  }

  abstract protected function initialize(Schedule $schedule);
}

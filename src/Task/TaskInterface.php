<?php


namespace Commander\Task;


use Datetime;

interface TaskInterface
{
  /**
   * Return true if the task is due to now
   * @param Datetime|string $currentTime
   * @return bool
   */
  public function isDue($currentTime): bool;

  /**
   * Get the next run dates for this job
   * @param int $counter
   * @return string[]
   */
  public function getNextRunDates(int $counter): array;

  /**
   * Execute the task
   */
  public function run();
}

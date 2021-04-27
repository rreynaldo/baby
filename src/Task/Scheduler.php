<?php


namespace Baby\Task;


use Baby\Event\EventDispatcher;

class Scheduler
{
  /**
   * @var TaskInterface[]
   */
  private array $tasks = [];

  /**
   * Adds the task to the task stack
   * @param TaskInterface $task
   */
  public function addTask(TaskInterface $task)
  {
    $this->tasks[] = $task;
  }

  /**
   * Run due tasks
   * @param string $currentTime
   */
  public function run($currentTime = "now")
  {
    foreach ($this->tasks as $task) {
      if ($task->isDue($currentTime)) {
        $this->runTask($task);
      }
    }
  }

  /**
   * Run the task
   * @param TaskInterface $task
   */
  public function runTask(TaskInterface $task)
  {
    $task->run();
  }

  /**
   * @return TaskInterface[]
   */
  public function getTasks(): array
  {
    return $this->tasks;
  }
}

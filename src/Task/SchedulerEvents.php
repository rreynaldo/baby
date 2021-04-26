<?php

namespace Commander\Task;

class SchedulerEvents
{
  const ON_START = "onStart"; // called when the scheduler starts to loops through tasks
  const BEFORE_TASK_RUNS = "beforeTaskRuns"; // called before a task gets executed
  const AFTER_TASK_RUNS = "afterTaskRuns"; // called after a task gets executed
  const ON_SKIP = "onSkip"; // called when the task is skipped
  const ON_END = "onEnd"; // called after the scheduler runs all the tasks
}

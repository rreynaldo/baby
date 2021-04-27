<?php

namespace Baby\Task;

class SchedulerEvents
{
  const ON_START = "onStart"; // called when the scheduler starts to loops through tasks
  const ON_END = "onEnd"; // called after the scheduler runs all the tasks
}

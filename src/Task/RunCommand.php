<?php


namespace Commander\Task;


use Commander\Input\InputArgument;
use Exception;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RunCommand extends Command
{
  /**
   * @var Scheduler
   */
  private Scheduler $scheduler;

  public function __construct(Scheduler $scheduler)
  {
    parent::__construct();
    $this->scheduler = $scheduler;
  }

  protected function configure()
  {
    $this
      ->setName("scheduler:run")
      ->setDescription("Run due tasks")
      ->setHelp("This command actually run the tasks that are due at the moment the command is called.
      This command should not be called manually. Check the documentation to learn how to set CRON jobs.")
      ->addArgument("id", InputArgument::OPTIONAL, "The ID of the task. Check ts:list for IDs");
  }

  /**
   * @throws Exception
   */
  protected function execute(InputInterface $input, OutputInterface $output): int
  {
    $id = $input->getArgument("id");

    if (!$id) {
      $this->scheduler->run();
    } else {
      $tasks = $this->scheduler->getTasks();
      $id = intval($id);

      if (array_key_exists($id - 1, $tasks) === false) {
        throw new Exception("There are no tasks corresponding to this ID");
      }

      $this->scheduler->runTask($tasks[$id - 1]);
    }

    return 0;
  }
}

<?php


namespace Baby\Task;


use Baby\Command\Command;
use Baby\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RunCommand extends Command {
  /**
   * @var Scheduler
   */
  private $scheduler;

  public function __construct(Scheduler $scheduler)
  {
    parent::__construct();
    $this->scheduler = $scheduler;
  }

  protected function configure() {
    $this
      ->setName("baby:run")
      ->setDescription("Run due tasks")
      ->setHelp("This command actually run the tasks that are due at the moment the command is called.
      This command should not be called manually. Check the documentation to learn how to set CRON jobs.")
      ->addArgument("id", InputArgument::OPTIONAL, "The ID of the task. Check ts:list for IDs")
    ;
  }

  protected function execute(InputInterface $input, OutputInterface $output) {
    $id = $input->getArgument("id");

    if (!$id) {
      $this->scheduler->run();
    } else {
      $tasks = $this->scheduler->getTasks();
      $id = intval($id);

      if (array_key_exists($id - 1, $tasks) === false) {
        throw new \Exception("There are no tasks corresponding to this ID");
      }

      $this->scheduler->runTask($tasks[$id - 1]);
    }

    return 0;
  }
}

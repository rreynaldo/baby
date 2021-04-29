## Baby: Commander CLI micro-framework based on Symfony Console (commands, schedules)

[![Baby Logo](https://raw.githubusercontent.com/rreynaldo/baby/main/logo.png)](https://github.com/rreynaldo/baby)

## Install

> composer require rreynaldo/baby

## Script Usage (Similar to Silly): Commander

```php
use Symfony\Component\Console\Output\OutputInterface;

$app = new Baby\Application();
$app->command('hello [name] [--yell]', function ($name, $yell, OutputInterface $output) {
      if ($name) {
          $text = 'Hello, '.$name;
      } else {
          $text = 'Hello';
      }
  
      if ($yell) {
          $text = strtoupper($text);
      }
  
      $output->writeln($text);
  });
$app->run();
```

## Running

Running the application is the same as running any other Symfony Console application:

```bash
$ php app.php hello
$ php app.php hello john --yell
$ php app.php hello --yell john
```

### Project Usage (Recommended user Baby Skeleton):

```php

<?php
use App\Commands\AppTestCommand;
use App\Schedules\AppTestSchedule;
use Baby\Application;

require_once __DIR__ . '/vendor/autoload.php'; 
include_once(__DIR__ . '/app/config.php'); //Define Main config

// Use Dependency injection (php/di)
$container = new DI\Container(); 

//Create APP
$app = new Application($APP_NAME, $APP_VERSION); 

// User container
$app->useContainer($container);  

//Register Schedules (Schedules)
$app->schedule(new AppTestSchedule($container));

//Register commands (Standar Symfony Commands in your project)
$app->add(new AppTestCommand($container));

 //run App
 $app->run();
```


## Commands

```php

<?php

namespace App\Commands;

use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AppTestCommand extends Command
{
  protected static $defaultName = 'app:test:command';
  protected ContainerInterface $container;

  /**
   * AppTestCommand constructor.
   */
  public function __construct(ContainerInterface $container)
  {
    parent::__construct();
    $this->container = $container;
  }

  protected function execute(InputInterface $input, OutputInterface $output): int
  {
    return Command::SUCCESS;
  }
}

```

## Schedules

```php
<?php

namespace App\Schedules;

use Baby\Task\AbstractScheduledTask;
use Baby\Task\Schedule;
use Psr\Container\ContainerInterface;

class AppTestSchedule extends AbstractScheduledTask
{
  protected ContainerInterface $container;

  /**
   * AppTestSchedule constructor.
   */
  public function __construct(ContainerInterface $container)
  {
    parent::__construct();
    $this->container = $container;
  }

  protected function initialize(Schedule $schedule)
  {
    $schedule->everyMinutes(1);
  }

  public function run()
  {
    print_r("everyMinutes");
  }
}
```

## Available Commands

```bash
Usage:
  command [options] [arguments]

Options:
  -h, --help            Display help for the given command. When no command is given display help for the list command
  -q, --quiet           Do not output any message
  -V, --version         Display this application version
      --ansi            Force ANSI output
      --no-ansi         Disable ANSI output
  -n, --no-interaction  Do not ask any interactive question
  -v|vv|vvv, --verbose  Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

Available commands:
  help                  Display help for a command
  list                  List commands
 app
  app:test:command
 baby
  baby:schedule-run     Run due tasks
  baby:scheduler-list   List the existing schedules
  baby:scheduler-start  Starts command scheduler
  baby:scheduler-stop   Stops command scheduler
```

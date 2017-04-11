# Virge::Cli
Used to create and run console commands

## Creating a command
```php
<?php

use Virge\Cli;
use Virge\Cli\Component\{
    Command,
    Input
};

class MyCommand extends Command
{
    const COMMAND = 'my_command';
    const COMMAND_HELP = 'some help text';
    const COMMAND_USAGE = 'my_command [--someOption] arg1';

    public function run(Input $input)
    {
        if($input->getOption('someOption')) {
            Cli::success("Something worked!");
        } else {
            Cli::error("Oops");
        }
    }
}

Cli::add(MyCommand::COMMAND, MyCommand::class)
->setHelpText(MyCommand::COMMAND_HELP)
->setUsage(MyCommand::COMMAND_USAGE)
;
```
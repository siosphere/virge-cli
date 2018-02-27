<?php
namespace Virge\Cli\Command;

use Virge\Cli;

class HelpCommand extends \Virge\Cli\Component\Command
{
    const COMMAND = 'help';
    const COMMAND_USAGE = 'help';
    const COMMAND_HELP = 'show available commands and usage';

    public function run()
    {
        $commands = Cli::getCommands();
        Cli::important('Virge::Cli');
        Cli::output();
        Cli::highlight("Usage: ");
        Cli::output("  command [options] [arguments]");
        Cli::output();
        Cli::highlight("Commands:");
        foreach($commands as $command)
        {
            Cli::output("  ", false);
            Cli::important($command->getCommand());
            if($command->getHelpText()) {
                Cli::output("    ", false);
                Cli::output($command->getHelpText());
            }

            if($command->getUsage()) {
                Cli::output("    ", false);
                Cli::highlight("Usage: ");
                Cli::output("      ", false);
                Cli::output($command->getUsage());
            }
            Cli::output();
        }
    }
}
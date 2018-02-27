<?php

use Virge\Cli;
use Virge\Cli\Command\HelpCommand;

Cli::add(HelpCommand::COMMAND, HelpCommand::class)
    ->setHelpText(HelpCommand::COMMAND_HELP)
    ->setUsage(HelpCommand::COMMAND_USAGE);
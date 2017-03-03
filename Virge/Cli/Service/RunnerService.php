<?php
namespace Virge\Cli\Service;

use Virge\Cli;

class RunnerService
{
    public function execute(string $command, $arguments = [])
    {
        return Cli::execute($command, $arguments);
    }
}
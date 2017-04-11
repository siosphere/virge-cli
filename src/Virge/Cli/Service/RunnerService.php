<?php
namespace Virge\Cli\Service;

use Virge\Cli;
use Virge\Cli\Component\Input;

class RunnerService
{
    public function execute(Input $input)
    {
        return Cli::execute($input);
    }
}
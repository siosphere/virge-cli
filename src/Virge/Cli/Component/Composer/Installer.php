<?php
namespace Virge\Cli\Component\Composer;

use Composer\Script\CommandEvent;

class Installer
{
    public static function install(CommandEvent $event)
    {
        $installDir = __DIR__ . '/../../../../../../';
        $binDir = __DIR__ . '/../../../../bin/';

        if(!copy($binDir . 'vadmin', $installDir . 'vadmin')) {
            $event->getIO()->writeError("Failed to install vadmin cli, make sure you have write permissions");
        }
    }
}
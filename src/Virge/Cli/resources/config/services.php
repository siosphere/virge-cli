<?php

use Virge\Cli\Service\RunnerService;
use Virge\Virge;

/**
 * Registers all given handlers with Virge that this Capsule contains
 * @author Michael Kramer
 */
Virge::registerService("cli", RunnerService::class);
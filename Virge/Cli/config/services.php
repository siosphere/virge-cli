<?php

use Virge\Cli\Capsule;

/**
 * Registers all given handlers with Virge that this Capsule contains
 * @author Michael Kramer
 */
Capsule::registerService("cli", "\\Virge\\Cli");
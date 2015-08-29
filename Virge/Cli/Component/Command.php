<?php
namespace Virge\Cli\Component;

use Virge\Core\Model;

/**
 * 
 * @author Michael Kramer
 */
class Command extends Model{
    
    /**
     * Terminate the command
     * @param int $exitCode
     */
    protected function terminate($exitCode = 0){
        exit($exitCode);
    }
    
    /**
     * Have the command sleep by seconds
     * @param int $seconds
     */
    protected function sleep($seconds = 0){
        sleep($seconds);
    }
    
}
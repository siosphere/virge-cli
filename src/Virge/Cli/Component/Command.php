<?php
namespace Virge\Cli\Component;

use Virge\Enigma;

/**
 * 
 * @author Michael Kramer
 */
class Command
{
    
    const COMMAND = ''; //should be overwritten by each command
    
    protected $lockValue = null;
    
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
    
    /**
     * Is an instance of this command already running?
     * @return type
     */
    protected function instanceAlreadyRunning($args = []) {

        $running_processes = array();
        $command = $this::COMMAND;
        if(count($args) > 0) {
            $command .= " " . implode(" ", $args);
        }

        exec("ps aux | grep '".$command."' | grep -v grep", $running_processes);
        return count($running_processes) > 1;
    }
    
    /**
     * Returns true if the lock file matches, false otherwise
     * 
     * @param string $file - Absolute path to lock file
     * @return boolean
     */
    protected function getCommandLock($file)
    {
        if(!is_file($file)) {
            $lockValue = Enigma::hash(microtime());
            file_put_contents($file, $lockValue);
        } else {
            $lockValue = file_get_contents($file);
        }
        
        if($this->lockValue === null) {
            $this->lockValue = $lockValue;
            return true;
        }
        
        return $this->lockValue === $lockValue;
    }
    
}
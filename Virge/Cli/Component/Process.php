<?php
namespace Virge\Cli\Component;

/**
 * 
 * @author Michael Kramer
 */
class Process extends \Virge\Core\Model {
    
    /**
     * @param string $command
     */
    public function __construct($command) {
        $this->command = $command;
    }
    
    /**
     * 
     */
    public function execute() {
        
        $this->process = proc_open($this->command,
        array(
            array("pipe","r"),
            array("pipe","w"),
            array("pipe","w"),
        ),
        $pipes);
        
        stream_set_blocking($pipes[1], 0);
        stream_set_blocking($pipes[2], 0);
        
        $this->pipes = $pipes;
    }
    
    /**
     * Is this process finished or not? If it is finished, close the process
     * @return boolean
     */
    public function isFinished() {
        
        if($this->process === NULL){
            return true;
        }
        
        $info = proc_get_status($this->process);
        
        if(!$info) {
            $this->setCleanExit(false);
            return true;
        }
        
        if($info['signaled']){
            $this->setCleanExit(false);
        }
        
        if(!$info['running']){
            $this->closeProcess($info);
        }
        
        
        return $info['running'];
    }
    
    /**
     * Close the process
     * @param Info $info
     */
    public function closeProcess($info) {
        $this->setCleanExit(true);
        $this->setExitCode($info['exitcode']);
        
        foreach($this->pipes as $pipe){
            fclose($pipe);
        }
        
        proc_close($this->process);
        $this->process = null;
    }
}
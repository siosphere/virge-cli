<?php
namespace Virge;

use Virge\Cli\Component\Command;

/**
 * 
 * @author Michael Kramer
 */

class Cli {
    
    /**
     * Holds our commands
     * @var array 
     */
    protected static $_commands = array();
    
    /**
     * Add a command to our CLI list
     * @param string $command
     * @param string|\Closure $handler
     * @param string $method
     * @param array $params
     * @return array
     */
    public static function add($command, $callable, $method = null, $params = array()) {
        return self::$_commands[] = new Command(array(
            'command'   => $command,
            'callable'  => $callable,
            'method'    => $method,
            'params'    => $params
        ));
    }
    
    /**
     * Execute a given command
     * @param string $command
     * @param array $arguments
     * @return mixed
     */
    public function execute($command, $arguments = array()) {
        
        foreach (self::$_commands as $_command) {
            if ($_command->command == $command) {

                if(is_callable($_command->getCallable())){
                    $handler = $_command->getCallable();
                    return $handler($arguments);
                }
                
                $method = $_command->getMethod();
                if(!$method) {
                    $method = 'run';
                }
                $className = $_command->getCallable();
                $command = new $className;
                return call_user_func_array(array($command, $method), $arguments);
            }
        }
    }
        
    /**
     * Request input, with explanation of what you are requesting
     * @param type $string
     */
    public static function input($string = ''){
        echo $string . " ";
        $value = trim(fgets(STDIN));
        return $value;
    }

    /**
     * Write output
     * @param string $string
     */
    public static function output($string = ''){
        echo $string . PHP_EOL;
    }
}
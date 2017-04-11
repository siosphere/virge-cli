<?php
namespace Virge;

use Virge\Cli\Component\Command\Definition;
use Virge\Cli\Component\{
    Input,
    Output
};

/**
 * 
 * @author Michael Kramer
 */

class Cli 
{
    /**
     * Holds our commands
     * @var array 
     */
    protected static $_commands = array();

    protected static $output;
    
    /**
     * Add a command to our CLI list
     * @param string $command
     * @param string|\Closure $handler
     * @param string $method
     * @param array $params
     * @return array
     */
    public static function add($command, $callable, $method = null, $params = []) 
    {
        return self::$_commands[$command] = new Definition($command, $callable, $method, $params);
    }

    public static function getCommands()
    {
        return self::$_commands;
    }
    
    /**
     * Execute a given command
     * @param string $command
     * @param array $arguments
     * @return mixed
     */
    public static function execute(Input $input) 
    {
        try {
            self::setupOutput();
            $command = $input->getCommand();

            if(!array_key_exists($command, self::$_commands)) {
                throw new \InvalidArgumentException("No command registered for: " . $command);
            }

            $_command = self::$_commands[$command];

            if(is_callable($_command->getCallable())){
                $handler = $_command->getCallable();
                return $handler($input);
            }
            
            $method = $_command->getMethod();
            if(!$method) {
                $method = 'run';
            }
            $className = $_command->getCallable();
            $command = new $className;
            
            return call_user_func_array([$command, $method], [$input]);

        } catch(\Exception $ex) {
            Cli::error("[".get_class($ex)."]");
            Cli::error($ex->getMessage());
            exit(-1);
        }
    }

    /**
     * Request input, with explanation of what you are requesting
     * @param type $string
     */
    public static function input($string = '')
    {
        echo $string . " ";
        $value = trim(fgets(STDIN));
        return $value;
    }

    /**
     * Write output
     * @param string $string
     */
    public static function output($string = '', $endLine = true)
    {
        self::$output->write($string);
        if($endLine) {
            self::$output->write(PHP_EOL);
        }
    }

    public static function success($string = '', $endLine = true)
    {
        self::$output->success($string);
        if($endLine) {
            self::$output->write(PHP_EOL);
        }
    }

    public static function warning($string = '', $endLine = true)
    {
        self::$output->warning($string);
        if($endLine) {
            self::$output->write(PHP_EOL);
        }
    }

    public static function error($string = '', $endLine = true)
    {
        self::$output->error($string);
        if($endLine) {
            self::$output->error(PHP_EOL);
        }
    }

    public static function important($string = '', $endLine = true)
    {
        self::$output->important($string);
        if($endLine) {
            self::$output->write(PHP_EOL);
        }
    }

    public static function highlight($string = '', $endLine = true)
    {
        self::$output->highlight($string);
        if($endLine) {
            self::$output->write(PHP_EOL);
        }
    }

    protected static function setupOutput()
    {
        self::$output = new Output();
    }
}
<?php
namespace Virge\Cli\Component;

class Input
{
    protected $options;
    
    protected $command;
    
    protected $arguments;

    public function __construct()
    {
        $this->options = [];
        $this->command = '';
        $this->arguments = [];
    }

    public static function parse($arguments = [])
    {
        $scriptName = $arguments[0];
        array_shift($arguments);

        $input = new Input();
        $input->parseOptions($arguments);
        $input->setCommand($arguments[0]);
        unset($arguments[0]);
        $input->setArguments(array_values($arguments));

        return $input;
    }

    public function parseOptions(&$arguments = [])
    {
        $options = [];
        foreach($arguments as $i => $argument) {
            if($argument[0] === '-') {
                $option = $this->getOptionFromArgument($argument);
                $options[$option->getName()] = $option;

                unset($arguments[$i]);
            }
        }
        $this->setOptions($options);
        $arguments = array_values($arguments);
    }

    public function setCommand(string $command)
    {
        $this->command = $command;

        return $this;
    }

    public function getCommand() : string
    {
        return $this->command;
    }

    public function setOptions(array $options)
    {
        $this->options = $options;

        return $this;
    }

    public function getOptions() : array 
    {
        return $this->options;
    }
    
    public function getOption(string $optionName)
    {
        return array_key_exists($optionName, $this->options) ? $this->options[$optionName]->getValue() : null;    
    }

    public function setArguments(array $arguments)
    {
        $this->arguments = $arguments;

        return $this;
    }

    public function getArguments() : array
    {
        return $this->arguments;
    }

    public function getArgument(int $i)
    {
        return array_key_exists($i, $this->arguments) ? $this->arguments[$i] : null;
    }

    protected function getOptionFromArgument($argument)
    {
        $optionData = explode('=', $argument);

        $optionName = $optionData[0][1] === '-' ? str_replace('-', '', $optionData[0]) : null;
        $optionValue = isset($optionData[1]) ? $optionData[1] : true;

        return new Option($optionName, $optionValue);
    }
}
<?php
namespace Virge\Cli\Component\Command;

class Definition
{
    protected $command;

    protected $callable;

    protected $method;

    protected $params;

    protected $helpText;

    protected $usage;

    public function __construct(string $command, $callable, $method, $params = [])
    {
        $this->command = $command;
        $this->callable = $callable;
        $this->method = $method;
        $this->params = $params;
        $this->helpText = '';
        $this->usage = '';
    }

    public function getCommand() : string
    {
        return $this->command;
    }

    public function getCallable()
    {
        return $this->callable;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getParams()
    {
        return $this->params;
    }

    public function setHelpText(string $helpText)
    {
        $this->helpText = $helpText;

        return $this;
    }

    public function getHelpText() : string
    {
        return $this->helpText;
    }

    public function setUsage(string $usage)
    {
        $this->usage = $usage;

        return $this;
    }

    public function getUsage() : string
    {
        return $this->usage;
    }
}
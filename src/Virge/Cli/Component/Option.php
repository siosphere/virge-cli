<?php
namespace Virge\Cli\Component;

class Option
{
    protected $name;

    protected $value;

    public function __construct(string $name, $value = true)
    {
        $this->name = $name;
        $this->value = $value;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function getValue()
    {
        return $this->value;
    }
}
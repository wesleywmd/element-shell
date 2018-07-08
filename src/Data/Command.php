<?php
namespace Wesleywmd\Element\Shell\Data;

class Command implements CommandInterface
{
    private $command;

    private $arguments;

    private $options;

    public function __construct($command, $arguments = [], $options = [])
    {
        $this->command = $command;
        $this->arguments = $arguments;
        $this->options = $options;
    }

    public function addArgument($argument)
    {
        if( !is_string($argument) ) {
            throw new CommandException("shell command argument not a string");
        }
        $this->arguments[] = $argument;
        return $this;
    }

    public function addArguments($arguments)
    {
        if( !is_array($arguments) ) {
            throw new CommandException("shell command argument group not a array");
        }
        array_walk($arguments, [$this, "addArgument"]);
        return $this;
    }

    public function addOption($value, $key)
    {
        if( !is_string($value) ) {
            throw new CommandException("shell command option value not a string");
        }

        if( !is_string($key) ) {
            throw new CommandException("shell command option key not a string");
        }

        $value = "\"$value\"";

        if( isset($this->options[$key] ) ) {
            if( !is_array($this->options[$key]) ) {
                $this->options[$key] = [ $this->options[$key] ];
            }
            $this->options[$key][] = $value;
        } else {
            $this->options[$key] = $value;
        }

        return $this;
    }

    public function addOptions($options)
    {
        if( !is_array($options) ) {
            throw new CommandException("shell command option group not a array");
        }

        array_walk($options, [$this, "addOption"]);

        return $this;
    }

    public function getCommand()
    {
        return $this->command;
    }

    public function setCommand($command)
    {
        if( !is_string($command) ) {
            throw new CommandException("shell command command not a string");
        }
        $this->command = trim($command);
        return $this;
    }

    public function toString()
    {
        $command = $this->command;

        $command .= " " . implode(" ", $this->arguments);

        foreach( $this->options as $key => $value ) {
            if( !is_array($value) ) {
                $command .= " " . $key . "=" . $value;
                continue;
            }

            foreach( $value as $v ) {
                $command .= " " . $key . "=" . $v;
            }
        }

        return trim($command);
    }

    /**
     * Magically converts object to string when treated as a string
     * @return string
     */
    public function __toString()
    {
        return $this->toString();
    }
}
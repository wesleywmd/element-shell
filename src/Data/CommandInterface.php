<?php
namespace Wesleywmd\Element\Shell\Data;

/**
 * Interface CommandInterface
 * @package Summon\Element\Shell\Data
 * @author Wesley Guthrie
 */
interface CommandInterface
{
    /**
     * Adds argument to command
     * @param array $argument
     *
     * @return CommandInterface
     */
    public function addArgument($argument);

    /**
     * Adds array of arguments to command
     * @param array $arguments
     *
     * @return CommandInterface
     */
    public function addArguments($arguments);

    /**
     * Adds option to command
     * @param mixed $value
     * @param mixed $key
     *
     * @return CommandInterface
     */
    public function addOption($value, $key);

    /**
     * Adds array of options to command
     * @param array $options
     *
     * @return CommandInterface
     */
    public function addOptions($options);

    /**
     * Sets command string
     * @param string $command
     *
     * @return mixed
     */
    public function setCommand($command);

    /**
     * Converts command data into an shell command string
     * @return string
     */
    public function toString();

    /**
     * Magically converts object to string when treated as a string
     * @return string
     */
    public function __toString();
}
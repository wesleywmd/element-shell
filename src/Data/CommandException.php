<?php
namespace Wesleywmd\Element\Shell\Data;

/**
 * Class CommandException
 * @package Wesleywmd\Element\Shell\Data
 */
class CommandException extends \Exception
{
    /** @var \Wesleywmd\Element\Shell\Data\CommandInterface $command */
    private $command;

    public function __construct($message = "", $command)
    {
        parent::__construct($message, 0, null);
        $this->command = $command;
    }
}
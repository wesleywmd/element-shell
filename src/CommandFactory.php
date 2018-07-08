<?php
namespace Wesleywmd\Element\Shell;

use Wesleywmd\Element\Shell\Data\Command;

class CommandFactory implements CommandFactoryInterface
{
    public function create($command, $arguments = [], $options = [])
    {
        return new Command($command, $arguments, $options);
    }
}
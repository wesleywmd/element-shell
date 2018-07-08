<?php
namespace Wesleywmd\Element\Shell;

use Wesleywmd\Element\Shell\Data\CommandInterface;

interface CliInterface
{
    public function execute(CommandInterface $command, $cwd = null);

    public function interact(CommandInterface $command, $cwd = null);
}
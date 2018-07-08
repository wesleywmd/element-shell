<?php
namespace Wesleywmd\Element\Shell;

class Operator
{
    /** @var \Wesleywmd\Element\Shell\CommandFactoryInterface $commandFactory */
    private $commandFactory;

    /** @var \Wesleywmd\Element\Shell\CliInterface $cli */
    private $cli;

    public function __construct(CommandFactoryInterface $commandFactory, CliInterface $cli)
    {
        $this->commandFactory = $commandFactory;
        $this->cli = $cli;
    }

    public function exists($commandString)
    {
        if( $this->cli->isWindows() ) {
            $command = $this->commandFactory
                ->create("WHERE",[$commandString, ">nul 2>&1 && ( echo 1 ) || ( echo 0 )"]);
        } else {
            $command = $this->commandFactory
                ->create("whereis",[$commandString]);
        }
        return (bool) (int) $this->cli->execute($command)->getResponse();
    }

    public function version($commandString)
    {
        $command = $this->commandFactory
            ->create($commandString,["--version","| head -n 1", "| awk '{print $2}'"]);
        return trim($this->cli->execute($command)->getResponse());
    }
}
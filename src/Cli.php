<?php
namespace Wesleywmd\Element\Shell;

use Wesleywmd\Element\Shell\Data\CommandInterface;

class Cli implements CliInterface
{
    private $resultFactory;

    private $process;

    public function __construct(
        ResultFactory $resultFactory,
        Process $process
    ) {
        $this->resultFactory = $resultFactory;
        $this->process = $process;
    }

    public function execute(CommandInterface $command, $cwd = null)
    {
        $descriptors = [
            1 => [ "pipe","w" ],
            2 => [ "pipe", $this->isWindows() ? "a" : "w" ]
        ];

        $pipes = [];
        $result = $this->resultFactory->create($command->toString(), $cwd);
        $startTime = time();
        $process = $this->process->open($result->getOriginalCommand(), $descriptors, $pipes, $result->getOriginalCwd());

        if( ! is_resource($process) ) {
            throw new CliException("[[1]] Could not run command {$result->getOriginalCommand()}");
        }

        $result->setResponse(stream_get_contents($pipes[1]));
        $result->appendToStdErr(stream_get_contents($pipes[2]));
        fclose($pipes[1]);
        fclose($pipes[2]);

        $status = $this->process->status($process);
        $result->setExitCode($status["exitcode"]);
        $endTime = time();

        $result->setExecutionTime($endTime - $startTime);

        if( $result->getExitCode() !== 0 && empty($result->getStdErr())) {
            throw new CliException("Failed without error message: {$result->getOriginalCommand()}");
        }

        return $result;
    }

    public function interact(CommandInterface $command, $cwd = null)
    {
        $descriptors = [
            0 => ["file", "php://stdin", "r"],
            1 => ["file", "php://stdout", "w"],
            2 => ["pipe", "w"]
        ];
        $pipes = [];
        $result = $this->resultFactory->create($command->toString(), $cwd);
        $startTime = time();
        $process = $this->process->open($result->getOriginalCommand(), $descriptors, $pipes, $result->getOriginalCwd());

        if( ! is_resource($process) ) {
            throw new CliException("[[1]] Could not run command \"{$result->getOriginalCommand()}\"");
        }

        do {
            $status = $this->process->status($process);
            if( ! feof($pipes[2]) ) {
                $errorLine = fgets($pipes[2]);
                echo $errorLine;
                $result->appendToStdErr($errorLine);
            }
        } while( $status["running"] );

        $result->setExitCode($status["exitcode"]);

        $this->process->close($process);
        $endTime = time();

        $result->setExecutionTime($endTime - $startTime);

        if( $result->getExitCode() !== 0 && empty($result->getStdErr())) {
            throw new CliException("Failed without error message: {$result->getOriginalCommand()}");
        }

        return $result;
    }

    public function isWindows()
    {
        return (bool) (strncasecmp(PHP_OS, "WIN", 3) === 0);
    }
}
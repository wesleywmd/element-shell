<?php
namespace Wesleywmd\Element\Shell\Data;

class Result implements ResultInterface
{
    private $originalCommand;

    private $originalCwd;

    private $response;

    private $exitCode;

    private $stderr = [];

    private $executionTime;

    public function __construct($originalCommand, $originalCwd = null)
    {
        $this->originalCommand = $originalCommand;
        $this->originalCwd = $originalCwd ?? getcwd();
    }

    public function getOriginalCommand()
    {
        return $this->originalCommand;
    }

    public function getOriginalCwd()
    {
        return $this->originalCwd;
    }

    public function getResponse()
    {
        return $this->response;
    }

    public function setResponse($response)
    {
        $this->response = $response;
        return $this;
    }

    public function getExitCode()
    {
        return $this->exitCode;
    }

    public function setExitCode($exitCode)
    {
        $this->exitCode = $exitCode;
        return $this;
    }

    public function appendToStdErr($stdErrLine)
    {
        $this->stderr[] = $stdErrLine;
    }

    public function getStdErr()
    {
        return $this->stderr;
    }

    public function getExecutionTime()
    {
        return $this->executionTime;
    }

    public function setExecutionTime($executionTime)
    {
        $this->executionTime = $executionTime;
        return $this;
    }
}
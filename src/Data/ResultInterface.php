<?php
namespace Wesleywmd\Element\Shell\Data;

interface ResultInterface
{
    public function getOriginalCommand();

    public function getOriginalCwd();

    public function getResponse();

    public function setResponse($response);

    public function getExitCode();

    public function setExitCode($exitCode);

    public function appendToStdErr($stdErrLine);

    public function getStdErr();

    public function getExecutionTime();

    public function setExecutionTime($executionTime);
}
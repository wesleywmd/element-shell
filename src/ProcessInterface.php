<?php
namespace Wesleywmd\Element\Shell;

interface ProcessInterface
{
    public function open($command, $descriptors, &$pipes, $cwd);

    public function close($process);

    public function status($process);
}
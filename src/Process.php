<?php
namespace Wesleywmd\Element\Shell;

class Process implements ProcessInterface
{
    public function open($command, $descriptors, $pipes, $cwd)
    {
        return proc_open($command, $descriptors, $pipes, $cwd);
    }

    public function close($process)
    {
        return proc_close($process);
    }

    public function status($process)
    {
        return proc_get_status($process);
    }
}
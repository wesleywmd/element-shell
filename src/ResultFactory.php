<?php
namespace Wesleywmd\Element\Shell;

use Wesleywmd\Element\Shell\Data\Result;

class ResultFactory implements ResultFactoryInterface
{
    public function create($originalCommand, $originalCwd)
    {
        return new Result($originalCommand, $originalCwd);
    }
}
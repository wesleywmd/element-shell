<?php
namespace Wesleywmd\Element\Shell;

interface ResultFactoryInterface
{
    public function create($originalCommand, $originalCwd);
}
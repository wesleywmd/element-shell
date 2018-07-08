<?php
namespace Wesleywmd\Element\Shell;

interface CommandFactoryInterface
{
    public function create($command, $arguments = [], $options = []);
}
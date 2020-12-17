<?php

namespace exert;

#[Attribute(Attribute::TARGET_CLASS)]
class ControllerAttribute
{
    private $path;
    
    public function __construct($path)
    {
        $this->path = $path;
    }
}

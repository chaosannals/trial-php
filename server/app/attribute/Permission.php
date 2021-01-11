<?php

namespace app\attribute;

use Attribute;

#[Attribute(Attribute::TARGET_FUNCTION | Attribute::TARGET_CLASS)]
class Permission
{
    public const NONE = 0;
    public const STRICT = 1;
    public const TOLERANT = 2;

    private $mode;
    private $tags;

    public function __construct($mode, ...$tags)
    {
        $this->mode = $mode;
        $this->tags = $tags;
    }

    public function has($tag)
    {
        return in_array($tag, $this->tags);
    }

    public function check($tags)
    {
        switch ($this->mode) {
            case self::NONE:
                return true;
            case self::STRICT:
                return $this->strictly($tags);
            case self::TOLERANT:
                return $this->tolerate($tags);
        }
        return false;
    }

    public function tolerate($tags)
    {
        $intersect = array_intersect($this->tags, $tags);
        return !empty($intersect);
    }

    public function strictly($tags)
    {
        $intersect = array_intersect($this->tags, $tags);
        $diff = array_diff($intersect, $this->tags);
        return empty($diff);
    }
}

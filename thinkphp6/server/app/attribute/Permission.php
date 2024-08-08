<?php

namespace app\attribute;

use Attribute;

/**
 * 权限
 * 
 */
#[Attribute(Attribute::TARGET_FUNCTION | Attribute::TARGET_CLASS)]
class Permission
{
    public const NONE = 0; // 无限制
    public const STRICT = 1; // 严格模式，必须全部权限符合。
    public const TOLERANT = 2; // 宽松模式，只要满足一个即可。

    private $mode;
    private $tags;

    /**
     * 初始化。
     *
     * @param int $mode
     * @param string ...$tags
     */
    public function __construct($mode, ...$tags)
    {
        $this->mode = $mode;
        $this->tags = $tags;
    }

    /**
     * 是否拥有该权限。
     *
     * @param string $tag
     * @return boolean
     */
    public function has($tag)
    {
        return in_array($tag, $this->tags);
    }

    /**
     * 检查是否符合权限。
     *
     * @param array $tags
     * @return boolean
     */
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

    /**
     * 宽松检查。
     *
     * @param array $tags
     * @return boolean
     */
    public function tolerate($tags)
    {
        $intersect = array_intersect($this->tags, $tags);
        return !empty($intersect);
    }

    /**
     * 严格检查
     *
     * @param array $tags
     * @return boolean
     */
    public function strictly($tags)
    {
        $intersect = array_intersect($this->tags, $tags);
        $diff = array_diff($intersect, $this->tags);
        return empty($diff);
    }
}

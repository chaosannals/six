<?php

namespace six;

use ReflectionClass;

/**
 * 权限。
 * 
 */
class SixPermit
{
    public const EXTRACT_PATTERN = '/@permit\s+([\w\-_, ]*)/';
    private $tags;

    /**
     * 设置权限
     *
     * @param array $tags
     */
    public function __construct($tags = [])
    {
        $this->tags = $tags;
    }

    /**
     * 解析类权限。
     *
     * @param string $class
     * @param string $method
     * @return array|null
     */
    public function analyze($class, $method)
    {
        $reflection = new ReflectionClass($class);
        $action = $reflection->getMethod($method);
        $comment = $action->getDocComment();
        if (preg_match(self::EXTRACT_PATTERN, $comment, $matches)) {
            return array_values(array_filter(
                array_map('trim', explode(',', $matches[1]))
            ));
        }
        return null;
    }

    public function isAvaliable($class, $method)
    {
        $tags = $this->analyze($class, $method);
        $intersection = array_intersect($tags, $this->tags);
        return count($intersection) > 0;
    }

    /**
     * 充分满足。
     *
     * @param string $class
     * @param string $method
     * @return boolean
     */
    public function isSufficient($class, $method)
    {
        $tags = $this->analyze($class, $method);
        $count = count($tags);
        $intersection = array_intersect($tags, $this->tags);
        return count($intersection) == $count;
    }
}

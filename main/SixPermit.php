<?php

namespace six;

use ReflectionClass;

class SixPermit
{
    public const EXTRACT_PATTERN = '/@permit\s+([\w\-_, ]*)/';

    public function __construct()
    {
    }

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
}

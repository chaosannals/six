<?php

namespace test\entity;

use six\orm\SixEntity;

class TesterEntity extends SixEntity
{
    /**
     * @limit 11
     * @unsigned
     * @var int
     */
    private $id;
}

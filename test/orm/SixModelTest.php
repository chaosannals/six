<?php

namespace test\orm;

use think\facade\Db;
use PHPUnit\Framework\TestCase;
use test\model\TesterModel;

class SixModelTest extends TestCase
{
    public static function setUpBeforeClass(): void
    {
        $setting = require dirname(__DIR__) . '/config/db.php';
        Db::setConfig($setting);
    }

    public function testBatch()
    {
        $m = new TesterModel();
        $m->batchLike([
            'name' => '1',
        ], [
            'name' => 'name',
        ]);
        $m->select();
    }
}

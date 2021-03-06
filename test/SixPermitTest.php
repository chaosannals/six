<?php

namespace test;

use PHPUnit\Framework\TestCase;
use six\SixPermit;
use test\controller\Test;

/**
 * 权限测试。
 * 
 */
class SixPermitTest extends TestCase
{
    public function testAnalyze()
    {
        $permit = new SixPermit();
        $none = $permit->analyze(Test::class, 'none');
        $this->assertEmpty($none);
        $nothing = $permit->analyze(Test::class, 'nothing');
        $this->assertNull($nothing);
        $one = $permit->analyze(Test::class, 'one');
        $this->assertContains('one', $one);
        $two = $permit->analyze(Test::class, 'two');
        $this->assertContains('two', $two);
    }

    public function testIsSufficient()
    {
        $permit = new SixPermit(['one', 'two']);
        $result = $permit->isSufficient(Test::class, 'one');
        $this->assertTrue($result);
    }

    public function testIsAvaliable()
    {
        $permit = new SixPermit(['two']);
        $result = $permit->isAvaliable(Test::class, 'two');
        $this->assertTrue($result);
    }
}

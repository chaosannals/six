<?php

namespace test;

use PHPUnit\Framework\TestCase;
use six\SixPermit;
use test\controller\Test;

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
}

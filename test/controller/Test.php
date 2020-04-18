<?php

namespace test\controller;

class Test
{
    /**
     * @permit
     */
    public function none()
    {
    }

    public function nothing()
    {
    }

    /**
     * @permit one
     */
    public function one()
    {
    }

    /**
     * @permit one, two
     */
    public function two()
    {
    }
}

<?php

namespace App\Core\Tester;

use App\Core\CodeRunner;
use PHPUnit\Framework\TestCase;

class SimpleTester extends TestCase
{

    public function check()
    {
       return $this->assertTrue(CodeRunner::doSomething() === 'something');
    }

}

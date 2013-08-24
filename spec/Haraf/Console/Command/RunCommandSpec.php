<?php

namespace spec\Haraf\Console\Command;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RunCommandSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Haraf\Console\Command\RunCommand');
    }
}

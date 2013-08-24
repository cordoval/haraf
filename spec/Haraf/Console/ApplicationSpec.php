<?php

namespace spec\Haraf\Console;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ApplicationSpec extends ObjectBehavior
{
    function it_boostraps_itself_with_a_run_command()
    {
        $this->beConstructedWith(1);
        $this->get('run')->shouldHaveType(\Haraf\Console\Command\RunCommand::class);
    }
}

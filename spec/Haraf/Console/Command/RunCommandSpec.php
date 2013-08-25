<?php

namespace spec\Haraf\Console\Command;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use Haraf\Runner\PhpSpec as Runner;

use Symfony\Component\Console\Input\InputInterface,
    Symfony\Component\Console\Output\OutputInterface;

class RunCommandSpec extends ObjectBehavior
{
    function it_runs_the_runner_when_executed(Runner $runner, InputInterface $input, OutputInterface $output)
    {
        $this->beConstructedWith($runner);
        
        $this->run($input, $output);
        
        $runner->run()->shouldHaveBeenCalled();
    }
}

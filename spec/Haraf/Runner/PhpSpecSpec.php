<?php

namespace spec\Haraf\Runner;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use Haraf\Environment\PhpSpec as Environment;

use PhpSpec\Runner\SpecificationRunner as SpecRunner,
    PhpSpec\Loader\Node\SpecificationNode as Specification;

class PhpSpecSpec extends ObjectBehavior
{
    
    function let(Environment $environment, SpecRunner $runner, Specification $spec)
    {
        $this->beConstructedWith($environment);

        $environment->getRunner()->willReturn($runner);
        $environment->getSpecifications()->willReturn([$spec]);
        $environment->configure()->willReturn(null);
    }
    
    function it_configures_the_phpspec_environment_when_it_is_run($environment)
    {
        $this->run();
        
        $environment->configure()->shouldHaveBeenCalled();
    }
    
    function it_gets_runner_and_specifications_from_environment_and_runs_them_when_it_is_run($environment, $runner, $spec)
    {
        $this->run();

        $environment->configure()->shouldHaveBeenCalled();
        $runner->run($spec)->shouldHaveBeenCalled();
    }
    
}

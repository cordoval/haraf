<?php

namespace spec\Haraf\Environment;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use Symfony\Component\Console\Input\InputInterface,
    Symfony\Component\Console\Output\OutputInterface,
    Symfony\Component\Console\Helper\HelperSet;

use PhpSpec\Console\Application,
    PhpSpec\ServiceContainer as Container,
    PhpSpec\Loader\ResourceLoader as Loader,
    PhpSpec\Runner\SpecificationRunner as SpecRunner,
    PhpSpec\Loader\Suite,
    PhpSpec\Loader\Node\SpecificationNode as Specification;

class PhpSpecSpec extends ObjectBehavior
{
    function let(Application $application, Container $container, Loader $loader, 
                 SpecRunner $runner, Suite $suite, Specification $spec)
    {
        $application->getContainer()->willReturn($container);
        
        $container->get('loader.resource_loader')->willReturn($loader);
        $container->get('runner.specification')->willReturn($runner);
        $container->set(Argument::any(), Argument::any())->willReturn(null);
        $container->configure()->willReturn(null);
        
        $loader->load(null)->willReturn($suite);
        $suite->getSpecifications()->willReturn([$spec]);
        
        $this->beConstructedWith($application);
    }
    
    function it_configures_container_from_phpspec_application($application, $container)
    {
        $this->configure();
        
        $application->getContainer()->shouldHaveBeenCalled();
        $container->configure()->shouldHaveBeenCalled();
    }
    
    function it_configures_console_inputs_and_outputs_in_the_container($container)
    {
        $this->configure();
        
        $container->set('console.input', Argument::type(InputInterface::class))->shouldhaveBeenCalled();
        $container->set('console.output', Argument::type(OutputInterface::class))->shouldhaveBeenCalled();
        $container->set('console.helpers', Argument::type(HelperSet::class))->shouldhaveBeenCalled();
    }    
    
    function it_gets_suite_of_specifications_from_loader_when_getSpecifications_is_called($spec)
    {
        $this->configure();
        $this->getSpecifications()->shouldReturn([$spec]);
    }
    
    function it_gets_a_runner_for_the_specs_when_getRunner_is_called($runner)
    {
        $this->configure();
        $this->getRunner()->shouldReturn($runner);
    }
}

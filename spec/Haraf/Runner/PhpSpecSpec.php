<?php

namespace spec\Haraf\Runner;

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
    
    function it_configures_container_from_phpspec_application_and_gets_components_it_needs($application, $container)
    {
        $this->run();
        
        $application->getContainer()->shouldHaveBeenCalled();
        
        $container->get('loader.resource_loader')->shouldHaveBeenCalled();
        $container->get('runner.specification')->shouldHaveBeenCalled();
        
        $container->configure()->shouldHaveBeenCalled();
    }
    
    function it_configures_console_inputs_and_outputs_in_the_container($container)
    {
        $this->run();
        
        $container->set('console.input', Argument::type(InputInterface::class))->shouldhaveBeenCalled();
        $container->set('console.output', Argument::type(OutputInterface::class))->shouldhaveBeenCalled();
        $container->set('console.helpers', Argument::type(HelperSet::class))->shouldhaveBeenCalled();
    }
    
    function it_gets_suite_of_specifications_from_loader($loader, $suite)
    {
        $this->run();
        
        $loader->load(null)->shouldHaveBeenCalled();
        $suite->getSpecifications()->shouldHaveBeenCalled();
    }

    
    function it_runs_the_specifications_using_the_runner($runner, $spec)
    {
        $this->run();
        
        $runner->run($spec)->shouldHaveBeenCalled();
    }
    
}

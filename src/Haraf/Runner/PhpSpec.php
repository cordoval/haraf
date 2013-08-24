<?php

namespace Haraf\Runner;

use PhpSpec\Console\Application;

use Symfony\Component\Console\Input\ArgvInput as Input,
    Symfony\Component\Console\Output\NullOutput as Output,
    Symfony\Component\Console\Helper\HelperSet as Helpers;
    
class PhpSpec
{
    private $application;
    
    public function __construct(Application $application)
    {
        $this->application = $application;
    }

    public function run()
    {
        $container = $this->application->getContainer();
        
        $container->set('console.input', new Input());
        $container->set('console.output', new Output());
        $container->set('console.helpers', new Helpers());
        
        $loader = $container->get('loader.resource_loader');
        $specRunner = $container->get('runner.specification');
        
        $specs = $loader->load(null)->getSpecifications();
        
        foreach ($specs as $spec) {
            $specRunner->run($spec);
        }
    }
}
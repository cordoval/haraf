<?php

namespace Haraf\Environment;

use PhpSpec\Console\Application;

use Symfony\Component\Console\Input\ArgvInput as Input,
    Symfony\Component\Console\Output\NullOutput as Output,
    Symfony\Component\Console\Helper\HelperSet as Helpers;

class PhpSpec
{
    
    private $application;
    private $container;
    
    public function __construct(Application $application)
    {
        $this->application = $application;
    }
    
    public function configure()
    {
        $this->container = $this->application->getContainer();
        $this->container->set('console.input', new Input());
        $this->container->set('console.output', new Output());
        $this->container->set('console.helpers', new Helpers());
        $this->container->configure();     
    }
    
    public function getRunner()
    {
        return $this->container->get('runner.specification');
    }
    
    public function getSpecifications()
    {
        $loader = $this->container->get('loader.resource_loader');
        return $loader->load(null)->getSpecifications();
    }
  
}
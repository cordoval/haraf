<?php

namespace Haraf\Environment;

use PhpSpec\Console\Application;

use Symfony\Component\Console\Input\ArgvInput as Input,
    Symfony\Component\Console\Output\NullOutput as Output,
    Symfony\Component\Console\Helper\HelperSet as Helpers;

/**
* Contains and configures the PhpSpec environment
*/
class PhpSpec
{
    
    private $application;
    private $container;
    
    /**
     * @var Application $application A real PhpSpec console application
     */
    public function __construct(Application $application)
    {
        $this->application = $application;
    }
    
    /**
     * Bootstraps the environment
     */
    public function configure()
    {
        $this->container = $this->application->getContainer();
        $this->container->set('console.input', new Input());
        $this->container->set('console.output', new Output());
        $this->container->set('console.helpers', new Helpers());
        $this->container->configure();
    }
    
    /**
     * Provides a configured Runner
     *
     * @return PhpSpec\Runner\SpecificationRunner
     */
    public function getRunner()
    {
        return $this->container->get('runner.specification');
    }
    
    /**
     * Provides located specifications to be run
     * 
     * @return array Set of PhpSpec\Loader\Node\ExampleNode
     */
    public function getSpecifications()
    {
        $loader = $this->container->get('loader.resource_loader');
        return $loader->load(null)->getSpecifications();
    }
  
}
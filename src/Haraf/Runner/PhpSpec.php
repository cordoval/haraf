<?php

namespace Haraf\Runner;
    
use Haraf\Environment\PhpSpec as Environment;
    
/**
* Coordinates the running of specs from the PhpSpec environment
*/
class PhpSpec
{
    /**
     * @var Environment The PhpSpec environment
     */
    private $environment;

    /**
     * @var Environment The PhpSpec environment
     */
    public function __construct(Environment $environment)
    {
        $this->environment = $environment;
    }

    /**
     * Gets the components needed from the PhpSpec environment, then runs the specs
     */
    public function run()
    {
        $this->environment->configure();
        
        $runner = $this->environment->getRunner();
        $specs = $this->environment->getSpecifications();
        
        foreach ($specs as $spec) {
            $runner->run($spec);
        }
    }
   
}
<?php

namespace Haraf\Runner;
    
use Haraf\Environment\PhpSpec as Environment;
    
class PhpSpec
{
    
    private $environment;

    public function __construct(Environment $environment)
    {
        $this->environment = $environment;
    }
    
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
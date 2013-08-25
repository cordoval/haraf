<?php

namespace Haraf\Console;

use Symfony\Component\Console\Application as BaseApplication;

use Haraf\Console\Command\RunCommand;

/**
* Main application
*/
class Application extends BaseApplication
{
    
    public function __construct($version)
    {
        parent::__construct($version);
        
        $this->add(new RunCommand());
    }
    
}

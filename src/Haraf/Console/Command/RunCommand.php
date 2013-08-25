<?php

namespace Haraf\Console\Command;

use Haraf\Runner\PhpSpec as Runner;

use Symfony\Component\Console\Command\Command as BaseCommand,
    Symfony\Component\Console\Input\InputInterface,
    Symfony\Component\Console\Output\OutputInterface;

/**
* Finds and runs any configured specs/tests
*/
class RunCommand extends BaseCommand
{
    private $runner;
    
    /**
     * @param Runner $runner The Haraf runner to use to run the tests
     */
    public function __construct(Runner $runner)
    {
        $this->runner = $runner;
        parent::__construct('run');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->runner->run();
    }
}

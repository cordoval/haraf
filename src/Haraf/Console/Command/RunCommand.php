<?php

namespace Haraf\Console\Command;

use Haraf\Runner\PhpSpec as Runner,
    Haraf\Environment\PhpSpec as Environment;

use Symfony\Component\Console\Command\Command as BaseCommand,
    Symfony\Component\Console\Input\InputInterface,
    Symfony\Component\Console\Output\OutputInterface;

use PhpSpec\Console\Application as PhpSpecApplication;

class RunCommand extends BaseCommand
{
    public function __construct()
    {
        parent::__construct('run');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $runner = new Runner(new Environment(new PhpSpecApplication(null)));
        $runner->run();
    }
}

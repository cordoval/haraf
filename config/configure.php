<?php

$container = new Pimple;

$container['application'] = function($c) {
    $application = new Symfony\Component\Console\Application('0.1alpha');
    
    $application->add($c['application.commands.run']);
    
    return $application;
};

$container['application.commands.run'] = function($c) {
    return new Haraf\Console\Command\RunCommand($c['runner.phpspec']);
};

$container['runner.phpspec'] = function($c) {
    return new Haraf\Runner\Phpspec($c['environment.phpspec']);
};

$container['environment.phpspec'] = function($c) {
    return new Haraf\Environment\Phpspec($c['phpspec.application']);
};

$container['phpspec.application'] = function($c) {
    return new PhpSpec\Console\Application(2);
};

return $container;
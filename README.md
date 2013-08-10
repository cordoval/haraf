Haraf is a PHP-based test/spec/story runner

Goals
=====

* A polylingual executable that can run test suites containing tests from different platforms and display the results in one homogenous format.

* Leverage existing components wherever possible.

* Allow organisations transitioning from one platform to another to migrate slowly rather than 'throw away' the old suite.

Milestones
==========

1. dogfooding the specs using the haraf executable
2. execute PHPUnit tests using PHPspec's formatters (event mapping between the two)
3. combined execution of PHPSpec + PHPUnit
4. add Behat execution to the list
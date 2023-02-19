<!DOCTYPE html>
<html>
<head><title>Testing</title></head>
<body>
    <h1>Unit and integration Testing</h1>
    
    <?php

        // create phpunit directory and install phpunit in it: composer require --dev phpunit/phpunit ^9.5 from https://phpunit.readthedocs.io/en/9.5/
        // to get available commands run in the console: ./phpunit/vendor/bin/phpunit
        // create directory for tests phpunit/tests
        // configure php unit in phpunit.xml (root of the project)
        // test the configuration: ./phpunit/vendor/bin/phpunit
        // to run specific tests specify them in the command e.g. ./phpunit/vendor/bin/phpunit MyTest.php
        // to run all tests in a directory use a command e.g. ./phpunit/vendor/bin/phpunit mytests
        
        // Unit tests test small units of code (e.g. single function) and
        // they mock/fake any needed dependencies or database connections
        // They are supposed to be simple and fast

        // Integration tests test multiple modules or units together (e.g. 
        // method that connects to DB, runs queries and returns records)
        // Dependencies can be resolved and they can use the DB connection

        // In both TDD and BDD tests are written prior to code
        // TDD - Test-driven development
        // BDD - Behavior-driven development

        
    ?>

</body>
</html>

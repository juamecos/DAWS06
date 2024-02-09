<?php


 function autoload_b958555b879437d6196ccbaaaf2f445f($class)
{
    $classes = array(
        'AppClases1OperacionesService' => __DIR__ .'/AppClases1OperacionesService.php'
    );
    if (!empty($classes[$class])) {
        include $classes[$class];
    };
}

spl_autoload_register('autoload_b958555b879437d6196ccbaaaf2f445f');

// Do nothing. The rest is just leftovers from the code generation.
{
}

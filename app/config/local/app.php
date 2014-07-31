<?php

return array(
    'debug' => true,
    'timezone' => 'Europe/Kiev',

    'providers' => append_config(array(
        'Way\Generators\GeneratorsServiceProvider',
        'Barryvdh\Debugbar\ServiceProvider',
        'Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider',
    )),
);

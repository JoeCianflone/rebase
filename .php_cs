<?php
/*
 * This document has been generated with
 * https://mlocati.github.io/php-cs-fixer-configurator/#version:2.16.3|configurator
 * you can change this configuration by importing this file.
 */
return PhpCsFixer\Config::create()
    ->setRules([
        '@PSR2' => true,
        '@PSR1' => true,
        '@Symfony' => true,
        '@PhpCsFixer' => true,
    ])
    ->setFinder(PhpCsFixer\Finder::create()
        ->exclude('vendor/')
        ->exclude('bootstrap/')
        ->exclude('public/')
        ->exclude('resources/')
        ->exclude('storage/')
        ->in(__DIR__)
    )
;

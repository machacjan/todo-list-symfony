<?php

$finder = PhpCsFixer\Finder::create()
    ->exclude('src/Migrations')
    ->in(sprintf('%s/src', __DIR__))
;

$config = new PhpCsFixer\Config();

return $config->setRules([
        'strict_param' => true,
        'array_syntax' => ['syntax' => 'short'],
        'modernize_strpos' => true,
        'constant_case' => ['case' => 'lower'],
        'native_function_invocation' => ['include' => ['@all'], 'scope' => 'all', 'strict' => true],
        'fully_qualified_strict_types' => true,
        'global_namespace_import' => ['import_classes' => true, 'import_constants' => null, 'import_functions' => null],
        'phpdoc_separation' => true,
        'phpdoc_trim' => true,
        'phpdoc_var_without_name' => true,
        'declare_strict_types' => true,
        'array_indentation' => true,
        'no_trailing_whitespace' => true,
        'no_whitespace_in_blank_line' => true,
        'single_blank_line_at_eof' => true,
    ])
    ->setFinder($finder)
;
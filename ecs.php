<?php

declare(strict_types=1);

use PhpCsFixer\Fixer\ClassNotation\ClassDefinitionFixer;
use PhpCsFixer\Fixer\ClassNotation\OrderedTraitsFixer;
use PhpCsFixer\Fixer\Import\NoUnusedImportsFixer;
use Symplify\EasyCodingStandard\Config\ECSConfig;

return ECSConfig::configure()
    ->withConfiguredRule(
        ClassDefinitionFixer::class,
        [
            'space_before_parenthesis' => true,
        ],
    )
    ->withFileExtensions(['php'])
    ->withPaths(
        [
            __DIR__ . '/src',
            __DIR__ . '/tests',
        ]
    )
    ->withPhpCsFixerSets(false, false, false, false, false, true)
    ->withPreparedSets(
        true,
        false,
        false,
        false,
        true,
        true,
        true,
        false,
        true,
        false,
        false,
        true,
        true
    )
    ->withRules([NoUnusedImportsFixer::class, OrderedTraitsFixer::class]);

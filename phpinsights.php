<?php

declare(strict_types=1);

return [
    'preset'  => 'default',
    'exclude' => [
        //  'path/to/directory-or-file'
    ],
    'add' => [
        //  ExampleMetric::class => [
        //      ExampleInsight::class,
        //  ]
    ],
    'remove' => [
        NunoMaduro\PhpInsights\Domain\Insights\ForbiddenNormalClasses::class,
    ],
    'config' => [
        \PhpCsFixer\Fixer\Operator\BinaryOperatorSpacesFixer::class => [
            'operators' => [
                '='   => 'align_single_space',
                '+='  => 'align_single_space',
                '===' => 'align_single_space_minimal',
                '=>'  => 'align',
            ],
        ],
    ],
];

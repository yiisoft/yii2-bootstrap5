<?php

namespace yiiunit\extensions\bootstrap5\data;

use yii\bootstrap5\ActiveField;

/**
 * A customized extension from ActiveField
 *
 * @see \yiiunit\extensions\bootstrap5\ActiveFieldTest::testHorizontalCssClassesOverride()
 *
 * @author Michael Härtl <haertl.mike@gmail.com>
 */
class ExtendedActiveField extends ActiveField
{
    public ?array $horizontalCssClasses = [
        'offset' => 'col-md-offset-4',
        'label' => 'col-md-4',
        'wrapper' => 'col-md-6',
        'error' => 'col-md-3',
        'hint' => 'col-md-3',
    ];
}

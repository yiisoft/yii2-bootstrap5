<?php

declare(strict_types=1);

namespace yiiunit\extensions\bootstrap5;

use yii\bootstrap5\ButtonDropdown;

/**
 * @group bootstrap5
 */
class ButtonDropdownTest extends TestCase
{
    public function testContainerOptions(): void
    {
        $containerClass = 'testClass';

        ButtonDropdown::$counter = 0;
        $out = ButtonDropdown::widget([
            'direction' => ButtonDropdown::DIRECTION_UP,
            'options' => [
                'class' => $containerClass,
            ],
            'label' => 'Action',
            'dropdown' => [
                'items' => [
                    [
                        'label' => 'DropdownA',
                        'url' => '/',
                    ],
                    [
                        'label' => 'DropdownB',
                        'url' => '#',
                    ],
                ],
            ],
        ]);

        $this->assertStringContainsString("$containerClass dropup btn-group", $out);
    }

    public function testDirection(): void
    {
        ButtonDropdown::$counter = 0;
        $out = ButtonDropdown::widget([
            'direction' => ButtonDropdown::DIRECTION_LEFT,
            'label' => 'Action',
            'dropdown' => [
                'items' => [
                    [
                        'label' => 'ItemA',
                        'url' => '#',
                    ],
                    [
                        'label' => 'ItemB',
                        'url' => '#',
                    ],
                ],
            ],
        ]);

        $expected = <<<EXPECTED
<div id="w0" class="dropleft btn-group"><button id="w0-button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Action</button>

<div id="w1" class="dropdown-menu"><a class="dropdown-item" href="#">ItemA</a>
<a class="dropdown-item" href="#">ItemB</a></div></div>
EXPECTED;

        $this->assertEqualsWithoutLE($expected, $out);
    }

    public function testSplit(): void
    {
        ButtonDropdown::$counter = 0;
        $out = ButtonDropdown::widget([
            'direction' => ButtonDropdown::DIRECTION_DOWN,
            'label' => 'Split dropdown',
            'split' => true,
            'dropdown' => [
                'items' => [
                    [
                        'label' => 'ItemA',
                        'url' => '#',
                    ],
                    [
                        'label' => 'ItemB',
                        'url' => '#',
                    ],
                ],
            ],
        ]);

        $expected = <<<EXPECTED
<div id="w0" class="dropdown btn-group"><button id="w1" class="btn">Split dropdown</button>
<button id="w0-button" class="btn dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false"><span class="visually-hidden">Toggle Dropdown</span></button>
<div id="w2" class="dropdown-menu"><a class="dropdown-item" href="#">ItemA</a>
<a class="dropdown-item" href="#">ItemB</a></div></div>
EXPECTED;

        $this->assertEqualsWithoutLE($expected, $out);
    }

    /**
     * @see https://github.com/yiisoft/yii2-bootstrap5/pull/88 fix
     */
    public function testGeneratedJS(): void
    {
        ButtonDropdown::$counter = 0;
        $out = ButtonDropdown::widget([
            'direction' => ButtonDropdown::DIRECTION_DOWN,
            'label' => 'Action',
            'dropdown' => [
                'items' => [
                    [
                        'label' => 'DropdownA',
                        'url' => '/',
                    ],
                    [
                        'label' => 'DropdownB',
                        'url' => '#',
                    ],
                ],
            ],
        ]);

        $js = array_shift(\Yii::$app->view->js);

        $this->assertIsArray($js);
        $this->assertNotContains('(new bootstrap.Button(\'#w0-button\', {}));', $js);
        $this->assertContains('(new bootstrap.Dropdown(\'#w0-button\', {}));', $js);
    }
}

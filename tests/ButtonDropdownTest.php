<?php

namespace yiiunit\extensions\bootstrap5;

use yii\bootstrap5\ButtonDropdown;

/**
 * @group bootstrap5
 */
class ButtonDropdownTest extends TestCase
{
    public function testContainerOptions()
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
                    ['label' => 'DropdownA', 'url' => '/'],
                    ['label' => 'DropdownB', 'url' => '#'],
                ],
            ],
        ]);

        $this->assertStringContainsString("$containerClass dropup btn-group", $out);
    }

    public function testDirection()
    {
        ButtonDropdown::$counter = 0;
        $out = ButtonDropdown::widget([
            'direction' => ButtonDropdown::DIRECTION_LEFT,
            'label' => 'Action',
            'dropdown' => [
                'items' => [
                    ['label' => 'ItemA', 'url' => '#'],
                    ['label' => 'ItemB', 'url' => '#'],
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

    public function testSplit()
    {
        ButtonDropdown::$counter = 0;
        $out = ButtonDropdown::widget([
            'direction' => ButtonDropdown::DIRECTION_DOWN,
            'label' => 'Split dropdown',
            'split' => true,
            'dropdown' => [
                'items' => [
                    ['label' => 'ItemA', 'url' => '#'],
                    ['label' => 'ItemB', 'url' => '#']
                ]
            ]
        ]);

        $expected = <<<EXPECTED
<div id="w0" class="dropdown btn-group"><button id="w1" class="btn">Split dropdown</button>
<button id="w0-button" class="btn dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false"><span class="visually-hidden">Toggle Dropdown</span></button>
<div id="w2" class="dropdown-menu"><a class="dropdown-item" href="#">ItemA</a>
<a class="dropdown-item" href="#">ItemB</a></div></div>
EXPECTED;

        $this->assertEqualsWithoutLE($expected, $out);
    }
}

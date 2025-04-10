<?php

namespace yiiunit\extensions\bootstrap5;

use yii\bootstrap5\Html;
use yii\bootstrap5\Modal;

/**
 * @group bootstrap5
 */
class ModalTest extends TestCase
{
    public function testBodyOptions()
    {
        Modal::$counter = 0;
        $out = Modal::widget([
            'closeButton' => false,
            'bodyOptions' => ['class' => 'modal-body test', 'style' => 'text-align:center;']
        ]);


        $expected = <<<HTML

<div id="w0" class="modal fade" tabindex="-1" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">

<div class="modal-body test" style="text-align:center;">

</div>

</div>
</div>
</div>
HTML;

        $this->assertEqualsWithoutLE($expected, $out);
    }

    /**
     */
    public function testContainerOptions()
    {
        Modal::$counter = 0;

        ob_start();
        Modal::begin([
            'title' => 'Modal title',
            'footer' => Html::button('Close', [
                    'type' => 'button',
                    'class' => ['btn', 'btn-secondary'],
                    'data' => [
                        'bs-dismiss' => 'modal'
                    ]
                ]) . "\n" . Html::button('Save changes', [
                    'type' => 'button',
                    'class' => ['btn', 'btn-primary']
                ])
        ]);
        echo '<p>Woohoo, you\'re reading this text in a modal!</p>';
        Modal::end();
        $out = ob_get_clean();

        $expected = <<<HTML

<div id="w0" class="modal fade" tabindex="-1" aria-hidden="true" aria-labelledby="w0-label">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h5 id="w0-label" class="modal-title">Modal title</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
<p>Woohoo, you're reading this text in a modal!</p>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
<button type="button" class="btn btn-primary">Save changes</button>
</div>
</div>
</div>
</div>
HTML;

        $this->assertEqualsWithoutLE($expected, $out);
    }

    public function testTriggerButton()
    {
        Modal::$counter = 0;

        ob_start();
        Modal::begin([
            'toggleButton' => [
                'class' => ['btn', 'btn-primary'],
                'label' => 'Launch demo modal'
            ],
            'title' => 'Modal title',
            'footer' => Html::button('Close', [
                    'type' => 'button',
                    'class' => ['btn', 'btn-secondary']
                ]) . "\n" . Html::button('Save changes', [
                    'type' => 'button',
                    'class' => ['btn', 'btn-primary']
                ])
        ]);
        echo '<p>Woohoo, you\'re reading this text in a modal!</p>';
        Modal::end();
        $out = ob_get_clean();

        $this->assertStringContainsString(
            '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#w0">Launch demo modal</button>',
            $out
        );
    }

    public function testDialogOptions()
    {
        Modal::$counter = 0;
        $out = Modal::widget([
            'closeButton' => false,
            'dialogOptions' => ['class' => 'test', 'style' => 'text-align:center;']
        ]);


        $expected = <<<HTML

<div id="w0" class="modal fade" tabindex="-1" aria-hidden="true">
<div class="test modal-dialog" style="text-align:center;">
<div class="modal-content">

<div class="modal-body">

</div>

</div>
</div>
</div>
HTML;

        $this->assertEqualsWithoutLE($expected, $out);
    }

    public function testCenterVertical()
    {
        Modal::$counter = 0;
        $out = Modal::widget([
            'closeButton' => false,
            'centerVertical' => true
        ]);


        $expected = <<<HTML

<div id="w0" class="modal fade" tabindex="-1" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content">

<div class="modal-body">

</div>

</div>
</div>
</div>
HTML;

        $this->assertEqualsWithoutLE($expected, $out);
    }

    public function testScrollable()
    {
        Modal::$counter = 0;
        $out = Modal::widget([
            'closeButton' => false,
            'scrollable' => true
        ]);


        $expected = <<<HTML

<div id="w0" class="modal fade" tabindex="-1" aria-hidden="true">
<div class="modal-dialog modal-dialog-scrollable">
<div class="modal-content">

<div class="modal-body">

</div>

</div>
</div>
</div>
HTML;

        $this->assertEqualsWithoutLE($expected, $out);
    }
}

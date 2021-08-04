<?php

namespace yiiunit\extensions\bootstrap5;

use yii\bootstrap5\Html;
use yii\bootstrap5\Modal;
use yii\bootstrap5\Offcanvas;

/**
 * @group bootstrap5
 */
class OffcanvasTest extends TestCase
{
    public function testBodyOptions()
    {
        Offcanvas::$counter = 0;
        $out = Offcanvas::widget([
            'closeButton' => false,
            'bodyOptions' => ['class' => 'offcanvas-body test', 'style' => ['text-align' => 'center']]
        ]);


        $expected = <<<HTML

<div id="w0" class="offcanvas offcanvas-start" tabindex="-1" data-bs-backdrop="true" data-bs-scroll="false">

<div class="offcanvas-body test" style="text-align: center;">

</div>
</div>
HTML;

        $this->assertEqualsWithoutLE($expected, $out);
    }

    /**
     */
    public function testOptions()
    {
        Offcanvas::$counter = 0;

        ob_start();
        Offcanvas::begin([
            'title' => 'Offcanvas title',
            'backdrop' => false,
            'scrolling' => true,
            'closeButton' => false
        ]);
        echo '<p>Woohoo, you\'re reading this text in an offcanvas!</p>';
        Offcanvas::end();
        $out = ob_get_clean();

        $expected = <<<HTML

<div id="w0" class="offcanvas offcanvas-start" tabindex="-1" data-bs-backdrop="false" data-bs-scroll="true" aria-labelledby="w0-label">
<div class="offcanvas-header">
<h5 id="w0-label" class="offcanvas-title">Offcanvas title</h5>
</div>
<div class="offcanvas-body">
<p>Woohoo, you're reading this text in an offcanvas!</p>
</div>
</div>
HTML;

        $this->assertEqualsWithoutLE($expected, $out);
    }

    public function testTriggerButton()
    {
        Offcanvas::$counter = 0;

        ob_start();
        Offcanvas::begin([
            'toggleButton' => [
                'class' => ['btn', 'btn-primary'],
                'label' => 'Launch demo offcanvas'
            ],
            'title' => 'Offcanvas title',
        ]);
        echo '<p>Woohoo, you\'re reading this text in an offcanvas!</p>';
        Offcanvas::end();
        $out = ob_get_clean();

        $this->assertContains(
            '<button type="button" class="btn btn-primary" data-bs-toggle="offcanvas" aria-controls="w0" data-bs-target="#w0">Launch demo offcanvas</button>',
            $out
        );
    }
}

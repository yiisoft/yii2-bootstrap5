<?php

namespace yiiunit\extensions\bootstrap5;

use PHPUnit\Framework\Constraint\IsType;
use Yii;
use yii\bootstrap5\Html;
use yii\bootstrap5\Popover;
use yii\web\View;

/**
 * @group bootstrap5
 */
class PopoverTest extends TestCase
{
    public function testButtonRender()
    {
        Popover::$counter = 0;
        $out = Popover::widget(['toggleButton' => ['class' => ['btn', 'btn-primary']]]);

        $expected = <<<HTML
<button type="button" id="w0" class="btn btn-primary">Show</button>
HTML;

        $this->assertEqualsWithoutLE($expected, $out);
    }

    public function testClientOptions()
    {
        Popover::$counter = 0;
        Popover::widget([
            'headerOptions' => ['class' => ['test-header']],
            'placement' => Popover::PLACEMENT_BOTTOM,
            'title' => 'Test Popover'
        ]);

        $js = Yii::$app->view->js[View::POS_READY];

        $this->assertInternalType(IsType::TYPE_ARRAY, $js);
        $options = array_shift($js);

        $this->assertContainsWithoutLE("jQuery('#w0').popover({", $options);
        $this->assertContainsWithoutLE("id=\u0022w0-popover\u0022", $options);
        $this->assertContainsWithoutLE("class=\u0022test-header popover-header\u0022", $options);
        $this->assertContainsWithoutLE('"placement":"bottom"', $options);
        $this->assertContainsWithoutLE('"title":"Test Popover"', $options);
    }

    public function testContent()
    {
        Popover::$counter = 0;
        Popover::begin([]);
        echo Html::tag('span', 'Test content', ['class' => ['test-content']]);
        Popover::end();

        $js = Yii::$app->view->js[View::POS_READY];

        $this->assertInternalType(IsType::TYPE_ARRAY, $js);
        $options = array_shift($js);

        $this->assertContainsWithoutLE('"content":"\u003Cspan class=\u0022test-content\u0022\u003ETest content\u003C\/span\u003E"', $options);
    }
}

<?php

namespace yiiunit\extensions\bootstrap5;

use yii\base\Model;
use yii\bootstrap5\Html;
use yii\bootstrap5\ToggleButtonGroup;

/**
 * @group bootstrap5
 */
class ToggleButtonGroupTest extends TestCase
{
    public function testCheckbox()
    {
        Html::$counter = 0;
        $html = ToggleButtonGroup::widget([
            'type' => ToggleButtonGroup::TYPE_CHECKBOX,
            'model' => new ToggleButtonGroupTestModel(),
            'attribute' => 'value',
            'items' => [
                '1' => 'item 1',
                '2' => 'item 2',
            ],
        ]);

        $expectedHtml = <<<HTML
<input type="hidden" name="ToggleButtonGroupTestModel[value]" value=""><div id="togglebuttongrouptestmodel-value" class="btn-group" role="group"><input type="checkbox" id="i0" class="btn-check" name="ToggleButtonGroupTestModel[value][]" value="1" autocomplete="off">
<label class="btn btn-outline-secondary" for="i0">item 1</label>
<input type="checkbox" id="i1" class="btn-check" name="ToggleButtonGroupTestModel[value][]" value="2" autocomplete="off">
<label class="btn btn-outline-secondary" for="i1">item 2</label></div>
HTML;
        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    /**
     */
    public function testCheckboxChecked()
    {
        Html::$counter = 0;
        $html = ToggleButtonGroup::widget([
            'type' => ToggleButtonGroup::TYPE_CHECKBOX,
            'model' => new ToggleButtonGroupTestModel(['value' => '2']),
            'attribute' => 'value',
            'items' => [
                '1' => 'item 1',
                '2' => 'item 2',
            ],
        ]);

        $this->assertContains('<input type="checkbox" id="i1" class="btn-check" name="ToggleButtonGroupTestModel[value][]" value="2" checked autocomplete="off">', $html);
    }

    public function testRadio()
    {
        Html::$counter = 0;
        $html = ToggleButtonGroup::widget([
            'type' => ToggleButtonGroup::TYPE_RADIO,
            'model' => new ToggleButtonGroupTestModel(),
            'attribute' => 'value',
            'items' => [
                '1' => 'item 1',
                '2' => 'item 2',
            ],
        ]);

        $expectedHtml = <<<HTML
<input type="hidden" name="ToggleButtonGroupTestModel[value]" value=""><div id="togglebuttongrouptestmodel-value" class="btn-group" role="group"><input type="radio" id="i0" class="btn-check" name="ToggleButtonGroupTestModel[value]" value="1" autocomplete="off">
<label class="btn btn-outline-secondary" for="i0">item 1</label>
<input type="radio" id="i1" class="btn-check" name="ToggleButtonGroupTestModel[value]" value="2" autocomplete="off">
<label class="btn btn-outline-secondary" for="i1">item 2</label></div>
HTML;
        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    /**
     */
    public function testRadioChecked()
    {
        Html::$counter = 0;
        $html = ToggleButtonGroup::widget([
            'type' => ToggleButtonGroup::TYPE_RADIO,
            'model' => new ToggleButtonGroupTestModel(['value' => '2']),
            'attribute' => 'value',
            'items' => [
                '1' => 'item 1',
                '2' => 'item 2',
            ],
        ]);

        $this->assertContains('<input type="radio" id="i1" class="btn-check" name="ToggleButtonGroupTestModel[value]" value="2" checked autocomplete="off">', $html);
    }
}

class ToggleButtonGroupTestModel extends Model
{
    public $value;
}

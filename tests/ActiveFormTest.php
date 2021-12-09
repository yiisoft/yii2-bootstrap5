<?php

namespace yiiunit\extensions\bootstrap5;

use yii\base\DynamicModel;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yiiunit\extensions\bootstrap5\data\User;

/**
 * Tests for ActiveForm widget
 *
 * @group bootstrap5
 */
class ActiveFormTest extends TestCase
{

    public function testDefaultLayout()
    {
        ActiveForm::$counter = 0;
        ob_start();
        $model = new DynamicModel(['attributeName', 'radios']);
        $form = ActiveForm::begin([
            'action' => '/some-action',
            'layout' => ActiveForm::LAYOUT_DEFAULT
        ]);
        echo $form->field($model, 'attributeName');
        ActiveForm::end();
        $out = ob_get_clean();

        $expected = <<<HTML
<div class="mb-3 field-dynamicmodel-attributename">
<label class="form-label" for="dynamicmodel-attributename">Attribute Name</label>
<input type="text" id="dynamicmodel-attributename" class="form-control" name="DynamicModel[attributeName]">

<div class="invalid-feedback"></div>
</div>
HTML;


        $this->assertContainsWithoutLE($expected, $out);
    }

    public function testHorizontalLayout()
    {
        Html::$counter = 0;
        ActiveForm::$counter = 0;
        ob_start();
        $model = new DynamicModel(['attributeName', 'checkbox', 'gridRadios']);
        $form = ActiveForm::begin([
            'action' => '/some-action',
            'layout' => ActiveForm::LAYOUT_HORIZONTAL
        ]);
        echo $form->field($model, 'attributeName');
        echo $form->field($model, 'checkbox')->checkbox();
        echo $form->field($model, 'gridRadios')->radioList([
            'option1' => 'First radio',
            'option2' => 'Second radio',
            'option3' => 'Third radio'
        ]);
        ActiveForm::end();
        $out = ob_get_clean();

        $expected = <<<HTML
<div class="mb-3 row field-dynamicmodel-attributename">
<label class="col-sm-2 col-form-label" for="dynamicmodel-attributename">Attribute Name</label>
<div class="col-sm-10">
<input type="text" id="dynamicmodel-attributename" class="form-control" name="DynamicModel[attributeName]">
<div class="invalid-feedback "></div>

</div>
</div>
HTML;
        $expected2 = <<<HTML
<div class="mb-3 row field-dynamicmodel-checkbox">
<div class="col-sm-10 offset-sm-2">
<div class="form-check">
<input type="hidden" name="DynamicModel[checkbox]" value="0"><input type="checkbox" id="dynamicmodel-checkbox" class="form-check-input" name="DynamicModel[checkbox]" value="1">
<label class="form-check-label" for="dynamicmodel-checkbox">Checkbox</label>
<div class="invalid-feedback "></div>

</div>
</div>
</div>
HTML;
        $expected3 = <<<HTML
<div class="mb-3 row field-dynamicmodel-gridradios">
<label class="col-sm-2 col-form-label">Grid Radios</label>
<div class="col-sm-10">
<input type="hidden" name="DynamicModel[gridRadios]" value=""><div id="dynamicmodel-gridradios" role="radiogroup"><div class="form-check">
<input type="radio" id="i0" class="form-check-input" name="DynamicModel[gridRadios]" value="option1">
<label class="form-check-label" for="i0">First radio</label>
</div>

<div class="form-check">
<input type="radio" id="i1" class="form-check-input" name="DynamicModel[gridRadios]" value="option2">
<label class="form-check-label" for="i1">Second radio</label>
</div>

<div class="form-check">
<input type="radio" id="i2" class="form-check-input" name="DynamicModel[gridRadios]" value="option3">
<label class="form-check-label" for="i2">Third radio</label>
<div class="invalid-feedback "></div>
</div>
</div>

</div>
</div>
HTML;


        $this->assertContainsWithoutLE($expected, $out);
        $this->assertContainsWithoutLE($expected2, $out);
        $this->assertContainsWithoutLE($expected3, $out);
    }

    /**
     */
    public function testHorizontalLayoutTemplateOverride()
    {
        ActiveForm::$counter = 0;
        ob_start();
        $model = new DynamicModel(['checkboxName']);
        $form = ActiveForm::begin([
            'action' => '/some-action',
            'layout' => ActiveForm::LAYOUT_HORIZONTAL
        ]);
        echo $form->field($model, 'checkboxName')->checkbox(['template' => "<div class=\"form-check offset-lg-1 col-lg-3\">\n{input}\n{label}\n</div>\n<div class=\"col-lg-8\">{error}</div>"]);
        ActiveForm::end();
        $out = ob_get_clean();

        $expected = <<<HTML
<div class="form-check offset-lg-1 col-lg-3">
<input type="hidden" name="DynamicModel[checkboxName]" value="0"><input type="checkbox" id="dynamicmodel-checkboxname" class="form-check-input" name="DynamicModel[checkboxName]" value="1">
<label class="form-check-label" for="dynamicmodel-checkboxname">Checkbox Name</label>
</div>
<div class="col-lg-8"><div class="invalid-feedback "></div></div>
HTML;


        $this->assertContainsWithoutLE($expected, $out);
    }

    public function testInlineLayout()
    {
        ActiveForm::$counter = 0;
        ob_start();
        $model = new DynamicModel(['attributeName', 'selectName', 'checkboxName']);
        $form = ActiveForm::begin([
            'action' => '/some-action',
            'layout' => ActiveForm::LAYOUT_INLINE
        ]);
        echo $form->field($model, 'attributeName');
        echo $form->field($model, 'selectName')->listBox([
            '1' => 'One',
            '2' => 'Two',
            '3' => 'Three'
        ]);
        echo $form->field($model, 'checkboxName')->checkbox();
        ActiveForm::end();
        $out = ob_get_clean();

        $expected = <<<HTML
<div class="mb-3 field-dynamicmodel-attributename">
<label class="form-label visually-hidden" for="dynamicmodel-attributename">Attribute Name</label>
<input type="text" id="dynamicmodel-attributename" class="form-control" name="DynamicModel[attributeName]" placeholder="Attribute Name">


</div>
HTML;
        $expected2 = <<<HTML
<div class="mb-3 field-dynamicmodel-selectname">
<label class="form-label" for="dynamicmodel-selectname">Select Name</label>
<input type="hidden" name="DynamicModel[selectName]" value=""><select id="dynamicmodel-selectname" class="form-select" name="DynamicModel[selectName]" size="4" placeholder>
<option value="1">One</option>
<option value="2">Two</option>
<option value="3">Three</option>
</select>


</div>
HTML;
        $expected3 = <<<HTML
<div class="mb-3 field-dynamicmodel-checkboxname">
<div class="form-check">
<input type="hidden" name="DynamicModel[checkboxName]" value="0"><input type="checkbox" id="dynamicmodel-checkboxname" class="form-check-input" name="DynamicModel[checkboxName]" value="1">
<label class="visually-hidden form-check-label" for="dynamicmodel-checkboxname">Checkbox Name</label>


</div>
</div>
HTML;


        $this->assertContainsWithoutLE('<form id="w0" class="form-inline"', $out);
        $this->assertContainsWithoutLE($expected, $out);
        $this->assertContainsWithoutLE($expected2, $out);
        $this->assertContainsWithoutLE($expected3, $out);
    }

    public function testFloatingLayout()
    {
        ActiveForm::$counter = 0;
        ob_start();
        $model = new DynamicModel(['attributeName', 'selectName', 'checkboxName']);
        $form = ActiveForm::begin([
            'action' => '/some-action',
            'layout' => ActiveForm::LAYOUT_FLOATING
        ]);
        echo $form->field($model, 'attributeName');
        echo $form->field($model, 'selectName')->listBox([
            '1' => 'One',
            '2' => 'Two',
            '3' => 'Three'
        ]);
        echo $form->field($model, 'checkboxName')->checkbox();
        ActiveForm::end();
        $out = ob_get_clean();

        $expected = <<<HTML
<div class="form-floating mt-3 field-dynamicmodel-attributename">
<input type="text" id="dynamicmodel-attributename" class="form-control" name="DynamicModel[attributeName]" placeholder="Attribute Name">
<label class="form-label" for="dynamicmodel-attributename">Attribute Name</label>
<div class="invalid-feedback"></div>

</div>
HTML;
        $expected2 = <<<HTML
<div class="form-floating mt-3 field-dynamicmodel-selectname">
<input type="hidden" name="DynamicModel[selectName]" value=""><select id="dynamicmodel-selectname" class="form-select" name="DynamicModel[selectName]" size="4" placeholder>
<option value="1">One</option>
<option value="2">Two</option>
<option value="3">Three</option>
</select>
<label class="form-label" for="dynamicmodel-selectname">Select Name</label>
<div class="invalid-feedback"></div>

</div>
HTML;
        $expected3 = <<<HTML
<div class="form-floating mt-3 field-dynamicmodel-checkboxname">
<div class="form-check">
<input type="hidden" name="DynamicModel[checkboxName]" value="0"><input type="checkbox" id="dynamicmodel-checkboxname" class="form-check-input" name="DynamicModel[checkboxName]" value="1">
<label class="form-check-label" for="dynamicmodel-checkboxname">Checkbox Name</label>
<div class="invalid-feedback"></div>

</div>
</div>
HTML;


        $this->assertContainsWithoutLE('<form id="w0"', $out);
        $this->assertContainsWithoutLE($expected, $out);
        $this->assertContainsWithoutLE($expected2, $out);
        $this->assertContainsWithoutLE($expected3, $out);
    }

    public function testHintRendering()
    {
        ActiveForm::$counter = 0;
        ob_start();
        $model = new User();
        $form = ActiveForm::begin([
            'action' => '/some-action',
            'layout' => ActiveForm::LAYOUT_DEFAULT
        ]);
        echo $form->field($model, 'firstName');
        echo $form->field($model, 'lastName');
        echo $form->field($model, 'username');
        echo $form->field($model, 'password')->passwordInput();
        ActiveForm::end();
        $out = ob_get_clean();

        $expected = <<<HTML
<div class="mb-3 field-user-firstname">
<label class="form-label" for="user-firstname">First Name</label>
<input type="text" id="user-firstname" class="form-control" name="User[firstName]">

<div class="invalid-feedback"></div>
</div>
HTML;
        $expected2 = <<<HTML
<div class="mb-3 field-user-lastname">
<label class="form-label" for="user-lastname">Last Name</label>
<input type="text" id="user-lastname" class="form-control" name="User[lastName]">

<div class="invalid-feedback"></div>
</div>
HTML;
        $expected3 = <<<HTML
<div class="mb-3 field-user-username required">
<label class="form-label" for="user-username">Username</label>
<input type="text" id="user-username" class="form-control" name="User[username]" aria-required="true">
<div class="form-text text-muted">Your username must be at least 4 characters long</div>
<div class="invalid-feedback"></div>
</div>
HTML;
        $expected4 = <<<HTML
<div class="mb-3 field-user-password required">
<label class="form-label" for="user-password">Password</label>
<input type="password" id="user-password" class="form-control" name="User[password]" aria-required="true">
<div class="form-text text-muted">Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.</div>
<div class="invalid-feedback"></div>
</div>
HTML;

        $this->assertContainsWithoutLE($expected, $out);
        $this->assertContainsWithoutLE($expected2, $out);
        $this->assertContainsWithoutLE($expected3, $out);
        $this->assertContainsWithoutLE($expected4, $out);
    }

    public function testStaticControlRendering()
    {
        ActiveForm::$counter = 0;
        ob_start();
        $model = new User();
        $model->setAttributes([
            'id' => 1,
            'firstName' => 'John',
            'lastName' => 'Doe'
        ]);
        $form = ActiveForm::begin([
            'action' => '/some-action',
            'layout' => ActiveForm::LAYOUT_DEFAULT
        ]);
        echo $form->field($model, 'id')->staticControl();
        echo $form->field($model, 'firstName')->staticControl();
        echo $form->field($model, 'lastName')->staticControl();
        echo $form->field($model, 'username')->staticControl();
        ActiveForm::end();
        $out = ob_get_clean();

        $expected = <<<HTML
<div class="mb-3 field-user-id">
<label class="form-label" for="user-id">Id</label>
<input type="text" class="form-control-plaintext" value="1" readonly>

<div class="invalid-feedback"></div>
</div>
HTML;

        $expected2 = <<<HTML
<div class="mb-3 field-user-firstname">
<label class="form-label" for="user-firstname">First Name</label>
<input type="text" class="form-control-plaintext" value="John" readonly>

<div class="invalid-feedback"></div>
</div>
HTML;
        $expected3 = <<<HTML
<div class="mb-3 field-user-lastname">
<label class="form-label" for="user-lastname">Last Name</label>
<input type="text" class="form-control-plaintext" value="Doe" readonly>

<div class="invalid-feedback"></div>
</div>
HTML;

        $this->assertContainsWithoutLE($expected, $out);
        $this->assertContainsWithoutLE($expected2, $out);
        $this->assertContainsWithoutLE($expected3, $out);
    }

    /**
     * Fixes #128
     * @see https://github.com/yiisoft/yii2-bootstrap5/issues/128
     */
    public function testInputTemplate()
    {
        $model = new User();
        $model->validate();

        ActiveForm::$counter = 0;
        ob_start();
        $form = ActiveForm::begin();
        echo $form->field($model, 'username', ['inputTemplate' => '{input}']);
        ActiveForm::end();
        $out = ob_get_clean();

        $expected = <<<HTML
<div class="mb-3 field-user-username required">
<label class="form-label" for="user-username">Username</label>
<input type="text" id="user-username" class="form-control is-invalid" name="User[username]" aria-required="true" aria-invalid="true">
<div class="form-text text-muted">Your username must be at least 4 characters long</div>
<div class="invalid-feedback">Username cannot be blank.</div>
</div>
HTML;

        $this->assertContainsWithoutLE($expected, $out);
    }

    /**
     * Fixes #196
     */
    public function testFormNoRoleAttribute()
    {
        $form = ActiveForm::widget();

        $this->assertNotContains('role="form"', $form);
    }

    public function testErrorSummaryRendering()
    {
        ActiveForm::$counter = 0;
        ob_start();
        $model = new User();
        $model->validate();
        $form = ActiveForm::begin([
            'action' => '/some-action',
            'layout' => ActiveForm::LAYOUT_DEFAULT
        ]);
        echo $form->errorSummary($model);
        ActiveForm::end();
        $out = ob_get_clean();


        $this->assertContainsWithoutLE('<div class="alert alert-danger"', $out);
    }

    protected function setUp()
    {
        // dirty way to have Request object not throwing exception when running testFormNoRoleAttribute()
        $_SERVER['REQUEST_URI'] = "index.php";

        parent::setUp();

    }
}

Yii widgets
===========

Most complex bootstrap components are wrapped into Yii widgets to allow more robust syntax and integrate with
framework features. All widgets belong to `\yii\bootstrap5` namespace:

- [[yii\bootstrap5\Accordion|Accordion]]
- [[yii\bootstrap5\ActiveField|ActiveField]]
- [[yii\bootstrap5\ActiveForm|ActiveForm]]
- [[yii\bootstrap5\Alert|Alert]]
- [[yii\bootstrap5\Breadcrumbs|Breadcrumbs]]
- [[yii\bootstrap5\Button|Button]]
- [[yii\bootstrap5\ButtonDropdown|ButtonDropdown]]
- [[yii\bootstrap5\ButtonGroup|ButtonGroup]]
- [[yii\bootstrap5\ButtonToolbar|ButtonToolbar]]
- [[yii\bootstrap5\Carousel|Carousel]]
- [[yii\bootstrap5\Dropdown|Dropdown]]
- [[yii\bootstrap5\LinkPager|LinkPager]]
- [[yii\bootstrap5\Modal|Modal]]
- [[yii\bootstrap5\Nav|Nav]]
- [[yii\bootstrap5\NavBar|NavBar]]
- [[yii\bootstrap5\Offcanvas|Offcanvas]]
- [[yii\bootstrap5\Popover|Popover]]
- [[yii\bootstrap5\Progress|Progress]]
- [[yii\bootstrap5\Tabs|Tabs]]
- [[yii\bootstrap5\Toast|Toast]]
- [[yii\bootstrap5\ToggleButtonGroup|ToggleButtonGroup]]

## ActiveField: additional fields <span id="additional-fields"></span>

- [Range](https://getbootstrap.com/docs/5.1/forms/range/): `$form->rangeInput(['min' => 0, 'max' => 100, 'step' => 1])`
- [Color picker](https://getbootstrap.com/docs/5.1/forms/form-control/#color): `$form->colorInput()`
- [Switch](https://getbootstrap.com/docs/5.1/forms/checks-radios/#switches): `$form->checkbox(['switch' => true])`

## Customizing widget CSS classes <span id="customizing-css-classes"></span>

The widgets allow quick composition of the HTML for the bootstrap components that require the bootstrap CSS classes.
The default classes for a particular component will be added automatically by the widget, and the optional classes that you may want to customize are usually supported through the properties of the widget.

For example, you may use [[yii\bootstrap5\Button::options]] to customize the appearance of a button.
The class 'btn' which is required for a button will be added automatically, so you don't need to worry about it.
All you need is specify a particular button class:

```php
echo Button::widget([
    'label' => 'Action',
    'options' => ['class' => 'btn-primary'], // produces class "btn btn-primary"
]);
```

However, sometimes you may need to replace the default classes with the alternative ones.
For example, the widget [[yii\bootstrap5\ButtonGroup]] uses 'btn-group' class for the container div by default,
but you may need to use 'btn-group-vertical' instead to align the buttons vertically.
Using a plain 'class' option simply adds 'btn-group-vertical' to 'btn-group', which will produce an incorrect result.
In order to override the default classes of a widget, you need to specify the 'class' option as an array that contains the customized class definition under the 'widget' key:

```php
echo ButtonGroup::widget([
    'options' => [
        'class' => ['widget' => 'btn-group-vertical'] // replaces 'btn-group' with 'btn-group-vertical'
    ],
    'buttons' => [
        ['label' => 'A'],
        ['label' => 'B'],
    ]
]);
```

## Navbar widget <span id="navbar-widget"></span>

The navbar widget has its peculiarities. You should define at which breakpoint the navbar collapses and the generic
style of navbar (color scheme).

You can change the color scheme and the collapse breakpoint with css classes. If not defined, the scheme defaults to 
`navbar-light bg-light` and the breakpoint to `navbar-expand-lg`. For more information, see [Bootstrap documentation](https://getbootstrap.com/docs/5.1/components/navbar/):

```php
Navbar::begin([
    'options' => [
        'class' => ['navbar-dark', 'bg-dark', 'navbar-expand-md']
    ]
]);
    [...]
Navbar::end();
``` 

If you'd like to flip the brand (icon) and toggle button positions in mobile navigation, you can do this like this:

```php
Navbar::begin([
	'brandOptions' => [
		'class' => ['order-1']
	],
	'togglerOptions' => [
		'class' => ['order-0']
	]
]);
    [...]
Navbar::end();
```

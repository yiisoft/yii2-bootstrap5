Виджеты Yii
===========

Большинство сложных Bootstrap компонентов обернуты в виджеты Yii, чтобы обеспечить более надежный синтаксис и интеграцию с особенностями фреймворка. Все виджеты относятся к пространству имен `\yii\bootstrap5`:

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

## ActiveField: дополнительные поля <span id="additional-fields"></span>

- [Диапазон](https://getbootstrap.com/docs/5.1/forms/range/): `$form->rangeInput(['min' => 0, 'max' => 100, 'step' => 1])`
- [Выбор цвета](https://getbootstrap.com/docs/5.1/forms/form-control/#color): `$form->colorInput()`
- [Переключатель](https://getbootstrap.com/docs/5.1/forms/checks-radios/#switches): `$form->checkbox(['switch' => true])`

## Настройка CSS классов виджетов <span id="customizing-css-classes"></span>

Виджеты позволяют быстро создавать HTML Bootstrap компоненты, которые требуют CSS классы Bootstrap. Классы по умолчанию, для конкретного компонента, будут добавлены автоматически виджетом, и необязательные классы, которые вы можете настроить, как правило, поддерживаются через свойства виджета.

Например, вы можете использовать [[yii\bootstrap5\Button::options]] чтобы настроить внешний вид кнопки. Класс `btn`, который требуется для кнопки, будет добавлен автоматически. Все, что вам нужно, это указать конкретный класс кнопки:

```php
echo Button::widget([
    'label' => 'Action',
    'options' => ['class' => 'btn-primary'], // устанавливает класс "btn btn-primary"
]);
```

Тем не менее, иногда вам может понадобиться заменить классы по умолчанию альтернативными. Например, виджет [[yii\bootstrap5\ButtonGroup]] использует класс `btn-group` для контейнера `div` по умолчанию, но вам, возможно, придётся использовать `btn-group-vertical` чтобы выровнять кнопки по вертикали. Добавление `btn-group-vertical` в параметр `class` приведет к неправильному результату. Для того, чтобы переопределить классы виджета по умолчанию, необходимо указать параметр `class` как массив, содержащий определение класса, настроенное в ключе `widget`:

```php
echo ButtonGroup::widget([
    'options' => [
        'class' => ['widget' => 'btn-group-vertical'] // заменяет класс 'btn-group' на 'btn-group-vertical'
    ],
    'buttons' => [
        ['label' => 'A'],
        ['label' => 'B'],
    ]
]);
```

## Виджет навигационной панели <span id="navbar-widget"></span>

Виджет навигационной панели имеет свои особенности. Вы должны задать точку останова (разрешение при котором панель отображается в свернутом виде)
и основной стиль отображения (цветовая схема) для панели.

Вы можете изменить цветовую схему и точку останова с помощью CSS классов. По умолчанию, используется цветовая схема 
`navbar-light bg-light` и точка останова `navbar-expand-lg`. Для получения доп. информации, смотрите [документацию Bootstrap](https://getbootstrap.com/docs/5.1/components/navbar/):

```php
Navbar::begin([
    'options' => [
        'class' => ['navbar-dark', 'bg-dark', 'navbar-expand-md']
    ]
]);
    [...]
Navbar::end();
``` 

Если Вы хотите повернуть бренд (значок) и переключить положение кнопок в мобильной навигации, то можете сделать это следующим образом:

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

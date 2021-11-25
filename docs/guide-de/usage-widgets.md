Yii widgets
===========

Die komplexesten Bootstrap Komponenten sind umgesetzt mittels Yii-Widget zur vereinfachten Verwendung und Integration 
von Framework-Funktionen. Alle Widgets gehören zum `\yii\bootstrap5` Namespace:

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
- [[yii\bootstrap5\Modal|Modal]]
- [[yii\bootstrap5\Nav|Nav]]
- [[yii\bootstrap5\NavBar|NavBar]]
- [[yii\bootstrap5\Offcanvas|Offcanvas]]
- [[yii\bootstrap5\Progress|Progress]]
- [[yii\bootstrap5\Tabs|Tabs]]
- [[yii\bootstrap5\ToggleButtonGroup|ToggleButtonGroup]]

## ActiveField: Weitere Input-Typen <span id="additional-fields"></span>

- [Range](https://getbootstrap.com/docs/5.1/forms/range/): `$form->rangeInput(['min' => 0, 'max' => 100, 'step' => 1])`
- [Color picker](https://getbootstrap.com/docs/5.1/forms/form-control/#color): `$form->colorInput()`
- [Switch](https://getbootstrap.com/docs/5.1/forms/checks-radios/#switches): `$form->checkbox(['switch' => true])`

## Anpassen der Widget CSS-Klassen <span id="customizing-css-classes"></span>

Die Widgets erlauben die schnelle Erstellung von HTML-Markup der Bootstrap Komponenten.
Die Standard-CSS-Klassen einer bestimmten Komponente wird automatisch vom Widget hinzugefügt. Alle weiteren (optionalen)
Klassen können Sie mittels der Attribute des Widgets anpassen.

Verwenden Sie z.B. [[yii\bootstrap5\Button::options]] zur Anpassung des Aussehens des Buttons. Die Klasse `btn`, welche
benötigt vom Button Widget benötigt wird, wird automatisch hinzugefügt. Sie müssen lediglich die besondere Button-Klasse
hinzufügen:

```php
echo Button::widget([
    'label' => 'Action',
    'options' => ['class' => 'btn-primary'], // produces class "btn btn-primary"
]);
```

Manchmal möchte man aber die Standard-Klasse ersetzen.
Das [[yii\bootstrap5\ButtonGroup]]-Widget beispielsweise verwendet standardmässig die 'btn-group' Klasse für den Container,
es müsste aber 'btn-group-vertical' erhalten zur vertikalen Ausrichtung.
Würden Sie wie oben nur die 'class'-Option verwenden, würde die 'btn-group-vertical'-Klasse zur 'btn-group'-Klasse hinzugefügt.
Zum Überschreiben der Standard-Klassen eines Widgets, müssen Sie die 'class'-Option unter dem Array-Schlüssel 'widget' angeben:

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

Das Navbar Widget hat so seine Eigenheiten. Bei der Verwendung des Widgets sollten Sie darauf achten, dass der Breakpoint,
ab welchem die Navigation zugeklappt wird (Mobile Navigation) sowie das Farbschema definiert sind.

Diese Definition geschieht über CSS Klassen. Die Standartwerte lauten `navbar-light bg-light` fürs Farbschema und
`navbar-expand-lg` für den brakpoint. Für weitere Informationen, konsultieren Sie die [Bootstrap Dokumentation](https://getbootstrap.com/docs/5.1/components/navbar/):
```php
Navbar::begin([
    'options' => [
        'class' => ['navbar-dark', 'bg-dark', 'navbar-expand-md']
    ]
]);
    [...]
Navbar::end();
``` 

Falls Sie die Reihenfolge des Logos und des "Toggle Buttons" ändern möchten, können Sie dies wie folgt tun:
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

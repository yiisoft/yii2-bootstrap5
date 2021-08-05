Migration von yii2-bootstrap4
=============================

yii2-bootstrap4 ist eine komplette Überarbeitung des Projekts (siehe den Bootstrap 4 von Bootstrap 3 Migrationsguide).
Die grössten Änderungen finden Sie hier zusammengefasst:

## Allgemein

* Der Namespace ist nun `yii\bootstrap5` anstatt `yii\bootstrap4`
* Die PHP Kompatibilität **ist beschränkt auf** `>=7.0`

## Widgets / Klassen

### BaseHtml

### ActiveField

### ActiveForm

Es gibt eine neue Konstante [[yii\bootstrap5\ActiveForm::LAYOUT_FLOATING]]. Sie repräsentiert ein
[neues Formular-Layout](https://getbootstrap.com/docs/5.1/forms/floating-labels/) in Bootstrap 5.

### Breadcrumbs

### ButtonDropdown

### ButtonToolbar

### Carousel

### LinkPager

### Modal

### Nav

### NavBar

Es gibt nun die Möglichkeit der Erstellung einer [Offcanvas Navbar](https://getbootstrap.com/docs/5.1/components/navbar/#offcanvas).
Dies ist zu erreichen indem man die Eigentschaft `$collapseOptions` des Widgets [[yii\bootstrap5\NavBar|Navbar]] auf `false`
und die Eigenschaft `$offcanvasOptions` auf ein array setzt (auch wenn leer).

### Tabs

### ToggleButtonGroup

Migrating from yii2-bootstrap4
==============================

yii2-bootstrap5 is a major rewrite of the entire project (according Bootstrap 5 to Bootstrap 4 migration guide).
The most notable changes are summarized below:

## General

* The namespace is `yii\bootstrap5` instead of `yii\bootstrap4`
* The php compatibility **is limited to** `>=7.0`
* The close buttons of widgets like [[yii\bootstrap5\Alert|Alert]] or [[yii\bootstrap5|Modal|Modal]] now gets rendered
  via CSS and does not have any content anymore. So be sure to remove `btn-close` class and set appropriate styles yourself
  if you override it.

## Widgets / Classes

### BaseHtml

### ActiveField

### ActiveForm

There is a new constant [[yii\bootstrap5\ActiveForm::LAYOUT_FLOATING]]. It's a 
[new form layout](https://getbootstrap.com/docs/5.1/forms/floating-labels/) introduced in Bootstrap 5.

### Breadcrumbs

### ButtonDropdown

### ButtonToolbar

### Carousel

### LinkPager

### Modal

Change `data-target` and `data-toggle` to `data-bs-target` and `data-bs-toggle`

### Nav

### NavBar

There is now the possibility to create an [offcanvas navbar](https://getbootstrap.com/docs/5.1/components/navbar/#offcanvas).
You can achieve this by setting the `$collapseOptions` to `false` in [[yii\bootstrap5\NavBar|Navbar]] widget and the 
`$offcanvasOptions` to at least an empty array.

### Tabs

### ToggleButtonGroup

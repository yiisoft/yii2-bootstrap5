Миграция с yii2-bootstrap4
==============================

yii2-bootstrap5 является серьезной переработкой всего проекта (в соответствии с руководством по миграции с Bootstrap4 на Bootstrap5).
Наиболее заметные изменения кратко изложены ниже:

## General

* Изменение namespace с `yii\bootstrap4` на `yii\bootstrap5`
* Минимальная совместимая версия php **ограничена** `>=7.0`
* Кнопки закрытия виджетов, таких как [[yii\bootstrap5\Alert|Alert]] или [[yii\bootstrap5\Modal|Modal]], теперь отображаются
с помощью CSS и больше не содержат содержимого. Поэтому обязательно удалите класс "btn-close" и самостоятельно установите соответствующие стили, если вы его переопределяли.


## Widgets / Classes

### BaseHtml

### ActiveField

### ActiveForm

Новая константа [[yii\bootstrap5\ActiveForm::LAYOUT_FLOATING]]. Это
[new form layout](https://getbootstrap.com/docs/5.1/forms/floating-labels/) введен в Bootstrap 5.

### Breadcrumbs

### ButtonDropdown

### ButtonToolbar

### Carousel

### LinkPager

### Modal

Заменить `data-target` и `data-toggle` на `data-bs-target` и `data-bs-toggle`

### Nav

### NavBar

Теперь есть возможность создать [offcanvas navbar](https://getbootstrap.com/docs/5.1/components/navbar/#offcanvas).
Вы можете добиться этого, установив для параметра `$collapseOptions` значение `false` в виджете [[yii\bootstrap5\NavBar|Navbar]] и
`$offcanvasOptions`, значение пустого массива.

### Tabs

### ToggleButtonGroup

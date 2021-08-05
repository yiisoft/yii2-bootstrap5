Html helper
===========

Bootstrap introduce muchas construcciones y esqueletos consistentes de HTML, que permiten crear diferentes efectos visuales.
Unicamente lo más complejo está cubierto por los widgets proporcionados en esta extensión. El resto debería ser
compuesto manualmente usando HTML directamente.
Sin embargo, algunas marcas especiales de Bootstrap son cubiertas por el helper [[\yii\bootstrap5\Html]].
[[\yii\bootstrap5\Html]] es una versión mejorada de la regular [[\yii\helpers\Html]] dedicada a las necesidades de Bootstrap.
Proporciona varios métodos útiles:

 - `staticControl()` - permite renderizar formularios "[static controls](https://getbootstrap.com/docs/5.1/forms/form-control/#readonly-plain-text)"

[[\yii\bootstrap5\Html]] hereda todas las funcionalidades disponibles en [[\yii\helpers\Html]] y puede usarse como sustituto,
así que no es necesario incluir ambos dentro de los archivos de tus vistas.
Por ejemplo:

```php
<?php
use yii\bootstrap5\Html;
?>
<?= Button::widget([
    'label' => Html::encode('Save & apply'),
    'encodeLabel' => false,
    'options' => ['class' => 'btn-primary'],
]); ?>
```

> Atención: no confundas [[\yii\bootstrap5\Html]] con [[\yii\helpers\Html]], ten cuidado que clases estás usando dentro de tus vistas.

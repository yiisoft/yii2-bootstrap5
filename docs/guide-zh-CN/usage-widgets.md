Yii 小部件
===========

大多数复杂的 bootstrap 组件被包装到 Yii 小部件中，以允许更强大的语法并与框架特性集成。 所有小部件都在命名空间 `\yii\bootstrap5` 下：

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

## 自定义小部件CSS类 <span id="customizing-css-classes"></span>

这些小部件可以快速构建基于 bootstrap CSS 样式的 bootstrap 组件，并直接生成 HTML 代码。
特定组件的默认样式是自动添加的，也可以通过修改部件属性添加自定义样式类。

例如, 使用 [[yii\bootstrap5\Button::options]] 创建按钮。
按钮中的 `btn` 样式将会被自动添加。只要再添加自己所需的按钮样式即可：

```php
echo Button::widget([
    'label' => 'Action',
    'options' => ['class' => 'btn-primary'], // produces class "btn btn-primary"
]);
```

但是，有的时候需要将默认样式替换为自定义样式。
例如, 小部件 [[yii\bootstrap5\ButtonGroup]] 默认使用 'btn-group' 类作为 div 容器的默认样式，但是我们希望使用 'btn-group-vertical' 作为默认样式以实现按钮组的垂直居中。
直接在 'class' 选项中添加 'btn-group-vertical' 是替换不了 'btn-group' 的。
为了重载组件的默认样式，需要在 'class' 选项中的 'widget' 选项中定义即可:

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

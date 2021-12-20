Asset Bundles
=============

Bootstrap - это комплексное front-end решение, включающее CSS, JavaScript, шрифты и т.д. Для того чтобы обеспечить гибкий контроль над компонентами Bootstrap, расширение предоставляет несколько Asset Bundles. Вот они:

- [[yii\bootstrap5\BootstrapAsset|BootstrapAsset]] - содержит CSS файлы.
- [[yii\bootstrap5\BootstrapPluginAsset|BootstrapPluginAsset]] - зависит от [[yii\bootstrap5\BootstrapAsset]], содержащий javascript файлы.
- [[yii\bootstrap5\BootstrapIconAsset|BootstrapIconAsset]] - содержит иконки.

Конкретные приложения могут потребовать различного использования. Если вам нужны только CSS-стили, то пакета [[yii\bootstrap5\BootstrapAsset]] будет достаточно. Тем не менее, если вы хотите использовать Bootstrap JavaScript, вам необходимо зарегистрировать [[yii\bootstrap5\BootstrapPluginAsset]], если вы хотите использовать Bootstrap Icons, вам необходимо зарегистрировать [[yii\bootstrap5\BootstrapIconAsset|BootstrapIconAsset]].

> Tip: большинство виджетов регистрируются с помощью [[yii\bootstrap5\BootstrapPluginAsset]] автоматически.

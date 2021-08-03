Asset Bundles
=============

Bootstrap is a complex front-end solution, which includes CSS, JavaScript, fonts and so on.
In order to allow you the most flexible control over Bootstrap components, this extension provides several asset bundles.
They are:

- [[yii\bootstrap5\BootstrapAsset|BootstrapAsset]] - contains only the main CSS files.
- [[yii\bootstrap5\BootstrapPluginAsset|BootstrapPluginAsset]] - depends on [[yii\bootstrap5\BootstrapAsset]], contains the javascript files.

Particular application needs may require different bundle (or bundle combination) usage.
If you only need CSS styles, [[yii\bootstrap5\BootstrapAsset]] will be enough for you. However, if
you intend to use Bootstrap JavaScript, you will need to register [[yii\bootstrap5\BootstrapPluginAsset]]
as well.

> Tip: most of the widgets register [[yii\bootstrap5\BootstrapPluginAsset]] automatically.

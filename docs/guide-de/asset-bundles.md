Asset Bundles
=============

Bootstrap ist eine komplexe Front-End-Lösung, welche CSS, Javascript, Schriften usw. beinhaltet.
Um Ihnen die flexibelste Kontrolle über die einzelnen Komponenten zu ermöglichen enthält diese Erweiterung verschiedene Asset Bundles.

Das sind:
- [[yii\bootstrap5\BootstrapAsset|BootstrapAsset]] - enthält nur das hauptsächliche CSS.
- [[yii\bootstrap5\BootstrapPluginAsset|BootstrapPluginAsset]] - enthält das Javascript. Abhängig von [[yii\bootstrap5\BootstrapAsset]].

Verschiedene Anwendunganforderungen erfordern verschiedene Bundles (bzw. Kombinationen).
Falls Sie nur auf das CSS angewiesen sind, reicht es wenn Sie [[yii\bootstrap5\BootstrapAsset]] laden.
Wenn Sie das Javascript verwenden möchten, müssen Sie [[yii\bootstrap5\BootstrapPluginAsset]] auch laden.

> Tipp: Die meisten Widgets laden [[yii\bootstrap5\BootstrapPluginAsset]] automatisch.

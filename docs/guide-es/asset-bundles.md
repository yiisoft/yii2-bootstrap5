Asset Bundles
=============

Bootstrap es una completa solución front-end, que incluye CSS, JavaScript, fuentes y mucho más.
Con el fin de permitir un control más flexible sobre los componentes de Bootstrap, esta extensión proporciona
varios asset bundles.
Ellos son:

- [[yii\bootstrap5\BootstrapAsset|BootstrapAsset]] - contiene unicamente los ficheros CSS principales.
- [[yii\bootstrap5\BootstrapPluginAsset|BootstrapPluginAsset]] - depende de [[yii\bootstrap5\BootstrapAsset]], contiene ficheros javascript.

Particularmente las aplicaciones pueden necesitar requerir diferentes usos de bundle (o combinación de bundle).
Si necesitas unicamente estilos CSS, [[yii\bootstrap5\BootstrapAsset]] será suficiente para ti. Sin embargo, si
quieres usar el JavaScript de Bootstrap, necesitas registrar [[yii\bootstrap5\BootstrapPluginAsset]].

> Consejo: la mayoría de los widgets registran automaticamente [[yii\bootstrap5\BootstrapPluginAsset]].

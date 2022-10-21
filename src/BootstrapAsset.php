<?php
/**
 * @link https://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license https://www.yiiframework.com/license/
 */

declare(strict_types=1);

namespace yii\bootstrap5;

use yii\web\AssetBundle;

/**
 * Twitter Bootstrap 5 CSS bundle.
 */
class BootstrapAsset extends AssetBundle
{
    /**
     * @inheritDoc
     */
    public $sourcePath = '@bower/bootstrap';
    /**
     * @inheritDoc
     */
    public $css = [
        YII_ENV_PROD ? 'dist/css/bootstrap.min.css' : 'dist/css/bootstrap.css'
    ];
    /**
     * @inheritDoc
     * Note: This asset MUST be force copy because BootstrapPluginAsset use same path!
     */
    public $publishOptions = [
        'only' => ['scss/*.scss', 'scss/*/*.scss', 'dist/css/bootstrap.*'],
        'except' => ['scss/bootstrap-*.scss'],
        'forceCopy' => true,
    ];
}

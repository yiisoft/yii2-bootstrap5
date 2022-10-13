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
 * Twitter Bootstrap 5 JavaScript bundle.
 */
class BootstrapPluginAsset extends AssetBundle
{
    /**
     * @inheritDoc
     */
    public $sourcePath = '@bower/bootstrap';
    /**
     * @inheritDoc
     */
    public $js = [
        YII_ENV_PROD ? 'dist/js/bootstrap.bundle.min.js' : 'dist/js/bootstrap.bundle.js'
    ];
    /**
     * @inheritDoc
     */
    public $publishOptions = [
        'only' => ['dist/js/bootstrap.bundle.*', 'js/src/*.js', 'js/src/*/*.js']
    ];
    /**
     * @inheritDoc
     */
    public $depends = [
        BootstrapAsset::class
    ];
}

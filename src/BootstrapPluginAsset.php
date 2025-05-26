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
    public $sourcePath = '@npm/bootstrap/dist';

    public $js = [
        'js/bootstrap.bundle.js',
    ];

    public $depends = [
        'yii\bootstrap5\BootstrapAsset',
    ];
}

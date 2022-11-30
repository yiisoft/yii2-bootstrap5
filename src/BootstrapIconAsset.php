<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

declare(strict_types=1);

namespace yii\bootstrap5;

use yii\web\AssetBundle;

/**
 * Twitter Bootstrap 5 icon bundle
 */
class BootstrapIconAsset extends AssetBundle
{
    /**
     * @inheritDoc
     */
    public $sourcePath = '@vendor/twbs/bootstrap-icons/font';

    /**
     * @inheritDoc
     */
    public $css = [
        'bootstrap-icons.css'
    ];
}

<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

declare(strict_types=1);

namespace yii\bootstrap5;

use yii\web\AssetBundle;

class BootstrapIconAsset extends AssetBundle
{
    public $sourcePath = '@vendor/twbs/bootstrap-icons/font';

    public $css = [
        'bootstrap-icons.css'
    ];

}

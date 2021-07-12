<?php

declare(strict_types=1);

namespace yii\bootstrap5;

use yii\web\AssetBundle;

class BootstrapAsset extends AssetBundle
{
    public $sourcePath = '@npm/bootstrap/dist';

    public $css = [
        'css/bootstrap.css',
    ];

    public $js = [];
}

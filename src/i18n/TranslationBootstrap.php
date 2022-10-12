<?php
/**
 * @link https://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license https://www.yiiframework.com/license/
 */

namespace yii\bootstrap5\i18n;

use yii\base\BootstrapInterface;
use yii\i18n\GettextMessageSource;

/**
 * This bootstrap implementation is used to add translations automatically to application configuration.
 *
 * @author Simon Karlen <simi.albi@gmail.com>
 */
class TranslationBootstrap implements BootstrapInterface
{
    /**
     * @inheritDoc
     */
    public function bootstrap($app)
    {
        $app->getI18n()->translations['yii/bootstrap5'] = [
            'class' => GettextMessageSource::class,
            'sourceLanguage' => 'en-US',
            'basePath' => '@yii/bootstrap5/messages'
        ];
    }
}

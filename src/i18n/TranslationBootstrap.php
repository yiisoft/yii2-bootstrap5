<?php
/**
 * @package yii2-bootstrap5
 * @author Simon Karlen <simi.albi@gmail.com>
 */

namespace yii\bootstrap5\i18n;

use yii\base\Application;

/**
 * This bootstrap implementation is used to add translations automatically to app configuration
 */
class TranslationBootstrap implements \yii\base\BootstrapInterface
{
    /**
     * {@inheritDoc}
     */
    public function bootstrap($app)
    {
        $app->i18n->translations['yii/bootstrap5*'] = [
            'class' => '\yii\i18n\GettextMessageSource',
            'sourceLanguage' => 'en-US',
            'basePath' => '@yii/bootstrap5/messages'
        ];
    }
}

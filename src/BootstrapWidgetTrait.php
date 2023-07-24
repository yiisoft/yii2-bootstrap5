<?php
/**
 * @link https://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license https://www.yiiframework.com/license/
 */

declare(strict_types=1);

namespace yii\bootstrap5;

use yii\base\InvalidConfigException;
use yii\helpers\Json;

/**
 * BootstrapWidgetTrait is the trait, which provides basic for all Bootstrap widgets features.
 *
 * Note: class, which uses this trait must declare public field named `options` with the array default value:
 *
 * ```php
 * class MyWidget extends \yii\base\Widget
 * {
 *     use BootstrapWidgetTrait;
 *
 *     public $options = [];
 * }
 * ```
 *
 * This field is not present in the trait in order to avoid possible PHP Fatal error on definition conflict.
 *
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @author Paul Klimov <klimov.paul@gmail.com>
 */
trait BootstrapWidgetTrait
{
    /**
     * @var array|false the options for the underlying Bootstrap JS plugin/component.
     * Please refer to the corresponding Bootstrap plugin/component Web page for possible options.
     * For example, [this page](https://getbootstrap.com/docs/5.1/components/modal/#options) shows
     * how to use the "Modal" component and the supported options (e.g. "backdrop").
     * If this property is false, `registerJs()` will not be called on the view to initialize the module.
     */
    public $clientOptions = [];
    /**
     * @var array the event handlers for the underlying Bootstrap JS plugin.
     * Please refer to the corresponding Bootstrap plugin Web page for possible events.
     * For example, [this page](https://getbootstrap.com/docs/5.1/components/modal/#events) shows
     * how to use the "Modal" plugin and the supported events (e.g. "shown.bs.modal").
     */
    public $clientEvents = [];

    /**
     * Initializes the widget.
     * This method will register the bootstrap asset bundle. If you override this method,
     * make sure you call the parent implementation first.
     * @throws InvalidConfigException
     */
    public function init()
    {
        parent::init();
        if (!isset($this->options['id'])) {
            $this->options['id'] = $this->getId();
        }
    }

    /**
     * Registers a specific Bootstrap plugin/component and the related events.
     *
     * @param string $name the name of the Bootstrap plugin
     */
    protected function registerPlugin(string $name)
    {
        /**
         * @see https://github.com/twbs/bootstrap/blob/v5.2.0/js/index.esm.js
         */
        $jsPlugins = [
            'alert',
            'button',
            'carousel',
            'collapse',
            'dropdown',
            'modal',
            'offcanvas',
            'popover',
            'scrollspy',
            'tab',
            'toast',
            'tooltip'
        ];
        if (in_array($name, $jsPlugins, true)) {
            $view = $this->getView();
            BootstrapPluginAsset::register($view);
            // 'popover', 'toast' and 'tooltip' plugins not activates via data attributes
            if ($this->clientOptions !== false || in_array($name, ['popover', 'toast', 'tooltip'], true)) {
                $name = ucfirst($name);
                $id = $this->options['id'];
                $options = empty($this->clientOptions) ? '{}' : Json::htmlEncode($this->clientOptions);
                $view->registerJs("(new bootstrap.$name('#$id', $options));");
            }

            $this->registerClientEvents($name);
        }
    }

    /**
     * Registers JS event handlers that are listed in [[clientEvents]].
     */
    protected function registerClientEvents(string $name = null)
    {
        if (!empty($this->clientEvents)) {
            $id = $this->options['id'];
            $js = [];
            $appendix = ($name === 'dropdown') ? '.parentElement' : '';
            foreach ($this->clientEvents as $event => $handler) {
                $js[] = "document.getElementById('$id')$appendix.addEventListener('$event', $handler);";
            }
            $this->getView()->registerJs(implode("\n", $js));
        }
    }
}

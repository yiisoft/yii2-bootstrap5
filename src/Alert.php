<?php
/**
 * @link https://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license https://www.yiiframework.com/license/
 */

declare(strict_types=1);

namespace yii\bootstrap5;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * Alert renders an alert bootstrap component.
 *
 * For example,
 *
 * ```php
 * echo Alert::widget([
 *     'options' => [
 *         'class' => 'alert-info',
 *     ],
 *     'body' => 'Say hello...',
 * ]);
 * ```
 *
 * The following example will show the content enclosed between the [[begin()]]
 * and [[end()]] calls within the alert box:
 *
 * ```php
 * Alert::begin([
 *     'options' => [
 *         'class' => 'alert-warning',
 *     ],
 * ]);
 *
 * echo 'Say hello...';
 *
 * Alert::end();
 * ```
 *
 * @see https://getbootstrap.com/docs/5.1/components/alerts/
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @author Simon Karlen <simi.albi@outlook.com>
 */
class Alert extends Widget
{
    /**
     * @var string the body content in the alert component. Note that anything between
     * the [[begin()]] and [[end()]] calls of the Alert widget will also be treated
     * as the body content, and will be rendered before this.
     */
    public $body;
    /**
     * @var array|false the options for rendering the close button tag.
     * The close button is displayed in the header of the modal window. Clicking
     * on the button will hide the modal window. If this is false, no close button will be rendered.
     *
     * The following special options are supported:
     *
     * - tag: string, the tag name of the button. Defaults to 'button'.
     *
     * The rest of the options will be rendered as the HTML attributes of the button tag.
     * Please refer to the [Alert documentation](https://getbootstrap.com/docs/5.1/components/alerts/)
     * for the supported HTML attributes.
     */
    public $closeButton = [];


    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        $this->initOptions();

        echo Html::beginTag('div', $this->options) . "\n";
    }

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        echo "\n" . $this->renderBodyEnd();
        echo "\n" . Html::endTag('div');

        $this->registerPlugin('alert');
    }

    /**
     * Renders the alert body and the close button (if any).
     * @return string the rendering result
     */
    protected function renderBodyEnd(): string
    {
        return $this->body . "\n" . $this->renderCloseButton() . "\n";
    }

    /**
     * Renders the close button.
     * @return string|null the rendering result
     */
    protected function renderCloseButton()
    {
        if (($closeButton = $this->closeButton) !== false) {
            $tag = ArrayHelper::remove($closeButton, 'tag', 'button');
            $label = ArrayHelper::remove($closeButton, 'label', '');
            if ($tag === 'button' && !isset($closeButton['type'])) {
                $closeButton['type'] = 'button';
            }

            return Html::tag($tag, $label, $closeButton);
        } else {
            return null;
        }
    }

    /**
     * Initializes the widget options.
     * This method sets the default values for various options.
     */
    protected function initOptions()
    {
        Html::addCssClass($this->options, ['widget' => 'alert']);

        if ($this->closeButton !== false) {
            $this->closeButton = array_merge([
                'class' => ['widget' => 'btn-close'],
                'data' => ['bs-dismiss' => 'alert'],
                'aria' => ['label' => Yii::t('yii/bootstrap5', 'Close')]
            ], $this->closeButton);

            Html::addCssClass($this->options, ['toggle' => 'alert-dismissible']);
        }
        if (!isset($this->options['role'])) {
            $this->options['role'] = 'alert';
        }
    }
}

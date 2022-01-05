<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

declare(strict_types=1);

namespace yii\bootstrap5;

use DateInterval;
use DateTime;
use DateTimeInterface;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * Toasts renders an toast bootstrap component.
 *
 * For example,
 *
 * ```php
 * echo Toast::widget([
 *     'title' => 'Hello world!',
 *     'dateTime' => 'now',
 *     'body' => 'Say hello...',
 * ]);
 * ```
 *
 * The following example will show the content enclosed between the [[begin()]]
 * and [[end()]] calls within the toast box:
 *
 * ```php
 * Toast::begin([
 *     'title' => 'Hello world!',
 *     'dateTime' => 'now'
 * ]);
 *
 * echo 'Say hello...';
 *
 * Toast::end();
 * ```
 *
 * @see https://getbootstrap.com/docs/5.1/components/toasts/
 * @author Simon Karlen <simi.albi@outlook.com>
 */
class Toast extends Widget
{
    /**
     * @var string|null the body content in the alert component. Note that anything between
     * the [[begin()]] and [[end()]] calls of the Toast widget will also be treated
     * as the body content, and will be rendered before this.
     */
    public $body = null;
    /**
     * @var string|null The title content in the toast.
     */
    public $title = null;
    /**
     * @var int|string|DateTime|DateTimeInterface|DateInterval|false The date time the toast message references to.
     * This will be formatted as relative time (via formatter component). It will be omitted if
     * set to `false` (default).
     */
    public $dateTime = false;
    /**
     * @var array|false the options for rendering the close button tag.
     * The close button is displayed in the header of the toast. Clicking on the button will hide the toast.
     *
     * The following special options are supported:
     *
     * - tag: string, the tag name of the button. Defaults to 'button'.
     * - label: string, the label of the button. Defaults to '&times;'.
     *
     * The rest of the options will be rendered as the HTML attributes of the button tag.
     * Please refer to the [Toast documentation](https://getbootstrap.com/docs/5.1/components/toasts/)
     * for the supported HTML attributes.
     */
    public $closeButton = [];
    /**
     * @var array additional title options
     *
     * The following special options are supported:
     *
     * - tag: string, the tag name of the button. Defaults to 'strong'.
     *
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $titleOptions = [];
    /**
     * @var array additional date time part options
     *
     * The following special options are supported:
     *
     * - tag: string, the tag name of the button. Defaults to 'small'.
     *
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $dateTimeOptions = [];
    /**
     * @var array additional header options
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $headerOptions = [];
    /**
     * @var array body options
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $bodyOptions = [];


    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        $this->initOptions();

        echo Html::beginTag('div', $this->options) . "\n";
        echo $this->renderHeader() . "\n";
        echo $this->renderBodyBegin() . "\n";
    }

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        echo "\n" . $this->renderBodyEnd();
        echo "\n" . Html::endTag('div');

        $this->registerPlugin('toast');
    }

    /**
     * Renders the header HTML markup of the modal
     * @return string the rendering result
     */
    protected function renderHeader(): string
    {
        $button = $this->renderCloseButton();
        $tag = ArrayHelper::remove($this->titleOptions, 'tag', 'strong');
        Html::addCssClass($this->titleOptions, ['widget' => 'me-auto']);
        $title = Html::tag($tag, $this->title === null ? '' : $this->title, $this->titleOptions);

        if ($this->dateTime !== false) {
            $tag = ArrayHelper::remove($this->dateTimeOptions, 'tag', 'small');
            Html::addCssClass($this->dateTimeOptions, ['widget' => 'text-muted']);
            $title .= "\n" . Html::tag($tag, Yii::$app->formatter->asRelativeTime($this->dateTime), $this->dateTimeOptions);
        }

        $title .= "\n" . $button;

        Html::addCssClass($this->headerOptions, ['widget' => 'toast-header']);

        return Html::tag('div', "\n" . $title . "\n", $this->headerOptions);
    }

    /**
     * Renders the opening tag of the toast body.
     * @return string the rendering result
     */
    protected function renderBodyBegin(): string
    {
        Html::addCssClass($this->bodyOptions, ['widget' => 'toast-body']);

        return Html::beginTag('div', $this->bodyOptions);
    }

    /**
     * Renders the toast body and the close button (if any).
     * @return string the rendering result
     */
    protected function renderBodyEnd(): string
    {
        return $this->body . "\n" . Html::endTag('div');
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
        Html::addCssClass($this->options, ['widget' => 'toast']);

        if ($this->closeButton !== false) {
            $this->closeButton = array_merge([
                'class' => ['widget' => 'btn-close'],
                'data' => ['bs-dismiss' => 'toast'],
                'aria' => ['label' => Yii::t('yii/bootstrap5', 'Close')]
            ], $this->closeButton);
        }

        if (!isset($this->options['role'])) {
            $this->options['role'] = 'alert';
        }
        if (!isset($this->options['aria']['live'])) {
            $this->options['aria'] = [
                'live' => 'assertive',
                'atomic' => 'true',
            ];
        }
    }
}

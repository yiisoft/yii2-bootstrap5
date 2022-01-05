<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

declare(strict_types=1);

namespace yii\bootstrap5;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * Offcanvas is a sidebar component that can be toggled via JavaScript to appear from the left, right, or bottom edge
 * of the viewport. Buttons or anchors are used as triggers that are attached to specific elements you toggle, and data
 * attributes are used to invoke the required JavaScript.
 *
 * The following example will show the content enclosed the [[begin()]] and [[end()]] calls within the offcancas
 * container:
 *
 * ```php
 * Offcanvas::begin([
 *     'placement' => Offcanvas::PLACEMENT_END,
 *     'backdrop' => true,
 *     'scrolling' => true
 * ]);
 *
 * Nav::widget([...]);
 *
 * Offcanvas::end();
 * ```
 *
 * @see https://getbootstrap.com/docs/5.1/components/offcanvas/
 * @author Simon Karlen <simi.albi@outlook.com>
 */
class Offcanvas extends Widget
{
    const PLACEMENT_START = 'start';
    const PLACEMENT_END = 'end';
    const PLACEMENT_TOP = 'top';
    const PLACEMENT_BOTTOM = 'bottom';

    /**
     * @var string Where to place the offcanvas. Can be of of the [[PLACEMENT_*]] constants.
     */
    public $placement = self::PLACEMENT_START;
    /**
     * @var boolean Whether to enable backdrop or not. Defaults to `true`.
     */
    public $backdrop = true;
    /**
     * @var boolean Whether to enable body scrolling or not. Defaults to `false`.
     */
    public $scrolling = false;
    /**
     * @var string The title content in the offcanvas container.
     */
    public $title;
    /**
     * @var array|false the options for rendering the close button tag.
     * The close button is displayed in the header of the offcanvas container. Clicking
     * on the button will hide the offcanvas container. If this is false, no close button will be rendered.
     *
     * The following special options are supported:
     *
     * - tag: string, the tag name of the button. Defaults to 'button'.
     *
     * The rest of the options will be rendered as the HTML attributes of the button tag.
     * Please refer to the [Offcanvas plugin help](https://getbootstrap.com/docs/5.1/components/offcanvas/)
     * for the supported HTML attributes.
     */
    public $closeButton = [];
    /**
     * @var array|false the options for rendering the toggle button tag.
     * The toggle button is used to toggle the visibility of the modal window.
     * If this property is false, no toggle button will be rendered.
     *
     * The following special options are supported:
     *
     * - tag: string, the tag name of the button. Defaults to 'button'.
     * - label: string, the label of the button. Defaults to 'Show'.
     *
     * The rest of the options will be rendered as the HTML attributes of the button tag.
     * Please refer to the [Modal plugin help](http://getbootstrap.com/javascript/#modals)
     * for the supported HTML attributes.
     */
    public $toggleButton = false;
    /**
     * @var array Additional header options.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $headerOptions = [];
    /**
     * @var array Additional title options.
     *
     * The following special options are supported:
     *
     * - tag: string, the tag name of the button. Defaults to 'h5'.
     *
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $titleOptions = [];
    /**
     * @var array Additional body options.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $bodyOptions = [];


    /**
     * {@inheritDoc}
     */
    public function init()
    {
        parent::init();

        $this->initOptions();

        echo $this->renderToggleButton() . "\n";
        echo Html::beginTag('div', $this->options) . "\n";
        echo $this->renderHeader() . "\n";
        echo $this->renderBodyBegin() . "\n";
    }


    /**
     * Renders the widget.
     */
    public function run()
    {
        echo "\n" . $this->renderBodyEnd();
        echo "\n" . Html::endTag('div');

        $this->registerPlugin('offcanvas');
    }

    /**
     * Renders the header HTML markup of the modal
     * @return string the rendering result
     */
    protected function renderHeader(): string
    {
        $button = $this->renderCloseButton();
        if (isset($this->title)) {
            $tag = ArrayHelper::remove($this->titleOptions, 'tag', 'h5');
            Html::addCssClass($this->titleOptions, ['widget' => 'offcanvas-title']);
            $header = Html::tag($tag, $this->title, $this->titleOptions);
        } else {
            $header = '';
        }

        if ($button !== null) {
            $header .= "\n" . $button;
        } elseif ($header === '') {
            return '';
        }
        Html::addCssClass($this->headerOptions, ['widget' => 'offcanvas-header']);

        return Html::tag('div', "\n" . $header . "\n", $this->headerOptions);
    }

    /**
     * Renders the opening tag of the modal body.
     * @return string the rendering result
     */
    protected function renderBodyBegin(): string
    {
        Html::addCssClass($this->bodyOptions, ['widget' => 'offcanvas-body']);

        return Html::beginTag('div', $this->bodyOptions);
    }

    /**
     * Renders the closing tag of the modal body.
     * @return string the rendering result
     */
    protected function renderBodyEnd(): string
    {
        return Html::endTag('div');
    }

    /**
     * Renders the toggle button.
     * @return string|null the rendering result
     */
    protected function renderToggleButton()
    {
        if (($toggleButton = $this->toggleButton) !== false) {
            $tag = ArrayHelper::remove($toggleButton, 'tag', 'button');
            $label = ArrayHelper::remove($toggleButton, 'label', Yii::t('yii/bootstrap5', 'Show'));

            return Html::tag($tag, $label, $toggleButton);
        } else {
            return null;
        }
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
        $this->options = array_merge([
            'tabindex' => -1,
            'data' =>[
                'bs-backdrop' => $this->backdrop ? 'true' : 'false',
                'bs-scroll' => $this->scrolling ? 'true' : 'false'
            ]
        ], $this->options);
        Html::addCssClass($this->options, ['widget' => 'offcanvas offcanvas-' . $this->placement]);

        $this->titleOptions = array_merge([
            'id' => $this->options['id'] . '-label',
        ], $this->titleOptions);
        if (!isset($this->options['aria']['label'], $this->options['aria']['labelledby']) && isset($this->title)) {
            $this->options['aria']['labelledby'] = $this->titleOptions['id'];
        }

        if ($this->closeButton !== false) {
            $this->closeButton = array_merge([
                'class' => ['widget' => 'btn-close text-reset'],
                'data' => ['bs-dismiss' => 'offcanvas'],
                'aria' => ['label' => Yii::t('yii/bootstrap5', 'Close')]
            ], $this->closeButton);
        }

        if ($this->toggleButton !== false) {
            $this->toggleButton = array_merge([
                'data' => ['bs-toggle' => 'offcanvas'],
                'type' => 'button',
                'aria' => ['controls' => $this->options['id']]
            ], $this->toggleButton);
            if (!isset($this->toggleButton['data']['bs-target']) && !isset($this->toggleButton['href'])) {
                $this->toggleButton['data']['bs-target'] = '#' . $this->options['id'];
            }
        }
    }
}

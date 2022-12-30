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
 * Popover renders a popover that can be toggled by clicking on a button.
 *
 * The following example will show the content enclosed between the [[begin()]]
 * and [[end()]] calls within the modal window:
 *
 * ```php
 * Popover::begin([
 *     'title' => 'Hello world',
 *     'toggleButton' => ['label' => 'click me'],
 * ]);
 *
 * echo 'Say hello...';
 *
 * Popover::end();
 * ```
 *
 * @see https://getbootstrap.com/docs/5.1/components/popovers/
 * @author Simon Karlen <simi.albi@outlook.com>
 */
class Popover extends Widget
{
    const PLACEMENT_AUTO = 'auto';
    const PLACEMENT_TOP = 'top';
    const PLACEMENT_BOTTOM = 'bottom';
    const PLACEMENT_LEFT = 'left';
    const PLACEMENT_RIGHT = 'right';
    const TRIGGER_CLICK = 'click';
    const TRIGGER_HOVER = 'hover';
    const TRIGGER_FOCUS = 'focus';
    const TRIGGER_MANUAL = 'manual';

    /**
     * @var string|null the tile content in the popover.
     */
    public $title = null;
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
     * @var array arrow options
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $arrowOptions = [];
    /**
     * @var string How to position the popover - [[PLACEMENT_AUTO]] | [[PLACEMENT_TOP]] | [[PLACEMENT_BOTTOM]] |
     * [[PLACEMENT_LEFT]] | [[PLACEMENT_RIGHT]]. When auto is specified, it will dynamically reorient the popover.
     */
    public $placement = self::PLACEMENT_AUTO;
    /**
     * @var array|false the options for rendering the toggle button tag.
     * The toggle button is used to toggle the visibility of the popover.
     * If this property is false, no toggle button will be rendered.
     *
     * The following special options are supported:
     *
     * - tag: string, the tag name of the button. Defaults to 'button'.
     * - label: string, the label of the button. Defaults to 'Show'.
     *
     * The rest of the options will be rendered as the HTML attributes of the button tag.
     * Please refer to the [Popover plugin help](https://getbootstrap.com/docs/5.1/components/popovers/)
     * for the supported HTML attributes.
     */
    public $toggleButton = false;


    /**
     * {@inheritDoc}
     */
    public function init()
    {
        parent::init();

        $this->initOptions();

        ob_start();
    }

    /**
     * {@inheritDoc}
     */
    public function run()
    {
        $content = ob_get_clean();

        if (!empty($content)) {
            $this->clientOptions['content'] = $content;
        }
        $html = $this->renderToggleButton();

        $this->registerPlugin('popover');

        return $html;
    }

    /**
     * Renders the arrow HTML markup of the popover
     * @return string the rendering result
     */
    protected function renderArrow(): string
    {
        Html::addCssClass($this->arrowOptions, ['widget' => 'popover-arrow']);

        return Html::tag('div', '', $this->arrowOptions);
    }

    /**
     * Renders the header HTML markup of the popover
     * @return string the rendering result
     */
    protected function renderHeader(): string
    {
        Html::addCssClass($this->headerOptions, ['widget' => 'popover-header']);

        return Html::tag('h3', '', $this->headerOptions);
    }

    /**
     * Renders the opening tag of the modal body.
     * @return string the rendering result
     */
    protected function renderBody(): string
    {
        Html::addCssClass($this->bodyOptions, ['widget' => 'popover-body']);

        return Html::tag('div', '', $this->bodyOptions);
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
            $toggleButton['id'] = $this->options['id'];

            return Html::tag($tag, $label, $toggleButton);
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

        $options = array_merge([
            'role' => 'tooltip',
        ], $this->options, ['id' => $this->options['id'] . '-popover']);
        Html::addCssClass($options, ['widget' => 'popover']);
        $template = Html::beginTag('div', $options);
        $template .= $this->renderArrow();
        $template .= $this->renderHeader();
        $template .= $this->renderBody();
        $template .= Html::endTag('div');

        $this->clientOptions = array_merge([
            'template' => $template,
            'placement' => $this->placement,
            'title' => $this->title,
            'sanitize' => false,
            'html' => true
        ], $this->clientOptions);

        if ($this->toggleButton !== false) {
            $this->toggleButton = array_merge([
                'type' => 'button',
            ], $this->toggleButton);
        }
    }
}

<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

declare(strict_types=1);

namespace yii\bootstrap5;

use Throwable;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/**
 * ButtonDropdown renders a group or split button dropdown bootstrap component.
 *
 * For example,
 *
 * ```php
 * // a button group using Dropdown widget
 * echo ButtonDropdown::widget([
 *     'label' => 'Action',
 *     'dropdown' => [
 *         'items' => [
 *             ['label' => 'DropdownA', 'url' => '/'],
 *             ['label' => 'DropdownB', 'url' => '#'],
 *         ],
 *     ],
 * ]);
 * ```
 * @see https://getbootstrap.com/docs/5.1/components/buttons/
 * @see https://getbootstrap.com/docs/5.1/components/dropdowns/
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 */
class ButtonDropdown extends Widget
{
    /**
     * The css class part of dropdown
     */
    const DIRECTION_DOWN = 'down';
    /**
     * The css class part of dropleft
     */
    const DIRECTION_LEFT = 'left';
    /**
     * The css class part of dropright
     */
    const DIRECTION_RIGHT = 'right';
    /**
     * The css class part of dropup
     */
    const DIRECTION_UP = 'up';

    /**
     * @var string|null the button label
     */
    public $label = null;
    /**
     * @var array the HTML attributes for the container tag. The following special options are recognized:
     *
     * - tag: string, defaults to "div", the name of the container tag.
     *
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $options = [];
    /**
     * @var array the HTML attributes of the button.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $buttonOptions = [];
    /**
     * @var array the configuration array for [[Dropdown]].
     */
    public $dropdown = [];
    /**
     * @var string the drop-direction of the widget
     *
     * Possible values are 'left', 'right', 'up', or 'down' (default)
     */
    public $direction = self::DIRECTION_DOWN;
    /**
     * @var bool whether to display a group of split-styled button group.
     */
    public $split = false;
    /**
     * @var string the tag to use to render the button
     */
    public $tagName = 'button';
    /**
     * @var bool whether the label should be HTML-encoded.
     */
    public $encodeLabel = true;
    /**
     * @var string name of a class to use for rendering dropdowns withing this widget. Defaults to [[Dropdown]].
     */
    public $dropdownClass = Dropdown::class;
    /**
     * @var bool whether to render the container using the [[options]] as HTML attributes. If set to `false`,
     * the container element enclosing the button and dropdown will NOT be rendered.
     */
    public $renderContainer = true;


    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        if (!isset($this->buttonOptions['id'])) {
            $this->buttonOptions['id'] = $this->options['id'] . '-button';
        }
        if ($this->label === null) {
            $this->label = Yii::t('yii/bootstrap5', 'Button');
        }
    }

    /**
     * {@inheritdoc}
     * @return string
     * @throws Throwable
     */
    public function run(): string
    {
        $html = $this->renderButton() . "\n" . $this->renderDropdown();

        if ($this->renderContainer) {
            Html::addCssClass($this->options, ['widget' => 'drop' . $this->direction, 'btn-group']);
            $options = $this->options;
            $tag = ArrayHelper::remove($options, 'tag', 'div');
            $html = Html::tag($tag, $html, $options);
        }

        // Set options id to button options id to ensure correct css selector in plugin initialisation
        $this->options['id'] = $this->buttonOptions['id'];

        $this->registerPlugin('dropdown');

        return $html;
    }

    /**
     * Generates the button dropdown.
     * @return string the rendering result.
     * @throws Throwable
     */
    protected function renderButton(): string
    {
        Html::addCssClass($this->buttonOptions, ['widget' => 'btn']);
        $label = $this->label;
        if ($this->encodeLabel) {
            $label = Html::encode($label);
        }

        if ($this->split) {
            $buttonOptions = $this->buttonOptions;
            $this->buttonOptions['data'] = ['bs-toggle' => 'dropdown'];
            $this->buttonOptions['aria'] = ['expanded' => 'false'];
            Html::addCssClass($this->buttonOptions, ['toggle' => 'dropdown-toggle dropdown-toggle-split']);
            unset($buttonOptions['id']);
            $splitButton = Button::widget([
                'label' => '<span class="visually-hidden">' . Yii::t('yii/bootstrap5', 'Toggle Dropdown') . '</span>',
                'encodeLabel' => false,
                'options' => $this->buttonOptions,
                'view' => $this->getView(),
            ]);
        } else {
            $buttonOptions = $this->buttonOptions;
            Html::addCssClass($buttonOptions, ['toggle' => 'dropdown-toggle']);
            $buttonOptions['data'] = ['bs-toggle' => 'dropdown'];
            $buttonOptions['aria'] = ['expanded' => 'false'];
            $splitButton = '';
        }

        if (isset($buttonOptions['href'])) {
            if (is_array($buttonOptions['href'])) {
                $buttonOptions['href'] = Url::to($buttonOptions['href']);
            }
        } else {
            if ($this->tagName === 'a') {
                $buttonOptions['href'] = '#';
                $buttonOptions['role'] = 'button';
            }
        }

        return Button::widget([
                'tagName' => $this->tagName,
                'label' => $label,
                'options' => $buttonOptions,
                'encodeLabel' => false,
                'view' => $this->getView(),
            ]) . "\n" . $splitButton;
    }

    /**
     * Generates the dropdown menu.
     * @return string the rendering result.
     * @throws Throwable
     */
    protected function renderDropdown(): string
    {
        $config = $this->dropdown;
        $config['clientOptions'] = [];
        $config['view'] = $this->getView();
        /** @var Widget $dropdownClass */
        $dropdownClass = $this->dropdownClass;

        return $dropdownClass::widget($config);
    }
}

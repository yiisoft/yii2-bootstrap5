<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

declare(strict_types=1);

namespace yii\bootstrap5;

use yii\base\Model;
use yii\helpers\ArrayHelper;

/**
 * BaseHtml provides concrete implementation for [[Html]].
 */
abstract class BaseHtml extends \yii\helpers\Html
{
    /**
     * @var int a counter used to generate [[id]] for widgets.
     * @internal
     */
    public static $counter = 0;
    /**
     * @var string the prefix to the automatically generated widget IDs.
     * @see getId()
     */
    public static $autoIdPrefix = 'i';
    /**
     * @var bool whether to removes duplicate class names in tag attribute `class` (fix strange yii2 behavior since 2.0.44)
     * @see mergeCssClasses()
     * @see renderTagAttributes()
     * @since 2.0.3
     */
    public static $normalizeClassAttribute = true;


    /**
     * Renders Bootstrap static form control.
     *
     * @param string $value static control value.
     * @param array $options the tag options in terms of name-value pairs. These will be rendered as
     * the attributes of the resulting tag. There are also a special options:
     *
     * @return string generated HTML
     * @see https://getbootstrap.com/docs/5.1/components/forms/#readonly-plain-text
     */
    public static function staticControl(string $value, array $options = []): string
    {
        static::addCssClass($options, 'form-control-plaintext');
        $options['readonly'] = true;

        return static::input('text', null, $value, $options);
    }

    /**
     * Generates a Bootstrap static form control for the given model attribute.
     * @param Model $model the model object.
     * @param string $attribute the attribute name or expression. See [[getAttributeName()]] for the format
     * about attribute expression.
     * @param array $options the tag options in terms of name-value pairs. See [[staticControl()]] for details.
     * @return string generated HTML
     * @see staticControl()
     */
    public static function activeStaticControl(Model $model, string $attribute, array $options = []): string
    {
        if (isset($options['value'])) {
            $value = $options['value'];
            unset($options['value']);
        } else {
            $value = static::getAttributeValue($model, $attribute);
        }

        return static::staticControl((string)$value, $options);
    }

    /**
     * {@inheritDoc}
     */
    public static function radioList($name, $selection = null, $items = [], $options = []): string
    {
        if (!isset($options['item'])) {
            $itemOptions = ArrayHelper::remove($options, 'itemOptions', []);
            $encode = ArrayHelper::getValue($options, 'encode', true);
            $options['item'] = function ($index, $label, $name, $checked, $value) use ($itemOptions, $encode) {
                unset($index);
                $options = array_merge(
                    [
                        'class' => 'form-check-input',
                        'label' => $encode ? static::encode($label) : $label,
                        'labelOptions' => ['class' => 'form-check-label'],
                        'value' => $value,
                    ], $itemOptions);

                return '<div class="form-check">' . static::radio($name, $checked, $options) . '</div>';
            };
        }

        return parent::radioList($name, $selection, $items, $options);
    }

    /**
     * {@inheritdoc}
     */
    public static function checkboxList($name, $selection = null, $items = [], $options = []): string
    {
        if (!isset($options['item'])) {
            $itemOptions = ArrayHelper::remove($options, 'itemOptions', []);
            $encode = ArrayHelper::getValue($options, 'encode', true);
            $options['item'] = function ($index, $label, $name, $checked, $value) use ($itemOptions, $encode) {
                unset($index);
                $options = array_merge(
                    [
                        'class' => 'form-check-input',
                        'label' => $encode ? static::encode($label) : $label,
                        'labelOptions' => ['class' => 'form-check-label'],
                        'value' => $value,
                    ], $itemOptions);

                return '<div class="form-check">' . Html::checkbox($name, $checked, $options) . '</div>';
            };
        }

        return parent::checkboxList($name, $selection, $items, $options);
    }

    /**
     * {@inheritdoc}
     */
    public static function error($model, $attribute, $options = []): string
    {
        if (!array_key_exists('class', $options)) {
            $options['class'] = ['invalid-feedback'];
        }

        return parent::error($model, $attribute, $options);
    }

    /**
     * @inheritdoc
     */
    protected static function booleanInput($type, $name, $checked = false, $options = []): string
    {
        $options['checked'] = (bool)$checked;
        $value = array_key_exists('value', $options) ? $options['value'] : '1';
        if (isset($options['uncheck'])) {
            // add a hidden field so that if the checkbox is not selected, it still submits a value
            $hiddenOptions = [];
            if (isset($options['form'])) {
                $hiddenOptions['form'] = $options['form'];
            }
            $hidden = static::hiddenInput($name, $options['uncheck'], $hiddenOptions);
            unset($options['uncheck']);
        } else {
            $hidden = '';
        }
        if (isset($options['label'])) {
            $label = $options['label'];
            $labelOptions = $options['labelOptions'] ?? [];
            unset($options['label'], $options['labelOptions']);

            if (!isset($options['id'])) {
                $options['id'] = static::getId();
            }

            $input = static::input($type, $name, $value, $options);

            if (isset($labelOptions['wrapInput']) && $labelOptions['wrapInput']) {
                unset($labelOptions['wrapInput']);
                $content = static::label($input . $label, $options['id'], $labelOptions);
            } else {
                $content = $input . "\n" . static::label($label, $options['id'], $labelOptions);
            }

            return $hidden . $content;
        }

        return $hidden . static::input($type, $name, $value, $options);
    }

    /**
     * Returns an autogenerated ID
     * @return string Autogenerated ID
     */
    protected static function getId(): string
    {
        return static::$autoIdPrefix . static::$counter++;
    }
}

<?php
/**
 * @link https://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license https://www.yiiframework.com/license/
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
     * @inheritDoc
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
     *
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
     * {@inheritdoc}
     * Pass `true` in `$options['inline']` to generate [inline list](https://getbootstrap.com/docs/5.1/forms/checks-radios/#inline).
     */
    public static function radioList($name, $selection = null, $items = [], $options = []): string
    {
        $inline = ArrayHelper::remove($options, 'inline', false);

        if (!isset($options['item'])) {
            $itemOptions = ArrayHelper::remove($options, 'itemOptions', []);
            static::addCssClass($itemOptions, ['bootstrap' => 'form-check-input']);
            if (!isset($itemOptions['labelOptions'])) {
                $itemOptions['labelOptions'] = ['class' => 'form-check-label'];
            } else {
                static::addCssClass($itemOptions['labelOptions'], ['bootstrap' => 'form-check-label']);
            }

            $wrapperOptions = $inline ? ['class' => 'form-check form-check-inline'] : ['class' => 'form-check'];

            $encode = ArrayHelper::getValue($options, 'encode', true);

            $options['item'] = function ($index, $label, $name, $checked, $value) use ($itemOptions, $wrapperOptions, $encode) {
                $itemOptions['value'] = $value;
                if (!isset($itemOptions['label'])) {
                    $itemOptions['label'] = $encode ? static::encode($label) : $label;
                }

                return static::tag('div', static::radio($name, $checked, $itemOptions), $wrapperOptions);
            };
        }

        return parent::radioList($name, $selection, $items, $options);
    }

    /**
     * {@inheritdoc}
     * Pass `true` in `$options['inline']` to generate [inline list](https://getbootstrap.com/docs/5.1/forms/checks-radios/#inline).
     */
    public static function checkboxList($name, $selection = null, $items = [], $options = []): string
    {
        $inline = ArrayHelper::remove($options, 'inline', false);

        if (!isset($options['item'])) {
            $itemOptions = ArrayHelper::remove($options, 'itemOptions', []);
            static::addCssClass($itemOptions, 'form-check-input');
            if (!isset($itemOptions['labelOptions'])) {
                $itemOptions['labelOptions'] = ['class' => 'form-check-label'];
            } else {
                static::addCssClass($itemOptions['labelOptions'], 'form-check-label');
            }

            $wrapperOptions = $inline ? ['class' => 'form-check form-check-inline'] : ['class' => 'form-check'];

            $encode = ArrayHelper::getValue($options, 'encode', true);

            $options['item'] = function ($index, $label, $name, $checked, $value) use ($itemOptions, $wrapperOptions, $encode) {
                $itemOptions['value'] = $value;
                if (!isset($itemOptions['label'])) {
                    $itemOptions['label'] = $encode ? static::encode($label) : $label;
                }

                return static::tag('div', static::checkbox($name, $checked, $itemOptions), $wrapperOptions);
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
     * {@inheritdoc}
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

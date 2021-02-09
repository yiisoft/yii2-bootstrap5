<?php

declare(strict_types=1);

namespace yii\bootstrap5;

/**
 * Button renders a bootstrap button.
 *
 * For example,
 *
 * ```php
 * echo Button::widget([
 *     'label' => 'Action',
 *     'options' => ['class' => 'btn-lg'],
 * ]);
 * ```
 * @see https://getbootstrap.com/docs/5.0/components/buttons/
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 */
class Button extends Widget
{
    /**
     * @var string the tag to use to render the button
     */
    public string $tagName = 'button';
    /**
     * @var string the button label
     */
    public string $label = 'Button';
    /**
     * @var bool whether the label should be HTML-encoded.
     */
    public bool $encodeLabel = true;


    /**
     * Initializes the widget.
     * If you override this method, make sure you call the parent implementation first.
     */
    public function init()
    {
        parent::init();
        $this->clientOptions = [];
        Html::addCssClass($this->options, ['widget' => 'btn']);
    }

    /**
     * {@inheritdoc}
     * @return string
     */
    public function run(): string
    {
        $this->registerPlugin('button');
        return Html::tag($this->tagName, $this->encodeLabel ? Html::encode($this->label) : $this->label,
            $this->options);
    }
}

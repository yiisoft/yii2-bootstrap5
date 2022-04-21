<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

declare(strict_types=1);

namespace yii\bootstrap5;

use RuntimeException;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * Breadcrumbs represents a Bootstrap 5 version of [[\yii\widgets\Breadcrumbs]]. It displays
 * a list of links indicating the position of the current page in the whole site hierarchy.
 *
 * To use Breadcrumbs, you need to configure its [[links]] property, which specifies the links to be displayed. For example,
 *
 * ```php
 * echo Breadcrumbs::widget([
 *     'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
 *     'options' => [],
 * ]);
 * ```
 * @see https://getbootstrap.com/docs/5.1/components/breadcrumb/
 * @author Alexandr Kozhevnikov <onmotion1@gmail.com>
 * @author Simon Karlen <simi.albi@outlook.com>
 */
class Breadcrumbs extends Widget
{
    /**
     * @var string the name of the breadcrumb container tag.
     */
    public $tag = 'ol';
    /**
     * @var bool whether to HTML-encode the link labels.
     */
    public $encodeLabels = true;
    /**
     * @var array|bool the first hyperlink in the breadcrumbs (called home link).
     * Please refer to [[links]] on the format of the link.
     * If this property is not set, it will default to a link pointing to [[\yii\web\Application::homeUrl]]
     * with the label 'Home'. If this property is false, the home link will not be rendered.
     */
    public $homeLink = [];
    /**
     * @var array list of links to appear in the breadcrumbs. If this property is empty,
     * the widget will not render anything. Each array element represents a single link in the breadcrumbs
     * with the following structure:
     *
     * ```php
     * [
     *     'label' => 'label of the link',  // required
     *     'url' => 'url of the link',      // optional, will be processed by Url::to()
     *     'template' => 'own template of the item', // optional, if not set $this->itemTemplate will be used
     * ]
     * ```
     *
     *
     */
    public $links = [];
    /**
     * @var string the template used to render each inactive item in the breadcrumbs. The token `{link}`
     * will be replaced with the actual HTML link for each inactive item.
     */
    public $itemTemplate = "<li class=\"breadcrumb-item\">{link}</li>\n";
    /**
     * @var string the template used to render each active item in the breadcrumbs. The token `{link}`
     * will be replaced with the actual HTML link for each active item.
     */
    public $activeItemTemplate = "<li class=\"breadcrumb-item active\" aria-current=\"page\">{link}</li>\n";
    /**
     * @var array the HTML attributes for the widgets nav container tag.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $navOptions = ['aria' => ['label' => 'breadcrumb']];


    /**
     * Initializes the widget.
     * If you override this method, make sure you call the parent implementation first.
     */
    public function init()
    {
        parent::init();
        $this->clientOptions = [];
        Html::addCssClass($this->options, ['widget' => 'breadcrumb']);
    }

    /**
     * {@inheritDoc}
     */
    public function run(): string
    {
        if (!isset($this->options['id'])) {
            $this->options['id'] = "{$this->getId()}-breadcrumb";
        }

        /** @psalm-suppress InvalidArgument */
        Html::addCssClass($this->options, ['widget' => 'breadcrumb']);

        if (empty($this->links)) {
            return '';
        }

        $links = [];

        if ($this->homeLink === []) {
            $links[] = $this->renderItem([
                'label' => Yii::t('yii/bootstrap5', 'Home'),
                'url' => Yii::$app->homeUrl,
            ], $this->itemTemplate);
        } elseif ($this->homeLink !== false) {
            $links[] = $this->renderItem($this->homeLink, $this->itemTemplate);
        }

        foreach ($this->links as $link) {
            if (!is_array($link)) {
                $link = ['label' => $link];
            }

            $links[] = $this->renderItem($link, isset($link['url']) ? $this->itemTemplate : $this->activeItemTemplate);
        }

        return Html::tag('nav', Html::tag($this->tag, implode('', $links), $this->options), $this->navOptions);
    }

    /**
     * The template used to render each active item in the breadcrumbs. The token `{link}` will be replaced with the
     * actual HTML link for each active item.
     *
     * @param string $value
     *
     * @return $this
     */
    public function activeItemTemplate(string $value): self
    {
        $this->activeItemTemplate = $value;

        return $this;
    }

    /**
     * Whether to HTML-encode the link labels.
     *
     * @param bool $value
     *
     * @return $this
     */
    public function encodeLabels(bool $value): self
    {
        $this->encodeLabels = $value;

        return $this;
    }

    /**
     * The first hyperlink in the breadcrumbs (called home link).
     *
     * Please refer to {@see links} on the format of the link.
     *
     * If this property is not set, it will default to a link pointing with the label 'Home'. If this property is false,
     * the home link will not be rendered.
     *
     * @param array|bool $value
     *
     * @return $this
     */
    public function homeLink($value): self
    {
        $this->homeLink = $value;

        return $this;
    }

    /**
     * The template used to render each inactive item in the breadcrumbs. The token `{link}` will be replaced with the
     * actual HTML link for each inactive item.
     *
     * @param string $value
     *
     * @return $this
     */
    public function itemTemplate(string $value): self
    {
        $this->itemTemplate = $value;

        return $this;
    }

    /**
     * List of links to appear in the breadcrumbs. If this property is empty, the widget will not render anything. Each
     * array element represents a single link in the breadcrumbs with the following structure:
     *
     * ```php
     * [
     *     'label' => 'label of the link',  // required
     *     'url' => 'url of the link',      // optional, will be processed by Url::to()
     *     'template' => 'own template of the item', // optional, if not set $this->itemTemplate will be used
     * ]
     * ```
     *
     * @param array $value
     *
     * @return $this
     */
    public function links(array $value): self
    {
        $this->links = $value;

        return $this;
    }

    /**
     * The HTML attributes for the widgets nav container tag.
     *
     * {@see \yii\helpers\Html::renderTagAttributes()} for details on how attributes are being rendered.
     *
     * @param array $value
     *
     * @return $this
     */
    public function navOptions(array $value): self
    {
        $this->navOptions = $value;

        return $this;
    }

    /**
     * The HTML attributes for the widget container tag. The following special options are recognized.
     *
     * {@see \yii\helpers\Html::renderTagAttributes()} for details on how attributes are being rendered.
     *
     * @param array $value
     *
     * @return $this
     */
    public function options(array $value): self
    {
        $this->options = $value;

        return $this;
    }

    /**
     * The name of the breadcrumb container tag.
     *
     * @param string $value
     *
     * @return $this
     */
    public function tag(string $value): self
    {
        $this->tag = $value;

        return $this;
    }

    /**
     * Renders a single breadcrumb item.
     *
     * @param array $link the link to be rendered. It must contain the "label" element. The "url" element is optional.
     * @param string $template the template to be used to rendered the link. The token "{link}" will be replaced by the
     * link.
     *
     * @return string the rendering result
     * @throws RuntimeException if `$link` does not have "label" element.
     *
     */
    protected function renderItem(array $link, string $template): string
    {
        $encodeLabel = ArrayHelper::remove($link, 'encode', $this->encodeLabels);

        if (array_key_exists('label', $link)) {
            $label = $encodeLabel ? Html::encode($link['label']) : $link['label'];
        } else {
            throw new RuntimeException('The "label" element is required for each link.');
        }

        if (isset($link['template'])) {
            $template = $link['template'];
        }

        if (isset($link['url'])) {
            $options = $link;
            unset($options['template'], $options['label'], $options['url']);
            $linkHtml = Html::a($label, $link['url'], $options);
        } else {
            $linkHtml = $label;
        }

        return strtr($template, ['{link}' => $linkHtml]);
    }
}

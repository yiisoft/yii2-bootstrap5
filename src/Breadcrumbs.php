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
 * This widget represents a Bootstrap 5 component "Breadcrumb". It displays a list of links indicating the
 * position of the current page in the whole site hierarchy.
 *
 * ```php
 * echo Breadcrumbs::widget([
 *     'links' => [
 *         [
 *             'label' => 'the item label', // required
 *             'url' => 'the item URL', // optional, will be processed by `Url::to()`
 *             'template' => 'own template of the item', // optional
 *          ],
 *          ['label' => 'the label of the active item']
 *     ],
 *     'options' => [...],
 * ]);
 * ```
 * or
 * ```php
 * echo Breadcrumbs::widget([
 *     'links' => [
 *         'the item URL' => 'the item label',
 *          0 => 'the label of the active item',
 *     ],
 *     'options' => [...],
 * ]);
 * ```
 *
 * @see https://getbootstrap.com/docs/5.1/components/breadcrumb/
 * @author Alexandr Kozhevnikov <onmotion1@gmail.com>
 * @author Simon Karlen <simi.albi@outlook.com>
 */
class Breadcrumbs extends \yii\widgets\Breadcrumbs
{
    use BootstrapWidgetTrait;

    /**
     * {@inheritDoc}
     */
    public $tag = 'ol';
    /**
     * @var array|false the first hyperlink in the breadcrumbs (called home link).
     * Please refer to [[links]] on the format of the link.
     * If this property is not set, it will default to a link pointing to [[\yii\web\Application::homeUrl]]
     * with the label 'Home'. If this property is false, the home link will not be rendered.
     */
    public $homeLink = [];
    /**
     * {@inheritDoc}
     */
    public $itemTemplate = "<li class=\"breadcrumb-item\">{link}</li>\n";
    /**
     * {@inheritDoc}
     */
    public $activeItemTemplate = "<li class=\"breadcrumb-item active\" aria-current=\"page\">{link}</li>\n";
    /**
     * @var array the HTML attributes for the widgets nav container tag.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $navOptions = ['aria' => ['label' => 'breadcrumb']];

    /**
     * {@inheritDoc}
     */
    public function run(): string
    {
        if (empty($this->links)) {
            return '';
        }

        // Normalize links
        $links = [];
        foreach ($this->links as $key => $value) {
            if (is_array($value)) {
                $links[] = $value;
            } else {
                $links[] = ['label' => $value, 'url' => is_string($key) ? $key : null];
            }
        }
        $this->links = $links;
        unset($links);

        if ($this->homeLink === []) {
            $this->homeLink = null;
        }

        if (!isset($this->options['id'])) {
            $this->options['id'] = "{$this->getId()}-breadcrumb";
        }
        Html::addCssClass($this->options, ['widget' => 'breadcrumb']);

        // parent method not return result
        ob_start();
        parent::run();
        $content = ob_get_clean();

        return Html::tag('nav', $content, $this->navOptions);
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
     * @param array|false $value
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
     * List of links to appear in the breadcrumbs. If this property is empty, the widget will not render anything.
     * Each array element represents a single item in the breadcrumbs with the following structure.
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
}

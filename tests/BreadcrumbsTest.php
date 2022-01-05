<?php

namespace yiiunit\extensions\bootstrap5;

use yii\bootstrap5\Breadcrumbs;

/**
 * @group bootstrap5
 */
class BreadcrumbsTest extends TestCase
{
    public function testRender()
    {
        Breadcrumbs::$counter = 0;
        $out = Breadcrumbs::widget([
            'homeLink' => ['label' => 'Home', 'url' => '#'],
            'links' => [
                ['label' => 'Library', 'url' => '#'],
                ['label' => 'Data']
            ]
        ]);

        $expected = <<<HTML
<nav aria-label="breadcrumb"><ol id="w0" class="breadcrumb"><li class="breadcrumb-item"><a href="#">Home</a></li>
<li class="breadcrumb-item"><a href="#">Library</a></li>
<li class="breadcrumb-item active" aria-current="page">Data</li>
</ol></nav>
HTML;
        $this->assertEqualsWithoutLE($expected, $out);
    }

    public function testRenderWithoutHomeLink()
    {
        Breadcrumbs::$counter = 0;
        $out = Breadcrumbs::widget([
            'homeLink' => false,
            'links' => [
                ['label' => 'Library', 'url' => '#'],
                ['label' => 'Data']
            ]
        ]);

        $expected = <<<HTML
<nav aria-label="breadcrumb"><ol id="w0" class="breadcrumb"><li class="breadcrumb-item"><a href="#">Library</a></li>
<li class="breadcrumb-item active" aria-current="page">Data</li>
</ol></nav>
HTML;

        $this->assertEqualsWithoutLE($expected, $out);
    }
}

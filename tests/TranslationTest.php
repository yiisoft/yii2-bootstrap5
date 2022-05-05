<?php
/**
 * @package yii2-bootstrap5
 * @author Simon Karlen <simi.albi@gmail.com>
 */

namespace yiiunit\extensions\bootstrap5;

use yii\bootstrap5\Alert;
use yii\bootstrap5\Breadcrumbs;

class TranslationTest extends TestCase
{
    protected function setUp()
    {
        $this->mockWebApplication([
            'language' => 'de-CH',
            'sourceLanguage' => 'en-US',
            'components' => [
                'i18n' => [
                    'translations' => [
                        'yii/bootstrap5*' => [
                            'class' => 'yii\i18n\GettextMessageSource',
                            'sourceLanguage' => 'en-US',
                            'basePath' => '@yii/bootstrap5/messages',
                        ],
                    ],
                ],
            ],
        ]);
    }

    public function testTranslatedAlert()
    {
        Alert::$counter = 0;
        $html = Alert::widget([
            'body' => '<strong>Heilige Guacamole!</strong> Das ist ein deutscher Test.',
            'options' => [
                'class' => ['alert-warning']
            ]
        ]);

        $expectedHtml = <<<HTML
<div id="w0" class="alert-warning alert alert-dismissible" role="alert">

<strong>Heilige Guacamole!</strong> Das ist ein deutscher Test.
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Schliessen"></button>

</div>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testTranslatedBreadcrumb()
    {
        Breadcrumbs::$counter = 0;
        $out = Breadcrumbs::widget([
            'links' => [
                ['label' => 'Library', 'url' => '#'],
                ['label' => 'Data']
            ]
        ]);

        $expected = <<<HTML
<nav aria-label="breadcrumb"><ol id="w0" class="breadcrumb"><li class="breadcrumb-item"><a href="/index.php">Home</a></li>
<li class="breadcrumb-item"><a href="#">Library</a></li>
<li class="breadcrumb-item active" aria-current="page">Data</li>
</ol></nav>
HTML;
        $this->assertEqualsWithoutLE($expected, $out);
    }
}

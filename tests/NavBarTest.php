<?php

namespace yiiunit\extensions\bootstrap5;

use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\bootstrap5\Offcanvas;

/**
 * Tests for NavBar widget
 *
 * @group bootstrap5
 */
class NavBarTest extends TestCase
{
    public function testRender()
    {
        NavBar::$counter = 0;

        $out = NavBar::widget([
            'brandLabel' => 'My Company',
            'brandUrl' => '/',
            'options' => [
                'class' => 'navbar-inverse navbar-static-top navbar-frontend',
            ],
        ]);

        $expected = <<<EXPECTED
<nav id="w0" class="navbar-inverse navbar-static-top navbar-frontend navbar">
<div class="container">
<a class="navbar-brand" href="/">My Company</a>
<button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#w0-collapse" aria-controls="w0-collapse" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
<div id="w0-collapse" class="collapse navbar-collapse">
</div>
</div>
</nav>
EXPECTED;

        $this->assertEqualsWithoutLE($expected, $out);
    }

    public function testBrandImage()
    {
        $out = NavBar::widget([
            'brandImage' => '/images/test.jpg',
            'brandUrl' => '/',
        ]);

        $this->assertStringContainsString('<a class="navbar-brand" href="/"><img src="/images/test.jpg" alt=""></a>', $out);
    }

    public function testBrandImageOptions()
    {
        $out = NavBar::widget([
            'brandImage' => '/images/test.jpg',
            'brandImageOptions' => ['alt' => 'test image'],
            'brandUrl' => '/',
        ]);

        $this->assertStringContainsString('<a class="navbar-brand" href="/"><img src="/images/test.jpg" alt="test image"></a>', $out);
    }

    public function testBrandLink()
    {
        $out = NavBar::widget([
            'brandLabel' => 'Yii Framework',
            'brandUrl' => false,
        ]);

        $this->assertStringContainsString('<a class="navbar-brand" href="/index.php">Yii Framework</a>', $out);
    }

    public function testBrandSpan()
    {
        $out = NavBar::widget([
            'brandLabel' => 'Yii Framework',
            'brandUrl' => null,
        ]);

        $this->assertStringContainsString('<span class="navbar-brand">Yii Framework</span>', $out);
    }

    /**
     */
    public function testNavAndForm()
    {

        NavBar::$counter = 0;

        ob_start();
        NavBar::begin([
            'brandLabel' => 'My Company',
            'brandUrl' => '/',
            'options' => [
            ],
        ]);
        echo Nav::widget([
            'options' => [
                'class' => ['mr-auto']
            ],
            'items' => [
                ['label' => 'Home', 'url' => '#'],
                ['label' => 'Link', 'url' => '#'],
                ['label' => 'Dropdown', 'items' => [
                    ['label' => 'Action', 'url' => '#'],
                    ['label' => 'Another action', 'url' => '#'],
                    '-',
                    ['label' => 'Something else here', 'url' => '#'],
                ]]
            ]
        ]);
        echo <<<HTML
<form class="form-inline my-2 my-lg-0">
<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
</form>
HTML;
        NavBar::end();
        $out = ob_get_clean();

        $expected = <<<EXPECTED
<nav id="w0" class="navbar navbar-expand-lg navbar-light bg-light">
<div class="container">
<a class="navbar-brand" href="/">My Company</a>
<button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#w0-collapse" aria-controls="w0-collapse" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
<div id="w0-collapse" class="collapse navbar-collapse">
<ul id="w1" class="mr-auto nav"><li class="nav-item"><a class="nav-link" href="#">Home</a></li>
<li class="nav-item"><a class="nav-link" href="#">Link</a></li>
<li class="dropdown nav-item"><a class="dropdown-toggle nav-link" href="#" data-bs-toggle="dropdown" role="button" aria-expanded="false">Dropdown</a><div id="w2" class="dropdown-menu"><a class="dropdown-item" href="#">Action</a>
<a class="dropdown-item" href="#">Another action</a>
<hr class="dropdown-divider">
<a class="dropdown-item" href="#">Something else here</a></div></li></ul><form class="form-inline my-2 my-lg-0">
<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
</form></div>
</div>
</nav>
EXPECTED;

        $this->assertEqualsWithoutLE($expected, $out);
    }

    public function testOffcanvasNavigation()
    {
        NavBar::$counter = 0;

        ob_start();
        NavBar::begin([
            'brandLabel' => 'Offcanvas navbar',
            'brandUrl' => ['/'],
            'options' => [
                'class' => ['navbar', 'navbar-light', 'bg-light', 'fixed-top']
            ],
            'innerContainerOptions' => [
                'class' => ['container-fluid']
            ],
            'collapseOptions' => false,
            'offcanvasOptions' => [
                'title' => 'Offcanvas',
                'placement' => Offcanvas::PLACEMENT_END
            ]
        ]);
        echo Nav::widget([
            'options' => [
                'class' => ['navbar-nav']
            ],
            'items' => [
                ['label' => 'Home', 'url' => '#'],
                ['label' => 'Link', 'url' => '#'],
                ['label' => 'Dropdown', 'items' => [
                    ['label' => 'Action', 'url' => '#'],
                    ['label' => 'Another action', 'url' => '#'],
                    '-',
                    ['label' => 'Something else here', 'url' => '#'],
                ]]
            ]
        ]);
        NavBar::end();
        $out = ob_get_clean();

        $expected = <<<HTML
<nav id="w0" class="navbar navbar-light bg-light fixed-top">
<div class="container-fluid">
<a class="navbar-brand" href="/index.php?r=">Offcanvas navbar</a>
<button type="button" class="navbar-toggler" data-bs-toggle="offcanvas" data-bs-target="#w0-offcanvas" aria-controls="w0-offcanvas" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>

<div id="w0-offcanvas" class="offcanvas offcanvas-end" tabindex="-1" data-bs-backdrop="true" data-bs-scroll="false" aria-labelledby="w0-offcanvas-label">
<div class="offcanvas-header">
<h5 id="w0-offcanvas-label" class="offcanvas-title">Offcanvas</h5>
<button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
</div>
<div class="offcanvas-body">
<ul id="w1" class="navbar-nav nav"><li class="nav-item"><a class="nav-link" href="#">Home</a></li>
<li class="nav-item"><a class="nav-link" href="#">Link</a></li>
<li class="dropdown nav-item"><a class="dropdown-toggle nav-link" href="#" data-bs-toggle="dropdown" role="button" aria-expanded="false">Dropdown</a><div id="w2" class="dropdown-menu"><a class="dropdown-item" href="#">Action</a>
<a class="dropdown-item" href="#">Another action</a>
<hr class="dropdown-divider">
<a class="dropdown-item" href="#">Something else here</a></div></li></ul>
</div>
</div></div>
</nav>
HTML;

        $this->assertEqualsWithoutLE($expected, $out);
    }

    public function testNoCollapse()
    {
        NavBar::$counter = 0;

        $out = NavBar::widget([
            'brandLabel' => 'My Company',
            'brandUrl' => '/',
            'collapseOptions' => false,
        ]);

        $expected = <<<EXPECTED
<nav id="w0" class="navbar navbar-expand-lg navbar-light bg-light">
<div class="container">
<a class="navbar-brand" href="/">My Company</a>

</div>
</nav>
EXPECTED;

        $this->assertEqualsWithoutLE($expected, $out);
    }
}

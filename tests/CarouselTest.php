<?php

namespace yiiunit\extensions\bootstrap5;


use yii\bootstrap5\Carousel;

/**
 * @group bootstrap5
 */
class CarouselTest extends TestCase
{
    function testContainerOptions()
    {
        Carousel::$counter = 0;
        $out = Carousel::widget([
            'items' => [
                [
                    'content' => '<img src="https://via.placeholder.com/800x400?text=First+slide" class="d-block w-100">',
                    'caption' => '<h5>First slide label</h5><p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>',
                    'captionOptions' => [
                        'class' => ['d-none', 'd-md-block']
                    ]
                ],
                [
                    'content' => '<img src="https://via.placeholder.com/800x400?text=Second+slide" class="d-block w-100">',
                    'caption' => '<h5>Second slide label</h5><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>',
                    'captionOptions' => [
                        'class' => ['d-none', 'd-md-block']
                    ]
                ],
                [
                    'content' => '<img src="https://via.placeholder.com/800x400?text=Third+slide" class="d-block w-100">',
                    'caption' => '<h5>Third slide label</h5><p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>',
                    'captionOptions' => [
                        'class' => ['d-none', 'd-md-block']
                    ]
                ]
            ]
        ]);

        $expected = <<<HTML
<div id="w0" class="carousel slide" data-bs-ride="carousel">
<div class="carousel-indicators"><button type="button" class="active" data-bs-target="#w0" data-bs-slide-to="0" aria-current="true"></button>
<button type="button" data-bs-target="#w0" data-bs-slide-to="1"></button>
<button type="button" data-bs-target="#w0" data-bs-slide-to="2"></button></div>
<div class="carousel-inner"><div class="carousel-item active"><img src="https://via.placeholder.com/800x400?text=First+slide" class="d-block w-100">
<div class="d-none d-md-block carousel-caption"><h5>First slide label</h5><p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p></div></div>
<div class="carousel-item"><img src="https://via.placeholder.com/800x400?text=Second+slide" class="d-block w-100">
<div class="d-none d-md-block carousel-caption"><h5>Second slide label</h5><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p></div></div>
<div class="carousel-item"><img src="https://via.placeholder.com/800x400?text=Third+slide" class="d-block w-100">
<div class="d-none d-md-block carousel-caption"><h5>Third slide label</h5><p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p></div></div></div>
<button type="button" class="carousel-control-prev" data-bs-target="#w0" data-bs-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="visually-hidden">Previous</span></button>
<button type="button" class="carousel-control-next" data-bs-target="#w0" data-bs-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="visually-hidden">Next</span></button>
</div>

HTML;
        $this->assertEqualsWithoutLE($expected, $out);
    }

    /**
     */
    public function testCrossfade()
    {
        Carousel::$counter = 0;
        $out = Carousel::widget([
            'crossfade' => true,
            'items' => [
                [
                    'content' => '<img src="https://via.placeholder.com/800x400?text=First+slide" class="d-block w-100">',
                    'caption' => '<h5>First slide label</h5><p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>',
                    'captionOptions' => [
                        'class' => ['d-none', 'd-md-block']
                    ]
                ],
                [
                    'content' => '<img src="https://via.placeholder.com/800x400?text=Second+slide" class="d-block w-100">',
                    'caption' => '<h5>Second slide label</h5><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>',
                    'captionOptions' => [
                        'class' => ['d-none', 'd-md-block']
                    ]
                ],
                [
                    'content' => '<img src="https://via.placeholder.com/800x400?text=Third+slide" class="d-block w-100">',
                    'caption' => '<h5>Third slide label</h5><p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>',
                    'captionOptions' => [
                        'class' => ['d-none', 'd-md-block']
                    ]
                ]
            ]
        ]);

        $this->assertStringContainsString('class="carousel slide carousel-fade"', $out);
    }
}

Basic Usage
===========

Yii doesn't wrap the Bootstrap basics into PHP code since HTML is very simple by itself in this case. You can find details
about using the basics at [Bootstrap documentation](https://getbootstrap.com/docs/). Still Yii provides a convenient
way to include Bootstrap assets in your pages with a line(s) added to `@app/assets/AppAsset.php`(basic application):

```php
public $depends = [
    <...>
    yii\bootstrap5\BootstrapAsset::class,
    // optional, Bootstrap icons
    // yii\bootstrap5\BootstrapIconAsset::class
];
```

Using Bootstrap through Yii asset manager allows you to minimize its resources and combine with your own resources when
needed.

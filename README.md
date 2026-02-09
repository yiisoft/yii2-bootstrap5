<p align="center">
    <picture>
        <source media="(prefers-color-scheme: dark)" srcset="https://www.yiiframework.com/image/yii_logo_light.svg">
        <source media="(prefers-color-scheme: light)" srcset="https://www.yiiframework.com/image/yii_logo_dark.svg">
        <img src="https://www.yiiframework.com/image/yii_logo_dark.svg" alt="Yii Framework" height="100px">
    </picture>
    <h1 align="center">Twitter Bootstrap 5 Extension for Yii 2</h1>
    <br>
</p>

This is the Twitter Bootstrap extension for [Yii framework 2.0](https://www.yiiframework.com). It encapsulates [Bootstrap 5](https://getbootstrap.com/) components
and plugins in terms of Yii widgets, and thus makes using Bootstrap components/plugins
in Yii applications extremely easy.

For license information check the [LICENSE](LICENSE.md)-file.

Documentation is at [docs/guide/README.md](docs/guide/README.md).

[![Latest Stable Version](https://img.shields.io/packagist/v/yiisoft/yii2-bootstrap5.svg?style=for-the-badge&label=Stable&logo=packagist)](https://packagist.org/packages/yiisoft/yii2-bootstrap5)
[![Total Downloads](https://img.shields.io/packagist/dt/yiisoft/yii2-bootstrap5.svg?style=for-the-badge&label=Downloads)](https://packagist.org/packages/yiisoft/yii2-bootstrap5)
[![build](https://img.shields.io/github/actions/workflow/status/yiisoft/yii2-bootstrap5/build.yml?style=for-the-badge&logo=github&label=Build)](https://github.com/yiisoft/yii2-bootstrap5/actions?query=workflow%3Abuild)
[![codecov](https://img.shields.io/codecov/c/github/yiisoft/yii2-bootstrap5.svg?style=for-the-badge&logo=codecov&logoColor=white&label=Codecov)](https://codecov.io/gh/yiisoft/yii2-bootstrap5)
[![Static Analysis](https://img.shields.io/github/actions/workflow/status/yiisoft/yii2-bootstrap5/static.yml?style=for-the-badge&label=Static)](https://github.com/yiisoft/yii2-bootstrap5/actions/workflows/static.yml)

Installation
------------

> [!IMPORTANT]
> - The minimum required [PHP](https://www.php.net/) version is PHP `7.4`.
> - It works best with PHP `8`.

The preferred way to install this extension is through [composer](https://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist yiisoft/yii2-bootstrap5
```

or add

```
"yiisoft/yii2-bootstrap5": "*"
```

to the require section of your `composer.json` file.

Translations
----

The i18n configuration will be automatically added to your application configuration via bootstrapping process.

Usage
----

For example, the following
single line of code in a view file would render a Bootstrap Progress plugin:

```php
<?= yii\bootstrap5\Progress::widget(['percent' => 60, 'label' => 'test']) ?>
```

## Documentation

- [Internals](docs/internals.md)

## Support the project

[![Open Collective](https://img.shields.io/badge/Open%20Collective-sponsor-7eadf1?style=for-the-badge&logo=open%20collective&logoColor=7eadf1&labelColor=555555)](https://opencollective.com/yiisoft)

## Follow updates

[![Official website](https://img.shields.io/badge/Powered_by-Yii_Framework-green.svg?style=for-the-badge&logo=yii)](https://www.yiiframework.com/)
[![Follow on X](https://img.shields.io/badge/-Follow%20on%20X-1DA1F2.svg?style=for-the-badge&logo=x&logoColor=white&labelColor=000000)](https://x.com/yiiframework)
[![Telegram](https://img.shields.io/badge/telegram-join-1DA1F2?style=for-the-badge&logo=telegram)](https://t.me/yii_framework_in_english)
[![Slack](https://img.shields.io/badge/slack-join-1DA1F2?style=for-the-badge&logo=slack)](https://yiiframework.com/go/slack)

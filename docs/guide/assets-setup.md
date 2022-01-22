Assets Setup
============

This extensions relies on [Bower](http://bower.io/) and/or [NPM](https://www.npmjs.org/) packages for the asset installation.
Before using this package you should decide in which way you will install those packages in your project.


## Using asset-packagist repository

You can setup [asset-packagist.org](https://asset-packagist.org) as package source for the Bootstrap assets.

In the `composer.json` of your project, add the following lines:

```json
"repositories": [
    {
        "type": "composer",
        "url": "https://asset-packagist.org"
    }
]
```

Adjust `@npm` and `@bower` in you application configuration:

```php
return [
    //...
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    //...
];
```


## Using composer asset plugin

Install [composer asset plugin](https://github.com/francoispluchino/composer-asset-plugin/) globally, using following command:

```
composer global require "fxp/composer-asset-plugin:^1.4.0"
```

Add the following lines to `composer.json` of your project to adjust directories where the installed packages
will be placed, if you want to publish them using Yii:

```json
"extra": {
    "asset-installer-paths": {
        "npm-asset-library": "vendor/npm",
        "bower-asset-library": "vendor/bower"
    }
}
```

Then you can run composer install/update command to pick up Bootstrap assets.

> Note: `fxp/composer-asset-plugin` significantly slows down the `composer update` command in comparison
  to asset-packagist.


## Using Bower/NPM client directly

You can install Bootstrap assets directly via Bower or NPM client.
In the `package.json` of your project, add the following lines:

```json
{
    ...
    "dependencies": {
        "bootstrap": "5.1",
        ...
    }
    ...
}
```

In the `composer.json` of your project, add the following lines in order to prevent redundant Bootstrap asset installation:

```json
"replace": {
    "npm-asset/bootstrap": ">=5.1"
},
```


## Using CDN

You may use Bootstrap assets from [official CDN](https://www.bootstrapcdn.com).

In the `composer.json` of your project, add the following lines in order to prevent redundant Bootstrap asset installation:

```json
"replace": {
    "npm-asset/bootstrap": ">=5.1"
},
```

Configure 'assetManager' application component, overriding Bootstrap asset bundles with CDN links:

```php
return [
    'components' => [
        'assetManager' => [
            // override bundles to use CDN :
            'bundles' => [
                'yii\bootstrap5\BootstrapAsset' => [
                    'sourcePath' => null,
                    'baseUrl' => 'https://cdn.jsdelivr.net/npm/bootstrap@5.1/dist/',
                    'css' => [
                        'css/bootstrap.min.css'
                    ],
                ],
                'yii\bootstrap5\BootstrapPluginAsset' => [
                    'sourcePath' => null,
                    'baseUrl' => 'https://cdn.jsdelivr.net/npm/bootstrap@5.1/dist/',
                    'js' => [
                        'js/bootstrap.bundle.min.js'
                    ],
                ],
            ],
        ],
        // ...
    ],
    // ...
];
```


## Compiling from the .sass files

If you want to customize the Bootstrap CSS source directly, you may want to compile it from source *.sass files.

In such case installing Bootstrap assets from Composer or Bower/NPM makes no sense, since you can not modify files
inside 'vendor' directory.
You'll have to download Bootstrap assets manually and place them somewhere inside your project source code,
for example in the 'assets/source/bootstrap' folder.

In the `composer.json` of your project, add the following lines in order to prevent redundant Bootstrap asset installation:

```json
"replace": {
    "npm-asset/bootstrap": ">=5.1"
},
```

Configure 'assetManager' application component, overriding Bootstrap asset bundles:

```php
return [
    'components' => [
        'assetManager' => [
            // override bundles to use local project files :
            'bundles' => [
                'yii\bootstrap5\BootstrapAsset' => [
                    'sourcePath' => '@app/assets/source/bootstrap/dist',
                    'css' => [
                        YII_ENV_DEV ? 'css/bootstrap.css' : 'css/bootstrap.min.css',
                    ],
                ],
                'yii\bootstrap5\BootstrapPluginAsset' => [
                    'sourcePath' => '@app/assets/source/bootstrap/dist',
                    'js' => [
                        YII_ENV_DEV ? 'js/bootstrap.js' : 'js/bootstrap.min.js',
                    ]
                ],
            ],
        ],
        // ...
    ],
    // ...
];
```

After you make changes to Bootstrap's source files, make sure to [compile them](https://getbootstrap.com/docs/5.1/getting-started/contribute/#using-npm-scripts), eg. using `npm run dist`.

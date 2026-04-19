[!WARNING]
**⚠️ This project has been archived and is no longer maintained. ⚠️**

Github has shown it does not respect its users. Other have said it better than I can.

- https://www.theregister.com/2022/06/30/software_freedom_conservancy_quits_github/
- https://www.andrlik.org/dispatches/migrating-from-github-motivation/
- https://techresolve.blog/2025/12/27/looking-to-migrate-company-off-github-whats-the/
- https://lord.io/leaving-github/
- https://dev.to/alanwest/how-to-actually-migrate-from-github-to-codeberg-without-losing-your-mind-33bf>
> Development has moved to Codeberg:
> **➡️ https://codeberg.org/DavidJEddy/yii2-freeradius-module**
>
> Please update your remotes:
> ```bash
> git remote set-url origin https://codeberg.org/DavidJEddy/yii2-freeradius-module
> ```

---
# yii2-freeradius-module

Module to interface with a FreeRADIUS server

# Badges
[![Latest Stable Version](https://poser.pugx.org/davidjeddy/yii2-freeradius-module/v/stable?format=flat-square)](https://packagist.org/packages/davidjeddy/yii2-freeradius-module)
[![Total Downloads](https://poser.pugx.org/davidjeddy/yii2-freeradius-module/downloads)](https://packagist.org/packages/davidjeddy/yii2-freeradius-module)
[![Latest Unstable Version](https://poser.pugx.org/davidjeddy/yii2-freeradius-module/v/unstable?format=flat-square)](https://packagist.org/packages/davidjeddy/yii2-freeradius-module)
[![License](https://poser.pugx.org/davidjeddy/yii2-freeradius-module/license?format=flat-square)](https://packagist.org/packages/davidjeddy/yii2-freeradius-module)
[![Monthly Downloads](https://poser.pugx.org/davidjeddy/yii2-freeradius-module/d/monthly?format=flat-square)](https://packagist.org/packages/davidjeddy/yii2-freeradius-module)
[![Daily Downloads](https://poser.pugx.org/davidjeddy/yii2-freeradius-module/d/daily?format=flat-square)](https://packagist.org/packages/davidjeddy/yii2-freeradius-module)
[![composer.lock](https://poser.pugx.org/davidjeddy/yii2-freeradius-module/composerlock?format=flat-square)](https://packagist.org/packages/davidjeddy/yii2-freeradius-module)

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/0137c455-b0f7-482b-982e-182521bc2a11/big.png)](https://insight.sensiolabs.com/projects/0137c455-b0f7-482b-982e-182521bc2a11)

# REQUIREMENTS
PHP 7+

MySQL 5.5+

FreeRadius

Composer

Yii 2+ (advanced tempplate recommended)

# INSTALLATION
 + `cd {project root}`
 + Run `composer require davidjeddy/yii2-freeradius-module` in terminal
     + OR add `"davidjeddy/yii2-freeradius-module": "dev-master@dev"` to your project's  `composer.json`, then `composer install`.

# USAGE
Add the module to the configuration

```PHP
return [
    ...
    'modules' => [
        ...
        'free-radius' => [
            'class' => davidjeddy\freeradius\Module::class,
        ],
        ...
    ],
];

```

To add to a typical AdminLTE admin panel:

Edit ./backend/views/layouts/common.php and add the following inside `Menu::widget([ ... ])`
```
    [
        'label'     => Yii::t('backend', 'Free Radius'),
        'icon'      => '<i class="fa fa-id-card-o"></i>',
        'url'       => ['/free-radius/default/index'],
        'visible'   => Yii::$app->user->can('administrator')
    ],
```

# TESTING
TODO

# Misc
If the server does not yet have a `RadCheck` table from FreeRadius, run

the modules migration from the project root:

`php ./console/yii migrate/up --migrationPath=./vendor/davidjeddy/yii2-freeradius-module/migration/`
# yii2-freeradius-module

Module to interface with a FreeRADIUS server


# Badges


# REQUIREMENTS

Linux
FreeRadius
MySQL 5.5+
Composer
Yii 2+


# INSTALLATION

Recommended way is with Composer.
 + Run `composer require davidjeddy/yii2-freeradius-module` on the terminal in your {project root}.
 + OR add `"davidjeddy/yii2-freeradius-module": "dev-master@dev"` to your projects `composer.json` and unpdate.
 + Enbable the module in your apps config/web.config module list


# TESTING


# USAGE

Add the module to the configuration

```PHP
return [
    ...
    'modules' => [
        ...
        'free-radius' => [
            'class' => 'davidjeddy\freeradius\Module',
        ],
        ...
    ],
...    
```

IF the server does not yet had a radcheck table from FreeRadius, run this from the project root:
`./yii migrate/up --migrationPath=./vendor/davidjeddy/yii2-freeradius-module/migration/`


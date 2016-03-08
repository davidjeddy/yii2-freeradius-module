[![SensioLabsInsight](https://insight.sensiolabs.com/projects/0137c455-b0f7-482b-982e-182521bc2a11/big.png)](https://insight.sensiolabs.com/projects/0137c455-b0f7-482b-982e-182521bc2a11)

# yii2-freeradius-module

Module to interface with a FreeRADIUS server


# Badges


# REQUIREMENTS

MySQL 5.5+
FreeRadius
Composer
Yii 2+


# INSTALLATION

 + `cd {project root}`
 + Run `composer require davidjeddy/yii2-freeradius-module` in terminal
 + OR add `"davidjeddy/yii2-freeradius-module": "dev-master@dev"` to your project's  `composer.json`, then `composer install`.
 + Enbable the module in your apps config/web.config module list


# TESTING

Needed

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

IF the server does not yet have a `radcheck` table from FreeRadius, run the modules migration from the project root:
`./yii migrate/up --migrationPath=./vendor/davidjeddy/yii2-freeradius-module/migration/`


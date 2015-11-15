<?php

namespace davidjeddy\freeradius;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'davidjeddy\freeradius\controllers';
    public $defaultRoute        = 'default/index';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}

<?php

namespace davidjeddy\freeradius;

/**
 * Class Module
 *
 * @package davidjeddy\freeradius
 */
class Module extends \yii\base\Module
{
    /**
     * @var string
     */
    public $controllerNamespace = 'davidjeddy\freeradius\controllers';

    /**
     * @var string
     */
    public $defaultRoute        = 'default/index';
}

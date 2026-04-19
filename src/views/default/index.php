<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Radchecks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="RadCheck-index">

    <h1><?php echo Html::encode($this->title) ?></h1>

    <p>
        <?php echo Html::a('Create Radcheck', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'username',
            //'attribute',
            'op',
            // 'value:datetime',
            [
                'label' => 'Attribute',
                'value' => function (\davidjeddy\freeradius\models\RadCheck $model, $key, $value, $widget) {
                    if ($model->attribute == 'expiration' && is_numeric($model->value)) {
                        // expiration
                        // Jan 1, 1970, 12:00:00 AM
                        return date('M. d, Y, H:m:i A', $model->value);
                    } elseif (strstr($model->attribute, 'clear-password') ) {
                        // clear password
                        return $model->value;
                    } elseif (strstr($model->attribute, 'password') ) {
                        // other password
                        return false;
                    } else {
                        // other data
                        return $model->value;
                    }

                    return false;
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>

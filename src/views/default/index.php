<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Radchecks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="radcheck-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Radcheck', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            'username',
            'attribute',
            'op',
            // 'value:datetime',
            [
                'label' => 'attribute',
                'value' => function ($model, $key, $value, $widget) {
                    if ($model->value == 'expiration' &&is_numeric($model->value)) {
                        // expiration
                        return date($model->value);
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

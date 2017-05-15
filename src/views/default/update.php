<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\FreeRadius\models\RadCheck */

$this->title = 'Update Radcheck: ' . ' ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Radchecks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="RadCheck-update">

    <h1><?php echo Html::encode($this->title) ?></h1>

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

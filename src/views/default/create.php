<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\FreeRadius\models\RadCheck */

$this->title = 'Create New Entery';
$this->params['breadcrumbs'][] = ['label' => 'Radchecks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="RadCheck-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

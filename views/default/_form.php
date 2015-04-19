<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\FreeRadius\models\radcheck */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="radcheck-form">

    <?php $form = ActiveForm::begin(); ?>

	<?php // show approp. form based on action. 'create' or 'update' ?>
	<?php if ($model->isNewRecord  == true) { ?>
		<?= $form->field($model, 'username')->textInput(['maxlength' => 32]) ?>
		<?= $form->field($model, 'attribute')->textInput(['maxlength' => 32]) ?>
		<?= $form->field($model, 'op')->textInput(['maxlength' => 2]) ?>
		<?= $form->field($model, 'value')->textInput(['maxlength' => 32]) ?>
	<?php } elseif ($model->isNewRecord  == false) { ?>
	    <?= $form->field($model, 'username')->textInput(['maxlength' => 32, 'disabled' => true]) ?>
		<?= $form->field($model, 'attribute')->textInput(['maxlength' => 32, 'disabled' => true]) ?>
		<?= $form->field($model, 'op')->hiddenInput(['maxlength' => 2])->label(false) ?>
		<?= $form->field($model, 'value')->textInput(['maxlength' => 32]) ?>
	<?php } ?>

    <div class="form-group">
        <?= Html::submitButton(
        	$model->isNewRecord ? 'Create' : 'Update',
        	['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']
        ) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

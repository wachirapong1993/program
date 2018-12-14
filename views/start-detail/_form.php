<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\StartDetail */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="start-detail-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'start_program_id')->textInput() ?>

    <?= $form->field($model, 'check_feeder')->textInput() ?>

    <?= $form->field($model, 'check_part')->textInput() ?>

    <?= $form->field($model, 'lot_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'total')->textInput() ?>

    <?= $form->field($model, 'qc_status_id')->textInput() ?>

    <?= $form->field($model, 'part_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'feeder_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\QcConfirm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="qc-confirm-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'check_feeder')->textInput() ?>

    <?= $form->field($model, 'check_part')->textInput() ?>

    <?= $form->field($model, 'qc_emp')->textInput() ?>

    <?= $form->field($model, 'start_detail_id')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'feeder')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'part_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'qc_status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

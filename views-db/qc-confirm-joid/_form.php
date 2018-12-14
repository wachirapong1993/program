<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\QcConfirmJoid */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="qc-confirm-joid-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'check_feeder')->textInput() ?>

    <?= $form->field($model, 'check_part')->textInput() ?>

    <?= $form->field($model, 'joid_part_id')->textInput() ?>

    <?= $form->field($model, 'qc_status')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

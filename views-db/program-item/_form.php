<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProgramItem */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="program-item-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'program_detail_id')->textInput() ?>

    <?= $form->field($model, 'feeder_id')->textInput() ?>

    <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'amount')->textInput() ?>

    <?= $form->field($model, 'part_no')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

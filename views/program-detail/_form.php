<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProgramDetail */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="program-detail-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'barcode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'program_id')->textInput() ?>

    <?= $form->field($model, 'solder_paste')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'table_machine_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

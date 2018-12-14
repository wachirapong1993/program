<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ArrangementDetail */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="arrangement-detail-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'arrangement_id')->textInput() ?>

    <?= $form->field($model, 'item_celco_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'feeder_id')->textInput() ?>

    <?= $form->field($model, 'comment')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'amount')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ArrangementDetailSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="arrangement-detail-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'arrangement_id') ?>

    <?= $form->field($model, 'item_celco_code') ?>

    <?= $form->field($model, 'feeder_id') ?>

    <?= $form->field($model, 'comment') ?>

    <?php // echo $form->field($model, 'amount') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

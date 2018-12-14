<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ItemSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="item-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'part_no') ?>

    <?= $form->field($model, 'part_name') ?>

    <?= $form->field($model, 'part_type') ?>

    <?= $form->field($model, 'celco_code') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'part_size') ?>

    <!-- <?= $form->field($model, 'position') ?> -->

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

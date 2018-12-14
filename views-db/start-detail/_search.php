<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\StartDetailSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="start-detail-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'start_program_id') ?>

    <?= $form->field($model, 'check_feeder') ?>

    <?= $form->field($model, 'check_part') ?>

    <?= $form->field($model, 'lot_no') ?>

    <?php // echo $form->field($model, 'total') ?>

    <?php // echo $form->field($model, 'qc_status_id') ?>

    <?php // echo $form->field($model, 'part_no') ?>

    <?php // echo $form->field($model, 'feeder_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

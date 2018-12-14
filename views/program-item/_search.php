<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProgramItemSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="program-item-search">

    <?php
    $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
    ]);
    ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'program_detail_id') ?>

    <?= $form->field($model, 'feeder_id') ?>

    <?= $form->field($model, 'comment') ?>

    <?= $form->field($model, 'amount') ?>

    <?= $form->field($model, 'program') ?>
    <?= $form->field($model, 'tbl') ?>
    <?= $form->field($model, 'customer') ?>
    <?= $form->field($model, 'part_type') ?>



    <?php // echo $form->field($model, 'part_no')  ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

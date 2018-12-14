<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\QcConfirmSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="qc-confirm-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'check_feeder') ?>

    <?= $form->field($model, 'check_part') ?>

    <?= $form->field($model, 'qc_emp') ?>

    <?= $form->field($model, 'start_detail_id') ?>

    <?php echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'feeder') ?>

    <?php // echo $form->field($model, 'part_no') ?>

    <?php // echo $form->field($model, 'qc_status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

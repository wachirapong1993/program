<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\JoidPart */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="joid-part-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'lot_no')->textInput() ?>

    <?= $form->field($model, 'total')->textInput() ?>

    

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

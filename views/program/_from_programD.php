<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\ProgramItem;
/* @var $this yii\web\View */
/* @var $model app\models\Pcb */
/* @var $form yii\widgets\ActiveForm */
$modelI = new ProgramItem();
?>

<div class="pcb-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($modelI, 'feeder_id')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

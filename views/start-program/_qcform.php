<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\QcConfirm */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Put Employee Code';
$this->params['breadcrumbs'][] = ['label' => 'Put Employee Code', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="qc-confirm-form">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php $form = ActiveForm::begin(); ?>

 

    <?= $form->field($model, 'qc_emp')->textInput() ?>

    <?= $form->field($model, 'start_detail_id')->hiddenInput(['value'=>$id])->label(false) ?>

    

<!--    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>-->

    <?php ActiveForm::end(); ?>

</div>

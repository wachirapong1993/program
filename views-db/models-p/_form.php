<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\ModelsP */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="models-p-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'customer_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(app\models\Customer::find()->all(), 'id', 'name'),
        'options' => ['placeholder' => 'Select Customer'],
        'pluginOptions' => [
            'allowClear' => true,
        //   'minimumInputLength' => 2,
        ],])
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

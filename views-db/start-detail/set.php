<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Pcb */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pcb-form">

    <?php $form = ActiveForm::begin(['id'=>'myForm']); ?>

    <?= $form->field($model, 'program')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script>

   

    function submitform()
{
  alert('test');
  document.getElementById("w0").submit();
}
    </script>
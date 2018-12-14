<?php

use yii\helpers\Html;
use kartik\select2\Select2;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\widgets\ActiveForm;
use kartik\widgets\DepDrop;
use app\models\Customer;
use app\models\ModelsP;
use app\models\Program;

/* @var $this yii\web\View */
/* @var $model app\models\StartMain */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="start-main-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=
    $form->field($model, 'customer_id')->dropdownList(
            ArrayHelper::map(Customer::find()->all(), 'id', 'name'), [
        'id' => 'ddl-customer',
        'prompt' => 'Select Customer'
    ]);
    ?>
    <?=
    $form->field($model, 'models_id')->widget(DepDrop::classname(), [
        'options' => ['id' => 'ddl-models'],
        'data' => [],
        'pluginOptions' => [
            'depends' => ['ddl-customer'],
            'placeholder' => 'Select Customer...',
            'url' => Url::to(['/start-main/get-models'])
        ]
    ]);
    ?>
    <?=
    $form->field($model, 'Line_id')->widget(DepDrop::classname(), [
        'options' => ['id' => 'ddl-line'],
        'data' => [],
        'pluginOptions' => [
            'depends' => ['ddl-customer', 'ddl-models'],
            //  'value'=>'4',
            'placeholder' => 'Select Line...',
            'url' => Url::to(['/start-main/get-line'])
        ]
    ]);
    ?>
   


    <?=
    $form->field($model, 'program_id')->widget(DepDrop::classname(), [
        'options' => ['id' => 'ddl-program'],
        'data' => [],
        'pluginOptions' => [
            'depends' => ['ddl-customer', 'ddl-models', 'ddl-line'],
            'placeholder' => 'Select Machince...',
            'url' => Url::to(['/start-main/get-program'])
        ]
    ]);
    ?>


    



    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

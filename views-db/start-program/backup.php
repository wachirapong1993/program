<?php

use yii\helpers\Html;
use kartik\select2\Select2;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use kartik\widgets\DepDrop;
use app\models\Customer;
use app\models\ModelsP;
use app\models\Program;
/* @var $this yii\web\View */
/* @var $model app\models\StartProgram */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="start-program-form">

    <?php $form = ActiveForm::begin(['layout'=>'horizontal']); ?>

    <?= $form->field($model, 'emp_code')->textInput() ?>
    
    <?=
    $form->field($model, 'customer_id')->dropdownList(
            ArrayHelper::map(Customer::find()->all(), 'id', 'name'), [
        'id' => 'ddl-customer',
        'prompt' => 'Select Customer'
    ])->label('Customer');
    ?>
    <?=
    $form->field($model, 'models')->widget(DepDrop::classname(), [
        'options' => ['id' => 'ddl-models'],
        'data' => [],
        'pluginOptions' => [
            'depends' => ['ddl-customer'],
            'placeholder' => 'Select Customer...',
            'url' => Url::to(['/start-program/get-models'])
        ]
    ]);
    ?>

    <?=
    $form->field($model, 'mainprogram')->widget(DepDrop::classname(), [
        'options' => ['id' => 'ddl-mainprogram'],
        'data' => [],
        'pluginOptions' => [
            'depends' => ['ddl-customer', 'ddl-models'],
            'placeholder' => 'Select Mainprogram...',
            'url' => Url::to(['/start-program/get-mainprogram'])
        ]
    ]);
    ?>


    <?= $form->field($model, 'program_detail_id')->widget(DepDrop::classname(), [
        'options' => ['id' => 'ddl-subprogram'],
        'data' => [],
        'pluginOptions' => [
            'depends' => ['ddl-customer', 'ddl-models','ddl-mainprogram'],
            'placeholder' => 'Select Subprogram...',
            'url' => Url::to(['/start-program/get-subprogram'])
        ]
    ]);
    ?>

  


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

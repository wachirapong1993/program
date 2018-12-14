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

<div class="container">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>

  

    <?=
    $form->field($model, 'customer_id')->dropdownList(
            ArrayHelper::map(Customer::find()->all(), 'id', 'name'), [
        'id' => 'ddl-customer',
        'prompt' => 'Select Customer'
    ]);
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
    $form->field($model, 'line')->widget(DepDrop::classname(), [
        'options' => ['id' => 'ddl-line'],
        'data' => [],
        'pluginOptions' => [
            'depends' => ['ddl-customer','ddl-models'],
          //  'value'=>'4',
            'placeholder' => 'Select Line...',
            'url' => Url::to(['/start-program/get-line'])
        ]
    ]);
    ?>
    <?=
    $form->field($model, 'machine')->widget(DepDrop::classname(), [
        'options' => ['id' => 'ddl-machine'],
        'data' => [],
        'pluginOptions' => [
            'depends' => ['ddl-customer','ddl-models','ddl-line'],
            'placeholder' => 'Select Machince...',
            'url' => Url::to(['/start-program/get-machine'])
        ]
    ]);
    ?>

    <?=
    $form->field($model, 'tblmc')->widget(DepDrop::classname(), [
        'options' => ['id' => 'ddl-tblmc'],
        'data' => [],
        'pluginOptions' => [
            'depends' => ['ddl-customer','ddl-models','ddl-line','ddl-machine'],
            'placeholder' => 'Select MachineTable...',
            'url' => Url::to(['/start-program/get-tblmc'])
        ]
    ]);
    ?>
    <?=
    $form->field($model, 'program_detail_id')->widget(DepDrop::classname(), [
        'options' => ['id' => 'ddl-mainprogram'],
        'data' => [],
        'pluginOptions' => [
            'depends' => ['ddl-customer','ddl-models','ddl-line','ddl-machine','ddl-tblmc'],
            'placeholder' => 'Select Mainprogram...',
            'url' => Url::to(['/start-program/get-mainprogram'])
        ]
    ]);
    ?>


    


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success','data' => [
            'confirm' => 'Are you sure you want to Next this item?',
            'method' => 'post',
        ],
        //   'target' => '_blank',
        //a 'data-toggle' => 'tooltip',
        'title' => 'Will open the generated PDF file in a new window'
    ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;
use kartik\select2\Select2;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\widgets\DepDrop;
use app\models\Customer;
use app\models\ModelsP;
use app\models\Program;
use kartik\daterange\DateRangePicker;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\StartProgram */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Search for Report';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php $form = ActiveForm::begin([]); ?>



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
            'placeholder' => 'Select Models...',
            'url' => Url::to(['/report/get-models'])
        ]
    ]);
    ?>
    <?=
    $form->field($model, 'line')->widget(DepDrop::classname(), [
        'options' => ['id' => 'ddl-line'],
        'data' => [],
        'pluginOptions' => [
            'depends' => ['ddl-customer', 'ddl-models'],
            //  'value'=>'4',
            'placeholder' => 'Select Line...',
            'url' => Url::to(['/report/get-line'])
        ]
    ]);
    ?>
    <?=
    $form->field($model, 'machine')->widget(DepDrop::classname(), [
        'options' => ['id' => 'ddl-machine'],
        'data' => [],
        'pluginOptions' => [
            'depends' => ['ddl-customer', 'ddl-models', 'ddl-line'],
            'placeholder' => 'Select Machince...',
            'url' => Url::to(['/report/get-machine'])
        ]
    ]);
    ?>

    <?=
    $form->field($model, 'tblmc')->widget(DepDrop::classname(), [
        'options' => ['id' => 'ddl-tblmc'],
        'data' => [],
        'pluginOptions' => [
            'depends' => ['ddl-customer', 'ddl-models', 'ddl-line', 'ddl-machine'],
            'placeholder' => 'Select MachineTable...',
            'url' => Url::to(['/report/get-tblmc'])
        ]
    ]);
    ?>
    <?=
    $form->field($model, 'program_detail_id')->widget(DepDrop::classname(), [
        'options' => ['id' => 'ddl-mainprogram'],
        'data' => [],
        'pluginOptions' => [
            'depends' => ['ddl-customer', 'ddl-models', 'ddl-line', 'ddl-machine', 'ddl-tblmc'],
            'placeholder' => 'Select Mainprogram...',
            'url' => Url::to(['/report/get-mainprogram'])
        ]
    ]);
    ?>
    <?=
    $form->field($model, 'createTimeRange', [
        'addon' => ['prepend' => ['content' => '<i class="fas fa-calendar-alt"></i>']],
        'options' => ['class' => 'drp-container form-group']
    ])->widget(DateRangePicker::classname(), [
        'value' => '2018-10-04 - 2018-11-14',
        //'attribute' => 'createTimeRange',
        'useWithAddon' => true,
        'convertFormat' => true,
        'startAttribute' => 'createTimeStart',
        'endAttribute' => 'createTimeEnd',
        'pluginOptions' => [
            'timePicker' => true,
            'timePickerIncrement' => 30,
            'locale' => [
                'format' => 'Y-m-d h:i A'
            ]
        ]
    ]);
    ?>




    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success', 'onclick' => '(function ( $event ) { alert("Please Recheck The Data"); })();']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

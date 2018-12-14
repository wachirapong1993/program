<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\widgets\DepDrop;
use kartik\select2\Select2;
use app\models\Line;
use app\models\Machine;
use app\models\TableMachine;
use kartik\widgets\DatePicker;
use wbraganca\dynamicform\DynamicFormWidget;

/* @var $this yii\web\View */
/* @var $model app\models\Arrangement */
/* @var $form yii\widgets\ActiveForm */

//$js = '
//jQuery(".dynamicform_wrapper").on("afterInsert", function(e, item) {
//    jQuery(".dynamicform_wrapper .panel-title-address").each(function(index) {
//        jQuery(this).html("Address: " + (index + 1))
//    });
//});
//
//jQuery(".dynamicform_wrapper").on("afterDelete", function(e) {
//    jQuery(".dynamicform_wrapper .panel-title-address").each(function(index) {
//        jQuery(this).html("Address: " + (index + 1))
//    });
//});
//';
?>

<div class="arrangement-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

    <?=
    $form->field($model, 'Line_id')->dropdownList(
            ArrayHelper::map(Line::find()->all(), 'id', 'name'), [
        'id' => 'ddl-line',
        'prompt' => 'Select Line'
    ]);
    ?>
    <?=
    $form->field($model, 'machine_id')->widget(DepDrop::classname(), [
        'options' => ['id' => 'ddl-machine'],
        'data' => [],
        'pluginOptions' => [
            'depends' => ['ddl-line'],
            'placeholder' => 'Select Machince...',
            'url' => Url::to(['/arrangement/get-machine'])
        ]
    ]);
    ?>

    <?=
    $form->field($model, 'table_machine_id')->widget(DepDrop::classname(), [
        'options'=>['id'=>'ddl-table_machine_id'],
        'data' => [],
        'pluginOptions' => [
            'depends' => ['ddl-line', 'ddl-machine'],
            'placeholder' => 'Select MachineTable...',
            'url' => Url::to(['/arrangement/get-machinetable'])
        ]
    ]);
    ?>
     <?=
    $form->field($modela, 'feeder_id')->widget(DepDrop::classname(), [
        'options'=>['id'=>'ddl-feeder_id'],
        'data' => [],
        'pluginOptions' => [
            'depends' => ['ddl-line', 'ddl-machine','ddl-table_machine_id'],
            'placeholder' => 'Select Feeder...',
            'url' => Url::to(['/arrangement/get-feeder'])
        ]
    ]);
    ?>
    
    <?=
    $form->field($model, 'pcb_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(app\models\Pcb::find()->all(), 'id', 'name'),
        'options' => ['placeholder' => 'Select PCB'],
        'pluginOptions' => [
            'allowClear' => true,
        //   'minimumInputLength' => 2,
        ],])
    ?>

    <?=
    $form->field($model, 'program_detail_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(app\models\ProgramDetail::find()->all(), 'id', 'title'),
        'options' => ['placeholder' => 'Select Program'],
        'pluginOptions' => [
            'allowClear' => true,
        //   'minimumInputLength' => 2,
        ],])
    ?>

    <?=
    $form->field($model, 'created_date')->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'Enter event time ...'],
        'pluginOptions' => [
            'autoclose' => true
        ]
    ]);
    ?>

    <?= $form->field($model, 'solder_paste')->textarea(['maxlength' => true]) ?>

    <?= $form->field($model, 'rev')->textInput() ?>



    <div class="form-group">
    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

<?php ActiveForm::end(); ?>

</div>

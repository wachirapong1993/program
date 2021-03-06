<?php

use yii\helpers\Html;
use kartik\select2\Select2;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use kartik\widgets\DepDrop;
use app\models\Line;
use app\models\Machine;
use app\models\TableMachine;

/* @var $this yii\web\View */
/* @var $model app\models\Program */
/* @var $form yii\widgets\ActiveForm */
?>


<div class="program-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data'], 'layout' => 'horizontal']); ?>



    <?=
    $form->field($model, 'models_p_id')->dropdownList(
            ArrayHelper::map(app\models\ModelsP::find()->all(), 'id', 'name', 'customer.name'), [
        'id' => 'ddl-models',
        'prompt' => 'Select Line'
    ]);
    ?>


    <?=
    $form->field($model, 'Line_id')->widget(DepDrop::classname(), [
        'options' => ['id' => 'ddl-line'],
        'data' => [],
        'pluginOptions' => [
            'depends' => ['ddl-models'],
            'placeholder' => 'Select Machince...',
            'url' => Url::to(['/program/get-line'])
        ]
    ]);
    ?>
    <?=
    $form->field($modelD, 'machine')->widget(DepDrop::classname(), [
        'options' => ['id' => 'ddl-machine'],
        'data' => [],
        'pluginOptions' => [
            'depends' => ['ddl-models', 'ddl-line'],
            'placeholder' => 'Select Machince...',
            'url' => Url::to(['program/get-machine'])
        ]
    ]);
    ?>

    <?=
    $form->field($modelD, 'table_machine_id')->widget(DepDrop::classname(), [
        'options' => ['id' => 'ddl-table_machine_id'],
        'data' => [],
        'pluginOptions' => [
            'depends' => ['ddl-models', 'ddl-line','ddl-machine'],
            'placeholder' => 'Select MachineTable...',
            'url' => Url::to(['/program/get-machinetable'])
        ]
    ]);
    ?>



    <?=
    $form->field($model, 'pcb_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(app\models\Pcb::find()->all(), 'id', 'name'),
        'options' => ['placeholder' => 'Select Direction'],
        'pluginOptions' => [
            'allowClear' => true,
        //   'minimumInputLength' => 2,
        ],])
    ?>

    <?= $form->field($model, 'rev')->textInput() ?>

    <?= $form->field($modelD, 'solder_paste')->textarea(['maxlength' => true]) ?>

<?= $form->field($modelImport, 'fileImport')->fileInput() ?>

</div>








<div class="form-group">
<?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>

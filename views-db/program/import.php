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
/* @var $model app\models\StartProgram */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="start-program-form">
       <h1><?= Html::encode($this->title) ?></h1>
    <?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>



    <?=
    $form->field($modelD, 'program_id')->hiddenInput(['value' => $model->id])->label(false);
    ?>
    <?=
    $form->field($modelD, 'line')->dropdownList(
            ArrayHelper::map(Line::find()->all(), 'id', 'name'), [
        'id' => 'ddl-line',
        'prompt' => 'Select Line'
    ]);
    ?>
    <?=
    $form->field($modelD, 'machine')->widget(DepDrop::classname(), [
        'options' => ['id' => 'ddl-machine'],
        'data' => [],
        'pluginOptions' => [
            'depends' => ['ddl-line'],
            'placeholder' => 'Select Machince...',
            'url' => Url::to(['/program/get-machine'])
        ]
    ]);
    ?>

    <?=
    $form->field($modelD, 'table_machine_id')->widget(DepDrop::classname(), [
        'options' => ['id' => 'ddl-table_machine_id'],
        'data' => [],
        'pluginOptions' => [
            'depends' => ['ddl-line', 'ddl-machine'],
            'placeholder' => 'Select MachineTable...',
            'url' => Url::to(['/program/get-machinetable'])
        ]
    ]);
    ?>

    <?= $form->field($modelD, 'solder_paste')->textarea(['maxlength' => true]) ?>

    <?= $form->field($modelImport, 'fileImport')->fileInput() ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
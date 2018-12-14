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
//echo $model->id;
/*echo $modelL;
//print_r($modelM);
die();*/
?>

<div class="start-program-form">
 <h1><?= Html::encode($this->title) ?></h1>
 <?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>

 <?=
 $form->field($modelD, 'machine')->dropdownList(
   ArrayHelper::map(app\models\Machine::find()->where(['Line_id'=>$modelL])->all(), 'id', 'name' ),  [
        'id' => 'ddl-machine',
        'prompt' => 'Select Machine',
         //'type' => DepDrop::TYPE_SELECT2,
    ])->label('Machine');
    ?>


    <?=
    $form->field($modelD, 'table_machine_id')->widget(DepDrop::classname(), [
        'options' => ['id' => 'ddl-table_machine_id'],
        'type' => DepDrop::TYPE_SELECT2,
        'data' => [],
        'pluginOptions' => [
            'depends' => ['ddl-machine'],
            'placeholder' => 'Select TBL...',
            'url' => Url::to(['/program-detail/get-line'])
        ]
    ]);
    ?>

    <?=
    $form->field($modelD, 'program_id')->hiddenInput(['value' => $model->id])->label(false);
    ?>
    <!-- <?=
    $form->field($modelD, 'machine')->dropdownList(
        ArrayHelper::map(app\models\Machine::find()->where(['Line_id'=>$modelL])->all(), 'id', 'name' ), [
            'id' => 'ddl-machine',
            'prompt' => 'Select machine'
        ])->label('Machine');
        ?>


        <?= $form->field($modelD, 'table_machine_id')->widget(DepDrop::classname(), [
            'options' => ['id' => 'ddl-table_machine_id'],
            'data' => [],
            'pluginOptions' => [
                'depends' => ['ddl-machine'],
                'placeholder' => 'Select MachineTable...',
                'url' => Url::to(['/program-detail/get-machinetable'])
            ]
        ]);  ?> -->

















        <?= $form->field($modelD, 'solder_paste')->textarea(['maxlength' => true]) ?>

        <?= $form->field($modelImport, 'fileImport')->fileInput() ?>
        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
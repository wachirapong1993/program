<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\widgets\DepDrop;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Feeder */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="feeder-form">

<?php $form = ActiveForm::begin(); ?>

   

    <?=
    $form->field($model, 'Line_id')->dropdownList(
            ArrayHelper::map(\app\models\Line::find()->all(), 'id', 'name'), [
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
            'url' => Url::to(['/feeder/get-machine'])
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
            'url' => Url::to(['/feeder/get-machinetable'])
        ]
    ]);
    ?>
    <?=
    $form->field($model, 'direction_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(app\models\Direction::find()->all(), 'id', 'name'),
        'options' => ['placeholder' => 'Select Direction'],
        'pluginOptions' => [
            'allowClear' => true,
        //   'minimumInputLength' => 2,
        ],])
    ?>

    <?=
    $form->field($model, 'feeder_point_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(app\models\FeederPoint::find()->all(), 'id', 'id'),
        'options' => ['placeholder' => 'Select Direction'],
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

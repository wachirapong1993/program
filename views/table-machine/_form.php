<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\widgets\DepDrop;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\TableMachine */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="table-machine-form">

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
            'url' => Url::to(['/table-machine/get-machine'])
        ]
    ]);
    ?>
      <?=
    $form->field($model, 'table_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(app\models\Tables::find()->all(), 'id', 'name'),
        'options' => ['placeholder' => 'Select Table'],
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
 
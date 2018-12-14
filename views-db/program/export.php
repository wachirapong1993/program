<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use yii\helpers\Html;
use kartik\select2\Select2;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\widgets\DepDrop;

$this->title = 'Search For Export Arrangement Table';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="program-form">

    <h1><?= Html::encode($this->title) ?></h1>
<?php $form = ActiveForm::begin([]); ?>



    <?=
    $form->field($model, 'name')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(app\models\ProgramDetail::find()->all(), 'id', 'title', 'tableMachine.table.name'),
        'options' => ['placeholder' => 'Select Direction'],
        'pluginOptions' => [
            'allowClear' => true,
        //   'minimumInputLength' => 2,
        ],])
    ?>









    <div class="form-group">
        <?=
        Html::submitButton('Save', ['class' => 'btn btn-success',
            'target' => '_blank',
            'data-toggle' => 'tooltip',
            'title' => 'Will open the generated PDF file in a new window'])
        ?>
    </div>

<?php ActiveForm::end(); ?>
</div>
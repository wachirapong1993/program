<?php

use yii\helpers\Html;
use kartik\select2\Select2;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;

//use kartik\widgets\DepDrop;
//use app\models\Customer;
//use app\models\ModelsP;
//use app\models\Program;
//use kartik\select2\Select2;
//use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\StartProgram */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Scan Part';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>

    <?php
    //echo $details->id;
    ?>
        <?= $form->field($model, 'st_id')->hiddenInput(['value'=> $modelST])->label(false);?>
    
    <?=
    $form->field($model, 'item_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(app\models\ProgramItem::find()->where(['program_detail_id' => $details])->andWhere(['feeder_id' => $feeder_id])->all(), 'part_no', 'part_no'),
        'options' => ['placeholder' => 'Scan Part', 'id' => 'n1'],
        'pluginOptions' => [
            'allowClear' => true,
        //   'minimumInputLength' => 2,
        ],])
    ?>



    <div class="form-group">
        <div class="center-block">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success', 'onClick' => 'fncSubmit()']) ?>
            <?= Html::a('Back', ['/start-program/index', 'id' => $id], ['class' => 'btn btn-danger']) ?>
        </div>
    </div>






    <?php ActiveForm::end(); ?>

</div>
<script type="text/javascript">
//    function fncSubmit()
//    {
//        if (document.getElementById('n1').value == "")
//        {
//            alert('PLEASE INPUT DATA');
//           // document.form.n1.focus();
//            //document.getElementById("n1").focus();
//            
//            //return stop;
//        }
//    }
</script>
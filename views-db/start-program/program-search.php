<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$this->title = 'Search Program';
$this->params['breadcrumbs'][] = ['label' => 'Search-Program', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->registerJS('http://code.jquery.com/jquery-1.7.1.js');
?>

<div>
    <?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>
    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $form->field($model, 'program_search')->textInput(['autofocus' => 'autofocus', 'id' => 'txt1', 'onKeyDown' => 'setNextFocus("txt2");'])
    ?>
    <?=
    $form->field($model, 'part_no')->textInput(['id' => 'txt2', 'onKeyDown' => 'setNextFocus("txt3");'])
    ?>
    <?= $form->field($model, 'emp_code')->textInput(['maxlength' => 20, 'id' => 'txt3', 'onKeyDown' => 'setNextFocus("txt4");'])->label('Production Employee') ?>

    <?= $form->field($model, 'qc_emp')->textInput(['id' => 'txt4']) ?>




    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
<script language="JavaScript">
    document.onkeydown = chkEvent
    function chkEvent(e) {
        var keycode;
        if (window.event)
            keycode = window.event.keyCode; //*** for IE ***//
        else if (e)
            keycode = e.which; //*** for Firefox ***//
        if (keycode == 13)
        {
            return false;
        }
    }

    function setNextFocus(objId) {
        if (event.keyCode == 13) {
            var obj = document.getElementById(objId);
            if (obj) {
                obj.focus();
            }
        }
    }

</script>

<!--    $form->field($model, 'program_search')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(app\models\ProgramDetail::find()->all(), 'id', 'barcode', 'program.modelsP.name'),
        'options' => ['placeholder' => 'Select Direction'],
        'pluginOptions' => [
            'allowClear' => true,
        //   'minimumInputLength' => 2,
        ],])
    
    $form->field($model, 'part_no')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(app\models\Item::find()->all(), 'part_no', 'part_no'),
        'options' => (['placeholder' => 'Select Direction']),
        'pluginOptions' => [
            'allowClear' => true,
        //   'minimumInputLength' => 2,
        ],])-->

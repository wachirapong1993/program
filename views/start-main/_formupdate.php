<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\widgets\ActiveForm;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<div class="start-main-form">
    <div class="container">
        <?php $form = ActiveForm::begin(); ?>
        <h1>Input Production </h1>
        <div class="row">
            <div class="col-sm-6">
                <?=
                $form->field($model, 'amount')->textInput();
                ?>
            </div>
            <div class="col-sm-6" >
                <?=
                $form->field($model, 'program_status_id')->dropdownList(
                        ArrayHelper::map(app\models\ProgramStatus::find()->all(), 'id', 'name'), [
                    // 'id' => 'ddl-customer',
                    'prompt' => 'Select Status'
                ]);
                ?>
            </div>
        </div>
        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>






</div>

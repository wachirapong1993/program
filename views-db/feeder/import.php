<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;

/* use yii\bootstrap\ActiveForm;
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$this->title = 'Import Feeder';
$this->params['breadcrumbs'][] = ['label' => 'Feeders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="program-form">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data'], 'layout' => 'horizontal']); ?>
<?= $form->field($modelImport, 'fileImport')->fileInput() ?>

    <div class="form-group">
<?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

<?php ActiveForm::end(); ?>
</div>
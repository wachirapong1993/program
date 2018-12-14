<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\JoidPartSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="joid-part-search">

    <?php
    $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
    ]);
    ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'check_feeder') ?>

    <?= $form->field($model, 'check_part') ?>

    <?= $form->field($model, 'lot_no') ?>

<?= $form->field($model, 'total') ?>



    <?php echo $form->field($model, 'program') ?>

    <?php // echo $form->field($model, 'line') ?>

    <?php // echo $form->field($model, 'item_id') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

        <?php // echo $form->field($model, 'start_detail_id')  ?>

    <div class="form-group">
<?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
    <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

<?php ActiveForm::end(); ?>

</div>

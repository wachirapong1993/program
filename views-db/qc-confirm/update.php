<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\QcConfirm */

$this->title = 'Update Qc Confirm: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Qc Confirms', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="qc-confirm-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

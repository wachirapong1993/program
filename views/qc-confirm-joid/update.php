<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\QcConfirmJoid */

$this->title = 'Update Qc Confirm Joid: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Qc Confirm Joids', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="qc-confirm-joid-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

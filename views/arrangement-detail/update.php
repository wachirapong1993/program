<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ArrangementDetail */

$this->title = 'Update Arrangement Detail: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Arrangement Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="arrangement-detail-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

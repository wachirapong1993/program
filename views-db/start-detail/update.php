<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\StartDetail */

$this->title = 'Update Start Detail: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Start Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="start-detail-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CheckStatus */

$this->title = 'Update Check Status: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Check Statuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="check-status-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

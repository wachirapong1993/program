<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PartType */

$this->title = 'Update Part Type: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Part Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="part-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

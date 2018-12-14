<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\JoidPart */

$this->title = 'Update Joid Part: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Joid Parts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="joid-part-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

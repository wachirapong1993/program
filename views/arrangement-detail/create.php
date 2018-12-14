<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ArrangementDetail */

$this->title = 'Create Arrangement Detail';
$this->params['breadcrumbs'][] = ['label' => 'Arrangement Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="arrangement-detail-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
